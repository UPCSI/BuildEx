<h1>Faculty</h1>
<hr>
<!-- Notification Handling Part-->
<?php if(isset($notification)): ?>
	<div data-alert class="alert-box info"> <?php echo $notification; ?> <a href="#" class="close">&times;</a> </div>
<?php endif; ?>

<?php $this->load->view('admin/_faculty_list'); ?>
<hr>
<?php $this->load->view('admin/_faculty_requests_list'); ?>