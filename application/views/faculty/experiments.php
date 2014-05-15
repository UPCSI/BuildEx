<h1 class="white"> Experiments </h1>
<!-- Notification Handling Part-->
<?php if(isset($notification)): ?>
	<div data-alert class="alert-box info"> <?php echo $notification; ?>
	<a href="#" class="close">&times;</a> </div>
<?php endif; ?>

<div class="row">
	<div class="large-6 medium-6 small-6 column">
		<h3 class="white">My Experiments</h3>
	</div>
	<div class="large-6 medium-6 small-6 column">
		<a style="float:right" class = "button small" href="#" data-reveal-id="create_experiment_modal">
			Create Experiment
		</a>
	</div>
</div>

<?php if(isset($experiments)): ?>
	<div class="row">
		<div class="large-6 column">
			<?php $this->load->view('faculty/_experiments_list'); ?>
		</div>	
	</div>
<?php else: ?>
	<p> You have no experiments </p>
<?php endif; ?>

<?php $this->load->view('faculty/_add_experiment_modal'); ?>