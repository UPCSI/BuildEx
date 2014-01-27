<h1> Admin </h1>

<?php echo "BuildEx: You (". $this->session->userdata('username') .") are logged in with a role of ". ucfirst($this->session->userdata('role')[0]); ?></br>
<hr>
<a href = "<?php echo site_url('admin'); ?>"> Home</a><br/>
<h3> Summary </h3>
<h4> Charts </h4>
<p> This is a chart </p>
<a href = "<?php echo site_url('admin/profile'); ?>"> Profile </a><br/>
<a href = "<?php echo site_url('admin/graduates'); ?>"> Graduates</a><br/>
<a href = "<?php echo site_url('admin/faculty'); ?>"> Faculty </a><br/>
<a href = "<?php echo site_url('admin/laboratories'); ?>"> Laboratories</a><br/>
<a href = "<?php echo site_url('home/logout'); ?>"> Logout</a><br/>