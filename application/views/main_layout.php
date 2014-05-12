<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?> | BuildEx</title>

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
    
</html>