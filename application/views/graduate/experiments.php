<h3> Graduate: Experiments </h3>
<hr>
<!-- Notification Handling Part-->
<?php if(isset($notification)): ?>
	<pre> <?php echo $notification; ?> </pre>
<?php endif; ?>

<h2>My Experiments</h2>
<?php if(isset($experiments)):
 ?>
	<?php foreach ($experiments as $experiment):?>
		<?php echo anchor('graduate/view_experiment/'.$gid.'/'.$experiment->eid, $experiment->title); ?>
		<?php echo form_open('experiment/delete_experiment/'.$experiment->eid); ?>
		<?php echo form_submit('submit','Delete'); ?>
		<?php echo form_close(); ?>
		<a href = "<?php echo site_url('experiment/edit_experiment/'.$experiment->eid); ?>"> Edit </a> <!--Change to button please.-->
		</br>
	<?php endforeach; ?>	
<?php else: ?>
	<p> You have no experiments </p>
<?php endif; ?>
<br>
<hr>
<!-- Modal - Create Experiment -->
<div id="createExperiment" class="reveal-modal tiny" data-reveal>
  <h2>Create an Experiment</h2>
	<?php echo validation_errors();?>
	<?php echo form_open("experiment/add_experiment");?>

	<label>Title</label>
	<input type="text" id="title" required name="title" placeholder="Title">

	<label>Description</label>
	<input type="text" id="description" required name="description" placeholder="Description">

	<label>Target Count</label><br/>
	<input type="text" id="targetCount" required name="target_count" placeholder="Target Count"><br/><br/>

	<input type="submit" class="button" value="Create Experiment">

	<?php echo form_close();?>
  <a class="close-reveal-modal">&#215;</a>
</div>
<a href="#" data-reveal-id="createExperiment">Create Experiment</a>
<!-- <a href = "<?php echo site_url('experiment'); ?>">Create Experiment</a><br/> -->