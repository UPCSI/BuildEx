<?php $this->load->view('builder/topbar'); ?>

<div class="row full main-workspace" style="min-height:100%;height:100%">
	<div class="large-11 medium-11 small-11 columns unpad-h" style="min-height:100%;height:100%">
		<div class="row full main-workspace" style="min-height:80%;height:80%">
			<div class="large-2 medium-2 small-2 column unmar-v" style="min-height:100%;height:100%;margin-top:10px;margin-bottom:10px;margin-top:0px;margin-bottom:0px;">
				<div class="slides panel callout" style="min-height:90%;height:90%;overflow-y:auto;margin-bottom:0px;">
				</div>
				<div class="panel callout" style="min-height:10%;height:10%;padding:0px;margin:0px;overflow-y:auto;">
					<ul class="off-canvas-list">
						<li><center>
							<ul class="button-group" style="display:table;margin-top:10px;margin-bottom:10px">
							  <li><a href="#" id="prevPage" class="button success tiny" style="display:inline-flex;margin:0"><i class="fa fa-arrow-left"></i></a></li>
							  <li><a href="#" id="newPage" class="button success tiny" style="display:inline-flex;margin:0"><i class="fa fa-plus"></i></a></li>
							  <li><a href="#" id="nextPage" class="button success tiny" style="display:inline-flex;margin:0"><i class="fa fa-arrow-right"></i></a></li>
							</ul>
						</center></li>
					</ul>
				</div>			 
			</div>

			<div class="large-10 medium-10 small-10 column" style="min-height:100%;height:100%;overflow:auto;display:flex;line-height:initial;text-align:-webkit-center;">
				<?php $this->load->view("builder/{$page}"); ?>
			</div>
		</div>
		<div class="row full main-workspace" style="min-height:20%;height:20%;margin-left:0px;margin-right:0px;background:#252525">
			<div class="large-12 medium-12 small-12 column unpad-h" style="top: -1px;">
				<?php $this->load->view('builder/elements'); ?>
			</div>
		</div>
	</div>
	<div class="large-1 medium-1 small-1 column" style="min-height:100%;height:100%;overflow-y:auto;background:#252525;padding:0px">
		<?php $this->load->view('builder/settings'); ?>
	</div>
</div>
<?php $this->load->view('builder/footer'); ?>

</body>
</html>
