<h2>BuildEx: Experiment</h2>
<? //echo '<pre>'; print_r($this->session->userdata); echo '</pre>'; ?>
<script>
	$.count = 1;
	$(function() {
	    $('#object1').click(function(eventClick, posX, posY){
	    	posX = typeof posX !== 'undefined' ? posX : null;
			posY = typeof posY !== 'undefined' ? posY : null;

			var htmlData='<div id="'+$.count+'" class="draggable ui-widget-content ui-draggable" style="height:100px; width:100px;';
			if (posX != null && posY != null){
				alert('x' + posX);
				alert('y' + posY);
				htmlData += ' left:'+ Math.abs(posX - 439) +'px; top:'+ Math.abs(posY - 124) +'px;"';
			}
			else{
				htmlData += '"';
			}

			htmlData += '><p style="color:black">Object</p><div id="pos'+$.count+'X"></div><div id="pos'+$.count+'Y"></div></div>';
	        $('.demo').append(htmlData);
	        $('.draggable').draggable({
	        	drag: function(){
		            var offset1 = $(this).offset();
		            var xPos1 = offset1.left;
		            var yPos1 = offset1.top;
		            var element = $(this).attr('id');
		            $('#pos'+element+'X').text('x: ' + xPos1);
		            $('#pos'+element+'Y').text('y: ' + yPos1);
		        }
	        });
	        $.count++;
	    });
	    $("#getObjectValues").click(function () {
			var msg = '[';
			for(i=1; i<$.count; i++){
				if (i!=1) {msg+=","}
				var offset = $('#'+i).offset();
		        var xPos = offset.left;
		        var yPos = offset.top;
		   		msg += "("+xPos+","+yPos+")";
			}
			msg += ']';
			
		   	$.ajax({
		   		url:"builder/save",
		   		type:"POST",
		   		data:{'msg':msg},
		   		success: function(s) {
		   			alert('success'+s);
		   			window.location.href = "<?php echo $this->session->userdata('active_role'); ?>"+"/experiments";
		   		}
		   	});
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
		<a id="object1"class = "button small">Create Object1</a>
		<a id="getObjectValues"class = "button small">Save Environment</a>
	</div>

	<!-- Workspace -->
	<div id="workspace" class="large-9 column" style="height:500px; background:black;">
		<div style="color:white">
			<p>Workspace</p>
		</div>
		<div class='demo'></div>
	</div>
</div>

<? 
	if(isset($var)){
		foreach ($var as $obj){
			echo '<script>';
			echo '$(function() {';
			echo '$("#object1").trigger("click",['.$obj[0].','.$obj[1].']);';
			echo '})';
			echo '</script>';
		}
	}
?>