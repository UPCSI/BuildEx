<?php if($experiment->is_published == 'f'): ?>
    <?php echo anchor(experiment_path($experiment, 'publish'), 'Publish', 'class = "button small"'); ?>
<?php else: ?>
    <p class = "white"><strong>URL:</strong>
        <a href ="<?php echo site_url('respond/view/'.$experiment->url); ?>">
            <?php echo site_url('respond/view/'.$experiment->url); ?>
        </a>
    </p>
    <?php echo anchor(experiment_path($experiment, 'unpublish'), 'Unpublish', 'class = "button small"'); ?>
<?php endif; ?>
