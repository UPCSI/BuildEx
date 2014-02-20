<div class = "sidebar"> 
  <ul class="side-nav">
    <li> <a href = "<?php echo site_url('graduate'); ?>"> Home </a></li>
    <li> <a href = "<?php echo site_url('graduate/profile'); ?>"> Profile </a></li>
    <li> <a href = "<?php echo site_url('graduate/experiments'); ?>"> Experiments </a></li>
    <li> <a href = "#" data-dropdown = "laboratories_dropdown" data-options="is_hover:true"> Laboratories </a></li>
  </ul>
</div>

<ul id="laboratories_dropdown" class="f-dropdown" data-dropdown-content>
	<li> <a href = "<?php echo site_url('graduate/laboratory'); ?>"> My Laboratory </a></li>
	<li> <a href = "<?php echo site_url('graduate/laboratories'); ?>"> Other Laboratories </a></li>	
</ul>