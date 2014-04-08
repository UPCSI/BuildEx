<? //echo '<pre>'; print_r($this->session->userdata); echo '</pre>'; ?>
<div id="workspace" class="demo panel callout" style="min-width:576px; max-width:576px; height:432px; position:relative; margin:auto; vertical-align: middle; padding:5px; border:0px" data-eid='<?= $eid;?>'>
<div id="page1" style="width:100%; height:100%"></div>
</div>

<?
	if(isset($var)){
		echo '<script>';
		echo '(function($){ ';
		echo '$(function() {';
		$total = 0;
		foreach ($pages as $page){
			$total += 1;
			$htmlData = '<div id="page' . $page->order .'" style="width:100%; height:100%"><div>';

			if($page->order != 1)
				echo "$('.demo').append('" . $htmlData . "');";
		}

		foreach ($var as $obj){
			if($obj[3] == "question")
				echo '$("#question").trigger("click",['.$obj[1].','.$obj[2].',"' .$obj[4] .'",'.$obj[0] .',' .$obj[6].',' .$obj[7] .',"' .$obj[5].'"]);';
	
			else if($obj[3] == "textinput")
				echo '$("#textinput").trigger("click",['.$obj[1].','.$obj[2].',"' ."" .'",'.$obj[0].',' .$obj[4].',' .$obj[5].']);';
			
			else if($obj[3] == "button")
				echo '$("#button").trigger("click",['.$obj[1].','.$obj[2].',"' .$obj[4] .'",'.$obj[0].',' .$obj[5].',' .$obj[6].']);';
			
			else if($obj[3] == "radio")
				echo '$("#radiobutton").trigger("click",['.$obj[1].','.$obj[2].',"' .$obj[4] .'",'.$obj[0].']);';
			
			else if($obj[3] == "checkbox")
				echo '$("#checkbox").trigger("click",['.$obj[1].','.$obj[2].',"' .$obj[4] .'",'.$obj[0].']);';
			
			else if($obj[3] == "dropdown")
				echo '$("#dropdown").trigger("click",['.$obj[1].','.$obj[2].',' .$obj[0].']);';
			
			else if($obj[3] == "slider")
				echo '$("#slider").trigger("click",['.$obj[1].','.$obj[2].',' .$obj[0] .',' .$obj[4] .',' .$obj[5].']);';			
		}

		for($index=2; $index<=$total; $index++){
			echo 'document.getElementById("page" + '.$index.').style.visibility =' ."'hidden';";
		}

		echo '$.page = '.$total.';';
		// echo 'alert($.page);';
	
		echo '});';
		echo '}) (jQuery);';
		echo '</script>';
	}
?>
<script>
(function($){
	$(function(){
		// alert($.page);
	});

})(jQuery);
</script>
