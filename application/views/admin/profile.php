<h3> Admin: Profile </h3>
<hr>
Name: <?php echo strtoupper($user->last_name).', '.ucwords($user->first_name).', '.ucfirst($user->middle_name); ?> <br>
Email Address: <?php echo $user->email_ad; ?> <br>
Roles: <br>
<?php 
	$count = 0;
	foreach ($roles as $role) {
		$count = $count + 1;
		echo '<a href ="' .site_url('home/redirect')  .'/' .$role .'">' .$count .'. '.ucfirst($role) .'</a><br/>';
	}
?>
