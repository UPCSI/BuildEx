<h1 class="white"> Experiments </h1>

<div class="row">
<div class="large-12 column">
<h3 class="white" style="display:inline">Advisory Experiments</h3>
<?php if(isset($requests)): ?>
	<br class="hide-for-large"/>
	<span style='color:#e74c3c !important'><a href="#requests"><i class="fa fa-exclamation-circle"></i> <?php echo count($requests) ?> pending requests</a></span>
<?php endif; ?>
</div>
</div>

<!-- Notification Handling Part-->
<?php if(isset($notification)): ?>
	<div data-alert class="alert-box info"> <?php echo $notification; ?> <a href="#" class="close">&times;</a> </div>
<?php endif; ?>

<h3>Graduates' Experiments</h3>
<?php if(isset($experiments)): ?>
	<!--table style="width:100%;display:none">
		<thead>
			<tr>
				<td width = "150"> Experiment </td>
				<td width = "150"> Researcher </td>
				<td width = "125"> Respondents </td>
				<td width = "125"> Quota </td>
				<td width = "125"> Status </td>
				<td width = "125"> Published </td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($experiments as $experiment): ?>
				<tr>
					<td><?php echo anchor('experiment/view/' . $experiment->eid, $experiment->title); ?></td>
					<td><a href = "<?php echo site_url('graduate/view/'.$experiment->username); ?>"><?php echo strtoupper($experiment->last_name).', '.ucwords($experiment->first_name).', '.ucfirst($experiment->middle_name); ?></a></td> 
					<td><?php echo $experiment->current_count; ?></td>
					<td><?php echo $experiment->target_count; ?></td>
					<td><?php if($experiment->status == 'f'){ echo "On-Going";}else{ echo "Complete"; } ?> </td>
					<td><?php if($experiment->is_published == 'f'){ echo "False"; }else{ echo "True"; } ?> </td>
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
				<h3> <?php echo anchor('experiment/view/' . $experiment->eid, $experiment->title); ?> </h3>
			</div>
		</div>
		</div>	
		<div class="row">
			<div class="large-12 column">
				<div class="panel">
				<h5><a href = "<?php echo site_url('graduate/view/'.$experiment->username); ?>"><?php echo strtoupper($experiment->last_name).', '.ucwords($experiment->first_name).', '.ucfirst($experiment->middle_name); ?></a></h5>
				<h5> Respondents: <?php echo $experiment->current_count; ?> </h5>
				<h5> Quota: <?php echo $experiment->target_count; ?> </h5>
				<h5> <?php if($experiment->status == 'f'){ if($experiment->is_published == 'f'){echo "<span style='color:#f1c40f'><i class='fa fa-minus-circle'></i> Standby </span>";}else{echo "<span style='color:#f1c40f'><i class='fa fa-play-circle'></i> Ongoing </span>";}}else{ echo "<span style='color:#36d077'><i class='fa fa-check-circle'></i> Complete </span>"; } ?> </h5>
				<h5> <?php if($experiment->is_published == 'f'){ if($experiment->status == 'f'){echo "<span style='color:#e74c3c'><i class='fa fa-times-circle'></i> Not published</span>";}else{echo "<span style='color:#f1c40f'><i class='fa fa-times-circle'></i> Closed</span>";} }else{ echo "<span style='color:#36d077'><i class='fa fa-check-circle'></i> Published</span>"; } ?> </h5>
			</div>
			</div>
		</div>
	</div>
	<?php $expcounter++; ?>
	<?php if($expcounter==(int)round(count($experiments)/2)): ?>
	</div><div class="large-6 column">
	<?php endif; ?>
	<?php endforeach; ?>
	</div>
	</div>

<?php else: ?>
	<p> You are not advising any experiment. </p>
<?php endif; ?>

<h3 name="requests"> Experiments to be advised </h3>
<?php if(isset($requests)): ?>
	<!--table style="width:100%;display:none">
		<thead>
			<tr>
				<td width = "150"> Experiment </td>
				<td width = "150"> Researcher </td>
				<td width = "125"> Respondents </td>
				<td width = "125"> Quota </td>
				<td width = "125"> Status </td>
				<td width = "125"> Published </td>
				<td width = "100"> Advise </td>
				<td width = "100"> Reject </td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($requests as $request): ?>
				<tr>
					<td><?php echo anchor('experiment/view/' . $request->eid, $request->title); ?></td>
					<td><a href = "graduate/view/<?php echo $request->username; ?>"><?php echo strtoupper($request->last_name).', '.ucwords($request->first_name).', '.ucfirst($request->middle_name); ?></a></td> 
					<td><?php echo $request->current_count; ?></td>
					<td><?php echo $request->target_count; ?></td>
					<td><?php if($request->status == 'f'){ echo "On-Going";}else{ echo "Complete"; } ?> </td>
					<td><?php if($request->is_published == 'f'){ echo "False"; }else{ echo "True"; } ?> </td>
					<td><a class = "button tiny" href = "<?php echo site_url('faculty/confirm_experiment/'.$request->eid); ?>"> Accept </a></td>
					<td><a class = "button tiny" href = "<?php echo site_url('faculty/reject_experiment/'.$request->eid); ?>"> Reject </a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table-->
<?php else: ?>
	<p> You have no pending advisory requests. </p>
<?php endif; ?>
