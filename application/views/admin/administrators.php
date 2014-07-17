<h1>Admin</h1>
<?php $this->load->view('layouts/_notification'); ?>

<?php $this->load->view('admin/_admins_list'); ?>

<a href="#" data-reveal-id="create_admin_modal" class="button small">Create Admin</a>

<?php $this->load->view('admin/_create_admin_modal'); ?>