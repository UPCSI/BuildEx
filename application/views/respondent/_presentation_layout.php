<?php
$this->load->view('respondent/header',$title);
$this->load->view('respondent/topbar');
?>
<div class="row">
<!--div class="large-12 medium-12 small-12 column" style="min-height:100%;height:100%;overflow:auto;display:flex;line-height:initial;text-align:-webkit-center;"-->
	<?php $this->load->view($main_content); ?>
<!--/div-->
</div>
</body>
</html>