<table border="0" cellspacing="0">
	<tr>
		<th>id</th>
		<th>blog</th>
		<th>mode</th>
		<th>type</th>
		<th>title</th>
		<th>body</th>
		<th>excerpt</th>
		<th>datetime</th>
	</tr>
	<?php foreach ($blog_table as $entry): ?>
	<tr>
		<?php foreach ($entry as $entry_data): ?>
			<td><?php echo $entry_data; ?></td>
		<?php endforeach; ?>
	</tr>
	<?php endforeach; ?>
</table>