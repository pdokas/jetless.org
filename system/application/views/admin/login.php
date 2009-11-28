<form method='post' action='/auth/check'><fieldset>
	<input type="text" name="name" value="" id="name">
	<input type="password" name="pass" value="" id="pass">
	<input type="hidden" name="referer" value="<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '' ?>" id="referer">
</fieldset></form>