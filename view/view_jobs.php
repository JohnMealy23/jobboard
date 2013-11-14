<div class="row contents">
	<div class="col-md-3 col-lg-2 left-column">
		<h3><? echo $language; ?></h3>
	</div>
	<div class="col-md-9 col-lg-10 right-column">
		<div class="row">
			<?			
			foreach($obj->listings as $row) {
				if($row['active'] == 1) {
				  	  echo "<div class='col-xs-12 col-md-6 col-lg-4 posts'>";
					  echo "<h3>" . $row['title'] . "</h3>";
					  echo "<p class='subtext'>Job ID: " . $row['id'] . "</p>";
					  echo "<p>Department: " . $row['department'] . "</p>";
					  echo "<p>Description: " . $row['description'] . "</p>";
					  echo "<p>Requirements:" . $row['requirements'] . "</p>";
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
			 ?>
		</div>	
	</div>
</div>