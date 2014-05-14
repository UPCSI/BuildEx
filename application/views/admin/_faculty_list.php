<?php if(isset($faculty)): ?>
    <table>
        <thead>
            <tr>
                <th width="200">Name</th>
                <th width="150">Username</th>
                <th width="150">Faculty No.</th>
                <th width="150">Joined</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($faculty as $member):?>
                <tr>
                    <td>
                        <a href = "<?php echo site_url('faculty/view/'.$member->username); ?>">
                            <?php echo strtoupper($member->last_name).', '.ucwords($member->first_name).', '.ucfirst($member->middle_name).'.'; ?> 
                        </a>
                    </td>
                    <td><?php echo $member->username; ?></td>
                    <td><?php echo $member->faculty_num;?></td>
                    <td>mm-dd-yyyy</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p> There are no active faculty member. </p>
<?php endif; ?>