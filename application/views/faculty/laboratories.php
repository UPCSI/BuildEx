<h1>Laboratory</h1>
<hr>
<?php if (isset($main_lab)): ?>
	<h3> <?php echo $main_lab->name; ?></h3>
	<?php if(isset($main_lab->description)): ?>
		<p> <?php echo $main_lab->description; ?> </p>
	<?php endif; ?>
	<p><strong> No. of members: </strong><?php echo $main_lab->members_count; ?> </p>
	<p><strong> Created: </strong> <?php echo $main_lab->since; ?> </p>
	<h4> Faculty Members </h4>
	<?php if(isset($faculty_members)): ?>
		<?php foreach ($faculty_members as $member): ?>
			<a href = "<?php echo site_url('faculty/view/'.$member->username); ?>"><?php echo strtoupper($member->last_name).', '.ucwords($member->first_name).', '.ucfirst($member->middle_name); ?> </a>
			<br>
		<?php endforeach; ?>
	<?php else: ?>
		<p>There are no faculty members.</p>
	<?php endif; ?>
	<br>
	<h4> Graduates </h4>
		<?php if(isset($graduates)): ?>
			<?php foreach ($graduates as $graduate): ?>
				<a href = "<?php echo site_url('graduate/view/'.$graduate->username); ?>"><?php echo strtoupper($graduate->last_name).', '.ucwords($graduate->first_name).', '.ucfirst($graduate->middle_name); ?> </a>
				<br>
			<?php endforeach; ?>
		<?php else: ?>
			<p>There are no students.</p>
		<? endif; ?>
<? else: ?>
	<?php $this->session->set_flashdata('is_member',false); ?>
	<p> You do not belong to any laboratory. </p>
	<hr>
	<h4> Apply to Laboratory </h4>
	<?php if(isset($laboratories)): ?>
		<?php foreach ($laboratories as $laboratory): ?>
			<a href = "<?php echo site_url('laboratories/view/'.$laboratory->labid); ?>"> <?php echo $laboratory->name; ?> </a>
			<br>
		<?php endforeach; ?>
	<?php else: ?>
		<p> There are no created laboratories yet. </p>
	<?php endif; ?>
<?php endif; ?>
<br>