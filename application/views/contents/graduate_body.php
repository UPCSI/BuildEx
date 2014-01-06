<?php $role = $this->session->userdata('role');
echo "BuildEx: You (". $this->session->userdata('username') .") are logged in with a role of ". ucfirst($role[0]); ?>
<br/><br/><a href = "<?php echo site_url('home/logout'); ?>"> Logout</a><br/>

<h2>My Experiments</h2>
<?php 
	foreach ($experiments as $experiment){
		echo anchor('experiment/update_experiment/' . $experiment->eid, $experiment->title);
		echo '</br>';
	}
?>

<a href = "<?php echo site_url('experiment'); ?>"> Create Experiment </a><br/>