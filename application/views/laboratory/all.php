<?php $this->load->view('layouts/_notification'); ?>

<h1 class="white"> Laboratories </h1>

<div class="row">
	<div class="large-12 column">
		<h3 class="white">All Laboratories</h3>
	</div>
</div>

<?php if(isset($laboratories)): ?>
	<div class = "row">
		<?php if(count($laboratories) == 1): ?>
			<div class="large-4 column large-centered">
		<?php else: ?>
			<div class="large-4 column">
		<?php endif; ?>
				<div class="row">
					<?php foreach ($laboratories as $count => $laboratory): ?>
						<div class="row">
							<div class="large-12 columns">
								<button class="button lab expand" onClick="location.href='<?php echo laboratory_path($laboratory); ?>'">
									<div class="row full main-workspace">
										<div class="large-8 medium-8 small-8 column">
											<?php echo anchor(laboratory_path($laboratory), $laboratory->name); ?><br/>
											<?php echo anchor(faculty_path($laboratory), format_short_name($laboratory)); ?><br/>
											<i class="fa fa-users"></i>&nbsp;<?php echo $laboratory->members_count; ?><br/>
											<?php echo $laboratory->since; ?>
										</div>
										<div class="large-4 medium-4 small-4 column">
											<i class="fa fa-flask" style="font-size:5em"></i>
										</div>
									</div>
								</button>
							</div>
						</div>
						<?php if(($count==(int)round(count($laboratories)/3))||($count==(int)round((2*count($laboratories))/3))): ?>
							</div>
							<div class="large-4 column">
						<?php endif; ?>
					<?php endforeach; ?>
						</div>
				</div>
<?php else: ?>
	<p> No Existing Laboratories. </p>
<?php endif; ?>
