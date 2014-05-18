<h1> Laboratories </h1>
<hr>
<?php $this->load->view('layouts/_notification'); ?>
<?php $this->load->view('admin/_laboratories_list'); ?>

<a href="#" data-reveal-id="create_lab_modal" class="button small">Create Laboratory</a>

<?php $this->load->view('admin/_add_laboratory_modal'); ?>