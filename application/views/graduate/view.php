<h3> Graduate </h3>
<hr>
<?php if(isset($user)): ?>
	<h4> <?php echo strtoupper($user->last_name).', '.ucwords($user->first_name).', '.ucfirst($user->middle_name); ?> </h4>
	<h5> Email Address: <?php echo $user->email_ad; ?></h5>
	<?php if(isset($graduate)): ?>
		<h5> Student no: <?php echo $graduate->student_num; ?> </h5> 
	<?php endif; ?>
<?php endif; ?>
<hr>
<h4> My Experiments </h4>
<?php if(isset($experiments)): ?>
	<?php $count = 0; ?>
	<?php foreach ($experiments as $exp): ?>
		<?php $count+=1; ?>
		<h5> <?php echo $count.'. '; ?> <a href = "<?php echo site_url('experiment/view/'.$exp->eid.'/'.$graduate->gid); ?>" ><?= $exp->title; ?> </a> </h5>
	<?php endforeach; ?>
<?php else: ?>
	<p> There are no experiments. </p>
<?php endif; ?>