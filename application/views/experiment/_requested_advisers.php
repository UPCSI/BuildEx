<?php foreach($requested_advisers as $adviser): ?>
    <?php echo anchor(faculty_path($adviser), format_short_name($adviser)); ?>
    <br/>
<?php endforeach; ?>
