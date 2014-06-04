<h2 class = "white"> <?php echo $laboratory->name ?> </h2>
<p class = "white">
    <strong> Laboratory Head: </strong>
    <?php echo anchor(faculty_path($lab_head->username), format_full_name($lab_head)); ?>
</p>
<p class = "white"> <strong> No. of members: </strong> <?php echo $laboratory->members_count; ?></p>
<p class = "white"> <strong> Description: </strong><?php echo $laboratory->description; ?></p>
<p class = "white"> <strong> Created: </strong> <?php echo $laboratory->since; ?></p>