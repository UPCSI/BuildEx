<ul class="off-canvas-list">
    <li><label><?php echo SITE_NAME; ?> - Faculty</label></li>
    <li><?php echo anchor(page_path(), 'Home'); ?></li>
    <li><?php echo anchor(page_path(''), 'Profile'); ?></li>
    
    <li><label>Records</label></li>
    <li><?php echo anchor('faculty/'.role_id().'/experiments', 'Experiments'); ?></li>
    <li><?php echo anchor(page_path('advisories'), 'Advisory Experiments'); ?></li>
    <li><?php echo anchor(page_path('archives'), 'Archives'); ?></li>

    <li><label>Laboratories</label></li>
    <li><?php echo anchor(page_path('laboratory'), 'My Laboratory'); ?></li>
    <li><?php echo anchor('explore', 'Explore'); ?></li> 
</ul>
