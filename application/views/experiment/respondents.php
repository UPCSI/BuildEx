<h1> Respondents [<?php echo count($respondents); ?>] </h1>
</hr>

<?php if(isset($notification)): ?>
	<div data-alert class="alert-box info"> <?php echo $notification; ?> <a href="#" class="close">&times;</a> </div>
<?php endif; ?>

<?php $i = 1; ?>
<?php if(isset($respondents)): ?>
	<table>
		<thead>
			<tr>
				<td width = "50"> # </td>
				<td width = "175"> IP Address </td>
				<td width = "350"> Agents </td>
				<td width = "200"> Time Stamp </td>
				<td width = "150"> Actions </td>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($respondents as $respondent):?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td> <?php echo $respondent->ip_addr; ?> </td>
				<td> <?php echo $respondent->user_agent; ?> </td>
				<td> <?php echo $respondent->since; ?> </td>
				<td> <a class = "button tiny" href = "<?php echo site_url('respondent/delete_respondent/'.$respondent->rid); ?>"> Delete </a>
			</tr>
			<?php $i++; ?>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php else: ?>
	<p> You have no respondents for this experiment. </p>
<?php endif; ?>

