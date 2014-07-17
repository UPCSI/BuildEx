<div class="fixed show-for-medium-up">
  <nav class="top-bar" data-topbar>
    <ul class="title-area">
      <li class="name">
        <h1>
          <a href="<?php echo site_url(); ?>">
            <div class="icon" style="display:inline">
              <span>&nbsp;</span>
            </div>
            <strong><?php echo SITE_NAME; ?></strong>
          </a>
        </h1>
      </li>
      <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
    </ul>
    <section class="top-bar-section">
      <ul class="right">
        <li><?php echo anchor(page_path(''), username()); ?></li>
        <li><?php echo anchor(site_url('logout'), 'Log out'); ?></li>
      </ul>
    </section>
  </nav>
</div>
