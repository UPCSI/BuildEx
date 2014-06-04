<?php if(isset($is_member)): ?>
    <?php if(!$is_member): ?>
        <a class = "button small" href = "<?php echo site_url($role.'/request_lab/'.$laboratory->labid); ?>"> Apply </a>
    <?php endif; ?>
<?php endif; ?>