<h3> Graduates Requests 
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
			echo $request->username;
			echo 	' : ' .strtoupper($request->last_name)
					.', ' .ucwords($request->first_name)
					.' ' .ucfirst($request->middle_name);
			echo form_open('labhead/confirm_graduate/'.$request->gid);
			echo form_submit('submit','Confirm');
			echo form_close();

			echo form_open('labhead/reject_graduate/'.$request->gid);
			echo form_submit('submit','Reject');
			echo form_close();
			echo '<br>';
		}
	}

	else
		echo 'There are no requests.';
?>