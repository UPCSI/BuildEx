<h3> Admin: Graduates </h3>
<hr>
<?php if(isset($graduates)): ?>
	<?php $count = 0; ?>
	<?php foreach ($graduates as $graduate):?>
		<?php $count = $count + 1;?>
		<p> <?php echo $count.'. '; ?>
			<?php echo anchor('graduate/view/'.$graduate->username, $graduate->username); ?>
		</p>
	<? endforeach; ?>	
<? else: ?>
	<p> There are no graduates. </p>
<? endif; ?>