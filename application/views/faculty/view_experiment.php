<h1>Experiment</h1>
<hr>
<?php if(isset($notification)): ?>
	<div data-alert class="alert-box info"> <?php echo $notification; ?> <a href="#" class="close">&times;</a> </div>
<?php endif; ?>

<h2> <?php echo $experiment->title; ?></h2>
<p> <strong> Category: </strong><?php echo $experiment->category; ?> </p>
<p> <strong> Description: </strong><?php echo $experiment->description; ?> </p>
<p> <strong> Target Count: </strong><?php echo $experiment->target_count; ?> </p>
<p> <strong> Current Count: </strong><?php echo $experiment->current_count; ?> (<a href = "<?php echo site_url('faculty/view_respondents/'.$experiment->eid); ?>"> View All </a> ) </p>
<p> <strong> Status: </strong><?php if($experiment->status == 'f'){echo 'On-going';}else{echo 'Complete';} ?> </p>
<p> <strong> Is published: </strong><?php if($experiment->is_published == 'f'){echo 'False';}else{echo 'True';} ?> </p>

<a class = "button small" href = "<?php echo site_url('experiment/edit_experiment/'.$experiment->eid); ?>"> Edit </a>

<?php if($experiment->is_published == 'f'): ?>
	<a class = "button small" href = "<?php echo site_url('faculty/publish/'.$experiment->eid); ?>"> Publish </a>
<?php else: ?>
	<p> <strong> URL: </strong> <a href ="<?php echo site_url('respond/view/'.$experiment->url); ?>"> <?php echo site_url('respond/view/'.$experiment->url); ?> </a></p>
	<a class = "button small" href = "<?php echo site_url('faculty/unpublish/'.$experiment->eid); ?>"> Unpublish </a>
<?php endif; ?>

<a class = "button small" href = "<?php echo site_url('builder/form/'.$experiment->eid); ?>"> Go to Form Maker </a>
<a class = "button small" href = "<?php echo site_url('builder/app/'.$experiment->eid); ?>"> Go to Experiment Builder </a>