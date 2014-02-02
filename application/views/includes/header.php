<!DOCTYPE html>
<html lang = "en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $title ?> | BuildEx</title>

<!-- wow much CSS -->
<link rel="stylesheet" href="<?php echo site_url('css/normalize.css'); ?>">
<link rel="stylesheet" href="<?php echo site_url('css/foundation.css'); ?>">
<link rel="stylesheet" href="<?php echo site_url('css/custom.css'); ?>">
<link rel="stylesheet" href="<?php echo site_url('css/jquery-ui.css'); ?>">

<!-- wow much JS -->
<script src="<?php echo site_url('js/modernizr.js'); ?>"></script>
<script src="<?php echo site_url('js/jquery.js'); ?>"></script>
<script src="<?php echo site_url('js/jquery-ui.js'); ?>"></script>

<style>
  #draggable { width: 150px; height: 150px; padding: 0.5em; }
</style>
<script>
  $(function() {
    $( "#draggable" ).draggable();
  });
</script>
</head>

<body>