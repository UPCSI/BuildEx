<h1> Laboratory </h1>
<hr>
<? if(isset($laboratory)): ?> 
	<h2> <? echo $laboratory->name ?> </h2>
	<p> <strong> No. of members: </strong> <? echo $laboratory->members_count ?> </p>
	<p> <strong> Since: </strong> <? echo $laboratory->since; ?> </p>
	<p> <strong> Description: </strong> <?if(isset($laboratory->description)){echo $laboratory->description;}{ echo "None";} ?> </p>
	<h3> Faculty Members </h3>
	<? if(isset($faculty_members)): ?>
		<ol>
		<? foreach($faculty_members as $member): ?>
			<li> <a href = "<?php echo site_url('faculty/view/'.$member->username); ?>"> <? echo strtoupper($member->last_name).', '.ucwords($member->first_name).' '.ucfirst($member->middle_name); ?> </a> </li>
		<? endforeach; ?>
		</ol>
	<? else: ?>
		<p> There are no faculty members.</p>
	<? endif; ?>
	<h3> Graduates </h3>
	<? if(isset($graduates)): ?>
		<ol>
		<? foreach ($graduates as $graduate): ?>
			<li> <a href = "<?php echo site_url('graduate/view/'.$graduate->username); ?>"> <?echo strtoupper($graduate->last_name).', '.ucwords($graduate->first_name).' '.ucfirst($graduate->middle_name); ?></li>
		<? endforeach; ?>
		</ol>
	<? else: ?>
		<p> There are no students </p>
	<? endif; ?>
<? endif; ?>