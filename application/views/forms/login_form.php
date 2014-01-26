<?php echo form_open('login/validate_user');

echo form_input('username',set_value('username'),'placeholder = "username"'); 
echo form_password('password','','placeholder="password"');
echo form_submit('submit','Log in');

echo form_close(); ?>