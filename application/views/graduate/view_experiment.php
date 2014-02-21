<h3>Experiment</h3>
<hr>

<!-- Notification Handling Part-->
<?php if(isset($notification)): ?>
	<div data-alert class="alert-box info"> <?php echo $notification; ?> <a href="#" class="close">&times;</a> </div>
<?php endif; ?>

<a href = "<?php echo site_url('builder/app/'.$experiment->eid); ?>"> Go to Experiment Builder </a>
<h2> <?php echo $experiment->title; ?></h2>
<p> Category: <?php echo $experiment->category; ?> </p>
<p> Description: <?php echo $experiment->description; ?> </p>
<p> Target Count: <?php echo $experiment->target_count; ?> </p>
<p> Current Count: <?php echo $experiment->current_count; ?> </p>
<p> Is published: <?php if($experiment->is_published == 'f'){echo 'False';}else{echo 'True';} ?> </p>

<?php if($experiment->is_published == 'f'): ?>
	<fieldset>
	<legend>Publish</legend>
	<?php echo validation_errors();?>
	<?php echo form_open('graduate/request_advise/'.$experiment->eid); ?>

	<label><strong> Faculty Adviser </strong></label><br/>
	<input type="text" id="faculty_uname" required name="faculty_uname" placeholder="mtcarreon">

	<input type="submit" value="Publish">
	<?php echo form_close();?>
</fieldset>
<?php endif; ?>