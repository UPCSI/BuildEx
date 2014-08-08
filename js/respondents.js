var answer_cache = {};
var total_page = 0;
var qid_list = Array();
$.count = 1;
$.current_page = 1;
$.last_selected = null;
$.start_time = 0;
$.times = [];
$.unload_flagger = true;

function clear_form(){
	var my_form = document.getElementById("demographics");
	my_form.reset();
}

function register_answer(qid,value){
	answer_cache[qid] = value;
}

function setSlider(index) {
	var $el, allowedValues, settings, x;

	$("[data-slider]").each(function() {
    $.x = $el = $(this);
    settings = {};
    allowedValues = $el.data("slider-values");
    if (allowedValues) {
      settings.allowedValues = (function() {
        var _i, _len, _ref, _results;
        _ref = allowedValues.split(",");
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
          x = _ref[_i];
          _results.push(parseFloat(x));
        }
        return _results;
      })();
    }
    if ($el.data("slider-range")) {
      settings.range = $el.data("slider-range").split(",");
    }
    if ($el.data("slider-step")) {
      settings.step = $el.data("slider-step");
    }
    settings.snap = $el.data("slider-snap");
    settings.equalSteps = $el.data("slider-equal-steps");
    if ($el.data("slider-theme")) {
      settings.theme = $el.data("slider-theme");
    }
    if ($el.attr("data-slider-highlight")) {
      settings.highlight = $el.data("slider-highlight");
    }
    if ($el.data("slider-animate") != null) {
      settings.animate = $el.data("slider-animate");
    }
  });

	$('#movingslider'+index).simpleSlider(settings);
}

function draw_question(posX, posY, text_input, page_num, width, height, color, qid){
	posX = typeof posX !== 'undefined' ? posX : null;
	posY = typeof posY !== 'undefined' ? posY : null;
	page_num = typeof page_num !== 'undefined' ? page_num : 0;
	text_input = typeof text_input !== 'undefined' ? text_input : "";
	width = typeof width !== 'undefined' ? width : 200;
	height = typeof height !== 'undefined' ? height : 40;
	color = typeof color !== 'undefined' ? color : 000000;
	color = '#' + color;	

	workspace_width = $('#workspace').width()/1024; //hardcoded
	workspace_height = $('#workspace').height()/576; //hardcoded
	new_font_size = Math.sqrt(Math.pow(workspace_width,2) * Math.pow(workspace_height,2));
	zoomed_x = (posX/1024)*100; //hardcoded
	zoomed_y = (posY/576)*100; //hardcoded

	var htmlData='<div id="qtn'+$.count+'" class = "static_obj" data-page=" ' + total_page + '"';

	if (posX !== null && posY !== null){
		htmlData += 'style="left:'+ zoomed_x +'%; top:'+ zoomed_y +'%; width:'+ width*workspace_width + 'px; height:'+ height*workspace_height +'px;"';
	}

	if(text_input !== ""){
		htmlData += '><div id="qtneditable'+$.count+'" value="'+qid+'" data-page="'+page_num+'" class="text-holder" style="font-size:'+new_font_size*14+'px;">'+text_input+'</div></div>';
	}

	else{
		htmlData += '><div id="qtneditable'+$.count+'" value="'+qid+'" data-page="'+page_num+'" class="text-holder" data-placeholder="Enter Question" style="font-size:'+new_font_size*14+'px;"></div></div>';
	}

	var temp = $.count;
	var index = page_num;
	if(index <= 0){
		$("#page" + $.current_page).append(htmlData);
	}
	else{
		$("#page" + index).append(htmlData);
	}

	document.getElementById('qtneditable'+$.count).style.color = color;	
	$.count++;
}

function draw_text_input(posX, posY, text_input, page_num, width, height){
	posX = typeof posX !== 'undefined' ? posX : null;
	posY = typeof posY !== 'undefined' ? posY : null;
	page_num = typeof page_num !== 'undefined' ? page_num : 0;
	text_input = typeof text_input !== 'undefined' ? text_input : "";
	width = typeof width !== 'undefined' ? width : 200;
	height = typeof height !== 'undefined' ? height : 40;

	workspace_width = $('#workspace').width()/1024; //hardcoded
	workspace_height = $('#workspace').height()/576; //hardcoded
	new_font_size = Math.sqrt(Math.pow(workspace_width,2) * Math.pow(workspace_height,2));
	zoomed_x = (posX/1024)*100; //hardcoded
	zoomed_y = (posY/576)*100; //hardcoded

	var htmlData='<div id="inp'+$.count+'" class = "static_obj" data-page="' + total_page + '"';

	if (posX !== null && posY !== null){
		htmlData += 'style="left:'+ zoomed_x +'%; top:'+ zoomed_y +'%;  width:' + width*workspace_width + 'px; height:' + height*workspace_height + 'px"';
	}

	htmlData += '><div id="inpeditable'+$.count+'"class="text-holder" data-placeholder="Enter Input" style="font-size:'+new_font_size*14+'px;"></div></div>';

	var temp = $.count;
	var index = page_num;
	if(index <= 0){
		$("#page" + $.current_page).append(htmlData);
	}
	else{
		$("#page" + index).append(htmlData);
	}

	$('#inpeditable'+temp).click(function(){
        $(this).attr('contenteditable','true');
	});
	$.count++;
}

function draw_button(posX, posY, text_input, page_num, width, height, go_to){
	posX = typeof posX !== 'undefined' ? posX : null;
	posY = typeof posY !== 'undefined' ? posY : null;
	page_num = typeof page_num !== 'undefined' ? page_num : 0;
	text_input = typeof text_input !== 'undefined' ? text_input : "Button";
	width = typeof width !== 'undefined' ? width : 150;
	height = typeof height !== 'undefined' ? height : 40;
	go_to = typeof go_to !== 'undefined' ? go_to : null;


	workspace_width = $('#workspace').width()/1024; //hardcoded
	workspace_height = $('#workspace').height()/576; //hardcoded
	new_font_size = Math.sqrt(Math.pow(workspace_width,2) * Math.pow(workspace_height,2));
	zoomed_x = (posX/1024)*100; //hardcoded
	zoomed_y = (posY/576)*100; //hardcoded

	var htmlData='<div id="btn'+$.count+'" class="static_obj" ' + 'data-page="' + total_page + '" ';

	if (posX !== null && posY !== null){

		htmlData += 'style="left:'+ zoomed_x +'%; top:'+ zoomed_y +'%; width:' + width*workspace_width + 'px; height:' + height*workspace_height + 'px;"';
	}
	else{
		htmlData += 'style="width:150px; height:60px"';
	}

	htmlData += '><button id="btneditable'+$.count+'" style="width:100%; height:100%; margin-bottom:0px; padding:0px; font-size:'+new_font_size*14+'px;">'+text_input+'</button></div>';

	var temp = $.count;

	var index = page_num;

	if(index <= 0) {
		$("#page" + $.current_page).append(htmlData);
	}
	else {
		$("#page" + index).append(htmlData);
	}

	// add go_to data
	$('#btneditable'+temp).data('go_to', go_to);

	$('#btneditable'+temp).click(function() {
		var slide = parseInt($(this).data('go_to'));
		
		if(!isNaN(slide)) {
			$('#next_page').trigger('click',[slide, 'goto']);
		}
	});
	$.count++;
}

function draw_radio_button(posX, posY, text_input, page_num, width, height){
	posX = typeof posX !== 'undefined' ? posX : null;
	posY = typeof posY !== 'undefined' ? posY : null;
	page_num = typeof page_num !== 'undefined' ? page_num : 0;
	text_input = typeof text_input !== 'undefined' ? text_input : "Radio Button";
	width = typeof width !== 'undefined' ? width : 120;
	height = typeof height !== 'undefined' ? height : 25;

	workspace_width = $('#workspace').width()/1024; //hardcoded
	workspace_height = $('#workspace').height()/576; //hardcoded
	new_font_size = Math.sqrt(Math.pow(workspace_width,2) * Math.pow(workspace_height,2));
	zoomed_x = (posX/1024)*100; //hardcoded
	zoomed_y = (posY/576)*100; //hardcoded

	var htmlData='<div id="radbtn'+$.count+'" class="radiosnap static_obj"';
	if (posX != null && posY != null){
		htmlData += 'style="left:'+ zoomed_x +'%; top:'+ zoomed_y +'%; width:' + width*workspace_width + 'px; height:' + workspace_height + 'px;"';
	}
	else{
		htmlData += 'style="height:25px; width:120px;"';
	}

	htmlData += '><input type="radio" id="radbtneditable'+$.count+'" name="'+ total_page +'" value="'+text_input+'" style="font-size:'+new_font_size*14+'px;">'+text_input+'</div>';

	var temp = $.count;
	var index = page_num;

	if(index <= 0) {
		$("#page" + $.current_page).append(htmlData);
	}
	else {
		$("#page" + index).append(htmlData);
	}

  $(document).click(function(e){
  	if($(e.target).attr('id') == ('radbtn'+temp)){
  		$(e.target).children('.default').click();
  		$(e.target).children('.default').focus();
  	}
  });
  
  $.count++;
}

function draw_checkbox(posX, posY, text_input, page_num, width, height){
	posX = typeof posX !== 'undefined' ? posX : null;
	posY = typeof posY !== 'undefined' ? posY : null;
	page_num = typeof page_num !== 'undefined' ? page_num : 0;
	text_input = typeof text_input !== 'undefined' ? text_input : "Checkbox";
	width = typeof width !== 'undefined' ? width : 200;
	height = typeof height !== 'undefined' ? height : 40;

	workspace_width = $('#workspace').width()/1024; //hardcoded
	workspace_height = $('#workspace').height()/576; //hardcoded
	new_font_size = Math.sqrt(Math.pow(workspace_width,2) * Math.pow(workspace_height,2));
	zoomed_x = (posX/1024)*100; //hardcoded
	zoomed_y = (posY/576)*100; //hardcoded

	var htmlData='<div id="chkbox'+$.count+'" class="checksnap static_obj"';

	if (posX != null && posY != null){
		htmlData += 'style="left:'+ zoomed_x +'%; top:'+ zoomed_y +'%; width:' + width*workspace_width + 'px; height:' + workspace_height + 'px;"';
	}
	else{
		htmlData += 'style="height:25px; width:120px;"';
	}

	htmlData += '><input type="checkbox" id="chkeditable'+$.count+'" name="'+ total_page +'" value="'+text_input+'">'+text_input+'</div>';

	var temp = $.count;
	var index = page_num;

	if(index <= 0) {
		$("#page" + $.current_page).append(htmlData);
	}
	else {
		$("#page" + index).append(htmlData);
	}

  $(document).click(function(e){
  	if($(e.target).attr('id') == ('chkbox'+temp)){
  		$(e.target).children('.default').click();
  		$(e.target).children('.default').focus();
  	}
  });
    
    $.count++;
}

function draw_dropdown(posX, posY, page_num, options){
	posX = typeof posX !== 'undefined' ? posX : null;
	posY = typeof posY !== 'undefined' ? posY : null;
	page_num = typeof page_num !== 'undefined' ? page_num : 0;
	width = typeof width !== 'undefined' ? width : 140;
	height = typeof height !== 'undefined' ? height : 34;

	workspace_width = $('#workspace').width()/1024; //hardcoded
	workspace_height = $('#workspace').height()/576; //hardcoded
	new_font_size = Math.sqrt(Math.pow(workspace_width,2) * Math.pow(workspace_height,2));
	zoomed_x = (posX/1024)*100; //hardcoded
	zoomed_y = (posY/576)*100; //hardcoded

	var htmlData='<div id="dropdown'+$.count+'" class="static_obj"';

	if (posX != null && posY != null){
		htmlData += 'style="left:'+ zoomed_x +'%; top:'+ zoomed_y +'%; width:' + width*workspace_width + 'px; height:' + height*workspace_height + 'px;"';

	}
	else{
		htmlData += 'style="width:' + width*workspace_width + 'px; height:' + height*workspace_height + 'px;"';
	}

	htmlData += '><select id="drpeditable'+$.count+'" style="position:absolute; top:0; left:0">';
	if(options !== undefined){
		options.forEach(function(choice){
			htmlData += '<option value="'+choice+'">'+choice+'</option>';
		});
	}

	htmlData += '</div>';
	
	var temp = $.count;
	var index = page_num;

	if(index <= 0){
		$("#page" + $.current_page).append(htmlData);
	}
	else{
		$("#page" + index).append(htmlData);
	}

	$('#drpinput'+temp).val($('#drpeditable'+temp+' option:selected').text());

	$('#drpeditable'+temp).on('change', function(){
		$('#drpinput'+temp).val($('#drpeditable'+temp+' option:selected').text());
	});

	$('#drpinput'+temp).blur(function(){
			$('#drpeditable'+temp+' option:selected').remove();
	});
	
	$.count++;
}

function draw_slider(posX, posY, page_num, min, max, snap, highlight, step){
	posX = typeof posX !== 'undefined' ? posX : null;
	posY = typeof posY !== 'undefined' ? posY : null;
	page_num = typeof page_num !== 'undefined' ? page_num : 0;
	snap = typeof snap !== 'undefined' ? snap : false;
	highlight = typeof highlight !== 'undefined' ? highlight : false;
	step = typeof step !== 'undefined' ? step : 0;
	workspace_width = $('#workspace').width()/1024; //hardcoded
	workspace_height = $('#workspace').height()/576; //hardcoded
	new_font_size = Math.sqrt(Math.pow(workspace_width,2) * Math.pow(workspace_height,2));
	zoomed_x = (posX/1024)*100; //hardcoded
	zoomed_y = (posY/576)*100; //hardcoded

	var htmlData='<div id="sldr'+$.count+'" class="static_obj"';
	if (posX != null && posY != null){
		htmlData += 'style="left:'+ zoomed_x +'%; top:'+ zoomed_y +'%; height:'+25*workspace_height+'px; width:'+360*workspace_width+'px"';
	}
	else{
		htmlData += 'style="height:25px; width:360px"';
	}

	htmlData += '><input id="movingslider'+$.count+'" class="sldr" type="text" data-slider="true" data-slider-range="'+min+','+max+'" data-slider-step="'+step+'" data-slider-snap="'+snap+'" data-slider-highlight="'+highlight+'"></div>';

	var temp = $.count;
	var index = page_num;

	if(index <= 0) {
		$("#page" + $.current_page).append(htmlData);
	}
	else {
		$("#page" + index).append(htmlData);
	}

	setSlider(temp);

	$('#movingslider'+temp)
			.after('<span id="sliderspan'+$.count+'" class="output">'+min.toFixed(3)+'</span>')
	    .bind("slider:ready slider:changed", function (event, data) {
	      $(this).nextAll(".output:first").html(data.value.toFixed(3));
	    });

  $.count++;
}

function save_input(){
	var x = new Array();
	console.log(total_page + " pages.");
	console.log($.times);

	x.push(total_page);
	x.push($.times);
	
	for(i=1; i<=$.count; i++){
		if ($('#inp'+i).offset() !== undefined){
			page = $('#inp'+i).parent().attr("id").slice(4);
			question = $("div").find('[data-page="'+page+'"]');
			qid = question.attr('value');
			var data = {
				'qid'		:	 qid,
				'page'		:	 page,
				'type'		:	 "text_input",
				'text'	 	:	 $('#inpeditable'+i).text(),
			}

			x.push(data);
			// console.log(data);
		}

		if ($('#radbtn'+i).offset() !== undefined){
			page = $('#radbtn'+i).parent().attr("id").slice(4);
			question = $("div").find('[data-page="'+page+'"]');
			qid = question.attr('value');
			var data = {
				'qid'		:	 qid,
				'page'		:	 page,
				'type'		:	 "radio",
				'text'	 	:	 $('#radbtneditable'+i).val(),
				'checked'	:	 $('#radbtneditable'+i).prop('checked'),
			}

			x.push(data);
			// console.log(data);
		}

		if ($('#chkbox'+i).offset() !== undefined){
			page = $('#chkbox'+i).parent().attr("id").slice(4);
			question = $("div").find('[data-page="'+page+'"]');
			qid = question.attr('value');
			var data = {
				'qid'		:	 qid,
				'page'		:	 page,
				'type'		:	 "checkbox",
				'text'	 	:	 $('#chkeditable'+i).val(),
				'checked'	:	 $('#chkeditable'+i).prop('checked'),
			}

			x.push(data);
			// console.log(data);
		}

		if ($('#dropdown'+i).offset() !== undefined){
			page = $('#dropdown'+i).parent().attr("id").slice(4);
			question = $("div").find('[data-page="'+page+'"]');
			qid = question.attr('value');
			var data = {
				'qid'		:	 qid,
				'page'		:	 page,
				'type'		:	 "dropdown",
				'selected'	:	 $('#drpeditable'+i).val(),
			}

			x.push(data);
			// console.log(data);
		}

		if ($('#sldr'+i).offset() !== undefined){
			page = $('#sldr'+i).parent().attr("id").slice(4);
			question = $("div").find('[data-page="'+page+'"]');
			qid = question.attr('value');
			var data = {
				'qid'		:	 qid,
				'page'		:	 page,
				'type'		:	 "slider",
				'value'	 	:	 $('#sliderspan'+i).text(),
			}

			x.push(data);
			// console.log(data);
		}
	}

	$.ajax({
		url: js_site_url() + 'respond/'+ $('#workspace').attr('data-eid') + '/' + $('#workspace').attr('data-slug') + '/save',
		type:"POST",
		async:false,
		data:{
			'msg':x,
		},
		dataType: 'html',
		error: function(e, text) {
			console.log(text);
		},
		success: function(e, text) {
			console.log(text);
		},
		complete: function(data) {
			console.log(data.responseText);
		},
	});
}

(function($){
	$(function() {
		function changeTextBtn(){
			if(total_page == 1) {
				$('#next_page').text('Done')
				.css('padding-left',21).css('padding-right',21);
			}
		}

		function checkLastPage() {
			if($.current_page == total_page) {
				save_input();
				window.location.href = js_site_url() + 'respond/' + $('#workspace').attr('data-eid') + '/' + $('#workspace').attr('data-slug') + '/debrief';
				$.unload_flagger = false;
			}
		}

		$(window).on('beforeunload', function() {
			if($.unload_flagger) {
				$.ajax({
					url: js_site_url() + 'respond/interrupted',
	        type:"POST",
	        data:{
	          'done' : 'false',
	        },
	        dataType: 'json',
				});
				return 'Exiting will not submit your form';
			}
		});

		$(document).ready(function(){
			changeTextBtn();
			$.start_time = (Date.now())/1000;
		});

		$("#debrief-btn").click(function() {
			$.unload_flagger = false;
		});

		$("#next_page").click(function(eventClick, go_to, action){
			go_to = typeof go_to !== 'undefined' ? go_to : null;
			action = typeof go_to !== 'undefined' ? action : null;

			$.end_time = (Date.now()/1000);
			$.times.push($.end_time - $.start_time);

			if($.current_page != total_page){
				$.start_time = (Date.now())/1000;
			}
			else if($.current_page == total_page){
				$.unload_flagger = false;
			}

			if(!action) { // next button is clicked and action is null
				checkLastPage();
			}

    	$("#page" + $.current_page).css('visibility','hidden');

			if($.current_page < total_page) {
				$.current_page++;
			}

			//go_to
			if(go_to) {
				$.current_page = go_to;
			}

    	$("#page" + $.current_page).css('visibility','visible');	
		});
	});
})(jQuery);
