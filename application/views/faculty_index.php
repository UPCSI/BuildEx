<h1> Faculty </h1>

<?php echo "BuildEx: You (". $this->session->userdata('username') .") are logged in with a role of ". ucfirst($this->session->userdata('role')[0]); ?></br>
<hr>
<a href = "<?php echo site_url('faculty'); ?>"> Home </a><br/>
<h3> Summary </h3>
<h4> Charts </h4>
<p> This is a chart </p>
<a href = "<?php echo site_url('faculty/profile'); ?>"> Profile </a><br/>
<a href = "<?php echo site_url('faculty/experiments'); ?>"> My Experiments</a><br/>
<a href = "<?php echo site_url('faculty/advisory'); ?>"> Advisory Experiments</a><br/>
<a href = "<?php echo site_url('faculty/laboratories'); ?>"> Laboratories</a><br/>
<a href = "<?php echo site_url('home/logout'); ?>"> Logout</a><br/>