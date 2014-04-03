<h1> Personal Information </h1>
<p>*-required </p>

<?php echo form_open('respond/register'); ?>
	<fieldset>
		<legend>Personal Information</legend>

		<label>First Name</label>
		<input type="text" id="first_name" placeholder="First Name">

		<label>Middle Name</label>
		<input type="text" id="middle_name" placeholder="Middle Name">

		<label>Last Name</label>
		<input type="text" id="last_name" placeholder="Last Name">

		<label>Age</label>
		<input type="text" id="age" placeholder="18">

		<label>Email</label>
		<input type="text" id="email"  placeholder="yourname@example.com">

		<label>Address</label>
		<input type="text" id="address" placeholder="#69 Salvador St., Brgy. Krus Na Ligas, Quezon City">

		<label>Nationality</label>
		<input type="text" id="nationality" placeholder="Filipino">

		<label>Civil Status</label>
		<input type="radio" name = "civil_status" value = "0"> Single </br>
		<input type="radio" name = "civil_status" value = "1"> Married </br>
		<input type="radio" name = "civil_status" value = "2"> Separated </br>
		<input type="radio" name = "civil_status" value = "3"> Widowed </br>

		<label>Gender</label>
		<select name = "gender">
			<optgroup>
				<option value = "none"> 		None 		</option>
				<option value = "bisexual"> 	Bisexual 	</option>
				<option value = "female"> 		Female 		</option>
				<option value = "gay"> 			Gay 		</option>
				<option value = "lesbian"> 		Lesbian 	</option>
				<option value = "male"> 		Male 		</option>
				<option value = "transgender"> Transgender 	</option>
			</optgroup>
		</select>

	</fieldset>
	<input type="submit" class="button small" value="Submit">
	<button class = "small" onclick = "clear();"> Reset </button>
<?php echo form_close(); ?>