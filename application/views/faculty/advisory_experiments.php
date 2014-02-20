<h1> Advisory Experiments </h1>
<hr>
<!-- Notification Handling Part-->
<?php if(isset($notification)): ?>
	<div data-alert class="alert-box info"> <?php echo $notification; ?> <a href="#" class="close">&times;</a> </div>
<?php endif; ?>

<h3>Graduates' Experiments</h3>
<?php if(isset($experiments)): ?>
	<table>
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
					<td><a href = "graduate/view/<?php echo $experiment->username; ?>"><?php echo strtoupper($experiment->last_name).', '.ucwords($experiment->first_name).', '.ucfirst($experiment->middle_name); ?></a></td> 
					<td><?php echo $experiment->current_count; ?></td>
					<td><?php echo $experiment->target_count; ?></td>
					<td><?php if($experiment->status == 'f'){ echo "On-Going";}else{ echo "Complete"; } ?> </td>
					<td><?php if($experiment->is_published == 'f'){ echo "False"; }else{ echo "True"; } ?> </td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php else: ?>
	<p> You're not advising any experiment. </p>
<?php endif; ?>
<hr>
<h3> Experiments to be advised </h3>
<?php if(isset($requests)): ?>
	<table>
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
	</table>
<?php else: ?>
	<p> There is no advisory request. </p>
<?php endif; ?>
