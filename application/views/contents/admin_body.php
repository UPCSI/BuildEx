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

<h3>List of Faculty</h3>
<?php 
	foreach ($faculty as $faculty){
		echo anchor('faculty/edit_faculty/'.$faculty->uid.'/'.$faculty->fid,$faculty->username);
		echo '</br>';
	}
?>

<h3>List of Graduates</h3>
<?php 
	foreach ($graduates as $graduate){
		echo anchor('graduate/edit_graduate/'.$graduate->uid.'/'.$graduate->gid, $graduate->username);
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