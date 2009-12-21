<?php

require('markdown_helper.php');
require('smartypants_helper.php');

function typeset($text) {
	return smartypants(markdown($text));
}

?>