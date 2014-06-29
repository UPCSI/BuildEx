<?php $this->load->view('layouts/_notification'); ?>

<div class = "row">
	<div class = "large-12 column">
		<h2 class = "white"><?php echo $experiment->title; ?></h2>
		<p class = "white"><strong>Category:</strong><?php echo $experiment->category; ?> </p>
		<p class = "white"><strong>Description:</strong><?php echo $experiment->description; ?> </p>
		<p class = "white"><strong>Target Count:</strong><?php echo $experiment->target_count; ?> </p>
		<p class = "white"><strong>Current Count:</strong><?php echo $experiment->current_count; ?> (<a href = "<?php echo site_url('experiment/respondents/'.$experiment->eid); ?>"> View All </a> ) </p>
		<p class = "white"><strong>Status:</strong><?php if($experiment->status == 'f'){echo 'On-going';}else{echo 'Complete';} ?> </p>
		<p class = "white"><strong>Is published:</strong><?php if($experiment->is_published == 'f'){echo 'False';}else{echo 'True';} ?> </p>
		<?php if(isset($adviser)): ?>
			<p class = "white">
				<strong>Adviser:</strong>
				<?php echo anchor(faculty_path($adviser), format_short_name($adviser)); ?>
			</p>
		<?php endif; ?>

		<p class = "white"><strong>Requested Advisers:</strong></p>
		<?php if(isset($requested_advisers)): ?>
			<?php $this->load->view('experiment/_requested_advisers'); ?>
		<?php else: ?>
			None
		<?php endif; ?>

		<br/> <br/>

		<?php $this->load->view('experiment/_publish_form'); ?>

		<?php echo anchor(experiment_path($experiment, 'edit'), 'Edit', 'class = "button small"'); ?>
		<a class = "button small" href = "<?php echo site_url('builder/app/'.$experiment->eid); ?>"> Go to Experiment Builder </a>
	</div>
</div>
