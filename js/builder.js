(function($){ 
$(function() {

	$.count = 1;
	$.page = 1;
	$.current_page = 1;

    $('#question')
    	.click(function(eventClick, posX, posY, text_input, page_num){
	    	posX = typeof posX !== 'undefined' ? posX : null;
			posY = typeof posY !== 'undefined' ? posY : null;
			page_num = typeof page_num !== 'undefined' ? page_num : 0;
			text_input = typeof text_input !== 'undefined' ? text_input : "";
			var htmlData='<div id="qtn'+$.count+'" class="draggable ui-widget-content"';

			if (posX != null && posY != null){
				// alert('x' + posX);
				// alert('y' + posY);
				htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px;"';
			}

			if(text_input != "")
				htmlData += '><a href="#" class="delete"></a><div id="qtneditable'+$.count+'" class="editable">'+text_input+'</div></div>';
			else
				htmlData += '><a href="#" class="delete"></a><div id="qtneditable'+$.count+'" class="editable" data-placeholder="Enter Question" ></div></div>';

			var temp = $.count;
			var index = page_num;
			// alert(index);
			if(index <= 0){
				$("#page" + $.current_page).append(htmlData);
			}

			else{
				$("#page" + index).append(htmlData);
			}

	        $('#qtn'+temp).draggable({
	        	containment: "#workspace",
	        	scroll: false,
	        	snap: false,
	        	// drag: function(){
	        	// 	var xPos = $(this).css('left');
		        // 	var yPos = $(this).css('top');
		            // var offset1 = $(this).offset();
		            // var xPos1 = offset1.left;
		            // var yPos1 = offset1.top;
		            // var element = $(this).attr('id');
		            // //substring depends on the length of id string
		            // var number = element.substring(3);
		            // $('#pos'+number+'X').text('x: ' + xPos1);
		            // $('#pos'+number+'Y').text('y: ' + yPos1);
		        // }
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
		    $('a.delete').on('click',function(e){
		        e.preventDefault();
		        qtnID = $(this).closest('.draggable')[0].id;
		        //alert('Now deleting "'+qtnID+'"');
		        $('#'+qtnID+'').remove();
		    });
        $.count++;
    });

	$('#textinput')
    	.click(function(eventClick, posX, posY, text_input, page_num){
	    	posX = typeof posX !== 'undefined' ? posX : null;
			posY = typeof posY !== 'undefined' ? posY : null;
			page_num = typeof page_num !== 'undefined' ? page_num : 0;
			text_input = typeof text_input !== 'undefined' ? text_input : "";
			
			var htmlData='<div id="inp'+$.count+'" class="draggable ui-widget-content"';

			if (posX != null && posY != null){
				// alert('x' + posX);
				// alert('y' + posY);
				htmlData += 'style="left:'+ posX +'px; top:'+ posY +'px;""';
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
		    $('a.delete').on('click',function(e){
		        e.preventDefault();
		        qtnID = $(this).closest('.draggable')[0].id;
		        //alert('Now deleting "'+qtnID+'"');
		        $('#'+qtnID+'').remove();
		    });
        $.count++;
    });

	$('#button')
    	.click(function(eventClick, posX, posY, text_input, page_num){
	    	posX = typeof posX !== 'undefined' ? posX : null;
			posY = typeof posY !== 'undefined' ? posY : null;
			page_num = typeof page_num !== 'undefined' ? page_num : 0;
			text_input = typeof text_input !== 'undefined' ? text_input : "Button";

			var htmlData='<div id="btn'+$.count+'" class="draggable"';
			if (posX != null && posY != null){
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
		    	containment: "#workspace"
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
		    $('a.delete').on('click',function(e){
		        e.preventDefault();
		        btnID = $(this).closest('.draggable')[0].id;
		        //alert('Now deleting "'+objID+'"');
		        $('#'+btnID+'').remove();
		    });
		    
	        $.count++;
    });

	$('#radiobutton')
    	.click(function(eventClick, posX, posY, page_num){
	    	posX = typeof posX !== 'undefined' ? posX : null;
			posY = typeof posY !== 'undefined' ? posY : null;
			page_num = typeof page_num !== 'undefined' ? page_num : 0;

			var htmlData='<div id="radbtn'+$.count+'" class="radiosnap draggable ui-draggable"';
			if (posX != null && posY != null){
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
		    	containment: "#workspace"
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

		    $('a.delete').on('click',function(e){
		        e.preventDefault();
		        btnID = $(this).closest('.draggable')[0].id;
		        //alert('Now deleting "'+objID+'"');
		        $('#'+btnID+'').remove();
		    });
		    
	        $.count++;
    });

	$('#checkbox')
    	.click(function(eventClick, posX, posY, page_num){
	    	posX = typeof posX !== 'undefined' ? posX : null;
			posY = typeof posY !== 'undefined' ? posY : null;
			page_num = typeof page_num !== 'undefined' ? page_num : 0;

			var htmlData='<div id="chkbox'+$.count+'" class="checksnap draggable ui-draggable"';
			if (posX != null && posY != null){
				// alert('x' + posX);
				// alert('y' + posY);
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

		    $('a.delete').on('click',function(e){
		        e.preventDefault();
		        btnID = $(this).closest('.draggable')[0].id;
		        //alert('Now deleting "'+objID+'"');
		        $('#'+btnID+'').remove();
		    });
		    
	        $.count++;
    });

	$('#dropdown')
    	.click(function(eventClick, posX, posY, page_num){
	    	posX = typeof posX !== 'undefined' ? posX : null;
			posY = typeof posY !== 'undefined' ? posY : null;
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
		    
		    $('a.delete').on('click',function(e){
		        e.preventDefault();
		        btnID = $(this).closest('.draggable')[0].id;
		        //alert('Now deleting "'+objID+'"');
		        $('#'+btnID+'').remove();
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
    	.click(function(eventClick, posX, posY, page_num){
	    	posX = typeof posX !== 'undefined' ? posX : null;
			posY = typeof posY !== 'undefined' ? posY : null;
			page_num = typeof page_num !== 'undefined' ? page_num : 0;

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
	        })	    
		    $('a.delete').on('click',function(e){
		        e.preventDefault();
		        btnID = $(this).closest('.draggable')[0].id;
		        //alert('Now deleting "'+objID+'"');
		        $('#'+btnID+'').remove();
		    });
		    
	        $.count++;
    });

    $("#getObjectValues").click(function () {
    	//collect all question object
    	var eid = document.getElementById('workspace').getAttribute('data-eid');
		var x = new Array();
		x.push($.page);
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
		   		x.push(data);
		   	}

			if ($('#inp'+i).offset() !== undefined){
				var xPos = $('#inp'+i).css('left') == 'auto' ? 5 : parseInt($('#inp'+i).css('left'));
		        var yPos = $('#inp'+i).css('top') == 'auto' ? 5 : parseInt($('#inp'+i).css('top'));
		   		var data = new Array();
				data[0]=$('#inp'+i).parent().attr("id");
		   		data[1] = xPos;
		   		data[2] = yPos;
		   		data[3] = "textinput";
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
	   			//alert(data.responseText);
	   			window.location.href = window.location.protocol+"//"+window.location.host + '/BuildEx/' + data.responseText + '/experiments';
	   		},
	
	   	});
	});
	
	$('body').on('paste', '.ui-widget-content', function (e) {
	    setTimeout(function() {
	        console.log($(e.target).html($(e.target).text()));
	    }, 0);
	});

	$("#newPage").click(function(){
		$.page++;

		var htmlData = '<div id="page' + $.page +'"><div>';
		$('.demo').append(htmlData);

		document.getElementById("page" + $.current_page).style.visibility = 'hidden';
		$.current_page++;
		// alert($.current_page);

		document.getElementById("page" + $.current_page).style.visibility = 'visible';
	});

	$("#prevPage").click(function(){
		document.getElementById("page" + $.current_page).style.visibility = 'hidden';

		if($.current_page > 1){
			$.current_page--;
		}

		// alert($.current_page);
		document.getElementById("page" + $.current_page).style.visibility = 'visible';
	});

	$("#nextPage").click(function(){
		document.getElementById("page" + $.current_page).style.visibility = 'hidden';

		if($.current_page < $.page){
			$.current_page++;
		}

		// alert($.current_page);

		document.getElementById("page" + $.current_page).style.visibility = 'visible';
	});	

});   

}) (jQuery); 