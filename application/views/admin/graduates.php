	<h3> Admin: Graduates </h3>
<hr>
<?php 
	$count = 0;
	foreach ($graduates as $graduate){
		$count = $count + 1;
		echo $count.'. ';
		echo anchor('graduate/view/'.$graduate->username, $graduate->username);
		echo '</br>';
	}
?>