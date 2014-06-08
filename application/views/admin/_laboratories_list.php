<?php if (isset($laboratories)): ?>
    <table>
        <thead>
            <tr>
                <td width ="150"> Laboratory </td>
                <td width ="200"> Lab Head </td>
                <td width ="150"> No. of Members </td>
                <td width ="150"> Since </td>
                <td width ="200"> Actions </td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($laboratories as $laboratory): ?>
                <tr>
                    <td> <?php echo anchor(laboratory_path($laboratory), $laboratory->name); ?> </td>
                    <td> <?php echo anchor(faculty_path($laboratory), format_full_name($laboratory)); ?>
                    <td> <?php echo $laboratory->members_count; ?></td>
                    <td> <?php echo $laboratory->since; ?> </td>
                    <td>
                        <?php echo form_open('laboratories/destroy'); ?>
                            <?php echo form_hidden('lab_id', $laboratory->labid); ?>
                            <button class = "button tiny" type="submit" value="delete">&#x2717;</button>
                        <?php echo form_close(); ?>
                    </td> 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p> No Existing Laboratories. </p>
<?php endif; ?>