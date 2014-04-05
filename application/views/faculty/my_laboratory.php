<h1 class="white"> Laboratories </h1>

<div class="row">
<div class="large-12 column">
<h3 class="white" style="display:inline">My Laboratory</h3>
</div>
</div>

<?php if (isset($main_lab)): ?>
	<h2> <?php echo $main_lab->name; ?></h2>
	<p> <strong> Laboratory Head: </strong> <a href = "<?= site_url('faculty/view/'.$lab_head->username); ?>"><?= strtoupper($lab_head->last_name).', '.ucwords($lab_head->first_name).', '.ucfirst($lab_head->middle_name); ?> </a> </p>
	<?php if(isset($main_lab->description)): ?>
		<p> <?php echo $main_lab->description; ?> </p>
	<?php endif; ?>
	<p><strong> No. of members: </strong><?php echo $main_lab->members_count; ?> </p>
	<p> <strong> Description: </strong><? if(isset($main_lab->description)){echo $main_lab->description;}else{echo "None";}?> </p>
	<p><strong> Since: </strong> <?php echo $main_lab->since; ?> </p>
	<h4> Faculty Members </h4>
	<?php if(isset($faculty_members)): ?>
		<ol>
		<?php foreach ($faculty_members as $member): ?>
			<li><a href = "<?php echo site_url('faculty/view/'.$member->username); ?>"><?php echo strtoupper($member->last_name).', '.ucwords($member->first_name).', '.ucfirst($member->middle_name); ?> </a></li>
		<?php endforeach; ?>
		</ol>
	<?php else: ?>
		<p>There are no faculty members.</p>
	<?php endif; ?>
	<h4> Graduates </h4>
		<?php if(isset($graduates)): ?>
			<ol>
			<?php foreach ($graduates as $graduate): ?>
				<li> <a href = "<?php echo site_url('graduate/view/'.$graduate->username); ?>"><?php echo strtoupper($graduate->last_name).', '.ucwords($graduate->first_name).', '.ucfirst($graduate->middle_name); ?> </a> </li>
			<?php endforeach; ?>
			</ol>
		<?php else: ?>
			<p class=""white>There are no students.</p>
		<? endif; ?>

<? else: ?>
	<?php $this->session->set_flashdata('is_member',false); ?>
	<p> You do not belong to any laboratory. </p>
	<hr>
	<h4> Apply to Laboratory </h4>
	<?php if(isset($laboratories)): ?>
		<ol>
		<?php foreach ($laboratories as $laboratory): ?>
			<li> <a href = "<?php echo site_url('laboratories/view/'.$laboratory->labid); ?>"> <?php echo $laboratory->name; ?> </a> </li>
		<?php endforeach; ?>
	<?php else: ?>
		<p class="white"> There are no created laboratories yet. </p>
	<?php endif; ?>
<?php endif; ?>
<br>