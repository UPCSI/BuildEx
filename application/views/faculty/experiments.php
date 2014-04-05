<h1 class="white"> Experiments </h1>

<? //echo '<pre>'; print_r($this->session->userdata); echo '</pre>'; ?>

<!-- Notification Handling Part-->
<?php if(isset($notification)): ?>
	<div data-alert class="alert-box info"> <?php echo $notification; ?> <a href="#" class="close">&times;</a> </div>
<?php endif; ?>
<div class="row">
<div class="large-6 medium-6 small-6 column">
<h3 class="white">My Experiments</h3>
</div>
<div class="large-6 medium-6 small-6 column">
<a style="float:right" class = "button small" href="#" data-reveal-id="create_experiment_modal">Create Experiment</a>
</div>
</div>
<?php if(isset($experiments)): ?>

	<!--table style="width:100%;display:none">
		<thead>
			<tr>
				<td width = "200"> Experiment </td>
				<td width = "125"> Respondents </td>
				<td width = "125"> Quota </td>
				<td width = "125"> Status </td>
				<td width = "125"> Published </td>
				<td width = "200"> Actions </td>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($experiments as $experiment):?>
			<tr>
				<td> <?php echo anchor('faculty/view_experiment/'.$experiment->eid, $experiment->title); ?> </td>
				<td> <?php echo $experiment->current_count; ?> </td>
				<td> <?php echo $experiment->target_count; ?> </td>
				<td> <?php if($experiment->status == 'f'){ echo "On-Going";}else{ echo "Complete"; } ?> </td>
				<td> <?php if($experiment->is_published == 'f'){ echo "False"; }else{ echo "True"; } ?> </td>
				<td> <a class = "button tiny" href = "<?php echo site_url('experiment/delete_experiment/'.$experiment->eid); ?>"> Delete </a> <a class = "button tiny" href = "<?php echo site_url('builder/app/'.$experiment->eid); ?>"> Edit </a> </td>	
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table-->

	<div class="row">
	<div class="large-6 column">
	<?php $expcounter = 0; ?>
	<?php foreach ($experiments as $experiment):?>
	<div class="panel exp">
		<div class="titleholder">
		<div class="row full">
			<div class="large-12 column">
				<h3> <?php echo anchor('faculty/view_experiment/'.$experiment->eid, $experiment->title); ?> </h3>
			</div>
		</div>
		</div>	
		<div class="row">
			<div class="large-12 column">
				<div class="panel">
				<h5> Quota: <?php echo $experiment->current_count; ?>/<?php echo $experiment->target_count; ?> </h5>
				<h5> <?php if($experiment->status == 'f'){ if($experiment->is_published == 'f'){echo "<span style='color:#f1c40f'><i class='fa fa-minus-circle'></i> Standby </span>";}else{echo "<span style='color:#f1c40f'><i class='fa fa-play-circle'></i> Ongoing </span>";}}else{ echo "<span style='color:#36d077'><i class='fa fa-check-circle'></i> Complete </span>"; } ?> </h5>
				<h5> <?php if($experiment->is_published == 'f'){ if($experiment->status == 'f'){echo "<span style='color:#e74c3c'><i class='fa fa-times-circle'></i> Not published</span>";}else{echo "<span style='color:#f1c40f'><i class='fa fa-times-circle'></i> Closed</span>";} }else{ echo "<span style='color:#36d077'><i class='fa fa-check-circle'></i> Published</span>"; } ?> </h5>
				<h5 class="actions"> <a class = "button tiny" href = "<?php echo site_url('experiment/delete_experiment/'.$experiment->eid); ?>"> Delete </a> <a class = "button tiny" href = "<?php echo site_url('builder/app/'.$experiment->eid); ?>"> Edit </a> </h5>	
			</div>
			</div>
		</div>
	</div>
	<?php $expcounter++; ?>
	<?php if($expcounter==((int)round(count($experiments)/2))): ?>
	</div><div class="large-6 column">
	<?php endif; ?>
	<?php endforeach; ?>
	</div>
	</div>
<?php else: ?>
	<p> You have no experiments </p>
<?php endif; ?>

<!-- Modal - Create Experiment -->
<div id="create_experiment_modal" class="reveal-modal small" data-reveal>
  <h2>Create an Experiment</h2>
	<?php echo validation_errors();?>
	<?php echo form_open("experiment/add_experiment");?>
	<fieldset>
		<legend> Create Experiment </legend>
		<label>Title</label>
		<input type="text" id="title" required name="title" placeholder="Title">

		<label>Description</label>
		<input type="text" id="description" required name="description" placeholder="Description">

		<label>Target Count</label><br/>
		<input type="text" id="targetCount" required name="target_count" placeholder="Target Count"><br/><br/>

		<input type="submit" class="button small" value="Create Experiment">
	</fieldset>
	<?php echo form_close();?>
  <a class="close-reveal-modal">&#215;</a>
</div>