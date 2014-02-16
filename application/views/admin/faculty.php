<h3>Admin: Faculty</h3>
<hr>
<!-- Notification Handling Part-->
<?php if(isset($notification)): ?>
	<pre> <?php echo $notification; ?> </pre> <br>
<?php endif; ?>

<?php
	if(isset($faculty)){
		$count = 0;
		foreach ($faculty as $faculty){
			$count = $count + 1;
			echo $count.'. ';
			echo anchor('faculty/view/'.$faculty->username,$faculty->username);
			echo '</br>';
		}
	}
	else{
		echo 'There are no active faculty member.';
	}
?>
<br>
<hr>
<h3> Faculty Requests 
	<?php
		if(isset($requests)){
			echo '('.count($requests).')';
		}
	?>
</h3>
<?php
	if(isset($requests)){
		$count = 0;
		foreach($requests as $request){
			$count = $count + 1;
			echo $count.'. ';
			echo anchor('faculty/view/'.$request->username,$request->username);
			echo ' : '.strtoupper($request->last_name).', '.ucwords($request->first_name).', '.ucfirst($request->middle_name).' : '.$request->faculty_num;
			echo form_open('admin/confirm_faculty/'.$request->fid);
			echo form_submit('submit','Confirm');
			echo form_close();
			echo form_open('admin/reject_faculty/'.$request->fid);
			echo form_submit('submit','Reject');
			echo form_close();
			echo '<br>';
		}
	}
	else{
		echo 'There are no requests.';
	}
?>