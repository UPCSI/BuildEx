<?php //echo '<pre>'; print_r($this->session->userdata); echo '</pre>'; ?>
<div id="workspace" class="demo panel callout" style="min-width:1024px; max-width:1024px; height:576px; margin:auto; vertical-align: middle; padding:0px; border:0px" data-eid='<?php $eid;?>'>
</div>

<?php
	if(isset($var)){
		echo '<script>';
		echo '(function($){ ';
		echo '$(function() {';
		$total = 1;
		echo '$("#newPage").click();'; // initialize page1
		foreach ($pages as $page){
			if($page->order != 1) {
				$total += 1;
				$htmlData = '<div id="page' . $page->order .'" class="pageframe" style="width:100%; height:100%"><div>';
				$htmlData1 = '<div id="slide'. $page->order .'" class="panel pnl"><i class="fi-x remove-icon pull-right"></i><p class="slide-title">Slide '. $page->order .'</p></div>';
				
				echo "$('.demo').append('" . $htmlData . "');";
				echo "$('.slides').append('" . $htmlData1 . "');";
			}
		}

		foreach ($var as $obj){
			if($obj['type'] == "question"){
				echo '$("#question").removeClass("disabled");';
				echo '$("#question").trigger("click",['.$obj['xPos'].','.$obj['yPos'].',"' .$obj['text'] .'",'.$obj['page'] .',"' .$obj['width'].'","' .$obj['height'] .'","' .$obj['color'].'"]);';
			}

			else if($obj['type'] == "textinput"){
				echo '$("#textinput").trigger("click",['.$obj['xPos'].','.$obj['yPos'].',"' ."" .'",'.$obj['page'].',"' .$obj['width'].'","' .$obj['height'].'"]);';
			}
			
			else if($obj['type'] == "button"){
				echo '$("#button").trigger("click",['.$obj['xPos'].','.$obj['yPos'].',"' .$obj['text'] .'",'.$obj['page'].',"' .$obj['width'].'","' .$obj['height'].'"]);';
			}

			else if($obj['type'] == "radio"){
				echo '$("#radiobutton").trigger("click",['.$obj['xPos'].','.$obj['yPos'].',"' .$obj['text'] .'",'.$obj['page'].']);';
			}
			
			else if($obj['type'] == "checkbox"){
				echo '$("#checkbox").trigger("click",['.$obj['xPos'].','.$obj['yPos'].',"' .$obj['text'] .'",'.$obj['page'].']);';
			}
			
			else if($obj['type'] == "dropdown"){
				echo '$("#dropdown").trigger("click",['.$obj['xPos'].','.$obj['yPos'].',' .$obj['page'].']);';
			}

			else if($obj['type'] == "slider"){
				echo '$("#slider").trigger("click",['.$obj['xPos'].','.$obj['yPos'].',' .$obj['page'] .',' .$obj['min'] .',' .$obj['max'].']);';
			}
		}

		for($index=2; $index<=$total; $index++){
			echo '$("#page" + '.$index.').css("visibility", "hidden");';
		}

		echo '$.page = '.$total.';';
	
		echo '});';
		echo '}) (jQuery);';
		echo '</script>';
	}

	else{
		echo '<script>';
		echo '(function($){ ';
		echo '$(function() {';
			echo '$("#newPage").click();';
		echo '});';
		echo '}) (jQuery);';
		echo '</script>';
	}
?>
