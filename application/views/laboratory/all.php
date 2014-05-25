<h1 class="white"> Laboratories </h1>

<div class="row">
<div class="large-12 column">
<h3 class="white">All Laboratories</h3>
</div>
</div>

<?php if (isset($laboratories)): ?>
	<div class="row">
		<?php if (count($laboratories)==1): ?>
		<div class="large-4 column large-centered">
		<?php else: ?>
		<div class="large-4 column">
		<? endif; ?>

		<?php $expcounter = 0; ?>
		<?php foreach ($laboratories as $laboratory): ?>
		<div class="row">
		<div class="large-12 columns">
		<button class="button lab expand" onClick="location.href='<?php echo site_url('laboratories/view/'.$laboratory->labid,$laboratory->name); ?>'">
			<div class="row full main-workspace">
				<div class="large-8 medium-8 small-8 column">
					<?php echo anchor('laboratories/view/'.$laboratory->labid,$laboratory->name); ?> <br/>
					<?php echo anchor('faculty/view/'.$laboratory->username,strtoupper($laboratory->last_name).', '.ucwords($laboratory->first_name).', '.ucfirst($laboratory->middle_name)[0].'.'); ?> <br/>
					<i class="fa fa-users"></i> &nbsp; <?php echo $laboratory->members_count; ?><br/>
					<?php echo $laboratory->since; ?>
				</div>
				<div class="large-4 medium-4 small-4 column">
					<i class="fa fa-flask" style="font-size:5em"></i>
				</div>
			</div>
		</button>
		</div>
		</div>
		<?php $expcounter++; ?>
		<?php if(($expcounter==(int)round(count($laboratories)/3))||($expcounter==(int)round((2*count($laboratories))/3))): ?>
		</div><div class="large-4 column">
		<?php endif; ?>
		<?php endforeach; ?>
		</div>
	</div>
<?php else: ?>
	<p> No Existing Laboratories. </p>
<? endif; ?>