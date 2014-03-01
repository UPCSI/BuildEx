<h2>BuildEx: Experiment</h2>
<? //echo '<pre>'; print_r($this->session->userdata); echo '</pre>'; ?>
<script>
	$.count = 1;
	$.page = 1;
	$.current_page = 1;
	$(function() {
	    $('#question')
	    	.click(function(eventClick, posX, posY){
		    	posX = typeof posX !== 'undefined' ? posX : null;
				posY = typeof posY !== 'undefined' ? posY : null;

				var htmlData='<div id="qtn'+$.count+'" class="draggable ui-widget-content ui-draggable" ' + 'data-page="' + $.page + '" ';
				if (posX != null && posY != null){
					alert('x' + posX);
					alert('y' + posY);
					htmlData += 'style="left:'+ Math.abs(posX - 439) +'px; top:'+ Math.abs(posY - 124) +'px;""';
				}
				
				// faulty -- contentEditable=true data-ph="My Placeholder String"
				htmlData += '><a href="#" class="delete"></a><div id="editable'+$.count+'" class="editable" style="color:black">Question</div><div id="pos'+$.count+'X"></div><div id="pos'+$.count+'Y"></div></div>';
				
				$('.demo').append(htmlData);	
		        $('.draggable').draggable({
		        	containment: "#workspace",
		        	scroll: false,
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
			    })
			    .click(function(){
			        if ( $(this).is('.ui-draggable-dragging') ) {
			            return;
			        }
			        $(this).draggable( "option", "disabled", true );
			        $(this).attr('contenteditable','true');
			    })
			    .blur(function(){
			        $(this).draggable( 'option', 'disabled', false);
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

				var htmlData='<div id="inp'+$.count+'" class="draggable ui-widget-content ui-draggable" ' + 'data-page="' + $.page + '" ';
				if (posX != null && posY != null){
					alert('x' + posX);
					alert('y' + posY);
					htmlData += 'style="left:'+ Math.abs(posX - 439) +'px; top:'+ Math.abs(posY - 124) +'px;""';
				}
				
				// faulty -- contentEditable=true data-ph="My Placeholder String"
				htmlData += '><a href="#" class="delete"></a><div id="editable'+$.count+'" class="editable" style="color:black">Text Input</div><div id="pos'+$.count+'X"></div><div id="pos'+$.count+'Y"></div></div>';
				
				$('.demo').append(htmlData);	
		        $('.draggable').draggable({
		        	containment: "#workspace",
		        	scroll: false,
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
		    })
		    .click(function(){
		        if ( $(this).is('.ui-draggable-dragging') ) {
		            return;
		        }
		        $(this).draggable( "option", "disabled", true );
		        $(this).attr('contenteditable','true');
		    })
		    .blur(function(){
		        $(this).draggable( 'option', 'disabled', false);
		        $(this).attr('contenteditable','false');
		    });
		    $('a.delete').on('click',function(e){
		        e.preventDefault();
		        inpID = $(this).closest('.draggable')[0].id;
		        //alert('Now deleting "'+objID+'"');
		        $('#'+inpID+'').remove();
		    });
	        $.count++;
	    });

		$('#button')
	    	.click(function(eventClick, posX, posY){
		    	posX = typeof posX !== 'undefined' ? posX : null;
				posY = typeof posY !== 'undefined' ? posY : null;

				var htmlData='<div id="btn'+$.count+'" class="draggable ui-widget-content ui-draggable" ' + 'data-page="' + $.page + '" ';
				if (posX != null && posY != null){
					alert('x' + posX);
					alert('y' + posY);
					htmlData += 'style="left:'+ Math.abs(posX - 439) +'px; top:'+ Math.abs(posY - 124) +'px;""';
				}
				
				// faulty -- contentEditable=true data-ph="My Placeholder String"
				htmlData += '><button id="editable'+$.count+'" style="width:100%; height:100%">Button</button><a href="#" class="delete" style="z-index:999"></a></div>';
				
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
		    	// containment: "#workspace"
		    })
		    .click(function(){
		        if ( $(this).is('.ui-draggable-dragging') ) {
		            return;
		        }
		        $(this).draggable( "option", "disabled", true );
		        $(this).attr('contenteditable','true');
		    })
		    .blur(function(){
		        $(this).draggable( 'option', 'disabled', false);
		        $(this).attr('contenteditable','false');
		    });
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
			var x = new Array();
			for(i=1; i<$.count; i++){
				if ($('#qtn'+i).offset() !== undefined){
	    			//alert($('#qtn'+i).offset().left);
					var offset = $('#qtn'+i).offset();
			        var xPos = offset.left;
			        var yPos = offset.top;
			   		var data = new Array();
			   		data[0] = xPos;
			   		data[1] = yPos;
			   		x.push(data);
			   	}
			}

		   	$.ajax({
		   		url: '<?=base_url()?>builder/save',
		   		type:"POST",
		   		data:{
		   			'msg':x,
		   			'eid':'<?=$eid?>'
		   		},
		   		dataType: 'json',
		   		complete: function(data) {
		   			//alert("success");
		   			//alert(data[0][0]);
		   			//alert(data.responseText);
		   			window.location.href = "<?php echo site_url($this->session->userdata('active_role').'/experiments'); ?>";
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
		

</script>
<div id="builder" class="row full">
	
	<!-- Toolbar -->
	<div id="pane" class="large-3 column" style="height:500px; background:gray">
		<div style="color:white">
			<p>Toolbar</p>
		</div>
		<!-- 
		<div id="draggable" class="ui-widget-content">
		  <p>Object</p>
		</div> 
		-->
		<a id="question"class = "button small">Create Question</a>
		<a id="textinput"class = "button small">Create Text Input</a>
		<a id="button"class = "button small">Create Button</a>
		<a id="getObjectValues"class = "button small">Save Environment</a>
		<a id="prevPage"class = "button small">Previous Page</a>
		<a id="nextPage"class = "button small">Next Page</a>
		<a id="newPage"class = "button small">New Page</a>
	</div>

	<!-- Workspace -->
	<div class="large-9 column" style="height:500px; background:#f7f7f7;">
		<div>
			<p>Workspace</p>
		</div>
		<div id="workspace" class="demo panel callout" style="width:100%;height:432px;margin-right:0px">
		<!--div class='demo'></div-->
    	</div>
		<!-- <div id="d">
			Text to edit
		</div> -->
	</div>
</div>

<? 
	if(isset($var)){
		foreach ($var as $obj){
			echo '<script>';
			echo '$(function() {';
			echo '$("#question").trigger("click",['.$obj[0].','.$obj[1].']);';
			echo '})';
			echo '</script>';
		}
	}
?>

