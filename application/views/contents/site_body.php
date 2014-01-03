<?php //echo '<pre>'; print_r($this->session->userdata); echo '</pre>'; ?>
<?php echo "BuildEx: You (". $this->session->userdata('username') .") are logged in."; ?>
<br/><br/><a href = "<?php echo site_url('login/logout'); ?>"> Logout</a><br/>