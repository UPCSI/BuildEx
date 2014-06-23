<?php echo form_open('admins/create'); ?>
    <label>Username</label>
    <input type="text" id="username" required name="username" placeholder="Username">

    <button type="submit" class="button tiny" value="create"> Create </button>
<?php echo form_close();?>