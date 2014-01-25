<h2>BuildEx: Experiment</h2>

 <fieldset>
	<legend>Create Experiment</legend>
	<?php echo validation_errors();?>
	<?php echo form_open("experiment/add_experiment") . "<br/>";?>

	<label>Title</label><br/>
	<input type="text" id="title" required name="title" placeholder="Title"><br/><br/>

	<label>Description</label><br/>
	<input type="text" id="description" required name="description" placeholder="Description"><br/><br/>

	<label>Category</label><br/>
	<input type="text" id="category" required name="category" placeholder="Category"><br/><br/>

	<label>Target Count</label><br/>
	<input type="text" id="targetCount" required name="target_count" placeholder="Target Count"><br/><br/>

	<div class ="form-group">
		<label>Privacy</label>
		<label class = "radio-inline">
			<?php echo form_radio('privacy','0',TRUE,'data-toggle = "radio" id="privacy1"');?>Private
		</label>
		<label class = "radio-inline">
			<?php echo form_radio('privacy','1',FALSE,'data-toggle = "radio" id="privacy2"');?>Public
		</label>
		<label class = "radio-inline">
			<?php echo form_radio('privacy','2',FALSE,'data-toggle = "radio" id="privacy3"');?>Laboratory
		</label>
	</div>

	<input type="submit" value="Create Experiment">
	<?php echo form_close();?>
</fieldset>