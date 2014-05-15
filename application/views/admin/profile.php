<h1> Profile </h1>
<hr>
<div class = "profile-info">
    <?php $this->load->view($this->session->userdata('active_role').'/_info'); ?>
</div>

<?php $this->load->view('users/_roles'); ?>