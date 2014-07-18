<ul class="off-canvas-list">
    <li><label><?php echo SITE_NAME; ?> - Graduate</label></li>
    <li><?php echo anchor(page_path(), 'Home'); ?></li>
    <li><?php echo anchor(page_path(''), 'Profile'); ?></li>

    <li><label>Laboratory</label></li>
    <li><?php echo anchor(current_namespace().'/laboratory', 'My Laboratory'); ?></li>
    <li><?php echo anchor(current_namespace().'/laboratory/requests', 'Requests'); ?></li>
    <li><?php echo anchor('explore', 'Explore'); ?></li> 
</ul>
