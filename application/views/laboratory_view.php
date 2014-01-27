<h3>Laboratory</h3>
<hr>
<?php 
	if (isset($laboratory)){ 
	echo '<h4>'.$laboratory->name.'</h4>';
	echo '<strong> No. of members: </strong>'.$laboratory->members_count;
	echo '<br>';
	echo '<h5> Faculty Members </h5>';
	if(isset($faculty_members)){
		foreach ($faculty_members as $member) {
			echo strtoupper($member->last_name).', '.ucwords($member->member_name).', '.ucfirst($member->middle_name);
			echo '<br>';
		}
	}
	else{
		echo 'There are no faculty members.';
	}

	echo '<br>';
	echo '<h5> Graduates </h5>';

	if(isset($graduates)){
		foreach ($graduates as $graduate) {
			echo strtoupper($graduate->last_name).', '.ucwords($graduate->member_name).', '.ucfirst($graduate->middle_name);
			echo '<br>';
		}
	}
	else{
		echo 'There are no students.';
	}
}
?>
<br>