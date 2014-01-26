<h2>BuildEx: Admin: Create Laboratory</h2>

<fieldset>
	<legend>Sign Up</legend>
	<?php echo validation_errors();?>
	<?php echo form_open("admin/add_lab") . "<br/>";?>1

	<label>Lab Name</label><br/>
	<input type="text" id="labname" required name="lab_name" placeholder="My Laboratory"><br/><br/>

	<label>Lab Head</label><br/>
	<input type="text" id="labhead" required name="lab_head" placeholder="Lab Head"><br/><br/>

	<input type="submit" value="Create">
	<?php echo form_close();?>
</fieldset>