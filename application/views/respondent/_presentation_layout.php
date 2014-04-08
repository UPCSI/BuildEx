<?php
$this->load->view('respondent/header',$title);
$this->load->view('respondent/topbar');
?>

<div class="large-12 medium-9 small-9 column" style="min-height:100%;height:100%;overflow:auto;display:flex;line-height:initial;text-align:-webkit-center;">
	<?php $this->load->view($main_content); ?>
</div>

</body>
</html>