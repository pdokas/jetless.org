<form id="new_entry" action="/admin/handle_new_entry" method="post" accept-charset="utf-8"><fieldset>
	<input type="text" id="title" name="title" maxlength="255" placeholder="Title">
	
	<input type="text" id="slug" name="slug" maxlength="127" placeholder="Slug">
	
	<textarea id="body" name="body" placeholder="Body"></textarea>
	
	<label for="excerpt">Excerpt</label>
	<textarea id="excerpt" name="excerpt" placeholder="Excerpt"></textarea>
	
	<label for="datetime">Time</label>
	<input type="datetime" id="datetime" name="datetime">
	
	<input type="submit" name="submit" value="Save">
	<input type="submit" name="submit" value="Save &amp; Publish">
</fieldset></form>