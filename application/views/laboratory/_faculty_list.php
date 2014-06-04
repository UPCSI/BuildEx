<h3 class = "white"> Faculty Members </h3>
<?php if(isset($faculty_members)): ?>
    <ol>
    <?php foreach($faculty_members as $member): ?>
        <li>
            <?php echo anchor(faculty_path($member->username, format_full_name($member))); ?>
        </li>
    <?php endforeach; ?>
    </ol>
<?php else: ?>
    <p> There are no faculty members.</p>
<?php endif; ?>