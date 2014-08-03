(function($){ 

	$(function() {
		
		$.count = 1;
		$.page = 1;
		$.current_page = 1;
		$.last_selected = null;
		$.start_time = 0;
		$.end_time = 0;
		
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
			}

			else{
				$('#question').removeClass('disabled');
			}
		}

		function getSelector() {
			el = $('.'+$.last_selected);
			if(el.attr('class') == undefined) {
				el = $('#'+$.last_selected);
			}

			return el;
		}

		function setSlider(index) {
			var $el, allowedValues, settings, x;

			$("[data-slider]").each(function() {
	      $el = $(this);
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

			// put id in track and dragger
			children = $('#movingslider'+index).siblings('div[id^="movingslider"]').children();
			$(children[0]).attr('id', 'track'+index);
			$(children[1]).attr('id', 'dragger'+index);
		}

		function clearSettings() {
			// delete all settings before the new ones
			total_properties = $('[id^="property"]').length;
			parent_element = $('#settings-main1').closest('ul');
			for (i = 1; i <= total_properties; i++) {
				property = '<input id="property'+i+'" class="settings" value="-">';
				parent_element.children(':nth-child('+(i+2)+')').children().remove();
				parent_element.children(':nth-child('+(i+2)+')').append(property);
			}
		}

		function setSliderSettings() {
			clearSettings();

			// set the new settings
			$('#property1').prop('type', 'checkbox').after('<label for="property1">Highlight</label>');
			$('#property2').prop('type', 'checkbox').after('<label for="property2">Snap</label>');
			$('#property3').prop('type', 'text').attr('placeholder', "Input Slider Range");
			$('#property4').prop('type', 'text').attr('placeholder', "Input Slider Step");

			// add events to the properties
			$('#property1').click(function(e) {
				var desired_state, possible_parents, parent, input_element, dragger_current_position, el;

				el = getSelector();

				desired_state = $(this).is(':checked');
				possible_parents = el.closest('[id^="sldr"]');
				parent = $(possible_parents[0]); //get closest first
				input_element = parent.children('input');
				input_element.attr('data-slider-highlight', desired_state);
				input_element.data('slider-highlight', desired_state);
				input_element.data('slider-object').settings.highlight = desired_state;

				if(desired_state) {
					var item, highlight;
					item = $("<div>").addClass('highlight-track').css({
		        position: "absolute",
		        top: "50%",
		        userSelect: "none",
		        cursor: "pointer",
		        width: "0",
		        marginTop: parent.find('[class="track"]').outerHeight() / -2,
		      });
		      parent.find('[class="track"]').after(item);

		      highlight = parent.children('.slider').children('.highlight-track');

		      input_element.data('slider-object').highlightTrack = item

		      highlight.mousedown(function(e){
						return input_element.data('slider-object').trackEvent(e);
					});

					dragger_current_position = parent.find('[class="dragger"]').position().left;
					highlight.width(dragger_current_position);
				}
				else {
					parent.children('.slider').children('.highlight-track').remove();
					input_element.data('slider-object').highlightTrack.remove();
				}
			});

			$('#property2').click(function(e) {
				var desired_state, possible_parents, parent, input_element, el;

				el = getSelector();

				desired_state = $(this).is(':checked');

				possible_parents = el.closest('[id^="sldr"]');
				parent = $(possible_parents[0]); //get closest first
				input_element = parent.children('input');

				input_element.attr('data-slider-snap', desired_state);
				input_element.data('slider-snap', desired_state);
				input_element.data('slider-object').settings.snap = desired_state;
			});

			$('#property3').keypress(function(e) {
				if(e.which == 13) {
					var new_range, new_range_array_version, el, possible_parents, parent, input_element, span_element, last_range_array, last_position_ratio

					new_range = $(this).val();
					new_range_array_version = $(this).val().split(',');
					new_range_array_version[0] = Number(new_range_array_version[0] == '' ? undefined : new_range_array_version[0]);
					new_range_array_version[1] = Number(new_range_array_version[1] == '' ? undefined : new_range_array_version[1]);
					if(new_range_array_version.length != 2 || isNaN(new_range_array_version[0]) || isNaN(new_range_array_version[1])) {
						alert('Wrong format. Right format is purely 2 numbers separated with a comma. No spaces. Example: 1,100');
						return;
					}

					el = getSelector();

					possible_parents = el.closest('[id^="sldr"]');
					parent = $(possible_parents[0]); //get closest first
					input_element = parent.children('input');
					span_element = input_element.siblings('span');
					last_range_array = input_element.attr('data-slider-range').split(',');
					last_position_ratio = span_element.text()/last_range_array[1]; //type juggled automatically to integer

					input_element.attr('data-slider-range', new_range);
					input_element.data('slider-range', new_range);
					input_element.data('slider-object').settings.range = new_range_array_version;

					input_element.simpleSlider('setRatio',last_position_ratio);

					$(this).blur();
				}
			});

			$('#property4').keypress(function(e) {
				if(e.which == 13) {
					var new_step, error_check, el, possible_parents, parent, input_element;

					new_step = $(this).val();
					error_check = Number(new_step == '' ? undefined : new_step);
					if(isNaN(error_check)) {
						alert('Wrong format. Right format is purely 1 number. No spaces. Example: 5');
						return;
					}
					el = getSelector();

					possible_parents = el.closest('[id^="sldr"]');
					parent = $(possible_parents[0]); //get closest first
					input_element = parent.children('input');
					input_element.attr('data-slider-step', new_step);
					input_element.data('slider-step', new_step);
					if(new_step <= 0) {
						new_step = undefined;
						$(this).val(0);
					} 
					input_element.data('slider-object').settings.step = new_step;

					$(this).blur();
				}
			});
		}

		function setButtonSettings() {
			clearSettings();

			// set the new settings
			$('#property1').prop('type', 'text').attr('placeholder', "Input Go To Slide");

			// add events to the properties
			$('#property1').keypress(function(e) {
				if(e.which == 13) {
					var new_goto, error_check, el, possible_parents, parent, button_element, 

					new_goto = $(this).val();
					error_check = Number(new_goto == '' || new_goto < 1 || new_goto % 1 != 0 ? undefined : new_goto);
					if(isNaN(error_check)) {
						alert('Wrong format/value. Right format is purely 1 integer and starts with 1. No decimal point. Example: 5');
						if($(this).data('go_to') == null) {
							$(this).val('');
						}
						return;
					}

					el = getSelector();

					possible_parents = el.closest('div[id^="btn"]');
					parent = $(possible_parents[0]); //get closest first
					button_element = parent.children('button');
					button_element.data('go_to', new_goto);

					$(this).blur();
				}
			});
		}

		$(document).click(function(e) {
			if($('#'+$.last_selected).is('[id^="qtn"], [id^="inp"], [btn-family], [id^="rad"], [id^="chk"], [id^="drop"], [id*="sldr"], [id*="slider"], [class*="track"], [class^="dragger"]')) {
				$('.settings').prop('disabled', false);
			}
			else if($('.'+$.last_selected).is('[id^="qtn"], [id^="inp"], [btn-family], [id^="rad"], [id^="chk"], [id^="drop"], [id*="sldr"], [id*="slider"], [class*="track"], [class^="dragger"]')) {
				$('.settings').prop('disabled', false);
			}
			else {
				$('.settings').prop('disabled', true);
			}

			var outside_workspace_and_sidebar = true;
			
			if(e.target.id) {
				if(!($('.sidebar').find('#' + e.target.id).length > 0)) {
					if($('#workspace').find('#' + e.target.id).length > 0) {
						outside_workspace_and_sidebar = false;
					}
				}
				else {
					outside_workspace_and_sidebar = false;
				}
			}
			if(e.target.className && e.target.id == "") {
				if(!($('.sidebar').find('.' + e.target.className).length > 0)) {
					if($('#workspace').find('.' + e.target.className).length > 0) {
						outside_workspace_and_sidebar = false;
					}
				}
				else {
					outside_workspace_and_sidebar = false;
				}
			}
			
			if(outside_workspace_and_sidebar) {
				$.last_selected = null;
			}
		});

		$('#workspace').click(function(e){
			var hex = rgb2hex($('.minicolors-swatch-color').css('background-color'));
			$('#'+$.last_selected).css('color', hex);

			$.last_selected = e.target.id;
			if($.last_selected == "") {
				$.last_selected = e.target.className;
			}
		});

		$('.color-picker').each( function() {
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
					if(opacity)
						log += ', ' + opacity;
					}
				catch(e) {}
			},

			theme: 'default'

			});				
		});

		$('#workspace').on('click', '.remove-icon', function(e){
			answer = confirm("Are you sure you want to delete this?");
			if(answer) {
				var parent = $(this).parent('div');
				if(parent.attr('id').substr(0,3) == 'qtn'){
					$('#question').removeClass('disabled');
				}
				
				parent.remove();
			}
		});

		$('#question')
			.click(function(eventClick, posX, posY, text_input, page_num, width, height, color){
				if(!$(this).hasClass('disabled')){
					posX = typeof posX !== 'undefined' ? posX : 412;
					posY = typeof posY !== 'undefined' ? posY : 268;
					page_num = typeof page_num !== 'undefined' ? page_num : 0;
					text_input = typeof text_input !== 'undefined' ? text_input : "";
					width = typeof width !== 'undefined' ? width : 200;
					height = typeof height !== 'undefined' ? height : 40;
					color = typeof color !== 'undefined' ? color : 000000;
					color = '#' + color;

					var htmlData='<div id="qtn'+$.count+'" class="draggable ui-widget-content"';

					if (posX != null && posY != null){
						htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px; width:' + width + 'px; height:' + height + 'px;"';
					}

					if(text_input != ""){
						htmlData += '><i class="fi-x remove-icon pull-right"></i><div id="qtneditable'+$.count+'" class="editable flag">'+text_input+'</div></div>';
					}

					else{
						htmlData += '><i class="fi-x remove-icon pull-right"></i><div id="qtneditable'+$.count+'" class="editable flag" data-placeholder="Enter Question" ></div></div>';
					}

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
							containment: "#workspace"
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
						var color = rgba2hex($('#qtneditable'+temp).css('color'));
						$('#clr').val(color);
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
			posX = typeof posX !== 'undefined' ? posX : 412;
			posY = typeof posY !== 'undefined' ? posY : 268;
			page_num = typeof page_num !== 'undefined' ? page_num : 0;
			text_input = typeof text_input !== 'undefined' ? text_input : "";
			width = typeof width !== 'undefined' ? width : 200;
			height = typeof height !== 'undefined' ? height : 40;
			
			var htmlData='<div id="inp'+$.count+'" class="draggable ui-widget-content"';

			if (posX != null && posY != null){
				htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px; width:' + width + 'px; height:' + height + 'px;"';
			}
			
			htmlData += '><i class="fi-x remove-icon pull-right"></i><div id="inpeditable'+$.count+'" class="editable" data-placeholder="Enter Input" ></div></div>';

			var temp = $.count;
			var index = page_num;

			if(index <= 0){
				$("#page" + $.current_page).append(htmlData);
			}

			else{
				$("#page" + index).append(htmlData);
			}

			$('#inp'+temp).draggable({
				containment: "#workspace",
				scroll: false,
				snap: false,
			})

			.resizable({
				containment: "#workspace"
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
			.click(function(eventClick, posX, posY, text_input, page_num, width, height, go_to){
			posX = typeof posX !== 'undefined' ? posX : 437;
			posY = typeof posY !== 'undefined' ? posY : 268;
			page_num = typeof page_num !== 'undefined' ? page_num : 0;
			text_input = typeof text_input !== 'undefined' ? text_input : "Button";
			width = typeof width !== 'undefined' ? width : 150;
			height = typeof height !== 'undefined' ? height : 40;
			go_to = typeof go_to !== 'undefined' ? go_to : null;

			var htmlData='<div id="btn'+$.count+'" class="draggable" btn-family ';

			if (posX != null && posY != null){
				htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px; width:' + width + 'px; height:' + height + 'px;"';
			}

			else{
				htmlData += 'style="width:150px; height:60"';
			}
			
			htmlData += 'style="width:150px; height:60"><button id="btneditable'+$.count+'" style="width:100%; height:100%; margin-bottom:0px; padding:0px"><div class="default'+$.count+'" btn-family style="width:100%; height:100%; display:inline; vertical-align:middle">'+text_input+'</div></button><i class="fi-x remove-icon pull-right"></i></div>';
			
			var temp = $.count;
			var index = page_num;

			if(index <= 0){
				$("#page" + $.current_page).append(htmlData);
			}
			else{
				$("#page" + index).append(htmlData);
			}

			// add go_to data
			$('#btneditable'+temp).data('go_to', go_to);

			$('#btn'+temp).draggable({
				containment: "#workspace",
				scroll: false,
				cancel: false,
			})

			.resizable({
				containment: "#workspace"
			});

			$('.default'+temp).click(function(){
				if ($(this).is('.ui-draggable-dragging') ) {
						return;
				}

				$('#btn'+temp).draggable( "option", "disabled", true );
				$(this).attr('contenteditable','true');
			});

			$(document).click(function(e){
				if(e.target.id == ('btneditable'+temp)) {
					$('#btneditable'+temp).children().click();
				}
				if(e.target.parentElement.id == ('btneditable'+temp)){
					button = $('#btneditable'+temp);
					button.children().focus();

					//set up the settings
					setButtonSettings();

					btn_go_to = button.data('go_to');

					$('#property1').attr('value', btn_go_to); // attr changes the html
					$('#property1').val(btn_go_to); // val changes the property
				}
				else if(e.target.className != 'default'+temp && e.target.id != 'btneditable'+temp){
					$('#btn'+temp).draggable( 'option', 'disabled', false);
					$('.default'+temp).attr('contenteditable','false');
				}
			});
			
			$.count++;
		});

		$('#radiobutton')
			.click(function(eventClick, posX, posY, text_input, page_num, width, height){
			posX = typeof posX !== 'undefined' ? posX : 452;
			posY = typeof posY !== 'undefined' ? posY : 275;
			page_num = typeof page_num !== 'undefined' ? page_num : 0;
			text_input = typeof text_input !== 'undefined' ? text_input : "Radio Button";
			width = typeof width !== 'undefined' ? width : 120;
			height = typeof height !== 'undefined' ? height : 25;

			var htmlData='<div id="radbtn'+$.count+'" class="radiosnap draggable ui-draggable"';
			if (posX != null && posY != null){
				htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px; width:' + width + 'px; height:' + height + 'px;"';
			}

			else{
				htmlData += 'style="height:25px; width:120px;"';
			}
			
			htmlData += '><input type="radio" id="radeditable'+$.count+'" name="'+$.page+'" value="radiobutton"><div id="radbtneditable'+$.count+'"class="default" style="width:100%; height:100%; display:inline; vertical-align:middle">'+text_input+'</div><i class="fi-x remove-icon pull-right"></i></div>';
			
			var temp = $.count;
			var index = page_num;

			if(index <= 0){
				$("#page" + $.current_page).append(htmlData);
			}

			else{
				$("#page" + index).append(htmlData);
			}

			$('#radbtn'+temp).draggable({
				containment: '#workspace',
				scroll: false,
				cancel: false,
				snap: '.radiosnap'
			})

			.resizable({
				containment: "#workspace"
			});

			$('.default').click(function(){
					if ($(this).is('.ui-draggable-dragging') ) {
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
			posX = typeof posX !== 'undefined' ? posX : 452;
			posY = typeof posY !== 'undefined' ? posY : 275;
			page_num = typeof page_num !== 'undefined' ? page_num : 0;
			text_input = typeof text_input !== 'undefined' ? text_input : "Checkbox";
			width = typeof width !== 'undefined' ? width : 120;
			height = typeof height !== 'undefined' ? height : 25;

			var htmlData='<div id="chkbox'+$.count+'" class="checksnap draggable ui-draggable"';
			if (posX != null && posY != null){
				htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px; width:' + width + 'px; height:' + height + 'px;"';
			}
			else{
				htmlData += 'style="height:25px; width:120px;"';
			}
			
			htmlData += '><input type="checkbox" id="chkeditable'+$.count+'" name="'+$.page+'" value="checkbox"><div id="chkboxeditable'+$.count+'" class="default" style="width:100%; height:100%; display:inline; vertical-align:middle">'+text_input+'</div><i class="fi-x remove-icon pull-right"></i></div>';
			
			var temp = $.count;
			var index = page_num;

			if(index <= 0){
				$("#page" + $.current_page).append(htmlData);
			}

			else{
				$("#page" + index).append(htmlData);
			}

			$('#chkbox'+temp).draggable({
				containment: "#workspace",
				scroll: false,
				cancel: false,
				snap: '.checksnap'
			})

			.resizable({
				containment: "#workspace"
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
			.click(function(eventClick, posX, posY, page_num, options){
			posX = typeof posX !== 'undefined' ? posX : 442;
			posY = typeof posY !== 'undefined' ? posY : 271;
			page_num = typeof page_num !== 'undefined' ? page_num : 0;
			// options = typeof options !== 'undefined' ? options : undefined;

			var htmlData='<div id="dropdown'+$.count+'" class="draggable ui-draggable"';

			if (posX != null && posY != null){
				htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px; height:34px; width:140px;"';
			}

			else{
				htmlData += 'style="height:34px; width:140px;"';
			}

			htmlData += '><select id="drpeditable'+$.count+'" style="position:absolute; top:0; left:0; height: 34px; width:140px;">';
			if(options !== undefined){
				options.forEach(function(choice){
					htmlData += '<option value="'+choice+'">'+choice+'</option>';
				});
			}

			htmlData += '<option value="addoption" selected="selected">Add Option</option> </select> <input id="drpinput'+$.count+'" type="text" name="" value="" placeholder="Add Option" style="color:#a9a9a9; position:absolute; width:125px; height:34px;"><i class="fi-x remove-icon pull-right"></i></div>';
			
			var temp = $.count;
			var index = page_num;

			if(index <= 0){
				$("#page" + $.current_page).append(htmlData);
			}

			else{
				$("#page" + index).append(htmlData);
			}

			$('#dropdown'+temp).draggable({
				containment: "#workspace",
				scroll: false,
				cancel: false,
			})

			.click(function(){
				$(this).draggable( "option", "disabled", true );
			});

			firstclick = true;

			$('#drpinput'+temp).click(function() {
				if(firstclick) {
					$(this).val('').css('color','#000');
					firstclick = false;
				}
			});

			$('#drpinput'+temp).val($('#drpeditable'+temp+' option:selected').text());

			$('#drpinput'+temp).keypress(function(e){
				if(e.which == 13) {
					$('#dropdown'+temp).draggable('option', 'disabled', false);
					if($('#drpeditable'+temp+' option:selected').val() == 'addoption' && $('#drpinput'+temp).val() != ""){
						var str = ' <option value="'+$('#drpinput'+temp).val() + '">'+ $('#drpinput'+temp).val() +'</option>';
						$('#drpeditable'+temp+' option').eq(-1).before(str);
						$('#drpeditable'+temp+' option:last').attr('selected','selected');
						$(this).val('');
					}
					else if($('#drpeditable'+temp+' option:selected').val() != 'addoption' && $('#drpinput'+temp).val() == ""){
						$('#drpeditable'+temp+' option:selected').remove();
					}
					$('#drpinput'+temp).blur();
				}
			});

			$('#drpeditable'+temp).on('change', function(){
				if($('#drpeditable'+temp+' option:selected').val() == 'addoption'){
					$('#drpinput'+temp).val('');
				}

				else{
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
			
			$.count++;
		});

		$('#slider')
			.click(function(eventClick, posX, posY, page_num, min, max, snap, highlight, step){
			posX = typeof posX !== 'undefined' ? posX : 332;
			posY = typeof posY !== 'undefined' ? posY : 275;
			page_num = typeof page_num !== 'undefined' ? page_num : 0;
			min = typeof min !== 'undefined' ? min : 0;
			max = typeof max !== 'undefined' ? max : 1;
			snap = typeof snap !== 'undefined' ? snap : false;
			highlight = typeof highlight !== 'undefined' ? highlight : false;
			step = typeof step !== 'undefined' ? step : 0;


			var htmlData='<div id="sldr'+$.count+'" class="draggable sldr-family" ';
			if (posX != null && posY != null){
				htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px; height:25px; width:400px"';
			}

			else{
				htmlData += 'style="height:25px; width:360px"';
			}

			htmlData += '><input id="movingslider'+$.count+'" class="sldr" type="text" data-slider="true" data-slider-range="'+min+','+max+'" data-slider-step="'+step+'" data-slider-snap="'+snap+'" data-slider-highlight="'+highlight+'"><i class="fi-x remove-icon pull-right"></i></div>';

			var temp = $.count;
			var index = page_num;

			if(index <= 0){
				$("#page" + $.current_page).append(htmlData);
			}

			else{
				$("#page" + index).append(htmlData);
			}

			setSlider(temp);

			$('#movingslider'+temp)
				.after('<span id="sliderspan'+$.count+'" class="output">'+min.toFixed(3)+'</span>')
		    .bind("slider:ready slider:changed", function (event, data) {
		      $(this).nextAll(".output:first").html(data.value.toFixed(3));
		    });

			$('#sldr'+temp).draggable({
				containment: "#workspace",
				scroll: false,
				cancel: false,
			})
			.resizable({
				containment: "#workspace"
			});

			// set up the settings
			$('#sldr' + temp).find('*').addBack().mousedown(function() {
				slider_range = $('#sldr' + temp).find('input').attr('data-slider-range');
				slider_snap = $('#sldr' + temp).find('input').attr('data-slider-snap');
				slider_highlight = $('#sldr' + temp).find('input').attr('data-slider-highlight');
				slider_step = $('#sldr' + temp).find('input').attr('data-slider-step');
				
				setSliderSettings();

				$('#settings-main1').text($('#sldr' + temp).attr('id'));
				$('#property1').prop('checked', (slider_highlight === 'true'));
				$('#property2').prop('checked', (slider_snap === 'true'));
				$('#property3').attr('value', slider_range); // attr changes the html
				$('#property3').val(slider_range); // val changes the property
				$('#property4').attr('value', slider_step); // attr changes the html
				$('#property4').val(slider_step); // val changes the property
			});

			$.count++;
		});

		/* returns array of objects, with the first item in the array being the total number of pages */
		$('#getObjectValues').click(function () {
			var eid = $('#workspace').attr('data-eid');
			var x = new Array();
			var question_exists = false;
			x.push($.page);

			for(j=1; j<=$.page; j++){
				var check = $('#page'+j).find('div');
				if(check.hasClass('flag')){
					question_exists = true;
				}
				else{
					question_exists = false;
					break;
				}
			}

			if(question_exists){
				/*
						save all questions first! input objects are bound to questions in the db;
						thus, all questions must exist in the db *before* other objects.
				*/

				for(i=1; i<$.count; i++){
					if ($('#qtn'+i).offset() !== undefined){
						var xPos = $('#qtn'+i).css('left') == 'auto' ? 5 : parseInt($('#qtn'+i).css('left'));
						var yPos = $('#qtn'+i).css('top') == 'auto' ? 5 : parseInt($('#qtn'+i).css('top'));
						var data = {
							'id'			:	 $('#qtn'+i).parent().attr("id"),
							'xPos'		:	 xPos,
							'yPos'		:	 yPos,
							'type'		:	 "question",
							'text'		:	 $('#qtneditable'+i).text(),
							'width'	 	:	 $('#qtn'+i).css("width"),
							'height'	:	 $('#qtn'+i).css("height"),
							'color'	 	:	 rgb2hex($('#qtneditable'+i).css("color"))
						}

						x.push(data);
					}
				}

				for(i=1; i<$.count; i++){
					//input
					if ($('#inp'+i).offset() !== undefined){
						var xPos = $('#inp'+i).css('left') == 'auto' ? 5 : parseInt($('#inp'+i).css('left'));
						var yPos = $('#inp'+i).css('top') == 'auto' ? 5 : parseInt($('#inp'+i).css('top'));
						var data = {
							'id'		:	 $('#inp'+i).parent().attr("id"),
							'xPos'		:	 xPos,
							'yPos'		:	 yPos,
							'type'		:	 "textinput",
							'width'	 	:	 $('#inp'+i).css("width"),
							'height'	:	 $('#inp'+i).css("height"),
						}

						x.push(data);
					}

					//button
					if ($('#btn'+i).offset() !== undefined){
						var xPos = $('#btn'+i).css('left') == 'auto' ? 5 : parseInt($('#btn'+i).css('left'));
						var yPos = $('#btn'+i).css('top') == 'auto' ? 5 : parseInt($('#btn'+i).css('top'));
						var data = {
							'id'		:	 $('#btn'+i).parent().attr('id'),
							'xPos'		:	 xPos,
							'yPos'		:	 yPos,
							'type'		:	 'button',
							'text'		:	 $('#btneditable'+i).text(),
							'width'	 	:	 $('#btn'+i).css('width'),
							'height'	:	 $('#btn'+i).css('height'),
							'go_to'		:  $('#btneditable'+i).data('go_to')
						}

						x.push(data);
					}

					//radio button
					if ($('#radbtn'+i).offset() !== undefined){
						var xPos = $('#radbtn'+i).css('left') == 'auto' ? 5 : parseInt($('#radbtn'+i).css('left'));
						var yPos = $('#radbtn'+i).css('top') == 'auto' ? 5 : parseInt($('#radbtn'+i).css('top'));
						var data = {
							'id'		:	 $('#radbtn'+i).parent().attr("id"),
							'xPos'		:	 xPos,
							'yPos'		:	 yPos,
							'type'		:	 "radio",
							'text'		:	 $('#radbtneditable'+i).text(),
							'width'	 	:	 $('#radbtn'+i).css("width"),
							'height'	:	 $('#radbtn'+i).css("height"),
						}

						x.push(data);
					}

					//checkbox
					if ($('#chkbox'+i).offset() !== undefined){
						var xPos = $('#chkbox'+i).css('left') == 'auto' ? 5 : parseInt($('#chkbox'+i).css('left'));
						var yPos = $('#chkbox'+i).css('top') == 'auto' ? 5 : parseInt($('#chkbox'+i).css('top'));
						var data = {
							'id'		:	 $('#chkbox'+i).parent().attr("id"),
							'xPos'		:	 xPos,
							'yPos'		:	 yPos,
							'type'		:	 "checkbox",
							'text'		:	 $('#chkboxeditable'+i).text(),
							'width'	 	:	 $('#chkbox'+i).css("width"),
							'height'	:	 $('#chkbox'+i).css("height"),
						}

						x.push(data);
					}

					//dropdown
					if ($('#dropdown'+i).offset() !== undefined){
						var options = new Array();
						$('#drpeditable'+i + " option").each(function(){
							if($(this).val() != "addoption"){
								options.push($(this).val());
							}
						});

						console.log(options);
						var xPos = $('#dropdown'+i).css('left') == 'auto' ? 5 : parseInt($('#dropdown'+i).css('left'));
						var yPos = $('#dropdown'+i).css('top') == 'auto' ? 5 : parseInt($('#dropdown'+i).css('top'));
						var data = {
							'id'		:	 $('#dropdown'+i).parent().attr("id"),
							'xPos'		:	 xPos,
							'yPos'		:	 yPos,
							'type'		:	 "dropdown",
							'options'	: 	 options,
						}

						x.push(data);
						console.log(data);
					}

					//slider
					if ($('#sldr'+i).offset() !== undefined){						
						var xPos = $('#sldr'+i).css('left') == 'auto' ? 5 : parseInt($('#sldr'+i).css('left'));
						var yPos = $('#sldr'+i).css('top') == 'auto' ? 5 : parseInt($('#sldr'+i).css('top'));
						var data = new Array();
						var data = {
							'id'		:	 $('#sldr'+i).parent().attr("id"),
							'xPos'		:	 xPos,
							'yPos'		:	 yPos,
							'type'		:	 "slider",
							'min'		:	 $('#movingslider'+i).data('slider-range').split(',')[0],
							'max'	 	:	 $('#movingslider'+i).data('slider-range').split(',')[1],
							'snap'	:  $('#movingslider'+i).data('slider-snap'),
							'highlight' : $('#movingslider'+i).data('slider-highlight'),
							'step'  :  $('#movingslider'+i).data('slider-step')
						}
						x.push(data);
					 }
				}

				$.ajax({
					url: js_site_url() + 'builder/save',
					type:"POST",
					data:{
						'msg':x,
						'eid':eid
					},
					dataType: 'json',
					beforeSend: function() {
						$('.save-done').css('opacity', '0');
						$('.save-loading').css('opacity', '0.7');
					},
					complete: function(data) {
						setTimeout(function() {
							$('.save-loading').css('opacity', '0');
							$('.save-done').css('opacity', '0.7');
						}, 500);
					},
				});
			}
		});
		
		$('body').on('paste', '.ui-widget-content', function (e) {
				setTimeout(function() {
						// console.log($(e.target).html($(e.target).text()));
				}, 0);
		});

		$('.slides').on('click', '.slide-title', function(e){
			var parent = $(this).parent();
			var id = parent.attr('id').substr(5,6);
			$('#slide' + $.current_page).css('background', '#f2f2f2');;
			$(parent).css('background', '#2ecc71');
			$("#page" + $.current_page).css("visibility", "hidden");
			$("#page" + id).css("visibility", "visible");
			$.current_page = parseInt(id);
			checkQuestion();
		});

		$('.slides').sortable({
			start: function(event, ui){
				var slide = ui.item.attr('id');
				$.bef_ind = $('#'+slide).index();

				var id = slide.substr(5,6);
				$('#slide' + $.current_page).css('background', '#f2f2f2');;
				$(ui.item).css('background', '#2ecc71');
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

		$('.slides').on('click', '.remove-icon', function(e){
			answer = confirm("Are you sure you want to delete this?");
			if(answer) {
				id = $(this).parent().attr('id').substring(5);
				$(this).parent('div').remove();
				$('#page'+id).remove();

				id = parseInt(id);
				for(i=id+1;i<=$.page;i++){
					$('#slide'+i+' p').text('Slide '+(i-1));
					$('#slide'+i).attr('id','slide'+(i-1));
					$('#page'+i).attr('id','page'+(i-1));
				}

				if((id < $.current_page || $.current_page == $.page) && $.page != 1){
					$.current_page--;
				}

				if($.page != 1 && id == ($.current_page+1) || id == $.current_page){
					$("#page" + $.current_page).css('visibility', "visible");
					checkQuestion();
					$("#slide"+$.current_page).css('background', '#2ecc71');
				}

				if($.page != 1){
					$.page--;
				}
			}
		});

		$('#newPage').click(function(){
			if($.trim($('.slides').html()).length == 0){
				var htmlData = '<div id="page1" class="pageframe" style="width:100%; height:100%"></div>';
				$('#workspace').append(htmlData);

				var htmlData = '<div id="slide1" class="panel pnl" style="background:#2ecc71"><i class="fi-x remove-icon pull-right"></i><p class="slide-title">Slide 1</p></div>';
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

		$('#prevPage').click(function(){
			$('#page' + $.current_page).css('visibility','hidden');

			if($.current_page > 1){
				$.current_page--;
			}
			
			$('#page' + $.current_page).css('visibility','visible');
			checkQuestion();

			//styling
			$('#slide'+$.current_page).css('background', '#2ecc71');
			$('#slide'+($.current_page+1)).css('background', '#f2f2f2');
		});

		$('#nextPage').click(function(){
			$('#page' + $.current_page).css('visibility','hidden');

			if($.current_page < $.page){
				$.current_page++;
			}

			$('#page' + $.current_page).css('visibility','visible');	
			checkQuestion();

			//styling 
			$('#slide' + ($.current_page-1)).css('background', '#f2f2f2');
			$('#slide' + $.current_page).css('background', '#2ecc71');
		}); 
	});	 

}) (jQuery); 