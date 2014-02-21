<h3>Laboratory</h3>
<hr>

<?php if(isset($notification)): ?>
	<div data-alert class="alert-box info"> <?php echo $notification; ?> <a href="#" class="close">&times;</a> </div>
<?php endif; ?>

<? if(isset($laboratory)): ?>
	<h3> <?echo $laboratory->name ?> </h3>
	<p> <strong> Laboratory Head: </strong> <a href = "<?= site_url('faculty/view/'.$lab_head->username); ?>"><?= strtoupper($lab_head->last_name).', '.ucwords($lab_head->first_name).', '.ucfirst($lab_head->middle_name); ?> </a> </p>
	<p> <strong> No. of members: </strong> <? echo $laboratory->members_count; ?> </p>
	<p> <strong> Created: </strong> <? echo $laboratory->since; ?>
	<h5> Faculty Members </h5>
	<? if(isset($faculty_members)): ?>
		<? foreach($faculty_members as $member): ?>
			<p> <a href = "<?= site_url('faculty/view/'.$member->username); ?>"><?= strtoupper($member->last_name).', '.ucwords($member->first_name).', '.ucfirst($member->middle_name); ?> </a> </p>
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
</br>
<? if(isset($is_member)): ?>
	<? if(!$is_member): ?>
		<a class = "button small" href = "<?php echo site_url($role.'/request_lab/'.$laboratory->labid); ?>"> Apply </a>
	<? endif; ?>
<? endif; ?>