<h2>BuildEx: Experiment</h2>
<script>
  $(function() {
    $( "#draggable" ).draggable();
  });
</script>
<script>
  $(function() {
    $( "#draggable1" ).draggable();
  });
</script>
<div id="builder" class="row full">
	<div id="pane" class="large-3 column">
		<div id="draggable" class="ui-widget-content">
		  <p>Tool</p>
		</div>
	</div>
	<div id="workspace" class="large-9 column">
		<div id="draggable1" class="ui-widget-content">
		  <p>Workspace</p>
		</div>
	</div>
</div>