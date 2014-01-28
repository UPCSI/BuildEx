<h3> Lab Profile </h3>
<hr>

<? if(isset($laboratory)): ?> 
	<h4> <?= $laboratory->name ?> </h4>
	<strong> No. of members: </strong> <?= $laboratory->members_count ?>
	<br> <br>
	<h5> Description </h5>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
	<h5> Faculty Members </h5>
	<? if(isset($faculty_members)): ?>
		<? foreach($faculty_members as $member): ?>
			<?= strtoupper($member->last_name).', '.ucwords($member->first_name).' '.ucfirst($member->middle_name); ?>
			<br>
		<? endforeach; ?>
	<? else: ?>
		<p> There are no faculty members.</p>
	<? endif; ?>
	<br>
	<h5> Graduates </h5>
	<? if(isset($graduates)): ?>
		<? foreach ($graduates as $graduate): ?>
			<?= strtoupper($graduate->last_name).', '.ucwords($graduate->first_name).' '.ucfirst($graduate->middle_name); ?>
			<br>
		<? endforeach; ?>
	<? else: ?>
		<p> There are no students </p>
	<? endif; ?>
<? endif; ?>
<br>