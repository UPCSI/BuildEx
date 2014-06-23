<h1>Experiment</h1>
<hr>

<!-- Notification Handling Part-->
<?php if(isset($notification)): ?>
	<div data-alert class="alert-box info"> <?php echo $notification; ?> <a href="#" class="close">&times;</a> </div>
<?php endif; ?>

<h2> <?php echo $experiment->title; ?></h2>
<p> <strong> Category: </strong><?php echo $experiment->category; ?> </p>
<p> <strong> Description: </strong><?php echo $experiment->description; ?> </p>
<p> <strong> Target Count: </strong><?php echo $experiment->target_count; ?> </p>
<p> <strong> Current Count: </strong><?php echo $experiment->current_count; ?> </p>
<p> <strong> Status: </strong><?php if($experiment->status == 'f'){echo 'On-going';}else{echo 'Complete';} ?> </p>
<p> <strong> Is published: </strong><?php if($experiment->is_published == 'f'){echo 'False';}else{echo 'True';} ?> </p>
<?php if($experiment->is_published == 'f'): ?>
	<a class = "button small" href="#" data-reveal-id="publishExperiment"> Publish </a>
	<div id="publishExperiment" class="reveal-modal tiny" data-reveal>
		<fieldset>
		<legend>Publish</legend>
		<?php echo form_open('graduate/request_advise/'.$experiment->eid); ?>
			<label><strong> Faculty Adviser </strong></label><br/>
			<input type="text" id="faculty_uname" required name="faculty_uname" placeholder="mtcarreon">
			<input type="submit" value="Publish">
		<?php echo form_close();?>
		</fieldset>
  		<a class="close-reveal-modal">&#215;</a>
	</div>
<?php else: ?>
	<p> <strong> URL: </strong> <a href ="<?php echo site_url('respond/view/'.$experiment->url); ?>"> <?php echo site_url('respond/view/'.$experiment->url); ?></a></p>
<?php endif; ?>
<a class = "button small" href = "<?php echo site_url('builder/app/'.$experiment->eid); ?>"> Go to Experiment Builder </a>