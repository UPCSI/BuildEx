<?php echo form_open("signup/add_faculty") . "<br/>";?>
	<div class="row">
		<div class="large-4 columns">
			<label>First Name</label>
			<input type="text" id="signUpFName" required name="fname" placeholder="First Name">
		</div>
		<div class="large-4 columns">
			<label>Middle Name</label>
			<input type="text" id="signUpMName" required name="mname" placeholder="Middle Name">
		</div>
		<div class="large-4 columns">
			<label>Last Name</label>
			<input type="text" id="signUpLName" required name="lname" placeholder="Last Name">
		</div>
	</div>

	<label>Email</label>
	<input type="text" id="signUpEmail" required name="email" placeholder="Email">

	<label>Faculty no.</label>
		<input type="text" id="faculty_num" required name="faculty_num" placeholder="201131208">

	<label>Username</label>
	<input type="text" id="signUpUsername" required name="username" placeholder="Username">

	<label>Password</label>
	<input type="password" id="signUpPass" required name="password" placeholder="Password">

	<label>Repeat Password</label>
	<input type="password" id="signUpPass" required name="password2" placeholder="Enter password again.">

	<input type="submit" class="button" value="Signup">
<?php echo form_close();?>