<? //echo '<pre>'; print_r($this->session->userdata); echo '</pre>'; ?>
<div id="workspace" class="demo panel callout" style="min-width:1024px; max-width:1024px; height:576px; margin:auto; vertical-align: middle; padding:0px; border:0px" data-eid='<?= $eid;?>'>

</div>

<?
	if(isset($var)){
		echo '<script>';
		echo '(function($){ ';
		echo '$(function() {';
		$total = 0;
		echo '$("#newPage").click();'; #initialize page1
		foreach ($pages as $page){
			$total += 1;
			$htmlData = '<div id="page' . $page->order .'" class="pageframe" style="width:100%; height:100%"><div>';
			$htmlData1 = '<div id="slide'. $page->order .'" class="slideframe panel pnl"><i class="fi-x remove-icon pull-right"></i><p class="slide-title">Slide '. $page->order .'</p></div>';
			
			if($page->order != 1) {
				echo "$('.demo').append('" . $htmlData . "');";
				echo "$('.slides').append('" . $htmlData1 . "');";
			}
			
		}

		foreach ($var as $obj){
			echo ' $("#question").removeClass("disabled");';
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
