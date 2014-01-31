<h1> Graduate </h1>

<?php echo "BuildEx: You (". $this->session->userdata('username') .") are logged in with a role of ". ucfirst($this->session->userdata('role')[0]); ?></br>
<hr>
<a href = "<?php echo site_url('graduate'); ?>"> Home</a><br/>
<h3> Summary </h3>
<h4> Homepage Details for a Graduate </h4>
<p> This is a chart.. or not. </p>
<a href = "<?php echo site_url('graduate/profile'); ?>"> Profile </a><br/>
<a href = "<?php echo site_url('graduate/experiments'); ?>"> Experiments </a><br/>
<a href = "<?php echo site_url('graduate/laboratories'); ?>"> Laboratories </a><br/>
<a href = "<?php echo site_url('home/logout'); ?>"> Logout</a><br/>