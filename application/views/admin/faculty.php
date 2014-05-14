<h1>Faculty</h1>
<hr>
<!-- Notification Handling Part-->
<?php if(isset($notification)): ?>
	<div data-alert class="alert-box info"> <?php echo $notification; ?> <a href="#" class="close">&times;</a> </div>
<?php endif; ?>

<?php if(isset($faculty)): ?>
	<table>
		<thead>
			<tr>
				<th width="200">Name</th>
				<th width="150">Username</th>
			    <th width="150">Faculty No.</th>
			    <th width="150">Joined</th>
			</tr>
		</thead>
		<tbody>
	<?php foreach ($faculty as $member):?>
		<tr>
			<td>
				<a href = "<?php echo site_url('faculty/view/'.$member->username); ?>">
					<?php echo strtoupper($member->last_name).', '.ucwords($member->first_name).', '.ucfirst($member->middle_name).'.'; ?> 
				</a>
			</td>
			<td><?php echo $member->username; ?></td>
			<td><?php echo $member->faculty_num;?></td>
			<td>mm-dd-yyyy</td>
  		</tr>
	<?php endforeach; ?>
		</tbody>
	</table>
	<?php else: ?>
		<p> There are no active faculty member. </p>
<?php endif; ?>
<hr>
<h3> Faculty Requests 
	<?php
		if(isset($requests)){
			echo '('.count($requests).')';
		}
	?>
</h3>
<?php if(isset($requests)): ?>
	<table>
		<thead>
			<tr>
				<th width="200">Name</th>
				<th width="150">Username</th>
				<th width="150">Faculty No.</th>
				<th width="150">Joined</th>
				<th width="100">Confirm</th>
				<th width="100">Reject</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($requests as $request): ?>
			<tr>
				<td>
					<a href = "<?php echo site_url('faculty/view/'.$request->username); ?>">
						<?php echo strtoupper($request->last_name).', '.ucwords($request->first_name).', '.ucfirst($request->middle_name); ?>
					</a>
				</td>
				<td><?php echo $request->username; ?></td>
				<td><?php echo $request->faculty_num; ?></td>
				<td> mm-dd-yyyy </td>
				<td><a href="<?php echo site_url('admin/confirm_faculty/'.$request->fid); ?>" class="button tiny"> &#x2713; </a> </td>
				<td><a href="<?php echo site_url('admin/reject_faculty/'.$request->fid); ?>" class="button tiny"> &#x2717; </a> </td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php else: ?>
	</p> There are no pending requests.</p>
<?php endif; ?>