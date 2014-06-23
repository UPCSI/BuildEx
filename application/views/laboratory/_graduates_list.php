<h3 class = "white"> Graduates </h3>
<?php if(isset($graduates)): ?>
    <ol>
    <?php foreach ($graduates as $graduate): ?>
        <li>
            <?php echo anchor(graduate_path($graduate->username), format_full_name($graduate)); ?>
        </li>
    <?php endforeach; ?>
    </ol>
<?php else: ?>
    <p class = "white"> There are no students </p>
<?php endif; ?>