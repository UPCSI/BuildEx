<?php if(isset($admins)): ?>
  <table>
    <thead>
      <tr>
        <th width="200">Name</th>
        <th width="150">Username</th>
        <th width="200">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($admins as $admin):?>
        <tr>
          <td><?php echo anchor(admin_path($admin), format_short_name($admin)); ?></td>
          <td><?php echo $admin->username; ?></td>
          <td>
            <?php echo form_open('admins/destroy'); ?>
              <?php echo form_hidden('admin_id', $admin->aid); ?>
              <button class = "button tiny" type="submit" value="delete">&#x2717;</button>
            <?php echo form_close(); ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>There are no active admins.</p>
<?php endif; ?>