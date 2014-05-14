<? //echo '<pre>'; print_r($this->session->userdata); echo '</pre>'; ?>
<div class="main-body" style="min-height:80%">
	<div class="row" style="text-align: left; padding-top:60px;">
		<h1> Debriefing </h1>
		<hr>
		<h2> Congratulations! </h2>
		<h2> Title: <?php echo $experiment; ?> </h2>
		<h3> Description: <?php echo $description; ?> </h3>
		<h3> Author: <?php echo $author; ?> </h3> 
		<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>

		<form id = "debrief" action="<?php echo site_url('respond/submit'); ?>" method = "post" accept-charset="utf-8">	
			<button id="debrief-btn" type = "submit" class = "small"> Submit </button>
			<a href = "<?php echo site_url('respond/leave'); ?>" class = "button small"> Cancel </a>
		</form>
	</div>
</div>