<h2>BuildEx: Create Experiment</h2>

 <fieldset>
	<legend>Sign Up</legend>
	<?php echo validation_errors();?>
	<?php echo form_open("experiment/add_experiment") . "<br/>";?>

	<label>Title</label><br/>
	<input type="text" id="title" required name="title" placeholder="Title"><br/><br/>

	<label>Description</label><br/>
	<input type="text" id="description" required name="description" placeholder="Description"><br/><br/>

	<label>Target Count</label><br/>
	<input type="text" id="targetCount" required name="target_count" placeholder="Target Count"><br/><br/>

	<input type="submit" value="Create Experiment">
	<?php echo form_close();?>
</fieldset>