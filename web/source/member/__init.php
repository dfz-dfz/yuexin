<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 
 */
 define('IN_GW', true);
if ($do == 'oauth' || $action == 'credit' || $action == 'passport' || $action == 'uc') {
	define('FRAME', 'setting');
} else {
	define('FRAME', 'member');
}

$frames = buildframes(array(FRAME));
$frames = $frames[FRAME];
