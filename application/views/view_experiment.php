<h2>BuildEx: Experiment</h2>

<fieldset>
	<legend>View Experiment</legend>

	<label>Title</label><br/>
	<input type="text" id="title" required name="title" value="<?php echo $experiment->title; ?>" placeholder="Title"><br/><br/>

	<label>Description</label><br/>
	<input type="text" id="description" required name="description" value="<?php echo $experiment->description; ?>" placeholder="Description"><br/><br/>

	<label>Target Count</label><br/>
	<input type="text" id="targetCount" required name="target_count" value="<?php echo $experiment->target_count; ?>" placeholder="Target Count"><br/><br/>

</fieldset>