<?php

function to_sql_datetime($timestamp) {
	return date('Y-m-d H:i:s', $timestamp);
}

function format_sql_datetime($timestamp, $format = 'c') {
	return date($format, strtotime($timestamp));
}

?>