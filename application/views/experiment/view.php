<?php if(isset($notification)): ?>
	<div data-alert class="alert-box info"> <?php echo $notification; ?> <a href="#" class="close">&times;</a> </div>
<?php endif; ?>

<div class = "row">
	<div class = "large-12 column">
		<h2 class = "white"> <?php echo $experiment->title; ?></h2>
		<p class = "white"> <strong> Category: </strong><?php echo $experiment->category; ?> </p>
		<p class = "white"> <strong> Description: </strong><?php echo $experiment->description; ?> </p>
		<p class = "white"> <strong> Target Count: </strong><?php echo $experiment->target_count; ?> </p>
		<p class = "white"> <strong> Current Count: </strong><?php echo $experiment->current_count; ?> (<a href = "<?php echo site_url('experiment/respondents/'.$experiment->eid); ?>"> View All </a> ) </p>
		<p class = "white"> <strong> Status: </strong><?php if($experiment->status == 'f'){echo 'On-going';}else{echo 'Complete';} ?> </p>
		<p class = "white"> <strong> Is published: </strong><?php if($experiment->is_published == 'f'){echo 'False';}else{echo 'True';} ?> </p>

		<br> <br>
		<?php if($experiment->is_published == 'f'): ?>
			<a class = "button small" href = "<?php echo site_url('experiment/publish/'.$experiment->eid); ?>"> Publish </a>
		<?php else: ?>
			<p class = "white"> <strong> URL: </strong> <a href ="<?php echo site_url('respond/view/'.$experiment->url); ?>"> <?php echo site_url('respond/view/'.$experiment->url); ?> </a></p>
			<a class = "button small" href = "<?php echo site_url('experiment/unpublish/'.$experiment->eid); ?>"> Unpublish </a>
		<?php endif; ?>
		<?php echo anchor(format_experiment_link($role, $id, $experiment).'/edit', 'Edit', 'class = "button small"'); ?>
		<a class = "button small" href = "<?php echo site_url('builder/app/'.$experiment->eid); ?>"> Go to Experiment Builder </a>
	</div>
</div>