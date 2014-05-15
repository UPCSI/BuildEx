<ol class = "laboratories">
	<?php foreach ($laboratories as $laboratory): ?>
		<li>
			<a href = "<?php echo site_url('laboratories/view/'.$laboratory->labid); ?>">
				<?php echo $laboratory->name; ?>
			</a>
		</li>
	<?php endforeach; ?>
</ol>