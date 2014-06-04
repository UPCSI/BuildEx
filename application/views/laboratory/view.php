<?php $this->load->view('layouts/_notification'); ?>

<?php if(isset($laboratory)): ?>
	<?php $this->load->view('laboratory/_info'); ?>
	
	<?php $this->load->view('laboratory/_faculty_list'); ?>
	
	<?php $this->load->view('laboratory/_graduates_list'); ?>
<?php endif; ?>

<?php $this->load->view('laboratory/_application_form'); ?>