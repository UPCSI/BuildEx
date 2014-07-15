<style>
@media only screen and (min-width: 40.063em) {
  .top-bar .title-area {
    float: right;
  }
}
</style>
<?php //echo '<pre>'; print_r($this->session->userdata); echo '</pre>'; ?>

<!-- Navigation Bar - Experiment Builder -->
<div class="fixed">
	<nav class="top-bar" data-topbar>
		<ul class="title-area">
			<li class="name">
				<h1><a href="<?php echo site_url(experiments_path($researcher)); ?>"><strong>BuildEx - Experiment Builder</strong></a></h1>
			</li>
			<li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
		</ul>

		<section class="top-bar-section">
			<ul class="left">
				<li><a href="<?php echo site_url(experiments_path($researcher)); ?>" class = "top-buttons">Back</a></li>
				<li><a href="#" id = "getObjectValues" class = "top-buttons button success">Save Environment</a></li>
				<li>
					<span class="save-loading"><img src="<? echo site_url('images/loading.gif'); ?>"></span>
					<span class="save-done"><i class="fi-check"></i></span>
				</li>
			</ul>
		</section>
	</nav>
</div>