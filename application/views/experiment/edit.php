<h2>BuildEx: Experiment</h2>

<fieldset>
	<legend>Edit Experiment</legend>
	<?php echo form_open(format_experiment_link($role, $id, $experiment).'/update'); ?>

		<label>Title</label><br/>
		<input type="text" id="title" required name="title" value="<?php echo $experiment->title; ?>">

		<label>Description</label><br/>
		<input type="text" id="description" required name="description" value="<?php echo $experiment->description; ?>">

		<label>Target Count</label><br/>
		<input type="text" id="targetCount" required name="target_count" value="<?php echo $experiment->target_count; ?>">

		<input type="submit" class = "button small" value="Submit">
	<?php echo form_close();?>
</fieldset>