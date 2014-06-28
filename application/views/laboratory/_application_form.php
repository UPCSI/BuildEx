<?php echo form_open(laboratory_path($laboratory, 'apply')); ?>
    <?php if($is_request_sent): ?>
        <input type="submit" class = "button small" value="Request sent" disabled="true">
    <?php else: ?>
        <input type="submit" class = "button small" value="Apply">
    <?php endif; ?>
<?php echo form_close();?>
