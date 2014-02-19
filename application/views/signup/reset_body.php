<h2>BuildEx: Reset Password</h2>

 <fieldset>
	<legend>We'll give you a temporary one!</legend>
	<?php echo validation_errors();?>
	<?php echo form_open("login/reset_password") . "<br/>";?>

	<label>Email</label>
	<input type="text" id="resetEmail" required name="email" placeholder="Enter email">
	<input type="submit" value="Reset">
	<?php echo form_close();?>
</fieldset><br/>

<a href = "<?php echo site_url('login'); ?>"> Login </a><br/>
