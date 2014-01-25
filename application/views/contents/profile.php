<h2>BuildEx: Profile</h2>

<fieldset>
	<legend>Profile</legend>

	<label>First Name</label><br/>
	<input type="text" id="signUpFName" required name="fname" value="<?php echo $user_profile->first_name; ?>" placeholder="First Name"><br/><br/>

	<label>Middle Name</label><br/>
	<input type="text" id="signUpMName" required name="mname" value="<?php echo $user_profile->middle_name; ?>" placeholder="Middle Name"><br/><br/>

	<label>Last Name</label><br/>
	<input type="text" id="signUpLName" required name="lname" value="<?php echo $user_profile->last_name; ?>" placeholder="Last Name"><br/><br/>

	<label>Email</label><br/>
	<input type="text" id="signUpEmail" required name="email" value="<?php echo $user_profile->email_ad; ?>" placeholder="Email"><br/><br/>

	<label>Username</label><br/>
	<input type="text" id="signUpUsername" required name="username" value="<?php echo $user_profile->username; ?>" placeholder="Username"><br/><br/>

	<!--<label>Faculty Number</label><br/>
	<input type="text" id="faculty_number" required name="faculty_number" value="<?php echo $faculty_profile->faculty_num; ?>" placeholder="201131208"><br/><br/>-->
</fieldset>
<?php //echo '<pre>'; print_r($profile); echo '</pre>'; ?>
<?php
	if($experiments != -1){
		echo '<h2>My Experiments</h2>';
		if($experiments != NULL){
			foreach ($experiments as $experiment){
				echo anchor('experiment/view_experiment/' . $profile->uid . '_' . $experiment->eid, $experiment->title);
				echo '</br>';
			}
		}
		else
			echo 'None at the moment';
	}
?>
