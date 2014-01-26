<?php

$this->load->view('includes/header',$title);

$this->load->view('components/topbar');

$this->load->view($main_content);

$this->load->view('components/sitemap');

$this->load->view('includes/footer');

?>

</body>
</html>