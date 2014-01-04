<?php //echo '<pre>'; print_r($this->session->userdata); echo '</pre>'; ?>
<?php echo "BuildEx: You (". $this->session->userdata('username') .") are logged in with a role of ". $this->session->userdata('role')[0]; ?></br>
<br/><br/><a href = "<?php echo site_url('login/logout'); ?>"> Logout</a><br/>

<h3>List of Admins</h3>
<?php 
	foreach ($admins as $admin){
		echo $admin->username;
		echo '</br>';
	}
?>

<h3>List of Faculty</h3>
<?php 
	foreach ($faculty as $faculty){
		echo $faculty->username;
		echo '</br>';
	}
?>

<h3>List of Graduates</h3>
<?php 
	foreach ($graduates as $graduate){
		echo $graduate->username;
		echo '</br>';
	}
?>

<h3>List of Respondents</h3>
<?php 
	foreach ($respondents as $respondent){
		echo $respondent->last_name . ', ' . $respondent->first_name;
		echo '</br>';
	}
?>