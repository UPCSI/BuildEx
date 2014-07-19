<?php if(isset($is_member)): ?>
  <?php if(!$is_member): ?>
    <?php echo form_open(laboratory_path($laboratory, 'apply')); ?>
      <?php echo form_hidden('laboratory_id', $laboratory->labid); ?>
      <button class = "button tiny" type="submit" value="apply">Apply</button>
    <?php echo form_close(); ?>
  <?php endif; ?>
<?php endif; ?>
