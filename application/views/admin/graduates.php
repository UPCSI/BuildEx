<h1> Graduates </h1>
<hr>
<?php if(isset($graduates)): ?>
	<table>
		<thead>
			<tr>
				<th width="200">Name</th>
				<th width="150">Username</th>
			    <th width="150">Student No.</th>
			    <th width="150">Joined</th>
			</tr>
		</thead>
		<tbody>
	<?php foreach ($graduates as $graduate):?>
		<tr>
			<td>
				<a href = "<?php echo site_url('graduate/view/'.$graduate->username); ?>">
					<?php echo strtoupper($graduate->last_name).', '.ucwords($graduate->first_name).', '.ucfirst($graduate->middle_name).'.'; ?> 
				</a>
			</td>
			<td><?php echo $graduate->username; ?></td>
			<td><?php echo $graduate->student_num;?></td>
			<td>mm-dd-yyyy</td>
  		</tr>
	<?php endforeach; ?>
		</tbody>
	</table>	
<?php else: ?>
	<p> There are no graduates. </p>
<?php endif; ?>