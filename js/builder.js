(function($){ 
$(function() {
	$.count = 1;
	$.page = 1;
	$.current_page = 1;

    $('#question')
    	.click(function(eventClick, posX, posY){
	    	posX = typeof posX !== 'undefined' ? posX : null;
			posY = typeof posY !== 'undefined' ? posY : null;
			
			var htmlData='<div id="qtn'+$.count+'" class="draggable ui-widget-content" ' + 'data-page="' + $.page + '"';

			if (posX != null && posY != null){
				// alert('x' + posX);
				// alert('y' + posY);
				htmlData += 'style="left:'+ Math.abs(posX - 439) +'px; top:'+ Math.abs(posY - 124) +'px;""';
			}

			htmlData += '><a href="#" class="delete"></a><div id="qtneditable'+$.count+'" class="editable" data-placeholder="Enter Question" ></div></div>';

			var temp = $.count;

			$('.demo').append(htmlData);	
	        $('.draggable').draggable({
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
		        $('.draggable').draggable( "option", "disabled", true );
		        $(this).attr('contenteditable','true');
		    })
		    .blur(function(){
		        $('.draggable').draggable( 'option', 'disabled', false);
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
    	.click(function(eventClick, posX, posY){
	    	posX = typeof posX !== 'undefined' ? posX : null;
			posY = typeof posY !== 'undefined' ? posY : null;
			
			var htmlData='<div id="inp'+$.count+'" class="draggable ui-widget-content" ' + 'data-page="' + $.page + '"';

			if (posX != null && posY != null){
				// alert('x' + posX);
				// alert('y' + posY);
				htmlData += 'style="left:'+ Math.abs(posX - 439) +'px; top:'+ Math.abs(posY - 124) +'px;""';
			}
			
			htmlData += '><a href="#" class="delete"></a><div id="inpeditable'+$.count+'" class="editable" data-placeholder="Enter Input" ></div></div>';

			var temp = $.count;

			$('.demo').append(htmlData);	
	        $('.draggable').draggable({
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
		        $('.draggable').draggable( "option", "disabled", true );
		        $(this).attr('contenteditable','true');
		    })
		    .blur(function(){
		        $('.draggable').draggable( 'option', 'disabled', false);
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
    	.click(function(eventClick, posX, posY){
	    	posX = typeof posX !== 'undefined' ? posX : null;
			posY = typeof posY !== 'undefined' ? posY : null;

			var htmlData='<div id="btn'+$.count+'" class="draggable" ' + 'data-page="' + $.page + '" ';
			if (posX != null && posY != null){
				alert('x' + posX);
				alert('y' + posY);
				htmlData += 'style="left:'+ Math.abs(posX - 439) +'px; top:'+ Math.abs(posY - 124) +'px;""';
			}
			
			// faulty -- contentEditable=true data-ph="My Placeholder String"
			htmlData += 'style="width:150px; height:60"><button id="editable'+$.count+'" style="width:100%; height:100%; margin-bottom:0px; padding:0px"><div class="default" style="width:100%; height:100%; display:inline; vertical-align:middle">Button</div></button><a href="#" class="delete"></a></div>';
			
			var temp = $.count;

			$('.demo').append(htmlData);	
	        $('.draggable').draggable({
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
		    	if($(e.target).attr('id') == ('editable'+temp)){
		    		$(e.target).children().click();
		    		$(e.target).children().focus();
		    	}
		    	else if(e.target.className != 'default' && e.target.id != 'editable'+temp){
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
    	.click(function(eventClick, posX, posY){
	    	posX = typeof posX !== 'undefined' ? posX : null;
			posY = typeof posY !== 'undefined' ? posY : null;

			var htmlData='<div id="radbtn'+$.count+'" class="radiosnap draggable ui-draggable" ' + 'data-page="' + $.page + '" ';
			if (posX != null && posY != null){
				alert('x' + posX);
				alert('y' + posY);
				htmlData += 'style="left:'+ Math.abs(posX - 439) +'px; top:'+ Math.abs(posY - 124) +'px;"';
			}
			
			// faulty -- contentEditable=true data-ph="My Placeholder String"
			htmlData += 'style="height:25px; width:120px;"><input type="radio" id="radeditable'+$.count+'" name="'+$.page+'" value="radiobutton"><div class="default" style="width:100%; height:100%; display:inline; vertical-align:middle">Radio Button</div><a href="#" class="delete"></a></div>';
			
			var temp = $.count;

			$('.demo').append(htmlData);	
	        $('.radiosnap.draggable').draggable({
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
		        $('.radiosnap.draggable').draggable( "option", "disabled", true );
		        $(this).attr('contenteditable','true');
		    })
		    .blur(function(){
		        $('.radiosnap.draggable').draggable( 'option', 'disabled', false);
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
    	.click(function(eventClick, posX, posY){
	    	posX = typeof posX !== 'undefined' ? posX : null;
			posY = typeof posY !== 'undefined' ? posY : null;

			var htmlData='<div id="chkbox'+$.count+'" class="checksnap draggable ui-draggable" ' + 'data-page="' + $.page + '" ';
			if (posX != null && posY != null){
				alert('x' + posX);
				alert('y' + posY);
				htmlData += 'style="left:'+ Math.abs(posX - 439) +'px; top:'+ Math.abs(posY - 124) +'px;"';
			}
			
			// faulty -- contentEditable=true data-ph="My Placeholder String"
			htmlData += 'style="height:25px; width:120px;"><input type="checkbox" id="chkeditable'+$.count+'" name="'+$.page+'" value="checkbox"><div class="default" style="width:100%; height:100%; display:inline; vertical-align:middle">Check Box</div><a href="#" class="delete"></a></div>';
			
			var temp = $.count;

			$('.demo').append(htmlData);	
	        $('.checksnap.draggable').draggable({
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
		        $('.checksnap.draggable').draggable( "option", "disabled", true );
		        $(this).attr('contenteditable','true');
		    })
		    .blur(function(){
		        $('.checksnap.draggable').draggable( 'option', 'disabled', false);
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
    	.click(function(eventClick, posX, posY){
	    	posX = typeof posX !== 'undefined' ? posX : null;
			posY = typeof posY !== 'undefined' ? posY : null;

			var htmlData='<div id="dropdown'+$.count+'" class="draggable ui-draggable" ' + 'data-page="' + $.page + '" ';
			if (posX != null && posY != null){
				htmlData += 'style="left:'+ Math.abs(posX - 439) +'px; top:'+ Math.abs(posY - 124) +'px;"';
			}
			
			// faulty -- contentEditable=true data-ph="My Placeholder String"
			htmlData += 'style="height:25px; width:140px;"> <select id="drpeditable'+$.count+'" style="position:absolute; width:160px; height:23px; top:0; left:0"> <option value="sample" selected="selected">Dropdown Menu</option><option value="addoption">Add Option</option> </select> <input id="drpinput'+$.count+'" type="text" name="" value="" placeholder="Add Option" style="position:absolute; width:140px; height:23px;"><a href="#" class="delete"></a></div>';
			

			$('.demo').append(htmlData);	
	        $('.draggable').draggable({
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

		    var temp = $.count;
		    $('#drpinput'+temp).val($('#drpeditable'+temp+' option:selected').text());

		    $('#drpinput'+temp).blur(function(){
		    	//alert('1');
		        $('.draggable').draggable( 'option', 'disabled', false);
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
    	.click(function(eventClick, posX, posY){
	    	posX = typeof posX !== 'undefined' ? posX : null;
			posY = typeof posY !== 'undefined' ? posY : null;

			var htmlData='<div id="sldr'+$.count+'" class="draggable"' + 'data-page="' + $.page + '" ';
			if (posX != null && posY != null){
				htmlData += 'style="left:'+ Math.abs(posX - 439) +'px; top:'+ Math.abs(posY - 124) +'px;"';
			}
			
			// faulty -- contentEditable=true data-ph="My Placeholder String"
			htmlData += 'style="height:25px; width:360px"><input id="movingslider'+$.count+'" class="sldr" type="text" data-slider="true" data-slider-range="1,1000"><span id="sldrspan'+$.count+'" class="output"></span><a href="#" class="delete"></a></div>';

			var temp = $.count;
			$('.demo').append(htmlData);	
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
		for(i=1; i<$.count; i++){
			if ($('#qtn'+i).offset() !== undefined){
		        var xPos = $('#qtn'+i).css('left');
		        var yPos = $('#qtn'+i).css('top');
		   		var data = new Array();
		   		data[0] = xPos;
		   		data[1] = yPos;
		   		data[2] = "question";
		   		x.push(data);
		   	}

			if ($('#inp'+i).offset() !== undefined){
				var xPos = $('#inp'+i).css('left');
		        var yPos = $('#inp'+i).css('top');
		   		var data = new Array();
		   		data[0] = xPos;
		   		data[1] = yPos;
		   		data[2] = "label";
		   		x.push(data);
		   	}

			if ($('#btn'+i).offset() !== undefined){
				var xPos = $('#btn'+i).css('left');
		        var yPos = $('#btn'+i).css('top');
		   		var data = new Array();
		   		data[0] = xPos;
		   		data[1] = yPos;
		   		data[2] = "button";
		   		x.push(data);
		   	}

			if ($('#radbtn'+i).offset() !== undefined){
				var xPos = $('#radbtn'+i).css('left');
		        var yPos = $('#radbtn'+i).css('top');
		   		var data = new Array();
		   		data[0] = xPos;
		   		data[1] = yPos;
		   		data[2] = "radio";
		   		x.push(data);
		   	}

			if ($('#chkbox'+i).offset() !== undefined){
				var xPos = $('#chkbox'+i).css('left');
		        var yPos = $('#chkbox'+i).css('top');
		   		var data = new Array();
		   		data[0] = xPos;
		   		data[1] = yPos;
		   		data[2] = "checkbox";
		   		x.push(data);
		   	}

			if ($('#dropdown'+i).offset() !== undefined){
				var xPos = $('#dropdown'+i).css('left');
		        var yPos = $('#dropdown'+i).css('top');
		   		var data = new Array();
		   		data[0] = xPos;
		   		data[1] = yPos;
		   		data[2] = "dropdown";
		   		x.push(data);
		   	}

			if ($('#sldr'+i).offset() !== undefined){
				var xPos = $('#sldr'+i).css('left');
		        var yPos = $('#sldr'+i).css('top');
		   		var data = new Array();
		   		data[0] = xPos;
		   		data[1] = yPos;
		   		data[2] = "slider";
		   		x.push(data);
		   	}

		}

	   	$.ajax({
	   		url: window.location.protocol+"//"+window.location.host + '/buildex/builder/save',
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
	   			window.location.href = window.location.protocol+"//"+window.location.host + '/buildex/' + data.responseText + '/experiments';
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
		$.current_page++;
		for(i=1; i<$.count; i++){
			if(document.getElementById('qtn'+i)){
				document.getElementById('qtn'+i).style.visibility = 'hidden';
			}

			if(document.getElementById('inp'+i)){
				document.getElementById('inp'+i).style.visibility = 'hidden';
			}

			if(document.getElementById('btn'+i)){
				document.getElementById('btn'+i).style.visibility = 'hidden';
			}
		}
	});

	$("#prevPage").click(function(){
		if($.current_page > 1){
			$.current_page--;
		}

		//hide all objects first
		for(i=1; i<$.count; i++){
			if(document.getElementById('qtn'+i)){
				document.getElementById('qtn'+i).style.visibility = 'hidden';
			}

			if(document.getElementById('inp'+i)){
				document.getElementById('inp'+i).style.visibility = 'hidden';
			}

			if(document.getElementById('btn'+i)){
				document.getElementById('btn'+i).style.visibility = 'hidden';
			}
		}

		//get objects for current page
		for(i=1; i<$.count; i++){
			if(document.getElementById('qtn'+i) && $("#qtn"+i).data('page') == $.current_page){
				document.getElementById('qtn'+i).style.visibility = 'visible';
			}

			if(document.getElementById('inp'+i) && $("#inp"+i).data('page') == $.current_page){
				document.getElementById('inp'+i).style.visibility = 'visible';
			}

			if(document.getElementById('btn'+i) && $("#btn"+i).data('page') == $.current_page){
				document.getElementById('btn'+i).style.visibility = 'visible';
			}
		}
	});

	$("#nextPage").click(function(){
		if($.current_page < $.page){
			$.current_page++;
		}

		//hide all objects first
		for(i=1; i<$.count; i++){
			if(document.getElementById('qtn'+i)){
				document.getElementById('qtn'+i).style.visibility = 'hidden';
			}

			if(document.getElementById('inp'+i)){
				document.getElementById('inp'+i).style.visibility = 'hidden';
			}

			if(document.getElementById('btn'+i)){
				document.getElementById('btn'+i).style.visibility = 'hidden';
			}
		}

		//get objects for current page
		for(i=1; i<$.count; i++){
			if(document.getElementById('qtn'+i) && $("#qtn"+i).data('page') == $.current_page){
				document.getElementById('qtn'+i).style.visibility = 'visible';
			}

			if(document.getElementById('inp'+i) && $("#inp"+i).data('page') == $.current_page){
				document.getElementById('inp'+i).style.visibility = 'visible';
			}

			if(document.getElementById('btn'+i) && $("#btn"+i).data('page') == $.current_page){
				document.getElementById('btn'+i).style.visibility = 'visible';
			}
		}
	});	
});   

}) (jQuery); 