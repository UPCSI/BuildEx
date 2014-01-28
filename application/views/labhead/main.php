<h1> Laboratory Head </h1>

<?php echo "BuildEx: You (". $this->session->userdata('username') .") are logged in with a role of Laboratory Head."; ?></br>
<hr>

<a href = "<?php echo site_url('labhead'); ?>"> Home</a><br/>
<a href = "<?php echo site_url('labhead/profile'); ?>"> Profile </a><br/>
<!-- <a href = "<?php echo site_url('labhead/add'); ?>"> Add Members </a><br/> -->
<a href = "<?php echo site_url('labhead/faculty_requests'); ?>"> Confirm Faculty </a><br/>
<a href = "<?php echo site_url('labhead/graduates_requests'); ?>"> Confirm Graduates </a><br/>

<br/>
<a href = "<?php echo site_url('labhead/laboratory'); ?>"> <? echo $lab_name; ?> </a><br/>

<br/>
<a href = "<?php echo site_url('home/logout'); ?>"> Logout</a><br/>