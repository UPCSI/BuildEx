<h5> Quota: <?php echo $experiment->current_count; ?>/<?php echo $experiment->target_count; ?> </h5>
<h5> 
	<?php if($experiment->status == 'f'):?>
		<?php if($experiment->is_published == 'f'): ?>
			<span style='color:#f1c40f'><i class='fa fa-minus-circle'></i>Standby</span>
		<?php else: ?>
			<span style='color:#f1c40f'><i class='fa fa-play-circle'></i>Ongoing</span>
		<?php endif; ?>
	<?php else: ?>
		<span style='color:#36d077'><i class='fa fa-check-circle'></i>Complete</span>
	<?php endif; ?>
</h5>
<h5> 
	<?php if($experiment->is_published == 'f'): ?>
		<?php if($experiment->status == 'f'): ?>
			<span style='color:#e74c3c'><i class='fa fa-times-circle'></i>Not published</span>
		<?php else: ?>
			<span style='color:#f1c40f'><i class='fa fa-times-circle'></i>Closed</span>
		<?php endif; ?>
	<?php else: ?>
		<span style='color:#36d077'><i class='fa fa-check-circle'></i>Published</span>
	<?php endif; ?>
</h5>
<h5 class="actions">
	<?php echo anchor("builder/app/{$experiment->eid}", 'Open', 'class = "button tiny"'); ?>
	<?php echo form_open(experiment_path($experiment, 'destroy'), array('class' => 'experiment_delete')); ?>
	 	<?php echo form_hidden('experiment_id', $experiment->eid); ?>
		<?php echo anchor('#', 'Delete', array('class' => 'button tiny')); ?>
	<?php echo form_close(); ?>
</h5>
