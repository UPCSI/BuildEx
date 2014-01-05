<h2>BuildEx: Login</h2>

 <fieldset>
	<legend>Sign In</legend>
	<?php echo validation_errors();?>
	<?php echo form_open("login/validate_user") . "<br/>";?>

	<label>Username</label>
	<input type="text" id="signInUsername" required name="username" placeholder="Enter username">

	<label>Password</label>
	<input type="password" id="signInPass" required name="password" placeholder="Password">
	<input type="submit" value="Login">
	<?php echo form_close();?>
</fieldset><br/>

<a href = "<?php echo site_url('signup/faculty'); ?>"> Sign Up (Faculty)</a><br/>
<a href = "<?php echo site_url('signup/student'); ?>"> Sign Up (Students)</a><br/><br/>
<a href = "<?php echo site_url('login/reset'); ?>"> Forgot your password?</a><br/><br/>
