<h1> Welcome! </h1>
<p> You are currently logged in as <strong> <?php echo $this->session->userdata('username'); ?> </strong> with a role of <strong> <?php echo ucfirst($this->session->userdata('active_role')); ?> </strong> </p>
<hr>
<?php $this->load->view('admin/_notifications'); ?>