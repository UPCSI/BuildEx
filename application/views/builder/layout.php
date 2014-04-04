<?php
	$this->load->view('builder/header',$title);
	$this->load->view('builder/topbar');
?>

<div class="row full legit" style="min-height:100%;height:100%">
<div class="large-10 medium-10 small-10 columns unpad-h" style="min-height:100%;height:100%">
<div class="row full legit" style="min-height:73%;height:73%">
<div class="large-3 medium-3 small-3 column unmar-v" style="min-height:100%;height:100%;margin-top:10px;margin-bottom:10px;margin-top:0px;
    margin-bottom:0px;">
<div class="panel callout" style="min-height:100%;height:100%;overflow-y:auto;">
<ol>
<?php $this->load->view('builder/panels'); ?>
</ol>
</div>
</div>
<div class="large-9 medium-9 small-9 column" style="min-height:100%;height:100%;overflow:auto;display:flex;line-height:initial;text-align:-webkit-center;">
<?php $this->load->view($main_content); ?>
</div>
</div>
<div class="row full legit" style="min-height:27%;height:27%;margin-left:0px;margin-right:0px;background:#252525">
<div class="large-12 medium-12 small-12 column unpad-h" style="top: -1px;">
<?php $this->load->view('builder/elements'); ?>
</div>
</div>
</div>
<div class="large-2 medium-2 small-2 column" style="min-height:100%;height:100%;overflow-y:auto;background:#252525;padding:0px">
<?php $this->load->view('builder/settings'); ?>
</div>
</div>
<?php $this->load->view('builder/footer'); ?>

</body>
</html>