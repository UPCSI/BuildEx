<h3>Graduate: My Laboratory</h3>
<hr>
<?php 
	if (isset($main_lab)){ 
	echo '<h4>'.$main_lab->name.'</h4>';
	echo '<br>';
	echo '<strong> No. of members: </strong>'.$main_lab->members_count;
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
}
else {
	echo '<p> You do not belong to any laboratory. </p>';
}
?>