<h3 class = "white"> Roles: </h3>
<ol>
    <?php foreach ($roles as $role): ?>
        <li style = "color: white;"> <a href ="<?php echo site_url('home/redirect')  .'/' .$role?>"> <?php echo ucfirst($role); ?> </a> </li>
    <?php endforeach; ?>
</ol>