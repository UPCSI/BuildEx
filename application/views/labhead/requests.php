<h1> Requests </h1>
<hr>
<!--Notification handling -->
<?php if(isset($notification)): ?>
	<div data-alert class="alert-box info"> <?php echo $notification; ?> <a href="#" class="close">&times;</a> </div>
<?php endif; ?>

<h2> Faculty Requests <?php if(isset($fac_requests)){ echo '('.count($fac_requests).')'; } ?> </h2>
<?php if(isset($fac_requests)): ?>
	<table>
		<thead>
			<tr>
				<th width="200">Name</th>
				<th width="150">Username</th>
			    <th width="150">Faculty No.</th>
			    <th width="150">Applied</th>
			    <th width="150">Confirm</th>
			    <th width="150">Reject</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($fac_requests as $request): ?>
			<tr>
				<td> <?php echo strtoupper($request->last_name).', ' .ucwords($request->first_name).' ' .ucfirst($request->middle_name); ?> </td>
				<td> <?php echo $request->username; ?> </td>
				<td> <?php echo $request->faculty_num; ?> </td>
				<td> <?php echo $request->since; ?> </td>
				<td><a class = "button tiny" href = "<?php echo site_url('labhead/confirm_faculty'.$request->labid.'/'.$request->fid); ?>"> Confirm </a></td>
				<td><a class = "button tiny" href = "<?php echo site_url('labhead/reject_faculty/'.$request->fid); ?>"> Reject </a></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php else: ?>
	<p> There are no requests. </p>
<?php endif; ?>

<hr>

<h2> Graduates Requests <?php if(isset($grad_requests)){ echo '('.count($grad_requests).')'; }?> </h2>
<?php if(isset($grad_requests)): ?>
	<table>
		<thead>
			<tr>
				<th width="200">Name</th>
				<th width="150">Username</th>
			    <th width="150">Student No.</th>
			    <th width="150">Applied</th>
			    <th width="150">Confirm</th>
			    <th width="150">Reject</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($grad_requests as $request): ?>
			<tr>
				<td> <?php echo strtoupper($request->last_name).', ' .ucwords($request->first_name).' ' .ucfirst($request->middle_name); ?> </td>
				<td> <?php echo $request->username; ?> </td>
				<td> <?php echo $request->student_num; ?> </td>
				<td> <?php echo $request->since; ?> </td>
				<td><a class = "button tiny" href = "<?php echo site_url('labhead/confirm_graduate/'.$request->labid.'/'.$request->gid); ?>"> Confirm </a></td>
				<td><a class = "button tiny" href = "<?php echo site_url('labhead/reject_graduate/'.$request->labid.'/'.$request->gid); ?>"> Reject </a></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php else: ?>
	<p> There are no requests. </p>
<?php endif; ?>