<h3> Admin: Graduates </h3>
<hr>
<?php 
	$count = 0;
	foreach ($graduates as $graduate){
		$count = $count + 1;
		echo $count.'. ';
		echo anchor('graduate/edit_graduate/'.$graduate->uid.'/'.$graduate->gid, $graduate->username);
		echo '</br>';
	}
?>