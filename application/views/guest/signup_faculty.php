<div class="row full" style="padding-top:2%">
	<h2>Create Account - Faculty</h2>
	<div class="large-3 columns large-push-9">
		Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
	</div>
	<div class="large-9 columns large-pull-3">
		<fieldset>
			<legend>Sign Up</legend>
			<?php echo validation_errors();?>
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

			<label>Username</label>
			<input type="text" id="signUpUsername" required name="username" placeholder="Username">

			<label>Password</label>
			<input type="password" id="signUpPass" required name="password" placeholder="Password">

			<label>Repeat Password</label>
			<input type="password" id="signUpPass" required name="password2" placeholder="Enter password again.">

			<input type="submit" class="button" value="Signup">
			<?php echo form_close();?>
		</fieldset>
	</div>
</div>