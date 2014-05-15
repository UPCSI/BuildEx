<div class="row full" style="padding-top:2%">
	<h2>Create Account - <?php echo ucfirst($role); ?></h2>
	<?php if(isset($notification)): ?>
		<div data-alert class="alert-box">
			<?php echo $notification; ?>
			<a href="#" class="close">&times;</a>
		</div>
	<?php endif; ?>
	<div class="large-3 columns large-push-9">
		<p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
	</div>
	<div class="large-9 columns large-pull-3">
		<fieldset>
			<legend>Sign Up</legend>
			<?php $this->load->view($role.'/_form'); ?>
		</fieldset>
	</div>
</div>