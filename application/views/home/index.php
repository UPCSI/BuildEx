<?php $this->load->view('home/_topbar'); ?>

<section class="jumbotron">
	<div class="row full">
		<div class="large-6 columns">
			<?php $this->load->view('home/_logo_animate'); ?>
		</div>
		<div class="large-6 columns">
			<?php $this->load->view('home/_main_caption'); ?>
		</div>
	</div>
</section>

<section class="homesection" id="description">
	<?php $this->load->view('home/_description'); ?>
</section>

<section class="homesection" id="features">
	<?php $this->load->view('home/_features'); ?>
</section>

<section class="homesection" id="showcase">
	<?php $this->load->view('home/_showcase'); ?>
</section>

<section class="homesection" id="about">
	<?php $this->load->view('home/_about'); ?>
</section>

<?php $this->load->view('layouts/_sitemap'); ?>