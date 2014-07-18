<?php $this->load->view('layouts/_notification'); ?>

<?php if(isset($laboratory)): ?>

  <h1><?php echo $laboratory->name; ?></h1>
  <h2>Requests</h2>
  
  <?php $this->load->view('laboratory/_faculty_requests_list',
        array('requests'=>$faculty_requests)); ?>
  
  <?php $this->load->view('laboratory/_graduates_requests_list',
        array('requests'=>$graduates_requests)); ?>
<?php endif; ?>
