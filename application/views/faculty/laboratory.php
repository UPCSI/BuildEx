<h1 class="white"> Laboratories </h1>

<div class="row">
	<div class="large-12 column">
		<h3 class="white" style="display:inline">My Laboratory</h3>
	</div>
</div>

<?php if (isset($main_lab)): ?>
	<?php $data['laboratory'] = $main_lab; ?>
	<?php $this->load->view('laboratory/view',$data); ?>
<? else: ?>
	<?php $this->session->set_flashdata('is_member',false); ?>
	<p> You do not belong to any laboratory. </p>
	<hr>
	<h4> Apply to Laboratory </h4>
	<?php if(isset($laboratories)): ?>
		<?php $data['laboratories'] = $laboratories; ?>
		<?php $this->load->view('faculty/_laboratories_list',$data); ?>
	<?php else: ?>
		<p class="white"> There are no created laboratories yet. </p>
	<?php endif; ?>
<?php endif; ?>
<br>