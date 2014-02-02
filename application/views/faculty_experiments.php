<h3> Faculty: Experiments </h3>
<hr>

<!-- Notification Handling Part-->
<?php if(isset($notification)): ?>
	<pre> <?php echo $notification; ?> </pre>
<?php endif; ?>

<h2>My Experiments</h2>
<?php if(isset($experiments)): ?>
	<?php foreach ($experiments as $experiment): ?>
		<?php echo anchor('experiment/view/'.$experiment->eid, $experiment->title); ?>
		</br>
	<?php endforeach; ?>	
<?php else: ?>
		<p> You have no experiments. </p>
<?php endif; ?>

<br>
<hr>

<a href = "<?php echo site_url('experiment'); ?>">Create Experiment</a><br/>