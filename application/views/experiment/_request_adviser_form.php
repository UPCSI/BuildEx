<?php echo form_open(experiment_path($experiment, 'request_adviser')); ?>
    <label><strong> Faculty Adviser </strong></label><br/>
    <input type="text" id="faculty_uname" required name="faculty_uname" placeholder="mtcarreon">
    <input type="submit" value="Publish">
<?php echo form_close();?>
