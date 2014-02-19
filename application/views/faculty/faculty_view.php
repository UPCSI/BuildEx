<h3> Faculty </h3>
<hr>
<?php if(isset($user)): ?>
	<h4> <?php strtoupper($user->last_name).', '.ucwords($user->first_name).', '.ucfirst($user->middle_name); ?> </h4>
	<h5> Email Address: <?php $user->email_ad; ?></h5>
	<?php if(isset($faculty)): ?>
		<h5> Faculty no: <?php $faculty->faculty_num; ?> </h5> 
	<?php endif; ?>
<?php endif; ?>
<hr>
<h4> Experiments </h4>
<?php if(isset($experiments)): ?>
	<?php $count = 0; ?>
	<?php foreach ($experiments as $exp): ?>
		<?php $count+=1; ?>
		<h5> <?php $count.'. '; ?> <a href = "<?php site_url('experiment/view/'.$exp->eid); ?>" ><?php $exp->title; ?> </a> </h5>
	<?php endforeach; ?>
<?php else: ?>
	<p> There are no experiments. </p>
<?php endif; ?>
