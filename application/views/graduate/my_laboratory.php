<h1>Laboratory</h1>
<hr>
<?php if (isset($main_lab)): ?>
	<h2><?php echo $main_lab->name; ?></h2>
	<p><strong> No. of members: </strong><?php echo $main_lab->members_count; ?></p>
	<h5> Faculty Members </h5>
	<?php if(isset($faculty_members)): ?>
		<?php foreach ($faculty_members as $member): ?>
			<a href = "<?php echo site_url('faculty/view/'.$member->username); ?>" ><?php echo strtoupper($member->last_name).', '.ucwords($member->first_name).', '.ucfirst($member->middle_name); ?> </a>
			<br>
		<? endforeach; ?>
	<?php else: ?>
		<p>There are no faculty members.</p>
	<?php endif; ?>
	<br>
	<h5> Graduates </h5>
		<?php if(isset($graduates)): ?>
			<?php foreach ($graduates as $graduate): ?>
				<a href = "<?php echo site_url('graduate/view/'.$graduate->username); ?>"><?php echo strtoupper($graduate->last_name).', '.ucwords($graduate->first_name).', '.ucfirst($graduate->middle_name); ?> </a>
				<br>
			<?php endforeach; ?>
		<?php else: ?>
			<p>There are no students.</p>
		<? endif; ?>
	<?php else: ?>
	<p> You do not belong to any laboratory. </p>
	<hr>
	<h4> Apply to Laboratory </h4>
	<?php if (isset($laboratories)): ?>
		<ol>
		<?php foreach ($laboratories as $laboratory): ?>
			<li><a href = "<?php echo site_url('laboratories/view/'.$laboratory->labid); ?>"><?php echo $laboratory->name; ?> </a></li>
		<?php endforeach; ?>
		</ol>
	<?php else: ?>
		<p>There are no laboratories. Poor you. :( </p>
	<?php endif; ?>
<?php endif; ?>
<br>