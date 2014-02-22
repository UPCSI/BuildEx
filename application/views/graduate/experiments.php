<h1> Experiments </h1>
<hr>

<!-- Notification Handling Part-->
<?php if(isset($notification)): ?>
	<div data-alert class="alert-box info"> <?php echo $notification; ?> <a href="#" class="close">&times;</a> </div>
<?php endif; ?>

<h3>My Experiments</h3>
<?php if(isset($experiments)): ?>
	<table>
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
				<td> <?php echo anchor('graduate/view_experiment/'.$gid.'/'.$experiment->eid, $experiment->title); ?> </td>
				<td> <?php echo $experiment->current_count; ?> </td>
				<td> <?php echo $experiment->target_count; ?> </td>
				<td> <?php if($experiment->status == 'f'){ echo "On-Going";}else{ echo "Complete"; } ?> </td>
				<td> <?php if($experiment->is_published == 'f'){ echo "False"; }else{ echo "True"; } ?> </td>
				<td> <a class = "button tiny" href = "<?php echo site_url('experiment/delete_experiment/'.$experiment->eid); ?>"> Delete </a> <a class = "button tiny" href = "<?php echo site_url('experiment/edit_experiment/'.$experiment->eid); ?>"> Edit </a> </td>	
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php else: ?>
	<p> You have no experiments </p>
<?php endif; ?>
<a class = "button small" href="#" data-reveal-id="createExperiment">Create Experiment</a>
<!-- Modal - Create Experiment -->
<div id="createExperiment" class="reveal-modal tiny" data-reveal>
  <h2>Create an Experiment</h2>
	<?php echo validation_errors();?>
	<?php echo form_open("experiment/add_experiment");?>

	<label>Title</label>
	<input type="text" id="title" required name="title" placeholder="Title">

	<label>Description</label>
	<input type="text" id="description" required name="description" placeholder="Description">

	<label>Target Count</label><br/>
	<input type="text" id="targetCount" required name="target_count" placeholder="Target Count"><br/><br/>

	<input type="submit" class="button" value="Create Experiment">

	<?php echo form_close();?>
  <a class="close-reveal-modal">&#215;</a>
</div>
<!-- <a href = "<?php echo site_url('experiment'); ?>">Create Experiment</a><br/> -->