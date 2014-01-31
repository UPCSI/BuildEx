<h3> Graduate: Experiments </h3>
<hr>
<h2>My Experiments</h2>
<?php if(isset($experiments)): ?>
	<?php foreach ($experiments as $experiment):?>
		<?php echo anchor('experiment/view/' . $experiment->eid, $experiment->title); ?>
		</br>
	<?php endforeach; ?>	
<?php else: ?>
	<p> You have no experiments </p>
<?php endif; ?>
<br>
<hr>
<fieldset>
	<legend>Create Experiment</legend>
	<?php echo validation_errors();?>
	<?php echo form_open("experiment/add_experiment"); ?>
	<br>

	<label>Title</label><br/>
	<input type="text" id="title" required name="title" placeholder="Title"><br/><br/>

	<label>Description</label><br/>
	<input type="text" id="description" required name="description" placeholder="Description"><br/><br/>

	<label>Target Count</label><br/>
	<input type="text" id="target_count" required name="target_count" placeholder="Target Count"><br/><br/>

	<input type="submit" value="Create">
	<?php echo form_close();?>
</fieldset>