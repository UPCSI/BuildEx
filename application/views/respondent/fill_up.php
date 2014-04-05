<div class = "row" style = "padding-top:50px">
	<h1> Personal Information </h1>
	<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum </p>
	<p>*-required </p>
</div>
<form id = "demographics" action="<?php echo site_url('respond/register'); ?>" method = "post" accept-charset="utf-8">	
	<div class = "row">
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
			<input type="radio" name = "civil_status" value = "0"> Single
			<input type="radio" name = "civil_status" value = "1"> Married
			<input type="radio" name = "civil_status" value = "2"> Separated
			<input type="radio" name = "civil_status" value = "3"> Widowed
			<br/>
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
	</div>
	</fieldset>
	<div class = "row">
		<button type="submit" class="small"> Submit </button>
		<button type = "button" class = "small" onclick = "clear_form()"> Reset </button> <!-- clear all inputs -->
	</div>
</form>
