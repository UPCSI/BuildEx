<h2>BuildEx: Create Account (Students)</h2>

 <fieldset>
	<legend>Sign Up</legend>
	<?php echo validation_errors();?>
	<?php echo form_open("signup/add_student") . "<br/>";?>

	<label>First Name</label><br/>
	<input type="text" id="signUpFName" required name="fname" placeholder="First Name"><br/><br/>

	<label>Middle Name</label><br/>
	<input type="text" id="signUpMName" required name="mname" placeholder="Middle Name"><br/><br/>

	<label>Last Name</label><br/>
	<input type="text" id="signUpLName" required name="lname" placeholder="Last Name"><br/><br/>

	<label>Email</label><br/>
	<input type="text" id="signUpEmail" required name="email" placeholder="Email"><br/><br/>

	<label>Username</label><br/>
	<input type="text" id="signUpUsername" required name="username" placeholder="Username"><br/><br/>

	<label>Password</label><br/>
	<input type="password" id="signUpPass" required name="password" placeholder="Password"><br/><br/>

	<label>Repeat Password</label><br/>
	<input type="password" id="signUpPass" required name="password2" placeholder="Enter password again."><br/><br/>

	<input type="submit" value="Signup">
	<?php echo form_close();?>
</fieldset>