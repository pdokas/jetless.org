<?php foreach ($entries as $entry): ?>
<article>
	<h1><?php echo $entry->title; ?></h1>
	<time datetime="<?php echo format_sql_datetime($entry->datetime); ?>" pubdate><?php echo format_sql_datetime($entry->datetime, 'M j, ~ga'); ?></time>

	<?php if ($entry->excerpt): ?>
		<?php echo $entry->excerpt; ?>
		
		<a href='#'>More &rarr;</a>
	<?php else: ?>
		<?php echo $entry->body; ?>
	<?php endif; ?>
</article>
<?php endforeach; ?>