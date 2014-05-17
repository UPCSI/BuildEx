<div style="position:absolute; right:0; z-index: 999; top: 40%;">
	<button type="button" id="next_page" style="margin:0; padding-left:23px; padding-right:23px; padding-top:40px; padding-bottom:40px">Next</button>
</div>
<div id="workspace" class="demo panel callout" style="min-width:1280px; max-width:1280px; height:720px; position:absolute; vertical-align: middle; padding:0; border:0; margin:0 auto; left:0; right:0;" data-eid='<?= $eid;?>'>
</div>
<?
	echo '<script>';
	if(isset($var)){	
		echo '(function($){ ';
		echo '$(function() {';
		$total = 0;
		foreach ($pages as $page){
			$total += 1;	 
			$htmlData = '<div id="page' . $page->order .'"></div>';
			echo "$('.demo').append('" . $htmlData . "');";
		}

		foreach ($var as $obj){
			if($obj[3] == "question"){
				echo 'draw_question('.$obj[1].','.$obj[2].',"' .$obj[4] .'",'.$obj[0].',' .$obj[6].',' .$obj[7] .',"' .$obj[5].'");';
			}
			
			else if($obj[3] == "textinput"){
				echo 'draw_text_input('.$obj[1].','.$obj[2].',"' ."" .'",'.$obj[0].',' .$obj[4].',' .$obj[5].');';
			}

			else if($obj[3] == "button"){
				echo 'draw_button('.$obj[1].','.$obj[2].',"' .$obj[4] .'",'.$obj[0].',' .$obj[5].',' .$obj[6].');';
			}

			else if($obj[3] == "radio"){
				echo 'draw_radio_button('.$obj[1].','.$obj[2].',"' .$obj[4] .'",'.$obj[0].',' .$obj[5].',' .$obj[6].');';
			}

			else if($obj[3] == "checkbox"){
				echo 'draw_checkbox('.$obj[1].','.$obj[2].',"' .$obj[4] .'",'.$obj[0].',' .$obj[5].',' .$obj[6].');';
			}

			/*
			else if($obj[3] == "dropdown")
				echo '$("#dropdown").trigger("click",['.$obj[1].','.$obj[2].',' .$obj[0].']);';*/
			
			else if($obj[3] == "slider"){
				echo 'draw_slider('.$obj[1].','.$obj[2].',' .$obj[0] .',' .$obj[4] .',' .$obj[5].',' .$obj[4] .',' .$obj[5].');';	
			}
		}

		for($index=2; $index<=$total; $index++){
			echo 'document.getElementById("page" + '.$index.').style.visibility =' ."'hidden';";
		}

		echo 'total_page = '.$total.';';

		echo '});';
		echo '}) (jQuery);';
	}
	else{
		echo 'console.log("Empty");';
	}
	echo '</script>';
?>