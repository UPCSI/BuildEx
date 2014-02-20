<div class = "sidebar"> 
  <ul class="side-nav">
    <li> <a href = "<?php echo site_url('labhead'); ?>"> Home </a></li>
    <li> <a href = "<?php echo site_url('labhead/profile'); ?>"> Profile </a></li>
    <li> <a href = "#" data-dropdown = "laboratories_dropdown" data-options = "is_hover:true"> Laboratories </a></li>
  </ul>
</div>

<ul id="laboratories_dropdown" class="f-dropdown" data-dropdown-content>
	<li> <a href = "<?php echo site_url('labhead/laboratory'); ?>"> My Laboratory </a></li>
	<li> <a href = "<?php echo site_url('labhead/requests'); ?>"> Requests </a></li>
	<li> <a href = "<?php echo site_url('labhead/laboratories'); ?>"> Other Laboratories </a></li>	
</ul>