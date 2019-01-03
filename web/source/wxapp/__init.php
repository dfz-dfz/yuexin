<?php
/**
 * [WECHAT 2017]
 * [WECHAT  a free software]
 */
defined('IN_IA') or exit('Access Denied');
$account_api = WeAccount::create();

if (!in_array($action, array('display', 'post', 'manage'))) {
	if (is_error($account_api)) {
		itoast('', url('wxapp/display'));
	}
	$check_manange = $account_api->checkIntoManage();
	if (is_error($check_manange)) {
		$account_display_url = $account_api->accountDisplayUrl();
		itoast('', $account_display_url);
	}
}

if (($action == 'version' && $do == 'home') || in_array($action, array('payment', 'refund', 'module-link-uniacid', 'entrance-link', 'front-download'))) {
	$account_type = $account_api->menuFrame;
	define('FRAME', $account_type);
}
