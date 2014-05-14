<h1> Laboratories </h1>
<hr>
<!-- Notification Handling Part-->
<?php if(isset($notification)): ?>
	<div data-alert class="alert-box info"> <?php echo $notification; ?> <a href="#" class="close">&times;</a> </div>
<?php endif; ?>

<?php $this->load->view('admin/_laboratories_list'); ?>

<a href="#" data-reveal-id="create_lab_modal" class="button small">Create Laboratory</a>

<?php $this->load->view('admin/_add_laboratory_modal'); ?>