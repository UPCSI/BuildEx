<h2>BuildEx: Experiment</h2>
<script>
  $(function() {
  	$.count = 1;
    $('#object1').click(function(){
        var htmlData='<div id="'+$.count+'" class="draggable ui-widget-content ui-draggable" style="height:100px; width:100px"><p>Object</p><div id="pos'+$.count+'X"></div><div id="pos'+$.count+'Y"></div></div>';
        $('.demo').append(htmlData);
        $('.draggable').draggable({
        	drag: function(){
	            var offset = $(this).offset();
	            var xPos = offset.left;
	            var yPos = offset.top;
	            var element = $(this).attr('id');
	            $('#pos'+element+'X').text('x: ' + xPos);
	            $('#pos'+element+'Y').text('y: ' + yPos);
	        }
        });
        $.count++;
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
	</div>

	<!-- Workspace -->
	<div id="workspace" class="large-9 column" style="height:500px; background:black;">
		<div style="color:white">
			<p>Workspace</p>
		</div>
		<div class='demo'></div>
	</div>

</div>