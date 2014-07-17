<h2><?php echo SITE_NAME; ?>: Reset Password</h2>

 <fieldset>
	<legend>We'll give you a temporary one!</legend>
	<?php echo validation_errors();?>
	<?php echo form_open("sign_in/reset_password"); ?>
	<label>Email</label>
	<input type="text" id="resetEmail" required name="email" placeholder="Enter email">
	<input type="submit" value="Reset">
	<?php echo form_close();?>
</fieldset><br/>

<a href = "<?php echo site_url('sign_in'); ?>"> Login </a><br/>
