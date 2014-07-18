<h3 class = "white">Roles:</h3>
<ol>
  <?php foreach ($roles as $role): ?>
    <li style = "color: white;">
      <?php echo anchor(site_url("change/{$role}"), ucfirst($role)); ?>
    </li>
  <?php endforeach; ?>
</ol>