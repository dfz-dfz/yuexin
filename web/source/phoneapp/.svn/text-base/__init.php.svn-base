<?php
/**
 */
defined('IN_IA') or exit('Access Denied');
$account_api = WeAccount::create();


if (!in_array($action, array('display', 'manage'))) {
	if (is_error($account_api)) {
		message($account_api['message'], url('phoneapp/display'));
	}
	$check_manange = $account_api->checkIntoManage();
	if (is_error($check_manange)) {
		$account_display_url = $account_api->accountDisplayUrl();
		itoast('', $account_display_url);
	}
}

if ($action == 'manage') {
	define('FRAME', 'system');
}

if (($action == 'version' && $do == 'home') || in_array($action, array('description', 'front-download'))) {
	$account_type = $account_api->menuFrame;
	define('FRAME', $account_type);
}