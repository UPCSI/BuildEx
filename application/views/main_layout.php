<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?> | <?php echo SITE_NAME; ?></title>

    <?php $this->load->view('includes/stylesheets/global'); ?>
    <?php if(isset($other_css)): ?>
        <?php render_styles($other_css); ?>
    <?php endif; ?>

    <?php $this->load->view('includes/javascripts/global'); ?>
    <?php if(isset($other_js)): ?>
        <?php render_scripts($other_js); ?>
    <?php endif; ?>
</head>

<body>
    <?php $this->load->view($main_content); ?>
</body>
    <?php $this->load->view('includes/javascripts/foundation'); ?>
<script>
  function js_site_url(){
    return urlTmp = "<?php echo site_url(); ?>";
  }
  function js_base_url(){
    return urlTmp = "<?php echo base_url(); ?>";
  }
</script>
</html>