<h1 class="white">Advisory Experiments</h1>
<?php $this->load->view('layouts/_notification'); ?>

<div class="row">
	<div class="large-12 column">
		<h3 class="white" style="display:inline">Advisory Experiments</h3>
		<?php if(isset($requests)): ?>
			<br class="hide-for-large"/>
			<span style='color:#e74c3c !important'><a href="#requests"><i class="fa fa-exclamation-circle"></i> <?php echo count($requests) ?> pending requests</a></span>
		<?php endif; ?>
	</div>
</div>

<br/>

<h3 class = "white">Graduates' Experiments</h3>
<?php if(isset($experiments)): ?>
	<div class="row">
		<div class="large-6 column">
			<?php $this->load->view('faculty/_experiments_list'); ?>
		</div>
	</div>
<?php else: ?>
	<p class = "white"> You are not advising any experiment. </p>
<?php endif; ?>

<br/>

<h3 class = "white" name="requests"> Experiments to be advised </h3>
<?php if(isset($requests)): ?>
	<?php $data['experiments'] = $requests; ?>
	<div class="row">
		<div class="large-6 column">
			<?php $this->load->view('faculty/_experiments_list', $data); ?>
		</div>
	</div>
<?php else: ?>
	<p class = "white"> You have no pending advisory requests. </p>
<?php endif; ?>
