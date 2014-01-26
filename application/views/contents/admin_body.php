<?php //echo '<pre>'; print_r($this->session->userdata); echo '</pre>'; ?>
<?php echo "BuildEx: You (". $this->session->userdata('username') .") are logged in with a role of ". ucfirst($this->session->userdata('role')[0]); ?></br>
<br/><br/><a href = "<?php echo site_url('home/logout'); ?>"> Logout</a><br/>

<h3>List of Admins</h3>
<?php 
	foreach ($admins as $admin){
		echo anchor('admin/edit_admin/'.$admin->uid.'/'.$admin->aid, $admin->username);
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

<h3>Functions</h3>
<a href = "<?php echo site_url('admin/create_lab'); ?>"> Create Laboratory </a><br/>