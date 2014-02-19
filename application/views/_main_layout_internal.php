<? $this->load->view('includes/header',$title); ?>

<? $this->load->view('components/topbar'); ?>

<div class = "main_body">
	<div class = "row full"> 
		<div class = "large-2 column">
			<? $this->load->view('components/sidebar'); ?>
		</div>
		<div class ="large-10 column">
			<div class = "main_content">
				<? $this->load->view($main_content); ?>
			</div>
		</div>
	</div>
</div>

<? $this->load->view('components/sitemap'); ?>
<? $this->load->view('includes/footer'); ?>

</body>
</html>