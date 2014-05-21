<?php if(isset($admins)): ?>
    <table>
        <thead>
            <tr>
                <th width="200">Name</th>
                <th width="150">Username</th>
                <th width="200">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admins as $member):?>
                <tr>
                    <td>
                        <a href = "<?php echo site_url('admin/view/'.$member->username); ?>">
                            <?php echo format_short_name($member); ?> 
                        </a>
                    </td>
                    <td><?php echo $member->username; ?></td>
                    <td>
                        <?php echo form_open('admin/destroy'); ?>
                            <?php echo form_hidden('admin_id',$member->aid); ?>
                            <button class = "button tiny" type="submit" value="delete">Delete</button>
                        <?php echo form_close(); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p> There are no active admins. </p>
<?php endif; ?>