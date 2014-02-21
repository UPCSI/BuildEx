<h1> Faculty </h1>
<hr>
<?php if(isset($user)): ?>
	<h3> <?php echo strtoupper($user->last_name).', '.ucwords($user->first_name).', '.ucfirst($user->middle_name); ?> </h3>
	<p><strong>Email Address: </strong> <?php echo $user->email_ad; ?></p>
	<?php if(isset($faculty)): ?>
		<p><strong>Faculty no:</strong> <?php echo $faculty->faculty_num; ?></p> 
	<?php endif; ?>
<?php endif; ?>
<hr>
<h3> Experiments </h3>
<?php if(isset($experiments)): ?>
	<?php foreach ($experiments as $exp): ?>
		<h5> <a href = "<?php echo site_url('experiment/view/'.$exp->eid); ?>" ><?php echo $exp->title; ?> </a> </h5>
	<?php endforeach; ?>
<?php else: ?>
	<p> There are no experiments. </p>
<?php endif; ?>