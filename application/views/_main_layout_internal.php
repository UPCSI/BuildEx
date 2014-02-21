<?php $this->load->view('includes/header',$title); ?>

<?php $this->load->view('components/topbar'); ?>

<div class = "main_body">
	<div class = "row full"> 
		<div class = "large-2 column">
			<?php $this->load->view('components/sidebar'.'_'.$this->session->userdata('active_role')); ?>
		</div>
		<div class ="large-10 column">
			<div class = "main_content">
				<?php $this->load->view($main_content); ?>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('components/sitemap'); ?>
<?php $this->load->view('includes/footer'); ?>

</body>
</html>