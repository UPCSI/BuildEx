<?php echo form_open("laboratories/create");?>
    <fieldset>
        <legend>Create Laboratory</legend>
        <label>Lab Name</label><br/>
        
        <input type="text" id="laboratory" required name="laboratory" placeholder = "My Laboratory">
        <br/>

        <label>Description</label><br/>
        <input type="text" id="description" required name="description" placeholder = "Description">
        <br/>

        <label>Lab Head</label><br/>
        <input type="text" id="faculty" required name="faculty" placeholder = "Name of faculty member">
        <br/>

        <input class = "button small" type="submit" value="Create">
    </fieldset>
<?php echo form_close();?>