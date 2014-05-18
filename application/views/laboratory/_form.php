<?php echo form_open("laboratories/create");?>
    <fieldset>
        <legend>Create Laboratory</legend>
        <label>Lab Name</label><br/>
        <input type="text" id="labname" required name="lab_name" placeholder="My Laboratory"><br/><br/>

        <label>Description</label><br/>
        <input type="text" id="description" required name="description" placeholder="This lab is..."><br/><br/>

        <label>Lab Head</label><br/>
        <input type="text" id="labhead" required name="lab_head" placeholder="Lab Head"><br/><br/>

        <input class = "button small" type="submit" value="Create">
    </fieldset>
<?php echo form_close();?>