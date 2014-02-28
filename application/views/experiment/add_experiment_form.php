<h2>BuildEx: Experiment</h2>
<? //echo '<pre>'; print_r($this->session->userdata); echo '</pre>'; ?>
<script>
	$.count = 1;
	$(function() {
	    $('#question')
	    	.click(function(eventClick, posX, posY){
		    	posX = typeof posX !== 'undefined' ? posX : null;
				posY = typeof posY !== 'undefined' ? posY : null;

				var htmlData='<div id="qtn'+$.count+'" class="draggable ui-widget-content ui-draggable" ';
				if (posX != null && posY != null){
					alert('x' + posX);
					alert('y' + posY);
					htmlData += 'style="left:'+ Math.abs(posX - 439) +'px; top:'+ Math.abs(posY - 124) +'px;""';
				}
				
				// faulty -- contentEditable=true data-ph="My Placeholder String"
				htmlData += '><a href="#" class="delete"></a><div id="editable'+$.count+'" class="editable" style="color:black" ></div><div id="pos'+$.count+'X"></div><div id="pos'+$.count+'Y"></div></div>';
				
				$('.demo').append(htmlData);	
		        $('.draggable').draggable({
		        	containment: "#workspace",
		        	scroll: false,
		        	drag: function(){
			            var offset1 = $(this).offset();
			            var xPos1 = offset1.left;
			            var yPos1 = offset1.top;
			            var element = $(this).attr('id');
			            //substring depends on the length of id string
			            var number = element.substring(3);
			            $('#pos'+number+'X').text('x: ' + xPos1);
			            $('#pos'+number+'Y').text('y: ' + yPos1);
			        }
	        })
		    .resizable()
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
		        qtnD = $(this).closest('.draggable')[0].id;
		        //alert('Now deleting "'+qtnID+'"');
		        $('#'+qtnID+'').remove();
		    });
	        $.count++;
	    });

		$('#textinput')
	    	.click(function(eventClick, posX, posY){
		    	posX = typeof posX !== 'undefined' ? posX : null;
				posY = typeof posY !== 'undefined' ? posY : null;

				var htmlData='<div id="inp'+$.count+'" class="draggable ui-widget-content ui-draggable" ';
				if (posX != null && posY != null){
					alert('x' + posX);
					alert('y' + posY);
					htmlData += 'style="left:'+ Math.abs(posX - 439) +'px; top:'+ Math.abs(posY - 124) +'px;""';
				}
				
				// faulty -- contentEditable=true data-ph="My Placeholder String"
				htmlData += '><a href="#" class="delete"></a><div id="editable'+$.count+'" class="editable" style="color:black" ></div><div id="pos'+$.count+'X"></div><div id="pos'+$.count+'Y"></div></div>';
				
				$('.demo').append(htmlData);	
		        $('.draggable').draggable({
		        	containment: "#workspace",
		        	scroll: false,
		        	drag: function(){
			            var offset1 = $(this).offset();
			            var xPos1 = offset1.left;
			            var yPos1 = offset1.top;
			            var element = $(this).attr('id');
			            //substring depends on the length of id string
			            var number = element.substring(3);
			            $('#pos'+number+'X').text('x: ' + xPos1);
			            $('#pos'+number+'Y').text('y: ' + yPos1);
			        }
	        })
		    .resizable()
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



	    $("#getObjectValues").click(function () {
			var x = new Array();
			for(i=1; i<$.count; i++){
				if ($('#obj'+i).offset() !== undefined){
	    			alert($('#obj'+i).offset().left);
					var offset = $('#obj'+i).offset();
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
		   			alert(data.responseText);
		   			window.location.href = "<?php echo site_url($this->session->userdata('active_role').'/experiments'); ?>";
		   		},
		
		   	});
		});
		
		$('body').on('paste', '.ui-widget-content', function (e) {
		    setTimeout(function() {
		        console.log($(e.target).html($(e.target).text()));
		    }, 0);
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
		<a id="getObjectValues"class = "button small">Save Environment</a>
	</div>

	<!-- Workspace -->
	<div id="workspace" class="large-9 column" style="height:500px; background:black;">
		<div style="color:white">
			<p>Workspace</p>
		</div>
		<div class='demo'></div>
    
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

