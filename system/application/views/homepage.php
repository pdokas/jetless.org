<?php foreach ($entries as $entry): ?>
<div>
	<h2><?php echo $entry->title; ?></h2>
	<h3><?php echo format_sql_datetime('M j, ga', $entry->datetime); ?></h3>

	<?php if ($entry->excerpt): ?>
		<?php echo $entry->excerpt; ?>
		
		<a href='#'>More &rarr;</a>
	<?php else: ?>
		<?php echo $entry->body; ?>
	<?php endif; ?>
</div>
<?php endforeach; ?>