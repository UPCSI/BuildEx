<h3>Laboratory</h3>
<hr>

<? if(isset($is_member)): ?>
	<? if(!$is_member): ?>
		<?= form_open($role.'/request_lab/'.$laboratory->labid); ?>
		<?= form_submit('submit','Apply'); ?>
		<?= form_close(); ?>
	<? endif; ?>
<? endif; ?>

<? if(isset($laboratory)): ?> 
	<h4> <?= $laboratory->name ?> </h4>
	<strong> No. of members: </strong> <?= $laboratory->members_count ?>
	<br> <br>
	<h5> Faculty Members </h5>
	<? if(isset($faculty_members)): ?>
		<? foreach($faculty_members as $member): ?>
			<?= strtoupper($member->last_name).', '.ucwords($member->first_name).', '.ucfirst($member->middle_name); ?>
			<br>
		<? endforeach; ?>
	<? else: ?>
		<p> There are no faculty members.</p>
	<? endif; ?>
	<br>
	<h5> Graduates </h5>
	<? if(isset($graduates)): ?>
		<? foreach ($graduates as $graduate): ?>
			<?= strtoupper($graduate->last_name).', '.ucwords($graduate->first_name).', '.ucfirst($graduate->middle_name); ?>
			<br>
		<? endforeach; ?>
	<? else: ?>
		<p> There are no students </p>
	<? endif; ?>
<? endif; ?>
<br>