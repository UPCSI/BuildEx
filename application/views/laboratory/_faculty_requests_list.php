<h3>Faculty Requests 
  <?php if(isset($requests)): ?>
    (<?php echo count($requests); ?>)
  <?php endif; ?>
</h3>
<?php if(isset($requests)): ?>
  <table>
    <thead>
      <tr>
        <th width="200">Name</th>
        <th width="150">Username</th>
        <th width="150">Faculty No.</th>
        <th width="150">Joined</th>
        <th width="200">Actions</th>
      </tr>
    </thead>
      <tbody>
        <?php foreach($requests as $member): ?>
        <tr>
          <td><?php echo anchor(faculty_path($member), format_full_name($member)); ?></td>
          <td><?php echo $member->username; ?></td>
          <td><?php echo $member->faculty_num; ?></td>
          <td>mm-dd-yyyy</td>
          <td>
            <?php echo form_open('labheads/accept_faculty'); ?>
              <?php echo form_hidden('faculty_id', $member->fid); ?>
              <button class = "button tiny" type="submit" value="confirm">&#x2713;</button>
            <?php echo form_close(); ?>

            <?php echo form_open('labheads/reject_faculty'); ?>
              <?php echo form_hidden('faculty_id', $member->fid); ?>
              <button class = "button tiny" type="submit" value="reject">&#x2717;</button>
            <?php echo form_close(); ?>
          </td> 
        </tr>
        <?php endforeach; ?>
      </tbody>
  </table>
<?php else: ?>
  </p> There are no pending requests.</p>
<?php endif; ?>
