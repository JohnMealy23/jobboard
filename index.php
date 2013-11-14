<?
//////////////////////////////Config//////////////////////////////
	
	$default_email = "default@email.com";		
	
	if(substr( $_SERVER['HTTP_HOST'], 0, 4 ) == 'dev.') { 
		$base_url = '';
	} else {
		$base_url = "http://notiondigitalarts.com/testing/busted";
	}
	
	//DB	
	if(substr( $_SERVER['HTTP_HOST'], 0, 4 ) == 'dev.') { 
	Config::write('db.host', 'localhost');
	 } else { 
	Config::write('db.host', 'busted.db.8947470.hostedresource.com');
	 }
	Config::write('db.user', 'busted');
	Config::write('db.port', '3306');
	Config::write('db.basename', 'busted');
	Config::write('db.password', 'L@t3rG4t0r');
	

//////////////////////////////Controller//////////////////////////////

	$ct = null;
	$jobid = null;
	$notification = null;
	$admin = false;
	$language = "";

	//Get destination:
	$qry_str = $_SERVER['QUERY_STRING'];
	parse_str ($qry_str);
	
	if($ct == "listingindex"){
		$admin = true;
		
		$obj = new Job();
		$obj->getAll('*');
		
		$language = "Select a job listing to edit.";
		include 'view/view_header.php';
		include 'view/view_adminindex.php';
		include 'view/view_footer.php';
	} 
	
	
	else if($ct == 'jobinput') {
	
		$admin = true;
		
		//Job has been input.  Add to DB and display results:
		if(isset($_POST["id"])) {
			//ID is already set. This is an entry revision. Update DB entry.
			 
			//Open Job object
			$job = new Job();
					
			//Collect POST data:
			if(isset($_POST["title"])) { $job->title = $_POST["title"]; }
			if(isset($_POST["description"])) { $job->description = $_POST["description"]; }
			if(isset($_POST["requirements"])) { $job->requirements = $_POST["requirements"]; }
			if(isset($_POST["contact_email"])) { $job->contact_email = $_POST["contact_email"]; }
			if(isset($_POST["department"])) { $job->department = $_POST["department"]; }
			if(isset($_POST["on_location"])) {
				if($_POST["on_location"] == 'on') {
					$job->on_location = '1'; 
				};
			}
			if(isset($_POST["active"])) {
				if($_POST["active"] == 'on') {
					$job->active = '1'; 
				};
			}
			$job->id = $_POST["id"];

			//Update DB:
			$job->save();
			
			$obj = new Job();
			$obj->getAll('*');
			//Pull data back out of DB
			//$job->Object($job->id);
		
			//Render the page
			//$post = $job->job_result[0];	
			//$requirements = $job->requirement_result;
			
			$notification = 'Job has been updated.';
			$language = "Select a posting to update.";
			include 'view/view_header.php';
			include 'view/view_adminindex.php';
			include 'view/view_footer.php';
			exit;
			
		} else if(isset($jobid)){
			//Go to job entry page, populated with requested job
			
			$job = new Job();
			$job->Object($jobid);
			//Render the page
			
			$post = $job->job_result[0];
			$requirements = $job->requirement_result;		
			$language = "Update the job posting.";

			
			include 'view/view_header.php';
			include 'view/view_jobentry.php';
			include 'view/view_footer.php';
			exit;
			
		} else {
			//Enter a new job into the DB:
			
			$job = new Job();
			$post = $job->job_array();
			$post['id'] = 'New Entry';
						
			$language = "Enter a new job.";
			include 'view/view_header.php';
			include 'view/view_jobentry.php';
			include 'view/view_footer.php';
			exit;
		}
	} else if($ct == 'del') {
			$obj = new Job();
			$obj->id = $jobid;

			//Update DB:
			$obj->del();

			$obj->getAll('*');
			
			$notification = 'Job Listing has been deleted.';
			$language = 'Select a posting to update.';
			include 'view/view_header.php';
			include 'view/view_adminindex.php';
			include 'view/view_footer.php';
			exit;
	} else {
		$obj = new Job();
		$obj->getAll('*');
		
		$language = "Please select from the following jobs.";
		include 'view/view_header.php';
		include 'view/view_jobs.php';
		include 'view/view_footer.php';
		exit;
	}

	
	
//////////////////////////////Model//////////////////////////////

	class Object {
		
		public $job_result = array();
		public $requirement_result = array();

	    public function Object($int=null) {
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
				
				$this->listing = $db->Database($query);
				
				$result[] = mysqli_fetch_array($this->listing, MYSQLI_ASSOC);
								
		//Collapse top level for single row array.  Retains index names.
				//foreach($this->job as $key => $value) {	
			  		foreach($result as $index => $field) {
			  			$this->job_result[$index] = $field;
			  		//}
				};

				unset($query_parts);	
		// Gather requirements	
					
				// $query_parts = array(
					// 'columns' => 'requirement',
					// 'table' => 'requirement_associative',
					// 'prop' => 'idpost',
					// 'arg' => $int
				// );
// 				
				// $query = "SELECT " . $query_parts['columns'] . " FROM " . $query_parts['table'] . " WHERE " . $query_parts['prop'] . " = " . $query_parts['arg'];
// 							
				// $this->db_reqs = $db->Database($query);
// 				
				// while($row = mysqli_fetch_array($this->db_reqs, MYSQLI_NUM)) {
				  	// $this->req[] = $row;
				// }
// 			
			// //Collapse top level for multiple row array.  Abandon index names.
				// $i = 0;
			  	// foreach($this->req as $key => $value) {	
			  		// foreach($value as $index => $field) {
			  			// $this->requirement_result[$i] = $field;
						// $i++;
			  		// }
				// };
				// unset($i);
				
	    	} else {
	
				
	    	}
	    }
		
		public function getAll($ids = null) {
			$db = new DB();	
			
			$id_str = "WHERE ";
			
			if(is_array($ids)) {
			//If multiple values are requested
				foreach($id as $value) {
					$id_str .= 'idpost = ' . $value . ',';
				}
				$columns_str = substr($columns_str, 0, -1);
			} elseif($ids == '*') {
			//If all entries are requested:
				$id_str = "";
			} else {
			//If a single entry is requested
				$id_str .= 'idpost = ' . $ids;
			}
			
			$query_parts = array(
				'columns' => '*',
				'table' => 'job',
				'where' => $id_str
			);
			
			$query = "SELECT " . $query_parts['columns'] . " FROM " . $query_parts['table'] . $query_parts['where'];
			
			$this->result = $db->Database($query);
				
			while($listing = mysqli_fetch_array($this->result, MYSQLI_ASSOC)){
					$this->listings[] = $listing;
			};
						
			unset($query_parts);
			unset($query);
		}
		
		function field() {
			
		}
		
		function del() {
		
		
			
			$db = new DB();
			$query = "DELETE FROM job WHERE id=". $this->id;
			$db->Database($query);
		}
		
	}

	class Job extends Object {
		
		public $job = array();
		public $id = "";
		public $title = "";
		public $description = "";
		public $requirements = "";
		public $contact_email = "";
		public $department = "";
		public $on_location = 1;
		public $active = 1;
		
		function job_array() {
			$this->job = array(
				'id' => $this->id,
				'title' => $this->title,
				'description' => $this->description,
				'requirements' => $this->requirements,
				'contact_email' => $this->contact_email,
				'department' => $this->department,
				'on_location' => $this->on_location,
				'active' => $this->active
			);
				
				return $this->job;
		}
		
		function save() {
		
			$db = new DB();
			$eggs = "";

			if($this->id == "New Entry") {
			//Insert data into new DB entry:
				
				$entries = $this->job_array();
				
				//Unset ID so that the BD auto-creates one
				unset($entries['id']);
				
				$query = "INSERT INTO job (";
				
				foreach ($entries as $key => $value) {
					$query .= $key . ", ";
				};
				
				$query = substr($query, 0, -2);
				
				$query .= ") VALUES ('";
								
				foreach ($entries as $value) {
					$query .= $value . "', '";
				};
				
				$query = substr($query, 0, -3);
				
				$query .= ")";
				
								
			} else {
			//Insert data into existing DB entry:
				
				$columns_str = "";
				
				foreach ($this->job_array() as $key => $value) {
					$columns_str .= $key . " = '" . $value . "', ";
				};
				
				$columns_str = substr($columns_str, 0, -2);
				
				$query_parts = array(
						'table' => 'job',
						'columns' => $columns_str,
						'prop' => 'id',
						'arg' => $this->id,
				);
			
				$query = "UPDATE " . $query_parts['table'] . " SET " . $columns_str . " WHERE " . $query_parts['prop'] . "=" . $query_parts['arg'];
				
			}
			$this->listing = $db->Database($query);
		}
		
	}			

	class DB {
		public function Database($query, $err = null){
			if($err) {
				print_r($query); echo "<br>";	
				echo '<br>' . $err . "<br>";
				
			}
			
			$con = mysqli_connect(Config::read('db.host'),"busted","L@t3rG4t0r","busted");
			
			if (mysqli_connect_errno($con)) {
				
			  echo "Failed to connect to DB: " . mysqli_connect_error();
			};
			
			$result = $con->query($query);
			if (!$result) {
				echo "Query result error: ";
			    printf("Error: %s\n", mysqli_error($con));
			    exit();
			};
			
			unset($query);

			mysqli_close($con);
			
			return $result;
		} 
		
	}	
	
	class Config {
		
	    static $confArray;
	
	    public static function read($name) {
	        return self::$confArray[$name];
	    }
	
	    public static function write($name, $value) {
	        self::$confArray[$name] = $value;
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
