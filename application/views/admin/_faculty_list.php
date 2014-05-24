<?php if(isset($faculty)): ?>
    <table>
        <thead>
            <tr>
                <th width="200">Name</th>
                <th width="150">Username</th>
                <th width="150">Faculty No.</th>
                <th width="150">Joined</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($faculty as $member):?>
                <tr>
                    <td>
                        <a href = "<?php echo site_url('faculty/view/'.$member->username); ?>">
                            <?php echo format_full_name($member); ?> 
                        </a>
                    </td>
                    <td><?php echo $member->username; ?></td>
                    <td><?php echo $member->faculty_num;?></td>
                    <td>mm-dd-yyyy</td>
                    <td>
                    <?php echo form_open('faculty/destroy'); ?>
                            <?php echo form_hidden('faculty_id',$member->fid); ?>
                            <button class = "button tiny" type="submit" value="delete">&#x2717;</button>
                        <?php echo form_close(); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p> There are no active faculty member. </p>
<?php endif; ?>