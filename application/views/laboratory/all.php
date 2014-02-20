<h1> Laboratories </h1>
<hr>

<?php if (isset($laboratories)): ?>
	<table>
		<thead>
			<tr>
				<td width ="150"> Laboratory </td>
				<td width ="200"> Lab Head </td>
				<td width ="150"> No. of Members </td>
				<td width ="150"> Since </td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($laboratories as $laboratory): ?>
				<tr>
					<td> <?php echo anchor('laboratories/view/'.$laboratory->labid,$laboratory->name); ?> </td>
					<td> <?php echo anchor('faculty/view/'.$laboratory->username,strtoupper($laboratory->last_name).', '.ucwords($laboratory->first_name).', '.ucfirst($laboratory->middle_name)[0].'.'); ?>
					<td> <?php echo $laboratory->members_count; ?></td>
					<td> <?php echo $laboratory->since; ?> </td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php else: ?>
	<p> No Existing Laboratories. </p>
<? endif; ?>