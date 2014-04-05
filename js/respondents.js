var answer_cache = {};

function clear_form(){
	var my_form = document.getElementById("demographics");
	my_form.reset();
}

function register_answer(qid,value){
	answer_cache[qid] = value;
}

function draw_question(posX, posY, text_input, page_num){
	posX = typeof posX !== 'undefined' ? posX : null;
	posY = typeof posY !== 'undefined' ? posY : null;
	page_num = typeof page_num !== 'undefined' ? page_num : 0;
	text_input = typeof text_input !== 'undefined' ? text_input : "";
	
	var htmlData='<div id="qtn'+$.count+'" class = "static_obj" data-page=" ' + $.page + '"';

	if (posX !== null && posY !== null){
		htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px;"';
	}

	if(text_input !== "")
		htmlData += '><div id="qtneditable'+$.count+'" class="text-holder">'+text_input+'</div></div>';
	else
		htmlData += '><div id="qtneditable'+$.count+'" class="text-holder" data-placeholder="Enter Question" ></div></div>';

	var temp = $.count;
	var index = page_num;
	if(index <= 0){
		$("#page" + $.current_page).append(htmlData);
	}
	else{
		$("#page" + index).append(htmlData);
	}

	$.count++;
}

function draw_text_input(posX, posY, text_input, page_num){
	posX = typeof posX !== 'undefined' ? posX : null;
	posY = typeof posY !== 'undefined' ? posY : null;
	page_num = typeof page_num !== 'undefined' ? page_num : 0;
	text_input = typeof text_input !== 'undefined' ? text_input : "";

	var htmlData='<div id="inp'+$.count+'" class = "static_obj" data-page="' + $.page + '"';

	if (posX !== null && posY !== null){
		htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px;""';
	}
	
	if(text_input !== ""){
		htmlData += '><div id="inpeditable'+$.count+'" class="text-holder">'+text_input+'</div></div>';
	}
	else{
		htmlData += '><div id="inpeditable'+$.count+'"class="text-holder" data-placeholder="Enter Input" ></div></div>';
	}
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

function draw_button(posX, posY, text_input, page_num){
	posX = typeof posX !== 'undefined' ? posX : null;
	posY = typeof posY !== 'undefined' ? posY : null;
	page_num = typeof page_num !== 'undefined' ? page_num : 0;
	text_input = typeof text_input !== 'undefined' ? text_input : "Button";

	var htmlData='<div id="btn'+$.count+'" class="static_obj" ' + 'data-page="' + $.page + '" ';

	if (posX !== null && posY !== null){
		htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px;"';
	}
	else{
		htmlData += 'style="width:150px; height:60"';
	}
	
	htmlData += 'style="width:150px; height:60"><button id="btneditable'+$.count+'" style="width:100%; height:100%; margin-bottom:0px; padding:0px">'+text_input+'</button></div>';
	
	var temp = $.count;

	var index = page_num;

	if(index <= 0)
		$("#page" + $.current_page).append(htmlData);
	else
		$("#page" + index).append(htmlData);

	$(document).click(function(e){
		if($(e.target).attr('id') == ('btneditable'+temp)){
			$(e.target).children().click();
			$(e.target).children().focus();
		}
	});
	$.count++;
}

function draw_radio_button(posX, posY, page_num){
	posX = typeof posX !== 'undefined' ? posX : null;
	posY = typeof posY !== 'undefined' ? posY : null;
	page_num = typeof page_num !== 'undefined' ? page_num : 0;
	text_input = typeof text_input !== 'undefined' ? text_input : "Radio Button";

	var htmlData='<div id="radbtn'+$.count+'" class="radiosnap static_obj"';
	if (posX != null && posY != null){
		htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px; height:25px; width:120px;"';
	}
	else{
		htmlData += 'style="height:25px; width:120px;"';
	}
	
	// faulty -- contentEditable=true data-ph="My Placeholder String"
	htmlData += '><input type="radio" id="radeditable'+$.count+'" name="'+$.page+'" value="radiobutton">'+text_input+'</div>';
	
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
    
    $.count++;
}

function draw_checkbox(posX, posY, text_input, page_num){
	posX = typeof posX !== 'undefined' ? posX : null;
	posY = typeof posY !== 'undefined' ? posY : null;
	page_num = typeof page_num !== 'undefined' ? page_num : 0;
	text_input = typeof text_input !== 'undefined' ? text_input : "Checkbox";

	var htmlData='<div id="chkbox'+$.count+'" class="checksnap static_obj"';

	if (posX != null && posY != null){
		htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px; height:25px; width:120px;"';
	}

	else{
		htmlData += 'style="height:25px; width:120px;"';
	}
	
	// faulty -- contentEditable=true data-ph="My Placeholder String"
	htmlData += '><input type="checkbox" id="chkeditable'+$.count+'" name="'+$.page+'" value="checkbox">'+text_input+'</div>';
	
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
    
    $.count++;
}

(function($){
	$(function() {
		$.count = 1;
		$.page = 1;
		$.current_page = 1;
		$.last_selected = null;

		$("#next_page").click(function(){
			document.getElementById("page" + $.current_page).style.visibility = 'hidden';

			if($.current_page < $.page){
				$.current_page++;
			}

			document.getElementById("page" + $.current_page).style.visibility = 'visible';

			alert($.current_page);
		});
	});
})(jQuery);
