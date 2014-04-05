<div id="workspace" class="demo panel callout" style="min-width:576px; max-width:576px; height:432px; position:relative; margin:auto; vertical-align: middle; padding:5px; border:0px" data-eid='<?= $eid;?>'>

</div>
<div class = "row" style="margin-top:80px">
	<button type = "button" id = "next_page"> Next </button>
</div>
<?
	if(isset($var)){
		echo '<script>';
		echo '(function($){ ';
		echo '$(function() {';
		$total = 0;
		foreach ($pages as $page){
			$total += 1;	 
			$htmlData = '<div id="page' . $page->order .'"></div>';
			echo "$('.demo').append('" . $htmlData . "');";
		}

		foreach ($var as $obj){
			// echo 'alert("sending page " +' .$obj[3].');';
			if($obj[3] == "question"){
				echo 'draw_question('.$obj[1].','.$obj[2].',"' .$obj[4] .'",'.$obj[0].');';
			}
			
			else if($obj[3] == "textinput"){
				echo 'draw_text_input('.$obj[1].','.$obj[2].',"' ."" .'",'.$obj[0].');';
			}
			else if($obj[3] == "button"){
				echo 'draw_button('.$obj[1].','.$obj[2].',"' .$obj[4] .'",'.$obj[0].');';
			}
			else if($obj[3] == "radio"){
				echo 'draw_radio_button('.$obj[1].','.$obj[2].',"' .$obj[4] .'",'.$obj[0].');';
			}
			else if($obj[3] == "checkbox"){
				echo 'draw_checkbox('.$obj[1].','.$obj[2].',"' .$obj[4] .'",'.$obj[0].');';
			}
			/*
			else if($obj[3] == "dropdown")
				echo '$("#dropdown").trigger("click",['.$obj[1].','.$obj[2].',' .$obj[0].']);';
			
			else if($obj[3] == "slider")
				echo '$("#slider").trigger("click",['.$obj[1].','.$obj[2].',' .$obj[0].']);';	*/		
		}

		for($index=2; $index<=$total; $index++){
			echo 'document.getElementById("page" + '.$index.').style.visibility =' ."'hidden';";
		}

		echo '$.page = '.$total.';';
	
		echo '});';
		echo '}) (jQuery);';
		echo '</script>';
	}
?>