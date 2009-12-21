<?php foreach ($entries as $entry): ?>
<article>
	<h1><?php echo typeset($entry->title); ?></h1>
	<time datetime="<?php echo format_sql_datetime($entry->datetime); ?>" pubdate><?php echo format_sql_datetime($entry->datetime, 'M j, ~ga'); ?></time>

	<?php if ($entry->excerpt): ?>
		<?php echo typeset($entry->excerpt); ?>
		
		<a href='#'>More &rarr;</a>
	<?php else: ?>
		<?php echo typeset($entry->body); ?>
	<?php endif; ?>
</article>
<?php endforeach; ?>