<h1> Laboratories </h1>
<hr>
<!-- Notification Handling Part-->
<?php if(isset($notification)): ?>
	<div data-alert class="alert-box info"> <?php echo $notification; ?> <a href="#" class="close">&times;</a> </div>
<?php endif; ?>

<?php if (isset($laboratories)): ?>
	<table>
		<thead>
			<tr>
				<td width ="150"> Laboratory </td>
				<td width ="200"> Lab Head </td>
				<td width ="150"> No. of Members </td>
				<td width ="150"> Since </td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($laboratories as $laboratory): ?>
				<tr>
					<td> <?php echo anchor('laboratories/view/'.$laboratory->labid,$laboratory->name); ?> </td>
					<td> <?php echo anchor('faculty/view/'.$laboratory->username,strtoupper($laboratory->last_name).', '.ucwords($laboratory->first_name).', '.ucfirst($laboratory->middle_name).'.'); ?>
					<td> <?php echo $laboratory->members_count; ?></td>
					<td> <?php echo $laboratory->since; ?> </td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php else: ?>
	<p> No Existing Laboratories. </p>
<? endif; ?>

<a href="#" data-reveal-id="create_lab_modal" class="button small">Create Laboratory</a>

<div id="create_lab_modal" class="reveal-modal small" data-reveal>
<fieldset>
<legend>Create Laboratory</legend>
	<?php echo validation_errors();?>
	<?php echo form_open("admin/add_lab");?> <br/>
		<label>Lab Name</label><br/>
		<input type="text" id="labname" required name="lab_name" placeholder="My Laboratory"><br/><br/>

		<label>Description</label><br/>
		<input type="text" id="description" required name="description" placeholder="This lab is..."><br/><br/>

		<label>Lab Head</label><br/>
		<input type="text" id="labhead" required name="lab_head" placeholder="Lab Head"><br/><br/>

		<input class = "button small" type="submit" value="Create">
	<?php echo form_close();?>
	</fieldset>
  <a class="close-reveal-modal">&#215;</a>
</div>