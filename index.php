<?
//Controller:
	$qry_str = $_SERVER['QUERY_STRING'];
	
	$ct = null;
	$notification = null;
	parse_str ($qry_str);

	if($ct == "listingindex"){
		
		
		include 'view/view_header.php';
		include 'view_adminindex.php';
		include 'view/view_footer.php';
	}
	
	else if($ct == 'jobinput') {
	//Job has been input.  Add to DB and display results:
		
		if(isset($_POST["id"])) {
			//ID is already set. This is an entry revision. Update DB entry.
			 
			//Open Job object
			$job = new Job();
			$job_container = $job->job();
					
			//Collect POST data:
			if(isset($_POST["title"])) { $job_container->title = $_POST["title"]; } else {echo "POST was not recieved."; die;}
			if(isset($_POST["description"])) { $job_container->description = $_POST["description"]; }
			if(isset($_POST["requirements"])) { $job_container->requirements = $_POST["requirements"]; }
			if(isset($_POST["contact_email"])) { $job_container->contact_email = $_POST["contact_email"]; }
			if(isset($_POST["department"])) { $job_container->department = $_POST["department"]; }
			if(isset($_POST["on_location"])) {
				if($_POST["on_location"] == 'on') {
					$job_container->on_location = '1'; 
				};
			}
			if(isset($_POST["active"])) {
				if($_POST["active"] == 'on') {
					$job_container->active = '1'; 
				};
			}
			if(isset($_POST["id"])) { $id = $_POST["id"]; }

			//Update DB:
			$job->update_entry($job_container, $id);
			
			//Render the page
			$obj = new Object();
			$obj->Object($id);
			$notification = 'Job Listing has been Updated';
			include 'view/view_header.php';
			include 'view/view_jobentry.php';
			include 'view/view_footer.php';
			exit;
			
		} else if($jobid){
			//Go to job entry page
			
			$obj = new Object();
			$obj->Object($jobid);
					
			include 'view/view_header.php';
			include 'view/view_jobentry.php';
			include 'view/view_footer.php';
			exit;
		} else {
			include 'view/view_header.php';
			include 'view/view_jobentry.php';
			include 'view/view_footer.php';
			exit;
		}
	} else {
		include '/view/view_header.php';
		echo "<br><br><br><br><br><h1>Page not found!</h1><br><br><br><br><br>";
		include 'view/view_footer.php';
		exit;
	}

	
//Model:
	class Job {
		
		function job() {
			$this->id = null;
			$this->title = "";
			$this->description = "";
			$this->requirements = "";
			$this->contact_email = "";
			$this->department = "";
			$this->on_location = 1;
			$this->active = 1;

		}
		
		function update_entry($job_container, $id) {
			
			$columns_str = "";
			
			foreach ($job_container as $key => $value) {
				$columns_str .= $key . " = '" . $value . "', ";
			};
			
			$columns_str = substr($columns_str, 0, -2);
			
			$query_parts = array(
					'table' => 'job',
					'columns' => $columns_str,
					'prop' => 'id',
					'arg' => $id,
			);
		
			$query = "UPDATE " . $query_parts['table'] . " SET " . $columns_str . " WHERE " . $query_parts['prop'] . "=" . $query_parts['arg'];
				
			$db = new DB();

			$this->listing = $db->Database($query);

		}
		
	}

	class DB {
		public function Database($query){
			//print_r($query); echo "<br>";
			
			$con = mysqli_connect("localhost","busted","3LVyRVEHaXppEyYM","busted");
			
			if (mysqli_connect_errno($con)) {
				
			  echo "Failed to connect to DB: " . mysqli_connect_error();
			};
			
			$result = $con->query($query);
			if (!$result) {
				
			    printf("Error: %s\n", mysqli_error($con));
			    exit();
			};
			
			unset($query);

			mysqli_close($con);
			
			return $result;
		} 
		
	}				
	
	class Object {

	    function Object($int=null) {
	    	if($int) {
	    			
	    		$db = new DB();			
		
		// Gather posting
				$query_parts = array(
					'columns' => '*',
					'table' => 'job',
					'prop' => 'id',
					'arg' => $int
				);
				
				$query = "SELECT " . $query_parts['columns'] . " FROM " . $query_parts['table'] . " WHERE " . $query_parts['prop'] . " = " . $query_parts['arg'];				
				
				unset($query_parts);
				
				$this->listing = $db->Database($query);
				
				$this->job[] = mysqli_fetch_array($this->listing, MYSQLI_ASSOC);

		//Collapse top level for single row array.  Retains index names.
				foreach($this->job as $key => $value) {	
			  		foreach($value as $index => $field) {
			  			$this->post[$index] = $field;
			  		}
				};
								
		// Gather requirements	
					
				$query_parts = array(
					'columns' => 'requirement',
					'table' => 'requirement_associative',
					'prop' => 'idpost',
					'arg' => $int
				);
				
				$query = "SELECT " . $query_parts['columns'] . " FROM " . $query_parts['table'] . " WHERE " . $query_parts['prop'] . " = " . $query_parts['arg'];
							
				$this->db_reqs = $db->Database($query);
				
				while($row = mysqli_fetch_array($this->db_reqs, MYSQLI_NUM)) {
				  	$this->req[] = $row;
				}
			
			//Collapse top level for multiple row array.  Abandon index names.
				$i = 0;
			  	foreach($this->req as $key => $value) {	
			  		foreach($value as $index => $field) {
			  			$this->requirements[$i] = $field;
						$i++;
			  		}
				};
				unset($i);
				
	    	} else {
	    		
				//New job
				
				
				
	    	}
	    }
		
		function getAll($ids) {
			$db = new DB();	
			
			$query_parts = array(
				'columns' => '*',
				'table' => 'job',
				'prop' => 'idpost',
				'arg' => $ids
			);
			
			$query = "SELECT " . $query_parts['columns'] . " FROM " . $query_parts['table'] . " WHERE " . $query_parts['prop'] . " = " . $query_parts['arg'];
			
			$this->result = $db->Database($query);
				
			while($listing = mysqli_fetch_array($this->listings, MYSQLI_ASSOC)){
					$listings[] = $listing;
			};
			
			print_r($listings);
			
			unset($query_parts);
			unset($query);
		}
		
		function field() {
			
		}
		
		function save() {
			
		}
		
	}



	
// update_title($title);
// 
// update_description($desc);
// 
// update_requirements($requirements);
// 
// set_active();
// 
// set_inactive();



//Store HTML in DB: htmlentities.($mything);



//View: 


?>
