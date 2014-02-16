<h3>Laboratory</h3>
<hr>
<? if(isset($is_member)): ?>
	<? if(!$is_member): ?>
		<? echo form_open($role.'/request_lab/'.$laboratory->labid); ?>
		<? echo form_submit('submit','Apply'); ?>
		<? echo form_close(); ?>
	<? endif; ?>
<? endif; ?>

<? if(isset($laboratory)): ?>
	<h3> <?echo $laboratory->name ?> </h3>
	<p> <strong> Laboratory Head: </strong> <a href = "<?= site_url('faculty/view/'.$lab_head->username); ?>"><?= strtoupper($lab_head->last_name).', '.ucwords($lab_head->first_name).', '.ucfirst($lab_head->middle_name); ?> </a> </p>
	<p> <strong> No. of members: </strong> <? echo $laboratory->members_count; ?> </p>
	<h5> Faculty Members </h5>
	<? if(isset($faculty_members)): ?>
		<? foreach($faculty_members as $member): ?>
			<a href = "<?= site_url('faculty/view/'.$member->username); ?>"><?= strtoupper($member->last_name).', '.ucwords($member->first_name).', '.ucfirst($member->middle_name); ?> </a>
			<br>
		<? endforeach; ?>
	<? else: ?>
		<p> There are no faculty members.</p>
	<? endif; ?>
	<h5> Graduates </h5>
	<? if(isset($graduates)): ?>
		<? foreach ($graduates as $graduate): ?>
			<a href = "<?= site_url('graduate/view/'.$graduate->username); ?>"><?= strtoupper($graduate->last_name).', '.ucwords($graduate->first_name).', '.ucfirst($graduate->middle_name); ?> </a>
			<br>
		<? endforeach; ?>
	<? else: ?>
		<p> There are no students </p>
	<? endif; ?>
<? endif; ?>
<br>