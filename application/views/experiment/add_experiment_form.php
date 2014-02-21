<h2>BuildEx: Experiment</h2>
<script>
  $(function() {
    $('#object1').click(function(){
        var htmlData='<div class="draggable ui-widget-content ui-draggable" style="height:100px; width:100px"><p>Object</p></div>';
        $('.demo').append(htmlData);
        $( ".draggable" ).draggable();
        });
   });
</script>
<div id="builder" class="row full">
	
	<!-- Toolbar -->
	<div id="pane" class="large-3 column" style="height:500px; background:gray">
		<div style="color:white">
			<p>Toolbar</p>
		</div>
		<!-- <div id="draggable" class="ui-widget-content">
		  <p>Object</p>
		</div> -->
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