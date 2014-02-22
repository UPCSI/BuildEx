<h1> Faculty </h1>
<hr>
<?php if(isset($user)): ?>
	<h2> <?php echo strtoupper($user->last_name).', '.ucwords($user->first_name).', '.ucfirst($user->middle_name); ?> </h2>
	<p><strong>Email Address: </strong> <?php echo $user->email_ad; ?></p>
	<?php if(isset($faculty)): ?>
		<p><strong>Faculty no:</strong> <?php echo $faculty->faculty_num; ?></p> 
	<?php endif; ?>
<?php endif; ?>
<hr>
<h2> Experiments </h2>
<?php if(isset($experiments)): ?>
	<table>
		<thead>
			<tr>
				<td width = "200"> Experiment </td>
				<td width = "125"> Respondents </td>
				<td width = "125"> Quota </td>
				<td width = "125"> Status </td>
				<td width = "125"> Published </td>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($experiments as $experiment):?>
			<tr>
				<td> <?php echo anchor('experiment/view/'.$experiment->eid, $experiment->title); ?> </td>
				<td> <?php echo $experiment->current_count; ?> </td>
				<td> <?php echo $experiment->target_count; ?> </td>
				<td> <?php if($experiment->status == 'f'){ echo "On-Going";}else{ echo "Complete"; } ?> </td>
				<td> <?php if($experiment->is_published == 'f'){ echo "False"; }else{ echo "True"; } ?> </td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php else: ?>
	<p> There are no experiments. </p>
<?php endif; ?>