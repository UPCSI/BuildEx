<?php if(isset($admins)): ?>
    <table>
        <thead>
            <tr>
                <th width="200">Name</th>
                <th width="150">Username</th>
                <th width="150">Joined</th>
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
                    <td>mm-dd-yyyy</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p> There are no active admins. </p>
<?php endif; ?>