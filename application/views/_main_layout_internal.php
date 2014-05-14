<body class="internal">
<?php $this->load->view('users/_topbar'); ?>

<div class = "main-body">
	<div class = "row full legit">
		<div class = "large-2 medium-3 columns sidebar show-for-medium-up">
			<?php $this->load->view('components/sidebar'.'_'.$this->session->userdata('active_role')); ?>
		</div>


		<div class ="large-10 medium-9 columns full">

			<div class="off-canvas-wrap docs-wrap">
			  <div class="inner-wrap">
			    <nav class="tab-bar hide-for-medium-up">
			      <section class="left-small">
			        <a class="left-off-canvas-toggle menu-icon"><span></span></a>
			      </section>

			      <section class="right tab-bar-section">
			        <h1 class="title">CS 192</h1>
			      </section>

			    </nav>

			    <aside class="left-off-canvas-menu hide-for-medium-up">
			      <?php $this->load->view('components/sidebar'.'_'.$this->session->userdata('active_role')); ?>
			    </aside>

			    <section class="main-section">
			      	<div class="row">
			      		<div class="large-12 columns">
							<?php $this->load->view($main_content); ?>
						</div>
					</div>
			    </section>

			  <a class="exit-off-canvas"></a>

			  </div>
			</div>


			
		</div>
	</div>
</div>

<?php $this->load->view('components/sitemap'); ?>
<?php $this->load->view('includes/footer'); ?>

</body>
</html>