<h1>Laboratory</h1>
<hr>

<?php if(isset($notification)): ?>
	<div data-alert class="alert-box info"> <?php echo $notification; ?> <a href="#" class="close">&times;</a> </div>
<?php endif; ?>

<? if(isset($laboratory)): ?>
	<h2> <?echo $laboratory->name ?> </h2>
	<p> <strong> Laboratory Head: </strong> <a href = "<?= site_url('faculty/view/'.$lab_head->username); ?>"><?= strtoupper($lab_head->last_name).', '.ucwords($lab_head->first_name).', '.ucfirst($lab_head->middle_name); ?> </a> </p>
	<p> <strong> No. of members: </strong> <? echo $laboratory->members_count; ?> </p>
	<p> <strong> Description: </strong><? if(isset($laboratory->description)){echo $laboratory->description;}?> </p>
	<p> <strong> Created: </strong> <? echo $laboratory->since; ?> </p>
	<h3> Faculty Members </h3>
	<? if(isset($faculty_members)): ?>
		<ol>
		<? foreach($faculty_members as $member): ?>
			<li><a href = "<?= site_url('faculty/view/'.$member->username); ?>"><?= strtoupper($member->last_name).', '.ucwords($member->first_name).', '.ucfirst($member->middle_name); ?> </a> </li>
		<? endforeach; ?>
		</ol>
	<? else: ?>
		<p> There are no faculty members.</p>
	<? endif; ?>
	
	<h3> Graduates </h3>
	<? if(isset($graduates)): ?>
		<ol>
		<? foreach ($graduates as $graduate): ?>
			<li> <a href = "<?= site_url('graduate/view/'.$graduate->username); ?>"><?= strtoupper($graduate->last_name).', '.ucwords($graduate->first_name).', '.ucfirst($graduate->middle_name); ?> </a> </li>
		<? endforeach; ?>
		</ol>
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