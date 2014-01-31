<h3> Graduate: Profile </h3>
<hr>
Name: <?php echo strtoupper($user->last_name).', '.ucwords($user->first_name).', '.ucfirst($user->middle_name); ?> <br>
Email Address: <?php echo $user->email_ad; ?> <br>
Student No: <?php echo $graduate->student_num; ?> <br>
<br>
Roles: <br>
<?php 
	$count = 0;
	foreach ($roles as $role) {
		$count = $count + 1;
		echo $count.'. '.ucfirst($role).'<br>';
	}
?>