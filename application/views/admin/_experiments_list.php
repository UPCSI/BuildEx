<?php if(isset($experiments)): ?>
    <table>
        <thead>
            <tr>
                <th width="200">Title</th>
                <th width="150">Author</th>
                <th width="150">Responses</th>
                <th width="150">Publish</th>
                <th width="150">Laboratory</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($experiments as $experiment): ?>
                <tr>
                    <td><?php echo anchor(experiment_path($experiment), $experiment->title); ?></td>
                    <td><?php echo anchor(researcher_path($experiment), researcher($experiment)); ?></td>
                    <td><?php echo response_ratio($experiment); ?></td>
                    <td><?php echo $experiment->is_published; ?></td>
                    <td><?php echo $experiment->name; ?> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p> There are no active experiments. </p>
<?php endif; ?>