<?php $this->load->view('builder/_view_topbar'); ?>
<div class="large-12 medium-12 small-12 column" style="position:relative;min-height:100%;height:100%;overflow:auto;display:flex;line-height:initial;text-align:-webkit-center;">
  
  <div style="position:absolute; right:0; z-index: 999; top: 40%;">
    <button type="button" id="next_page" style="margin:0; padding-left:23px; padding-right:23px; padding-top:40px; padding-bottom:40px">Next</button>
  </div>
  
  <div id="workspace" class="demo panel callout" style="min-width:1280px; max-width:1280px; height:720px; position:absolute; vertical-align: middle; padding:0; border:0; margin:0 auto; left:0; right:0;" data-eid="<?php echo $experiment->eid; ?>" data-slug="<?php echo $slug; ?>"></div>
  <?php
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
        if($obj['type'] == "question"){
          echo 'draw_question('.$obj['xPos'].','.$obj['yPos'].',"' .$obj['text'] .'",'.$obj['page'].',"' .$obj['width'].'","' .$obj['height'] .'","' .$obj['color'].'",'.$obj['qid'].');';
        }
        
        else if($obj['type'] == "textinput"){
          echo 'draw_text_input('.$obj['xPos'].','.$obj['yPos'].',"' ."" .'",'.$obj['page'].',"' .$obj['width'].'","' .$obj['height'].'");';
        }

        else if($obj['type'] == "button"){
          echo 'draw_button('.$obj['xPos'].','.$obj['yPos'].',"' .$obj['text'] .'",'.$obj['page'].',"' .$obj['width'].'","' .$obj['height'].'","' .$obj['go_to'] .'","' .$obj['btn_type'] '");';
        }

        else if($obj['type'] == "radio"){
          echo 'draw_radio_button('.$obj['xPos'].','.$obj['yPos'].',"' .$obj['text'] .'",'.$obj['page'].',"' .$obj['width'].'","' .$obj['height'].'");';
        }

        else if($obj['type'] == "checkbox"){
          echo 'draw_checkbox('.$obj['xPos'].','.$obj['yPos'].',"' .$obj['text'] .'",'.$obj['page'].',"' .$obj['width'].'","' .$obj['height'].'");';
        }

        else if($obj['type'] == "dropdown"){
          echo 'draw_dropdown('.$obj['xPos'].','.$obj['yPos'].',' .$obj['page'].','.json_encode($obj['options']).');';
        }
        
        else if($obj['type'] == "slider"){
          echo 'draw_slider('.$obj['xPos'].','.$obj['yPos'].',' .$obj['page'] .',' .$obj['min'] .',' .$obj['max'] .',' .json_encode($obj['snap']) .',' .json_encode($obj['highlight']) .',' .$obj['step'] .');';
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
</div>
