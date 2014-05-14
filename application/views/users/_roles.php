<h3> Roles: </h3>
<ol>
    <?php foreach ($roles as $role): ?>
        <li> <a href ="<?php echo site_url('home/redirect')  .'/' .$role?>"> <?php echo ucfirst($role); ?> </a> </li>
    <?php endforeach; ?>
</ol>