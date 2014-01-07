<h2>BuildEx: Profile</h2>

<fieldset>
	<legend>Profile</legend>

	<label>First Name</label><br/>
	<input type="text" id="signUpFName" required name="fname" value="<?php echo $profile->first_name; ?>" placeholder="First Name"><br/><br/>

	<label>Middle Name</label><br/>
	<input type="text" id="signUpMName" required name="mname" value="<?php echo $profile->middle_name; ?>" placeholder="Middle Name"><br/><br/>

	<label>Last Name</label><br/>
	<input type="text" id="signUpLName" required name="lname" value="<?php echo $profile->last_name; ?>" placeholder="Last Name"><br/><br/>

	<label>Email</label><br/>
	<input type="text" id="signUpEmail" required name="email" value="<?php echo $profile->email_ad; ?>" placeholder="Email"><br/><br/>

	<label>Username</label><br/>
	<input type="text" id="signUpUsername" required name="username" value="<?php echo $profile->username; ?>" placeholder="Username"><br/><br/>

</fieldset>
<?php echo '<pre>'; print_r($profile); echo '</pre>'; ?>
