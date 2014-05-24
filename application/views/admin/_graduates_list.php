<?php if(isset($graduates)): ?>
    <table>
        <thead>
            <tr>
                <th width="200">Name</th>
                <th width="150">Username</th>
                <th width="150">Student No.</th>
                <th width="150">Joined</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($graduates as $graduate):?>
        <tr>
            <td>
                <a href = "<?php echo site_url('graduates/view/'.$graduate->username); ?>">
                    <?php echo format_full_name($graduate); ?> 
                </a>
            </td>
            <td><?php echo $graduate->username; ?></td>
            <td><?php echo $graduate->student_num;?></td>
            <td>mm-dd-yyyy</td>
            <td>
                <?php echo form_open('graduates/destroy'); ?>
                    <?php echo form_hidden('graduate_id',$graduate->gid); ?>
                    <button class = "button tiny" type="submit" value="delete">&#x2717;</button>
                <?php echo form_close(); ?>
            </td>
        </tr>
    <?php endforeach; ?>
        </tbody>
    </table>    
<?php else: ?>
    <p> There are no graduates. </p>
<?php endif; ?>