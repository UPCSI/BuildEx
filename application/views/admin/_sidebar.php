<ul class="off-canvas-list">
  <li><label><?php echo SITE_NAME; ?> - Administrator</label></li>
  <li><?php echo anchor(page_path(), 'Home'); ?></li>
  <li><?php echo anchor(page_path(''), 'Profile'); ?></li>
  <li><label>Listings</label></li>
  <li><a href = "<?php echo site_url('admin/administrators'); ?>">Administrators</a></li>
  <li><a href = "<?php echo site_url('admin/laboratories'); ?>">Laboratories</a></li>
  <li><a href = "<?php echo site_url('admin/faculty'); ?>">Faculty</a></li>
  <li><a href = "<?php echo site_url('admin/graduates'); ?>">Graduates</a></li>
  <li><a href = "<?php echo site_url('admin/experiments'); ?>">Experiments</a></li>
  <li><a href = "<?php echo site_url('admin/respondents'); ?>">Respondents</a></li>
</ul>