<h1 class="white"> Experiments </h1>
<?php $this->load->view('layouts/_notification'); ?>

<div class="row">
	<div class="large-6 medium-6 small-6 column">
		<h3 class="white">My Experiments</h3>
	</div>
	<div class="large-6 medium-6 small-6 column">
		<?php echo anchor(experiment_path(NULL, 'add'), 'Create Experiment', 'class = "button small pull-right"'); ?>
	</div>
</div>

<?php if(isset($experiments)): ?>
	<div class="row">
		<?php $this->load->view('faculty/_experiments_list'); ?>
	</div>
<?php else: ?>
	<p class = "white"> You have no experiments. </p>
<?php endif; ?>