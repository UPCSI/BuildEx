<?php $this->load->view('home/_sign_in_modal'); ?>

<div class="fixed">
    <nav class="top-bar" data-topbar>
        <ul class="title-area">
            <li class="name">
                <h1><a href="<?php echo site_url(); ?>"><div class="icon" style="display:inline"><span>&nbsp;</span></div><strong>CS 192</strong></a></h1>
            </li>
            <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
        </ul>
        <section class="top-bar-section">
            <ul class="right">
                <li><a href="#" data-reveal-id="sign-in">Sign In</a></li>
                <li class="has-dropdown">
                    <a href="#">Sign Up</a>
                    <ul class="dropdown">
                        <li><a href="<?php echo site_url('sign_up/graduate'); ?>">Sign Up as Student</a></li>
                        <li><a href="<?php echo site_url('sign_up/faculty'); ?>">Sign Up as Faculty</a></li>
                    </ul>
                </li>
            </ul>
        </section>
    </nav>
</div>