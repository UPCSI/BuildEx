<h3>Graduate: My Laboratory</h3>
<hr>
<?php
	if (isset($main_lab)){ 
		echo '<h4>'.$main_lab->name.'</h4>';
		echo '<p><strong> No. of members: </strong>'.$main_lab->members_count.'</p>';
		echo '<h5> Faculty Members </h5>';
		if(isset($faculty_members)){
			foreach ($faculty_members as $member) {
				echo strtoupper($member->last_name).', '.ucwords($member->first_name).', '.ucfirst($member->middle_name);
				echo '<br>';
			}
		}
		else{
			echo '<p>There are no faculty members.</p>';
		}

	echo '<h5> Graduates </h5>';
		if(isset($graduates)){
			foreach ($graduates as $graduate) {
				echo strtoupper($graduate->last_name).', '.ucwords($graduate->first_name).', '.ucfirst($graduate->middle_name);
				echo '<br>';
			}
		}
		else{
			echo '<p>There are no students.</p>';
		}
	}
	else {
		$this->session->set_flashdata('is_member',false);
		echo '<p> You do not belong to any laboratory. </p>';
		echo '<hr>';
		echo '<h4> Apply to Laboratory </h4>';
		if (isset($laboratories)) {
			foreach ($laboratories as $laboratory) {
				echo '<a href = "'.site_url('laboratories/view/'.$laboratory->labid).'">';
				echo $laboratory->name;
				echo '</a>';
				echo '<br>';
			}
		}
		else echo '<p>There are no laboratories. Poor you. :(</p>';
	}
?>
<br>