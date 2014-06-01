<?php echo form_open(format_experiment_link($role, $id, $experiment)."/{$action}");?>
	<fieldset>
		<legend> Experiment </legend>
		<label>Title</label>
		<input type="text" id="title" required name="title" placeholder="Title">

		<label>Description</label>
		<input type="text" id="description" required name="description" placeholder="Description">

		<label>Target Count</label><br/>
		<input type="text" id="targetCount" required name="target_count" placeholder="Target Count"><br/><br/>

		<input type="submit" class="button small" value="Create Experiment">
	</fieldset>
<?php echo form_close();?>