<h1> <?php echo $admin->username; ?> </h1>
<div class = "profile-info">
    <?php $this->load->view('admin/_info'); ?>
</div>

<?php $this->load->view('users/_roles'); ?>