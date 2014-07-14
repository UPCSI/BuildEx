<ul class="off-canvas-list">
    <li><label><?php echo SITE_NAME; ?> - Graduate</label></li>
    <li><?php echo anchor(page_path(), 'Home'); ?></li>
    <li><?php echo anchor(page_path(''), 'Profile'); ?></li>
    
    <li><label>Records</label></li>
    <li><?php echo anchor(current_namespace().'/experiments', 'Experiments'); ?></li>

    <li><label>Laboratories</label></li>
    <li><?php echo anchor(current_namespace().'/laboratory', 'My Laboratory'); ?></li>
    <li><?php echo anchor('explore', 'Explore'); ?></li> 
</ul>
