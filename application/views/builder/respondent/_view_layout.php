<?php $this->load->view('includes/builder_view_header',$title); ?>

<body>
<?php $this->load->view('components/topbar_builder_view'); ?>

<?php $this->load->view($main_content); ?>

<?php //$this->load->view('components/sitemap'); ?>
</body>

<?php $this->load->view('includes/builder_view_footer'); ?>

</html>