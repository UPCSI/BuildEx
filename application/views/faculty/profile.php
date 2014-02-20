<h1> Profile </h1>
<hr>
<p> <strong> Name: </strong> <?php echo strtoupper($user->last_name).', '.ucwords($user->first_name).', '.ucfirst($user->middle_name); ?> </p>
<p> <strong> Email Address: </strong> <?php echo $user->email_ad; ?> </p>
<p> <strong> Faculty No: </strong> <?php echo $faculty->faculty_num; ?> </p>
Roles:
<ol>
	<?php foreach ($roles as $role): ?>
		<li> <a href ="<?php echo site_url('home/redirect')  .'/' .$role?>"> <?php echo ucfirst($role); ?> </a> </li>
	<?php endforeach; ?>
</ol>