<? 
	if(isset($var)){
		foreach ($var as $obj){
			echo '<script>';
			echo '$(function() {';
			echo '$("#question").trigger("click",['.$obj[0].','.$obj[1].']);';
			echo '})';
			echo '</script>';
		}
	}
?>

<script src="<?php echo site_url('js/vendor/jquery.js'); ?>"></script>
<script src="<?php echo site_url('js/jquery-ui.js'); ?>"></script>
<script src="<?php echo site_url('js/foundation.min.js'); ?>"></script>

<script>
	$(document).foundation();
</script>