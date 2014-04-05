var answer_cache = {};

function clear_form(){
	var my_form = document.getElementById("demographics");
	my_form.reset();
}

(function($){
$(function() {
	$.count = 1;
	$.page = 1;
	$.current_page = 1;
	
	function draw_question(posX, posY, text_input, page_num){
		posX = typeof posX !== 'undefined' ? posX : null;
		posY = typeof posY !== 'undefined' ? posY : null;
		page_num = typeof page_num !== 'undefined' ? page_num : 0;
		text_input = typeof text_input !== 'undefined' ? text_input : "";
		
		var htmlData='<div id="qtn'+$.count+'" class="ui-widget-content" ' + 'data-page="' + $.page + '"';

		if (posX !== null && posY !== null){
			htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px;""';
		}

		if(text_input !== "")
			htmlData += '><a href="#" class="delete"></a><div id="qtneditable'+$.count+'" class="editable">'+text_input+'</div></div>';
		else
			htmlData += '><a href="#" class="delete"></a><div id="qtneditable'+$.count+'" class="editable" data-placeholder="Enter Question" ></div></div>';

		var temp = $.count;
		var index = page_num;
		if(index <= 0){
			$("#page" + $.current_page).append(htmlData);
		}
		else{
			$("#page" + index).append(htmlData);
		}
    }

	$('#textinput')
		.click(function(eventClick, posX, posY, text_input, page_num){
			posX = typeof posX !== 'undefined' ? posX : null;
			posY = typeof posY !== 'undefined' ? posY : null;
			page_num = typeof page_num !== 'undefined' ? page_num : 0;
			text_input = typeof text_input !== 'undefined' ? text_input : "";
			
			var htmlData='<div id="inp'+$.count+'" class="ui-widget-content" ' + 'data-page="' + $.page + '"';

			if (posX !== null && posY !== null){
				// alert('x' + posX);
				// alert('y' + posY);
				htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px;""';
			}
			
			if(text_input !== ""){
				htmlData += '><a href="#" class="delete"></a><div id="inpeditable'+$.count+'" class="editable">'+text_input+'</div></div>';
			}
			else{
				htmlData += '><a href="#" class="delete"></a><div id="inpeditable'+$.count+'" class="editable" data-placeholder="Enter Input" ></div></div>';
			}
			var temp = $.count;
			var index = page_num;
			if(index <= 0)
				$("#page" + $.current_page).append(htmlData);
			else
				$("#page" + index).append(htmlData);

			$('#inpeditable'+temp).click(function(){
				$(this).attr('contenteditable','true');
			});
    });

	$('#button')
		.click(function(eventClick, posX, posY, text_input, page_num){
			posX = typeof posX !== 'undefined' ? posX : null;
			posY = typeof posY !== 'undefined' ? posY : null;
			page_num = typeof page_num !== 'undefined' ? page_num : 0;
			text_input = typeof text_input !== 'undefined' ? text_input : "Button";

			var htmlData='<div id="btn'+$.count+'" class="" ' + 'data-page="' + $.page + '" ';
			if (posX !== null && posY !== null){
				// alert('x' + posX);
				// alert('y' + posY);
				htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px;"';
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

			$('.default').click(function(){
				$(this).attr('contenteditable','true');
			});

			$(document).click(function(e){
				if($(e.target).attr('id') == ('btneditable'+temp)){
					$(e.target).children().click();
					$(e.target).children().focus();
				}
			});
    });

	$('#radiobutton')
		.click(function(eventClick, posX, posY, page_numm){
			posX = typeof posX !== 'undefined' ? posX : null;
			posY = typeof posY !== 'undefined' ? posY : null;
			page_num = typeof page_num !== 'undefined' ? page_num : 0;

			var htmlData='<div id="radbtn'+$.count+'" class="radiosnap draggable ui-draggable" ' + 'data-page="' + $.page + '" ';
			if (posX !== null && posY !== null){
				// alert('x' + posX);
				// alert('y' + posY);
				htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px; height:25px; width:120px;"';
			}
			else{
				htmlData += 'style="height:25px; width:120px;"';
			}
			
			// faulty -- contentEditable=true data-ph="My Placeholder String"
			htmlData += '><input type="radio" id="radeditable'+$.count+'" name="'+$.page+'" value="radiobutton"><div class="default" style="width:100%; height:100%; display:inline; vertical-align:middle">Radio Button</div><a href="#" class="delete"></a></div>';
			
			var temp = $.count;
			var index = page_num;

			if(index <= 0)
				$("#page" + $.current_page).append(htmlData);
			else
				$("#page" + index).append(htmlData);

			$(document).click(function(e){
				if($(e.target).attr('id') == ('radbtn'+temp)){
					$(e.target).children('.default').click();
					$(e.target).children('.default').focus();
				}
			});
    });

	$('#checkbox')
		.click(function(eventClick, posX, posY, page_num){
			posX = typeof posX !== 'undefined' ? posX : null;
			posY = typeof posY !== 'undefined' ? posY : null;
			page_num = typeof page_num !== 'undefined' ? page_num : 0;

			var htmlData='<div id="chkbox'+$.count+'" class="checksnap draggable ui-draggable" ' + 'data-page="' + $.page + '" ';
			if (posX !== null && posY !== null){
				htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px; height:25px; width:120px;"';
			}
			else{
				htmlData += 'style="height:25px; width:120px;"';
			}
			
			// faulty -- contentEditable=true data-ph="My Placeholder String"
			htmlData += '><input type="checkbox" id="chkeditable'+$.count+'" name="'+$.page+'" value="checkbox"><div class="default" style="width:100%; height:100%; display:inline; vertical-align:middle">Check Box</div><a href="#" class="delete"></a></div>';
			
			var temp = $.count;
			var index = page_num;

			if(index <= 0)
				$("#page" + $.current_page).append(htmlData);
			else
				$("#page" + index).append(htmlData);

			$(document).click(function(e){
				if($(e.target).attr('id') == ('chkbox'+temp)){
					$(e.target).children('.default').click();
					$(e.target).children('.default').focus();
				}
			});
    });

	$('#dropdown')
		.click(function(eventClick, posX, posY, page_num){
			posX = typeof posX !== 'undefined' ? posX : null;
			posY = typeof posY !== 'undefined' ? posY : null;
			page_num = typeof page_num !== 'undefined' ? page_num : 0;

			var htmlData='<div id="dropdown'+$.count+'" class="draggable ui-draggable" ' + 'data-page="' + $.page + '" ';
			if (posX !== null && posY !== null){
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
		});

	$('#slider')
		.click(function(eventClick, posX, posY, page_num){
			posX = typeof posX !== 'undefined' ? posX : null;
			posY = typeof posY !== 'undefined' ? posY : null;
			page_num = typeof page_num !== 'undefined' ? page_num : 0;

			var htmlData='<div id="sldr'+$.count+'" class="draggable"' + 'data-page="' + $.page + '" ';
			if (posX !== null && posY !== null){
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
					if(data.value.toFixed(3) === 0){
						base = parseInt(a[0]);
					}
					else{
						base = data.value.toFixed(3) * parseInt(a[1]);
					}
					$(this).nextAll(".output:first").html(base);
			});
    });

	function draw_page(page_num){
			var index = page_num;
			var htmlData = '<div id="page"' + index +'><div>';
			$('.demo').append(htmlData);
    }

	$('body').on('paste', '.ui-widget-content', function (e) {
		setTimeout(function() {
			console.log($(e.target).html($(e.target).text()));
		}, 0);
	});

	$("#prevPage").click(function(){
		document.getElementById("page" + $.current_page).style.visibility = 'hidden';

		if($.current_page > 1){
			$.current_page--;
		}

		document.getElementById("page" + $.current_page).style.visibility = 'visible';
	});

	$("#nextPage").click(function(){
		document.getElementById("page" + $.current_page).style.visibility = 'hidden';

		if($.current_page < $.page){
			$.current_page++;
		}

		document.getElementById("page" + $.current_page).style.visibility = 'visible';
	});
});

}) (jQuery);

function register_answer(qid,value){
	answer_cache[qid] = value;
}