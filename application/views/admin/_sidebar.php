<ul class="off-canvas-list">
  <li><label><?php echo SITE_NAME; ?> - Administrator</label></li>
  <li><?php echo anchor(page_path(), 'Home'); ?></li>
  <li><?php echo anchor(page_path(''), 'Profile'); ?></li>
  <li><label>Listings</label></li>
  <li><a href = "<?php echo site_url('admins/administrators'); ?>">Administrators</a></li>
  <li><a href = "<?php echo site_url('admins/laboratories'); ?>">Laboratories</a></li>
  <li><a href = "<?php echo site_url('admins/faculty'); ?>">Faculty</a></li>
  <li><a href = "<?php echo site_url('admins/graduates'); ?>">Graduates</a></li>
  <li><a href = "<?php echo site_url('admins/experiments'); ?>">Experiments</a></li>
  <li><a href = "<?php echo site_url('admins/respondents'); ?>">Respondents</a></li>
</ul>