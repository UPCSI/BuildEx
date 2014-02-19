<h3> Faculty: Advisory Experiments </h3>
<hr>
<h2>Graduates' Experiments</h2>
<?php if(isset($experiments)): ?>
		<?php foreach ($experiments as $experiment): ?>
			<?php if($experiment->status == 't'): ?>
				<?php echo anchor('experiment/update_experiment/' . $experiment->eid, $experiment->title); ?>
				</br>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php else: ?>
		<p> There are no experiments. </p>
	<?php endif; ?>
<hr>
<h2> Experiments to be advised </h2>
<?php if(isset($requests)): ?>
		<?php $count = 0 ?>
		<?php foreach ($requests as $request): ?>
			<?php if($request->status == 'f'): ?>
				<?php $count++; ?>
				<?php echo $count.'. ' ?>
				<?php echo anchor('experiment/update_experiment/' . $request->eid, $request->title); ?>
				<?php echo form_open('faculty/confirm_experiment/'.$request->eid); ?>
				<?php echo form_submit('submit','Confirm'); ?>
				<?php echo form_close(); ?>
				<?php echo form_open('faculty/reject_experiment/'.$request->eid); ?>
				<?php echo form_submit('submit','Reject'); ?>
				<?php echo form_close(); ?>
				</br>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php else: ?>
		<p> There are no advisory request. </p>
	<?php endif; ?>
<hr>
