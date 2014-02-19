<section class = "sidebar"> 
  <ul class="side-nav">
  	<?php foreach ($modules as $module): ?>
  		<li>
  			<?php if($module == 'home'): ?>
  				<a href = "<?php echo site_url($this->session->userdata('active_role').'/'); ?>">
  			<?php else: ?>
  				<a href = "<?php echo site_url($this->session->userdata('active_role').'/'.$module); ?>">
  			<?php endif; ?>
  				<?php echo ucfirst($module); ?> 
  			</a>
  		</li>
  	<?php endforeach; ?>
  </ul>
</section>