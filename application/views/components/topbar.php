<!-- Modal - Sign In -->
<!-- Disabled if already loggedin -->
<? if(!$this->session->userdata('loggedin')): ?>
	<div id="signin" class="reveal-modal tiny" data-reveal>
	  <h2>Sign In to BuildEx</h2>
	  <?php echo validation_errors();?>
		<?php echo form_open("home/validate_user") . "<br/>";?>
			<label>Username</label>
			<input type="text" id="signInUsername" required name="username" placeholder="Enter username">
			<label>Password</label>
			<input type="password" id="signInPass" required name="password" placeholder="Password">
			<input type="submit" class="button" value="Login">
		<?php echo form_close();?>
	  <a class="close-reveal-modal">&#215;</a>
	</div>
<? endif; ?>

<!-- Navigation Bar (Fixed) -->
<div class="fixed">
	<nav class="top-bar" data-topbar>
		<ul class="title-area">
			<li class="name">
				<h1><a href="<?php echo site_url(); ?>"><strong>BuildEx</strong></a></h1>
			</li>
			<li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
		</ul>
		<section class="top-bar-section">
			<!-- Right Nav Section -->
			<ul class="right">
				<? if(!$this->session->userdata('loggedin')): ?>
					<li><a href="#" data-reveal-id="signin">Sign In</a></li>
					<li class="has-dropdown">
						<a href="#">Sign Up</a>
						<ul class="dropdown">
							<li><a href="<?php echo site_url('signup/graduate'); ?>">Sign Up as Student</a></li>
							<li><a href="<?php echo site_url('signup/faculty'); ?>">Sign Up as Faculty</a></li>
						</ul>
					</li>
				<? else: ?>
					<li><a href="<?php echo site_url($this->session->userdata('active_role').'/profile'); ?>" ><? echo $this->session->userdata('username'); ?></a></li>
					<li><a href="<?php echo site_url('home/logout') ?>"> Logout </a></li>
				<? endif; ?>
			</ul>
			<!-- Left Nav Section 
			<ul class="left">
				<li><a href="#">What is BuildEx?</a></li>
				<li><a href="#">Features</a></li>
				<li><a href="#">In Action</a></li>
				<li><a href="#">About</a></li>
			</ul>
			-->
		</section>
	</nav>
</div>