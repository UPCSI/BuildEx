<h3> Faculty </h3>
<hr>
<? if(isset($user)): ?>
	<h4> <?= strtoupper($user->last_name).', '.ucwords($user->first_name).', '.ucfirst($user->middle_name); ?> </h4>
	<h5> Email Address: <?= $user->email_ad; ?></h5>
	<?if(isset($faculty)): ?>
		<h5> Faculty no: <?= $faculty->faculty_num; ?> </h5> 
	<? endif; ?>
<? endif; ?>
<hr>
<h4> My Experiments </h4>
<? if(isset($experiments)): ?>
	<? $count = 0; ?>
	<? foreach ($experiments as $exp): ?>
		<? $count+=1; ?>
		<h5> <?=$count.'. '; ?> <a href = "<?= site_url('experiment/faculty_view/'.$exp->eid.'/'.$graduate->gid); ?>" ><?= $exp->title; ?> </a> </h5>
	<? endforeach; ?>
<? else: ?>
	<p> There are no experiments. </p>
<? endif; ?>
