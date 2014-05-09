(function($){ 
$(function() {
  
  $.count = 1;
  $.page = 1;
  $.current_page = 1;
  $.last_selected = null;
  
  function rgba2hex(rgb){
   rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
   return (rgb && rgb.length === 4) ? "#" +
    ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
    ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
    ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
  }

  function rgb2hex(rgb) {
      rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
      function hex(x) {
          return ("0" + parseInt(x).toString(16)).slice(-2);
      }
      return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
  }

  function checkQuestion() {
    var check = $('#page'+$.current_page).find('div');
    if(check.hasClass('flag')){
      $('#question').addClass('disabled');
    }else{
      $('#question').removeClass('disabled');
    }
  }

  $(document).click(function(e){
    var hex = rgb2hex($('.minicolors-swatch-color').css('background-color'));
    $('#'+$.last_selected).css('color', hex);
  });


  $('.color-picker').each( function() {
    //
    // Dear reader, it's actually very easy to initialize MiniColors. For example:
    //
    //  $(selector).minicolors();
    //
    // The way I've done it below is just for the demo, so don't get confused 
    // by it. Also, data- attributes aren't supported at this time. Again, 
    // they're only used for the purposes of this demo.
    //
    $(this).minicolors({
      control: $(this).attr('data-control') || 'hue',
      defaultValue: $(this).attr('data-defaultValue') || '',
      inline: $(this).attr('data-inline') === 'true',
      letterCase: $(this).attr('data-letterCase') || 'lowercase',
      opacity: $(this).attr('data-opacity'),
      position: $(this).attr('data-position') || 'bottom left',
      change: function(hex, opacity) {
        $.hex = hex;
        var log;
        try {
          log = hex ? hex : 'transparent';
          if( opacity ) log += ', ' + opacity;
          console.log(log);
        } catch(e) {}
      },
      theme: 'default'
    });        
  });
    
  $('#workspace').on('click', '.delete', function(e){
      var parent = $(this).parent('div');
      if(parent.attr('id').substr(0,3) == 'qtn'){
        $('#question').removeClass('disabled');
      }
      parent.remove();
  });

  $('#question')
    .click(function(eventClick, posX, posY, text_input, page_num, width, height, color){
      // alert($(this).hasClass('disabled'));
      if(!$(this).hasClass('disabled')){
        posX = typeof posX !== 'undefined' ? posX : 183;
        posY = typeof posY !== 'undefined' ? posY : 191;
        page_num = typeof page_num !== 'undefined' ? page_num : 0;
        text_input = typeof text_input !== 'undefined' ? text_input : "";
        width = typeof width !== 'undefined' ? width : 200;
        height = typeof height !== 'undefined' ? height : 40;
        color = typeof color !== 'undefined' ? color : 000000;
        color = '#' + color;

        var htmlData='<div id="qtn'+$.count+'" class="draggable ui-widget-content"';

        if (posX != null && posY != null){
          // alert('x' + posX);
          // alert('y' + posY);
          htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px; width:' + width + 'px; height:' + height + 'px;"';
        }

        if(text_input != "")
          htmlData += '><a href="#" class="delete"></a><div id="qtneditable'+$.count+'" class="editable flag">'+text_input+'</div></div>';
        else
          htmlData += '><a href="#" class="delete"></a><div id="qtneditable'+$.count+'" class="editable flag" data-placeholder="Enter Question" ></div></div>';

        var temp = $.count;
        var index = page_num;
        if(index <= 0) {
          $("#page" + $.current_page).append(htmlData);
        }
        else {
          $("#page" + index).append(htmlData);
        }

        $('#qtn'+temp).draggable({
          containment: "#workspace",
          scroll: false,
          snap: false,
        })
        .resizable({
          containment: "parent"
        });
        $('#qtneditable'+temp).click(function(){
            if ( $(this).is('.ui-draggable-dragging') ) {
                return;
            }
            $('#qtn'+temp).draggable( "option", "disabled", true );
            $(this).attr('contenteditable','true');
        })
        .blur(function(){
            $('#qtn'+temp).draggable( 'option', 'disabled', false);
            $(this).attr('contenteditable','false');
        });

        //styling
        $('#qtneditable'+temp).click(function(){
          $.last_selected = $(this).attr('id');
          var color = rgba2hex($('#qtneditable'+temp).css('color'));
            $('#clr').val(color);
            // alert($.hex);
            $('#clr').minicolors('settings',{});
        })

        document.getElementById('qtneditable'+$.count).style.color = color;   
        $('#question').addClass('disabled');    
        $.count++;
      }
      else{
        return false;
      }
  });

  $('#textinput')
      .click(function(eventClick, posX, posY, text_input, page_num, width, height){
        posX = typeof posX !== 'undefined' ? posX : 183;
      posY = typeof posY !== 'undefined' ? posY : 191;
      page_num = typeof page_num !== 'undefined' ? page_num : 0;
      text_input = typeof text_input !== 'undefined' ? text_input : "";
      width = typeof width !== 'undefined' ? width : 200;
      height = typeof height !== 'undefined' ? height : 40;
      
      var htmlData='<div id="inp'+$.count+'" class="draggable ui-widget-content"';

      if (posX != null && posY != null){
        // alert('x' + posX);
        // alert('y' + posY);
        htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px; width:' + width + 'px; height:' + height + 'px;"';
      }
      
      if(text_input != "")
        htmlData += '><a href="#" class="delete"></a><div id="inpeditable'+$.count+'" class="editable">'+text_input+'</div></div>';
      else
        htmlData += '><a href="#" class="delete"></a><div id="inpeditable'+$.count+'" class="editable" data-placeholder="Enter Input" ></div></div>';

      var temp = $.count;
      var index = page_num;
      if(index <= 0)
        $("#page" + $.current_page).append(htmlData);
      else
        $("#page" + index).append(htmlData);

          $('#inp'+temp).draggable({
            containment: "#workspace",
            scroll: false,
            snap: false,
            // drag: function(){
            //     var offset1 = $(this).offset();
            //     var xPos1 = offset1.left;
            //     var yPos1 = offset1.top;
            //     var element = $(this).attr('id');
            //     //substring depends on the length of id string
            //     var number = element.substring(3);
            //     $('#pos'+number+'X').text('x: ' + xPos1);
            //     $('#pos'+number+'Y').text('y: ' + yPos1);
            // }
          })
        .resizable({
          containment: "parent"
        });
        $('#inpeditable'+temp).click(function(){
            if ( $(this).is('.ui-draggable-dragging') ) {
                return;
            }
            $('#inp'+temp).draggable( "option", "disabled", true );
            $(this).attr('contenteditable','true');
        })
        .blur(function(){
            $('#inp'+temp).draggable( 'option', 'disabled', false);
            $(this).attr('contenteditable','false');
        });
        
        $.count++;
  });

  $('#button')
      .click(function(eventClick, posX, posY, text_input, page_num, width, height){
        posX = typeof posX !== 'undefined' ? posX : 208;
      posY = typeof posY !== 'undefined' ? posY : 191;
      page_num = typeof page_num !== 'undefined' ? page_num : 0;
      text_input = typeof text_input !== 'undefined' ? text_input : "Button";
      width = typeof width !== 'undefined' ? width : 150;
      height = typeof height !== 'undefined' ? height : 40;

      var htmlData='<div id="btn'+$.count+'" class="draggable"';
      if (posX != null && posY != null){
        // alert('x' + posX);
        // alert('y' + posY);
        htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px; width:' + width + 'px; height:' + height + 'px;"';
      }
      else{
        htmlData += 'style="width:150px; height:60"';
      }
      
      htmlData += 'style="width:150px; height:60"><button id="btneditable'+$.count+'" style="width:100%; height:100%; margin-bottom:0px; padding:0px"><div class="default" style="width:100%; height:100%; display:inline; vertical-align:middle">'+text_input+'</div></button><a href="#" class="delete"></a></div>';
      
      var temp = $.count;

      var index = page_num;

      if(index <= 0)
        $("#page" + $.current_page).append(htmlData);
      else
        $("#page" + index).append(htmlData);

          $('#btn'+temp).draggable({
            containment: "#workspace",
            scroll: false,
            cancel: false,
            // drag: function(){
            //     var offset1 = $(this).offset();
            //     var xPos1 = offset1.left;
            //     var yPos1 = offset1.top;
            //     var element = $(this).attr('id');
            //     //substring depends on the length of id string
            //     var number = element.substring(3);
            //     $('#pos'+number+'X').text('x: ' + xPos1);
            //     $('#pos'+number+'Y').text('y: ' + yPos1);
            // }
          })
        .resizable({
          containment: "parent"
        });
        $('.default').click(function(){
            if ( $(this).is('.ui-draggable-dragging') ) {
                return;
            }
            $('#btn'+temp).draggable( "option", "disabled", true );
            $(this).attr('contenteditable','true');
        });

        $(document).click(function(e){
          if($(e.target).attr('id') == ('btneditable'+temp)){
            $(e.target).children().click();
            $(e.target).children().focus();
          }
          else if(e.target.className != 'default' && e.target.id != 'btneditable'+temp){
              $('#btn'+temp).draggable( 'option', 'disabled', false);
              $('.default').attr('contenteditable','false');
              
          }
        });
        
        $.count++;
    });

  $('#radiobutton')
      .click(function(eventClick, posX, posY, text_input, page_num, width, height){
        posX = typeof posX !== 'undefined' ? posX : 223;
      posY = typeof posY !== 'undefined' ? posY : 198;
      page_num = typeof page_num !== 'undefined' ? page_num : 0;
      text_input = typeof text_input !== 'undefined' ? text_input : "Radio Button";
      width = typeof width !== 'undefined' ? width : 120;
      height = typeof height !== 'undefined' ? height : 25;

      var htmlData='<div id="radbtn'+$.count+'" class="radiosnap draggable ui-draggable"';
      if (posX != null && posY != null){
        // alert('x' + posX);
        // alert('y' + posY);
        htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px; width:' + width + 'px; height:' + height + 'px;"';
      }
      else{
        htmlData += 'style="height:25px; width:120px;"';
      }
      
      // faulty -- contentEditable=true data-ph="My Placeholder String"
      htmlData += '><input type="radio" id="radeditable'+$.count+'" name="'+$.page+'" value="radiobutton"><div id="radbtneditable'+$.count+'"class="default" style="width:100%; height:100%; display:inline; vertical-align:middle">'+text_input+'</div><a href="#" class="delete"></a></div>';
      
      var temp = $.count;
      var index = page_num;

      if(index <= 0)
        $("#page" + $.current_page).append(htmlData);
      else
        $("#page" + index).append(htmlData);

          $('#radbtn'+temp).draggable({
            containment: "#workspace",
            scroll: false,
            cancel: false,
            snap: '.radiosnap'
            // drag: function(){
            //     var offset1 = $(this).offset();
            //     var xPos1 = offset1.left;
            //     var yPos1 = offset1.top;
            //     var element = $(this).attr('id');
            //     //substring depends on the length of id string
            //     var number = element.substring(3);
            //     $('#pos'+number+'X').text('x: ' + xPos1);
            //     $('#pos'+number+'Y').text('y: ' + yPos1);
            // }
          })
          .resizable({
          containment: "parent"
        });
        $('.default').click(function(){
            if ( $(this).is('.ui-draggable-dragging') ) {
                return;
            }
            $('#radbtn'+temp).draggable( "option", "disabled", true );
            $(this).attr('contenteditable','true');
        })
        .blur(function(){
            $('#radbtn'+temp).draggable( 'option', 'disabled', false);
            $(this).attr('contenteditable','false');
        });

        $(document).click(function(e){
          if($(e.target).attr('id') == ('radbtn'+temp)){
            $(e.target).children('.default').click();
            $(e.target).children('.default').focus();
          }
        });
        
        $.count++;
    });

  $('#checkbox')
      .click(function(eventClick, posX, posY, text_input, page_num, width, height){
        posX = typeof posX !== 'undefined' ? posX : 223;
      posY = typeof posY !== 'undefined' ? posY : 198;
      page_num = typeof page_num !== 'undefined' ? page_num : 0;
      text_input = typeof text_input !== 'undefined' ? text_input : "Checkbox";
      width = typeof width !== 'undefined' ? width : 120;
      height = typeof height !== 'undefined' ? height : 25;

      var htmlData='<div id="chkbox'+$.count+'" class="checksnap draggable ui-draggable"';
      if (posX != null && posY != null){
        // alert('x' + posX);
        // alert('y' + posY);
        htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px; width:' + width + 'px; height:' + height + 'px;"';
      }

      else{
        htmlData += 'style="height:25px; width:120px;"';
      }
      
      // faulty -- contentEditable=true data-ph="My Placeholder String"
      htmlData += '><input type="checkbox" id="chkeditable'+$.count+'" name="'+$.page+'" value="checkbox"><div id="chkboxeditable'+$.count+'" class="default" style="width:100%; height:100%; display:inline; vertical-align:middle">'+text_input+'</div><a href="#" class="delete"></a></div>';
      
      var temp = $.count;
      var index = page_num;

      if(index <= 0)
        $("#page" + $.current_page).append(htmlData);
      else
        $("#page" + index).append(htmlData);

          $('#chkbox'+temp).draggable({
            containment: "#workspace",
            scroll: false,
            cancel: false,
            snap: '.checksnap'
            // drag: function(){
            //     var offset1 = $(this).offset();
            //     var xPos1 = offset1.left;
            //     var yPos1 = offset1.top;
            //     var element = $(this).attr('id');
            //     //substring depends on the length of id string
            //     var number = element.substring(3);
            //     $('#pos'+number+'X').text('x: ' + xPos1);
            //     $('#pos'+number+'Y').text('y: ' + yPos1);
            // }
          })
        .resizable({
          containment: "parent"
        });
        $('.default').click(function(){
            if ( $(this).is('.ui-draggable-dragging') ) {
                return;
            }
            $('#chkbox'+temp).draggable( "option", "disabled", true );
            $(this).attr('contenteditable','true');
        })
        .blur(function(){
            $('#chkbox'+temp).draggable( 'option', 'disabled', false);
            $(this).attr('contenteditable','false');
        });

        $(document).click(function(e){
          if($(e.target).attr('id') == ('chkbox'+temp)){
            $(e.target).children('.default').click();
            $(e.target).children('.default').focus();
          }
        });

        $.count++;
    });

  $('#dropdown')
      .click(function(eventClick, posX, posY, page_num){
        posX = typeof posX !== 'undefined' ? posX : 213;
      posY = typeof posY !== 'undefined' ? posY : 194;
      page_num = typeof page_num !== 'undefined' ? page_num : 0;

      var htmlData='<div id="dropdown'+$.count+'" class="draggable ui-draggable"';
      if (posX != null && posY != null){
        htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px; height:34px; width:140px;"';
      }
      else{
        htmlData += 'style="height:34px; width:140px;"';
      }

      htmlData += '><select id="drpeditable'+$.count+'" style="position:absolute; top:0; left:0"> <option value="sample" selected="selected">Dropdown Menu</option><option value="addoption">Add Option</option> </select> <input id="drpinput'+$.count+'" type="text" name="" value="" placeholder="Add Option" style="position:absolute; width:125px; height:34px;"><a href="#" class="delete"></a></div>';
      
      var temp = $.count;
      var index = page_num;

      if(index <= 0)
        $("#page" + $.current_page).append(htmlData);
      else
        $("#page" + index).append(htmlData);

      $('#dropdown'+temp).draggable({
            containment: "#workspace",
            scroll: false,
            cancel: false,
            // drag: function(){
            //     var offset1 = $(this).offset();
            //     var xPos1 = offset1.left;
            //     var yPos1 = offset1.top;
            //     var element = $(this).attr('id');
            //     //substring depends on the length of id string
            //     var number = element.substring(3);
            //     $('#pos'+number+'X').text('x: ' + xPos1);
            //     $('#pos'+number+'Y').text('y: ' + yPos1);
            // }
      })
      .click(function(){
          $(this).draggable( "option", "disabled", true );
          $(this).attr('contenteditable','true');
      });

      $('#drpinput'+temp).val($('#drpeditable'+temp+' option:selected').text());

      $('#drpinput'+temp).blur(function(){
        //alert('1');
          $('#dropdown'+temp).draggable( 'option', 'disabled', false);
          $('.draggable').attr('contenteditable','false');
      });

      $('#drpeditable'+temp).on('change', function(){
        if($('#drpeditable'+temp+' option:selected').val() == 'addoption'){
          $('#drpinput'+temp).val('');
        }else{
          $('#drpinput'+temp).val($('#drpeditable'+temp+' option:selected').text());
        }
      });

      function edit(){
          $('#drpeditable'+temp+' option:selected').text($('#drpinput'+temp).val());
          $('#drpeditable'+temp+' option:selected').val($('#drpinput'+temp).val());
      }

      $('#drpinput'+temp).on('keyup', function(e){
          if($('#drpeditable'+temp+' option:selected').val() != 'addoption' && $('#drpinput'+temp).val() != ""){
              edit();
          }
      });


      $('#drpinput'+temp).blur(function(){
        if($('#drpeditable'+temp+' option:selected').val() == 'addoption' && $('#drpinput'+temp).val() != ""){
          var str = ' <option value="'+$('#drpinput'+temp).val() + '">'+ $('#drpinput'+temp).val() +'</option>';
                $('#drpeditable'+temp+' option').eq(-1).before(str);
                $('#drpeditable'+temp+' option:last').attr("selected", "selected");
        }
        else if($('#drpeditable'+temp+' option:selected').val() != 'addoption' && $('#drpinput'+temp).val() == ""){
            $('#drpeditable'+temp+' option:selected').remove();
          }
      });
          $.count++;
      });

  $('#slider')
      .click(function(eventClick, posX, posY, page_num, min, max){
        posX = typeof posX !== 'undefined' ? posX : 120;
      posY = typeof posY !== 'undefined' ? posY : 198;
      page_num = typeof page_num !== 'undefined' ? page_num : 0;
      min = typeof min !== 'undefined' ? min : 0;
      max = typeof max !== 'undefined' ? max : 1;

      var htmlData='<div id="sldr'+$.count+'" class="draggable"';
      if (posX != null && posY != null){
        htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px; height:25px; width:360px"';
      }
      else{
        htmlData += 'style="height:25px; width:360px"';
      }

      // faulty -- contentEditable=true data-ph="My Placeholder String"
      htmlData += '><input id="movingslider'+$.count+'" class="sldr" type="text" data-slider="true" data-slider-range="1,1000"><span id="sldrspan'+$.count+'" class="output"></span><a href="#" class="delete"></a></div>';

      var temp = $.count;
      var index = page_num;

      if(index <= 0)
        $("#page" + $.current_page).append(htmlData);
      else
        $("#page" + index).append(htmlData);

      $('#movingslider'+temp).simpleSlider();
      $('#sldrspan'+temp).html($('#movingslider'+temp).data('slider-range').split(',')[0]);
      $('#movingslider'+temp)
          .bind("slider:ready slider:changed", function (event, data) {

            var a = $(this).data('slider-range').split(',');
            var base = 0;
            if(data.value.toFixed(3) == 0){
              base = parseInt(a[0]);
            }
            else{
              base = data.value.toFixed(3) * parseInt(a[1]);
            }
              $(this).nextAll(".output:first").html(base);

      });
      $('#sldr'+temp).draggable({
        containment: "#workspace",
        scroll: false,
        cancel: false,
        // drag: function(){
        //     var offset1 = $(this).offset();
        //     var xPos1 = offset1.left;
        //     var yPos1 = offset1.top;
        //     var element = $(this).attr('id');
        //     //substring depends on the length of id string
        //     var number = element.substring(3);
        //     $('#pos'+number+'X').text('x: ' + xPos1);
        //     $('#pos'+number+'Y').text('y: ' + yPos1);
        // }
      });      

      $('#movingslider'+$.count).attr('data-slider-range', min + "," + max);
          $.count++;
    });

  $("#getObjectValues").click(function () {
    //collect all question object
    var eid = document.getElementById('workspace').getAttribute('data-eid');
    var x = new Array();
    var question_exists = false;
    x.push($.page);

    for(j=1; j<=$.page; j++){
      var check = $('#page'+j).find('div');
      if(check.hasClass('flag')){
        question_exists = true;
      }else{
        question_exists = false;
        break;
      }
    }

    if(question_exists){
      for(i=1; i<$.count; i++){
        if ($('#qtn'+i).offset() !== undefined){
          var xPos = $('#qtn'+i).css('left') == 'auto' ? 5 : parseInt($('#qtn'+i).css('left'));
          var yPos = $('#qtn'+i).css('top') == 'auto' ? 5 : parseInt($('#qtn'+i).css('top'));
          var data = new Array();
          data[0]=$('#qtn'+i).parent().attr("id");
          data[1] = xPos;
          data[2] = yPos;
          data[3] = "question";
          data[4] = document.getElementById('qtneditable'+i).textContent;
          data[5] = $('#qtn'+i).css("width");
          data[6] = $('#qtn'+i).css("height");
          data[7] = rgb2hex($('#qtneditable'+i).css("color"));
          x.push(data);
        }
      }
      for(i=1; i<$.count; i++){
        // if ($('#qtn'+i).offset() !== undefined){
       //        var xPos = $('#qtn'+i).css('left') == 'auto' ? 5 : parseInt($('#qtn'+i).css('left'));
       //        var yPos = $('#qtn'+i).css('top') == 'auto' ? 5 : parseInt($('#qtn'+i).css('top'));
       //       var data = new Array();
        //  data[0]=$('#qtn'+i).parent().attr("id");
       //       data[1] = xPos;
       //       data[2] = yPos;
       //       data[3] = "question";
       //       data[4] = document.getElementById('qtneditable'+i).textContent;
        //  data[5] = $('#qtn'+i).css("width");
        //  data[6] = $('#qtn'+i).css("height");
        //  data[7] = rgb2hex($('#qtneditable'+i).css("color"));
       //       x.push(data);
       //     }

        if ($('#inp'+i).offset() !== undefined){
          var xPos = $('#inp'+i).css('left') == 'auto' ? 5 : parseInt($('#inp'+i).css('left'));
          var yPos = $('#inp'+i).css('top') == 'auto' ? 5 : parseInt($('#inp'+i).css('top'));
          var data = new Array();
          data[0]=$('#inp'+i).parent().attr("id");
          data[1] = xPos;
          data[2] = yPos;
          data[3] = "textinput";
          data[4] = $('#inp'+i).css("width");
          data[5] = $('#inp'+i).css("height");
          x.push(data);
        }

        if ($('#btn'+i).offset() !== undefined){
          var xPos = $('#btn'+i).css('left') == 'auto' ? 5 : parseInt($('#btn'+i).css('left'));
              var yPos = $('#btn'+i).css('top') == 'auto' ? 5 : parseInt($('#btn'+i).css('top'));
            var data = new Array();
          data[0]=$('#btn'+i).parent().attr("id");
            data[1] = xPos;
            data[2] = yPos;
            data[3] = "button";
            data[4] = document.getElementById('btneditable'+i).textContent;
          data[5] = $('#btn'+i).css("width");
          data[6] = $('#btn'+i).css("height");
            x.push(data);
          }

        if ($('#radbtn'+i).offset() !== undefined){
          var xPos = $('#radbtn'+i).css('left') == 'auto' ? 5 : parseInt($('#radbtn'+i).css('left'));
              var yPos = $('#radbtn'+i).css('top') == 'auto' ? 5 : parseInt($('#radbtn'+i).css('top'));
            var data = new Array();
          data[0]=$('#radbtn'+i).parent().attr("id");
            data[1] = xPos;
            data[2] = yPos;
            data[3] = "radio";
            data[4] = document.getElementById('radbtneditable'+i).textContent;
          data[5] = $('#radbtn'+i).css("width");
          data[6] = $('#radbtn'+i).css("height");
            x.push(data);
          }

        if ($('#chkbox'+i).offset() !== undefined){
          var xPos = $('#chkbox'+i).css('left') == 'auto' ? 5 : parseInt($('#chkbox'+i).css('left'));
              var yPos = $('#chkbox'+i).css('top') == 'auto' ? 5 : parseInt($('#chkbox'+i).css('top'));
            var data = new Array();
          data[0]=$('#chkbox'+i).parent().attr("id");
            data[1] = xPos;
            data[2] = yPos;
            data[3] = "checkbox";
            data[4] = document.getElementById('chkboxeditable'+i).textContent;
          data[5] = $('#chkbox'+i).css("width");
          data[6] = $('#chkbox'+i).css("height");
            x.push(data);
          }

        if ($('#dropdown'+i).offset() !== undefined){
          var xPos = $('#dropdown'+i).css('left') == 'auto' ? 5 : parseInt($('#dropdown'+i).css('left'));
              var yPos = $('#dropdown'+i).css('top') == 'auto' ? 5 : parseInt($('#dropdown'+i).css('top'));
            var data = new Array();
          data[0]=$('#dropdown'+i).parent().attr("id");
            data[1] = xPos;
            data[2] = yPos;
            data[3] = "dropdown";
            x.push(data);
          }

        if ($('#sldr'+i).offset() !== undefined){
          var xPos = $('#sldr'+i).css('left') == 'auto' ? 5 : parseInt($('#sldr'+i).css('left'));
          var yPos = $('#sldr'+i).css('top') == 'auto' ? 5 : parseInt($('#sldr'+i).css('top'));
          var data = new Array();
          data[0]=$('#sldr'+i).parent().attr("id");
          data[1] = xPos;
          data[2] = yPos;
          data[3] = "slider";
          data[4] = $('#movingslider'+i).data('slider-range').split(',')[0];
          data[5] = $('#movingslider'+i).data('slider-range').split(',')[1];
          x.push(data);
         }
      }

      $.ajax({
        url: window.location.protocol+"//"+window.location.host + '/BuildEx/builder/save',
        type:"POST",
        data:{
          'msg':x,
          'eid':eid
        },
        dataType: 'json',
        complete: function(data) {
          // alert("Saved Successfully!");
          //alert(data[0][0]);
          // alert(data.responseText);
          
          window.location.href = window.location.protocol+"//"+window.location.host + '/BuildEx/' + data.responseText + '/experiments';
        },
      });
    }
    else{
      alert('Can\'t save, each slide should have a question');
    }
  });
  
  $('body').on('paste', '.ui-widget-content', function (e) {
      setTimeout(function() {
          console.log($(e.target).html($(e.target).text()));
      }, 0);
  });

  $('.slides').on('click', '.slide-title', function(e){
    var parent = $(this).parent();
    var id = parent.attr('id').substr(5,6);
    $('#slide' + $.current_page).css('background', '#f2f2f2');;
    $(parent).css('background', 'yellow');
    $("#page" + $.current_page).css("visibility", "hidden");
    $("#page" + id).css("visibility", "visible");
    $.current_page = parseInt(id);
    checkQuestion();
  });

  $( ".slides" ).sortable({
    start: function(event, ui){
      var slide = ui.item.attr('id');
      $.bef_ind = $('#'+slide).index();

      var id = slide.substr(5,6);
      $('#slide' + $.current_page).css('background', '#f2f2f2');;
      $(ui.item).css('background', 'yellow');
      $("#page" + $.current_page).css("visibility", "hidden");
      $("#page" + id).css("visibility", "visible");
    },
    stop: function(event,ui){
      var slide = ui.item.attr('id');
      var id = slide.substr(5,6);
      var aft_ind = $('#'+slide).index();
      if($.bef_ind < aft_ind){
        for(i=$.bef_ind;i<=aft_ind;i++){
          var orig_seq = parseInt(($('.slides').children().eq(i).attr('id').substr(5,6)));
          $('.slides').children().eq(i).attr('id','slide'+(i+1));
          $('.slides').children().eq(i).children('p').text('Slide '+(i+1));
          $('#workspace').children().eq(orig_seq-1).attr('id','page'+(i+1));
        }
        $('#workspace > div').tsort('',{attr:'id'});
      }
      else if(aft_ind < $.bef_ind){
        for(i=$.bef_ind;i>=aft_ind;i--){
          var orig_seq = parseInt(($('.slides').children().eq(i).attr('id').substr(5,6)));
          $('.slides').children().eq(i).attr('id','slide'+(i+1));
          $('.slides').children().eq(i).children('p').text('Slide '+(i+1));
          $('#workspace').children().eq(orig_seq-1).attr('id','page'+(i+1));
        }
        $('#workspace > div').tsort('',{attr:'id'});
      }
      $.current_page = parseInt(ui.item.index()+1);
     
    }
  });

  $("#newPage").click(function(){
    if($.trim($('.slides').html()).length == 0){

      var htmlData = '<div id="page1" class="pageframe" style="width:100%; height:100%"></div>';
      $('#workspace').append(htmlData);

      var htmlData = '<div id="slide1" class="slideframe panel pnl" style="background:yellow"><i class="fi-x remove-icon pull-right"></i><p class="slide-title">Slide 1</p></div>';

      $('.slides').append(htmlData);
    }
    else{
      if($.current_page < $.page){
        for(i=$.page; i>=$.current_page+1; i--){
          $('#slide'+i+' p').text('Slide '+(i+1));
          $('#slide'+i).attr('id','slide'+(i+1));
          $('#page'+i).attr('id','page'+(i+1));
        }
      }
      $.page++;
      var after_curr_page = $.current_page+1;

      var htmlData = '<div id="page' + after_curr_page +'" class="pageframe" style="width:100%; height:100%"></div>';
      $('#page'+$.current_page).after(htmlData);

      var htmlData = '<div id="slide'+ after_curr_page +'" class="panel pnl"><i class="fi-x remove-icon pull-right"></i><p class="slide-title">Slide '+ after_curr_page +'</p></div>';
      $('#slide'+$.current_page).after(htmlData);

      $('#question').removeClass('disabled');
      $("#nextPage").click();
    }
  });

  $('.slides').on('click', '.remove-icon',function(e){
    id = $(this).parent().attr('id').substring(5);
    $(this).parent('div').remove();
    $('#page'+id).remove();

    id = parseInt(id);
    for(i=id+1;i<=$.page;i++){
      $('#slide'+i+' p').text('Slide '+(i-1));
      $('#slide'+i).attr('id','slide'+(i-1));
      $('#page'+i).attr('id','page'+(i-1));
    }

    // alert($.page + ' ' + $.current_page + ' ' + id);

    if((id < $.current_page || $.current_page == $.page) && $.page != 1){
      $.current_page--;
    }

    if($.page != 1 && id == ($.current_page+1) || id == $.current_page){
      $("#page" + $.current_page).css("visibility", "visible");
      checkQuestion();
      $("#slide"+$.current_page).css('background', 'yellow');
    }
    if($.page != 1){
      $.page--;
    }
    // alert($.page + ' ' + $.current_page);
  });

  $("#prevPage").click(function(){
    document.getElementById("page" + $.current_page).style.visibility = 'hidden';

    if($.current_page > 1){
      $.current_page--;
    }


    document.getElementById("page" + $.current_page).style.visibility = 'visible';

    checkQuestion();

    //styling
    $("#slide"+$.current_page).css('background', 'yellow');
    $("#slide"+($.current_page+1)).css('background', '#f2f2f2');
  });

  $("#nextPage").click(function(){
    document.getElementById("page" + $.current_page).style.visibility = 'hidden';

    // alert($.current_page+' '+$.page);

    if($.current_page < $.page){
      $.current_page++;
    }

    
    document.getElementById("page" + $.current_page).style.visibility = 'visible';

    checkQuestion();

    //styling 
    $("#slide"+($.current_page-1)).css('background', '#f2f2f2');
    $("#slide"+$.current_page).css('background', 'yellow');
    
  }); 

});   

}) (jQuery); 