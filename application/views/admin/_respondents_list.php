<?php if(isset($respondents)): ?>
<table>
  <thead>
    <tr>
      <th width="200">IP Address</th>
      <th width="150">Experiment</th>
      <th width="150">Since</th>
      <th width="150">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($respondents as $respondent):?>
      <tr>
        <td><?php echo anchor(respondent_path($respondent), $respondent->ip_addr); ?></td>
        <td><?php echo $respondent->title; ?></td>
        <td><?php echo $respondent->since;?></td>
        <td>
          <?php echo form_open('respondents/destroy'); ?>
            <?php echo form_hidden('respondent_id', $respondent->rid); ?>
            <button class = "button tiny" type="submit" value="delete">&#x2717;</button>
          <?php echo form_close(); ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else: ?>
    <p> There are no active respondents yet. </p>
<?php endif; ?>
