<div class="row contents">
	<div class="col-md-3 col-lg-2 left-column">
		<h3><? echo $language; ?></h3>
	</div>
	<div class="col-md-9 col-lg-10 right-column">
		<div class="row">
			<?
			if(isset($obj->listings)) {
				foreach($obj->listings as $row) {
				  	  echo "<div class='col-lg-4 col-md-6 col-xs-12 posts'>";
					  echo "<a id='" . $row['id'] . "' alt='" . $base_url . "/?ct=del&jobid=" . $row['id'] . "' class='delete'><img src='imgs/x.png'></a>";
					  echo "<h3>" . $row['title'] . "</h3>";
					  echo "<p class='subtext'>Job ID: " . $row['id'] . "</p>";
					  echo "<p>Department: " . $row['department'] . "</p>";
					  echo "<p>Description: " . $row['description'] . "</p>";
					  echo "<p>Requirements:" . $row['requirements'] . "</p>";
					  echo "<p>Contact Email:" . $row['contact_email'] . "</p>";
					  echo "<p>On location:  "; 
					  if($row['on_location'] == 1) {
					  	echo "Yes.</p>";
					  } else {
					  	echo "No.</p>";
					  };
					  echo "<p>Active Listing:  "; 
					  if($row['active'] == 1) {
					  	echo "Yes.</p>";
					  } else {
					  	echo "No.</p>";
					  };
							
					  echo "<a href='" . $base_url . "/?ct=jobinput&jobid=" . $row['id'] . "' class='applyLink'><b>Click to Update Entry</b></a></p><br>";
					  echo "</div>";	  
					}
			 } else {
			 		echo "<div class='col-xs-12 posts'>";
					echo "<h3>No jobs currently posted.  Please <a href='" . $base_url . "/?ct=jobinput'>enter a job</a>.</h3>";
					echo "</div>";
				}
			 ?>
			 
			 <script>
			 	$(document).on( 'click', '.delete', function(){
			 		var url = $(this).attr('alt');
			 		var id =  $(this).attr('id');
			 		var conf = window.confirm('Are you sure you wish to delete job ' + id + '?');
			 		if(conf == true) {
			 			window.location.replace(url);
			 		};
			 	});
			 </script>
		</div>	
	</div>
</div>