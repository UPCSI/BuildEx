<?php echo form_open('faculty/create'); ?>
	<div class="row">
		<div class="large-4 columns">
			<label>First Name</label>
			<input type="text" id="first_name" required name="first_name" placeholder="First Name">
		</div>
		<div class="large-4 columns">
			<label>Middle Name</label>
			<input type="text" id="middle_name" required name="middle_name" placeholder="Middle Name">
		</div>
		<div class="large-4 columns">
			<label>Last Name</label>
			<input type="text" id="last_name" required name="last_name" placeholder="Last Name">
		</div>
	</div>

	<label>Email</label>
	<input type="text" id="emailusername" required name="email" placeholder="Email">

	<label>Faculty no.</label>
		<input type="text" id="faculty_num" required name="faculty_num" placeholder="201131208">

	<label>Username</label>
	<input type="text" id="username" required name="username" placeholder="Username">

	<label>Password</label>
	<input type="password" id="password" required name="password" placeholder="Password">

	<label>Repeat Password</label>
	<input type="password" id="password" required name="password2" placeholder="Enter password again.">

	<input type="submit" class="button" value="Signup">
<?php echo form_close();?>