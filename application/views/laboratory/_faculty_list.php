<h3 class = "white">Faculty Members</h3>
<?php if(isset($faculty)): ?>
  <ol>
  <?php foreach($faculty as $member): ?>
    <li>
      <?php echo anchor(faculty_path($member), format_full_name($member)); ?>
    </li>
  <?php endforeach; ?>
  </ol>
<?php else: ?>
  <p class="white">There are no faculty members.</p>
<?php endif; ?>
