<?

//Model:

	class DB {
		public function Database($query_parts){
			
			$con = mysqli_connect("localhost","busted","3LVyRVEHaXppEyYM","busted");
			
			$query = "SELECT " . $query_parts['columns'] . " FROM " . $query_parts['table'] . " WHERE " . $query_parts['prop'] . " = " . $query_parts['arg'];
					
			if (mysqli_connect_errno($con)) {
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			};
			
			$result = $con->query($query);
			if (!$result) {
			    printf("Error: %s\n", mysqli_error($con));
			    exit();
			};
			return $result;
		} 
	}				
	
	class Object {
		
		// public function getColumn($sql, $params)
			// {
			    // $stmt = $this->db->prepare($sql);
			    // $stmt->execute($params);
			    // return $stmt->fetchColumn();
// 				
			// }

		
	    function Object($int=null) {
	    	if($int) {
	    		$this->test = 'success';
				
				$query_parts = array(
					'columns' => '*',
					'table' => 'job',
					'prop' => 'id',
					'arg' => $int
				);
				
				$db = new DB();
				
				$this->listing = $db->Database($query_parts);
				
				
				
				$query_parts = array(
					'columns' => 'requirement',
					'table' => 'requirement_associative',
					'prop' => 'id_associative',
					'arg' => $int
				);
				
				$this->requirements = $db->Database($query_parts);
				
				// //$job_query = mysqli_query($con,"SELECT * FROM job WHERE id = '" . $int . "'");
				while($row = mysqli_fetch_array($this->listing, MYSQLI_ASSOC)) {
				  	$job[] = $row;
				  }
				
				 //$requirement_query = mysqli_query($this->con,"SELECT requirement FROM requirement_associative WHERE idpost = '" . $int . "'");

				  // while($row = mysqli_fetch_array($requirement_query, MYSQLI_NUM)) {
				  	// $req[] = $row;
				  // }
				// foreach ($req as $key => $value) { 
    				// $requirements[$key] = $value;
				// };
				  
			  	 foreach ($job as $key => $value) { 
		            //foreach ($values as $key => $value) {
		                $this->title = $key['title'];
			    		$this->description = $key['description'];
			    		$this->requirements = $this->requirements;
						$this->contact_email = $key['contact_email'];
			    		$this->department = $key['department'];
			    		$this->on_location = $key['on_location'];
			    		$this->active = $key['active'];
		            //}
		        }									  
			  
			  	return $job;
			  
	    	} else {
	    		$this->title = "";
	    		$this->description = "";
	    		$this->requirements = array();
	    		$this->contact_email = "";
	    		$this->department = "";
	    		$this->on_location = 1;
	    		$this->active = 1;
	    	}
	    }
		
		function getAll($array) {
			
		}
		
		function field() {
			
		}
		
		function save() {
			
		}
		
	}

	//	mysqli_close($con);

//Controller:
	
	
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

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Busted Tees Job Board</title>
		<meta name="description" content="The front-end portion of Busted help-wanted.">
		<meta name="author" content="John Mealy">

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="/favicon.ico">
		
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet/less" type="text/css" href="css/styles.less" />
        
        <?php 
			if(substr( $_SERVER['HTTP_HOST'], 0, 4 ) != 'dev.') { ?>
				<script type="text/javascript" src="js/jquery-1.10.2.min.js" charset="utf-8"></script>
			<?php } else { ?>
				<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
			<? }
		?>
        <script src="js/modernizr-2.6.2.min.js"></script>
        <script> /* Provisory for dev environment: */ localStorage.clear(); </script>
        <script type="text/javascript">var less=less||{};less.env='development';</script>
        <script>less = {}; less.env = 'development';</script>
        <script src="js/less-1.5.0.min.js?ts=<?=time()?>" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
	</head>
	<body>
		<?
		$obj = new Object();
		$stuff = $obj->Object('00000002');
		
		print_r($stuff);
		?>
		<header>
			<h1>Busted Tees Job Board</h1>
			
			<nav>
				<p>
					<a href="/">Home</a>
				</p>
				<p>
					<a href="/contact">Contact</a>
				</p>
			</nav>
		</header>
		<div class="container">
			
			
			<div class="row">
				<div class="col-md-4">
					<p>Welcome to our job board.</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
					<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p> 
					<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
				<div class="col-md-8">
					<div class="row">
						<!-- 
						<?php
						while($row = mysqli_fetch_array($jobs, MYSQLI_ASSOC))
						  {
							  if($row['active'] == 1) {
							  	  echo "<div class='col-md-5 col-xs-12 col-md-offset-1 posts'>";
								  echo "<h3>" . $row['title'] . "</h3>";
								  echo "<p class='subtext'>Job ID: " . $row['id'] . "</p>";
								  echo "<p>Department: " . $row['department'] . "</p>";
								  echo "<p>Description: " . $row['description'] . "</p>";
								  echo "<p>Requirements:</p>";
								  echo "<ul>";
								  $requirements = mysqli_query($con,"SELECT requirement FROM requirement_associative WHERE idpost = '" . $row['id'] . "'");
								  while($require = mysqli_fetch_array($requirements, MYSQLI_NUM)) {
								  	$posts[] = $require;
								  }
								  foreach ($posts as $values) { 
							            foreach ($values as $value) {
							                echo "<li>" . $value . "</li>";
							            }
							        }									  
								  unset($posts);
								  echo "</ul>";
								  echo "<p>On location:  "; 
								  if($row['on_location'] == 1) {
								  	echo "Yes.</p>";
								  } else {
								  	echo "No.</p>";
								  };
								  echo "<a href='mailto:" . $row['contact_email'] . "' class='applyLink'><b>Click to apply!</b></a></p><br>";
								  echo "</div>";	  
							  }
						  }
						 ?> -->
					</div>	
				</div>
			</div>
		</div>

		<footer>
			
		</footer>
	</body>
</html>
