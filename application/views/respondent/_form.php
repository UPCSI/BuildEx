<form id = "demographics" action="<?php echo site_url("respond/{$experiment->url}/create"); ?>" method = "post" accept-charset="utf-8">  
  <div class = "row">
    <fieldset>
      <legend>Personal Information</legend>

      <label>First Name</label>
      <input type="text" id="first_name"  required name = "first_name" placeholder="First Name">

      <label>Middle Name</label>
      <input type="text" id="middle_name" required name = "middle_name" placeholder="Middle Name">

      <label>Last Name</label>
      <input type="text" id="last_name" required name = "last_name" placeholder="Last Name">

      <label>Age</label>
      <input type="text" id="age" required name = "age" placeholder="18">

      <label>Email</label>
      <input type="text" id="email"  required name = "email" placeholder="yourname@example.com">

      <label>Address</label>
      <input type="text" id="address" required name = "address" placeholder="#69 Salvador St., Brgy. Krus Na Ligas, Quezon City">

      <label>Nationality</label>
      <input type="text" id="nationality" required name = "nationality" placeholder="Filipino">

      <label>Civil Status</label>
      <input type="radio" name = "civil_status" value = "0"> Single
      <input type="radio" name = "civil_status" value = "1"> Married
      <input type="radio" name = "civil_status" value = "2"> Separated
      <input type="radio" name = "civil_status" value = "3"> Widowed
      <br/>
      <label>Sex</label>
      <select name = "gender">
        <optgroup>
          <option value = "none">Male</option>
          <option value = "bisexual">Female</option>
        </optgroup>
      </select>
  </div>
  </fieldset>
  <div class = "row">
    <button type="submit" class="small">Submit</button>
    <button type = "button" class = "small" onclick = "clear_form()">Reset</button>
  </div>
</form>
