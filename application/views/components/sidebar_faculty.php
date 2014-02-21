<div class = "sidebar"> 
  <ul class="side-nav">
    <li> <a href = "<?php echo site_url('faculty'); ?>"> Home </a></li>
    <li> <a href = "<?php echo site_url('faculty/profile'); ?>"> Profile </a></li>
    <li> <a href = "#" data-dropdown = "experiments_dropdown" data-options="is_hover:true"> Experiments </a></li>
    <li> <a href = "#" data-dropdown = "laboratories_dropdown" data-options="is_hover:true"> Laboratories </a></li>
  </ul>
</div>

<ul id="experiments_dropdown" class="f-dropdown" data-dropdown-content>
	<li> <a href = "<?php echo site_url('faculty/experiments'); ?>"> My Experiments </a></li>
	<li> <a href = "<?php echo site_url('faculty/advisory'); ?>"> Advisory Experiments </a></li>	
</ul>

<ul id="laboratories_dropdown" class="f-dropdown" data-dropdown-content>
	<li> <a href = "<?php echo site_url('faculty/laboratory'); ?>"> My Laboratory </a></li>
	<li> <a href = "<?php echo site_url('faculty/laboratories'); ?>"> Other Laboratories </a></li>	
</ul>