<section class = "sidebar"> 
  <ul class="side-nav">
  	<? foreach ($modules as $module): ?>
  		<li>
  			<? if($module == 'home'): ?>
  				<a href = "<? echo site_url($this->session->userdata('active_role').'/'); ?>">
  			<? else: ?>
  				<a href = "<? echo site_url($this->session->userdata('active_role').'/'.$module); ?>">
  			<? endif; ?>
  				<? echo ucfirst($module); ?> 
  			</a>
  		</li>
  	<? endforeach; ?>
  </ul>
</section>