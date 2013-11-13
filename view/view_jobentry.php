<div class="row">
	<div class="col-md-4">
		<h2>Update the job posting.</h2>
	</div>
	<div class="col-md-8">
		<div class="row">
			
			<?
				$post = $obj->job[0];	
				$requirements = $obj->requirements;			
			?>										
			  	  <div class='col-xs-12 posts'>
			  	  <form action="/?ct=jobinput" method="post">
				  <table width="100%">
				  <tr><td width='15%'><label for='title'>Title: </label></td><td width="80%"><input autofocus autocomplete="on" width='100%' type='text' name='title' value='<?echo $post['title']; ?>'></td></tr>
				  <tr><td><p class='subtext'>ID: </p></td><td><p><? echo $post['id']; ?></p><input type='hidden' name='id' value='<? echo $post['id']; ?>'></td></tr>
				  <tr><td><label for='department'>Department: </label></td><td><input autocomplete="on" width='100%' type='text' name='department' value='<? echo $post['department']; ?>'></td></tr>
				  <tr><td><label for='description'>Description: </label></td><td><input autocomplete="on" type='text' name='description' value='<? echo $post['description']; ?>'></td></tr>
				  <tr><td><label for='requirements'>Requirements: </label></td>
				  	
				  <td><input autocomplete="on" type='text' class='requirements' name='requirements' value='<? echo $post['requirements']; ?>'>
				  <!-- <? 
				  $i = 0;
				  foreach ($requirements as $value) { ?>
			      <td><input autocomplete="on" type='text' class='requirement' name='requirement<? echo $i; ?>' value='<? echo $value; ?>'></td></tr>
			      <tr><td></td>
			      <? $i++; } unset($i);?>	
			      </td></tr> -->
				  <!--<tr><td></td><td align='right'><a class="AddAnother" id="AddDirection" alt="Direction">+ add a requirement</a></td></tr>-->
				  <tr><td class='spacing'></td><td></td></tr>
				  <tr><td><label for='contact_email'>Contact Email: </label></td><td><input autocomplete="on" type='text' name='contact_email' value='<? echo $post['contact_email'] ?>'></td></tr>
				  <tr><td><label for='on_location'>On location? </label></td><td><input type='checkbox' name='on_location' checked='<? if($post['on_location'] == 1) {echo 'checked';}; ?>'></td></tr> 
				  <tr><td><label for='active'>Active? </label></td><td><input type='checkbox' name='active' checked='<? if($post['active'] == 1) {echo 'checked';}; ?>'></td></tr>
				  <tr><td></td><td><input name='recipesubmit' value='Submit' type='submit'></td></tr>
				  </table>
				  </form>
				  </div>	
			 
			 </form>
		</div>	
	</div>
</div>