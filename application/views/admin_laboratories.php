<h3>Admin: Laboratories</h3>
<hr>
<?php 
	$count = 0;
	foreach ($laboratories as $laboratory){
		$count = $count + 1;
		echo $count.'. ';
		echo anchor('laboratory/edit_laboratory/'.$laboratory->labid,$laboratory->name);
		echo '</br>';
	}
?>
<br>
<hr>

<fieldset>
	<legend>Create Laboratory</legend>
	<?php echo validation_errors();?>
	<?php echo form_open("admin/add_lab") . "<br/>";?>

	<label>Lab Name</label><br/>
	<input type="text" id="labname" required name="lab_name" placeholder="My Laboratory"><br/><br/>

	<label>Lab Head</label><br/>
	<input type="text" id="labhead" required name="lab_head" placeholder="Lab Head"><br/><br/>

	<input type="submit" value="Create">

	<?php echo form_close();?>
</fieldset>