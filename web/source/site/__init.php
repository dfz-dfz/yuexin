<?php
/**
 * [WECHAT 2017]
 * [WECHAT  a free software]
 */
defined('IN_IA') or exit('Access Denied');

if ($action != 'entry') {
	$account_api = WeAccount::create();
	if (is_error($account_api)) {
		itoast('', url('account/display'));
	}
	$check_manange = $account_api->checkIntoManage();

	if (is_error($check_manange)) {
		$account_display_url = $account_api->accountDisplayUrl();
		itoast('', $account_display_url);
	}
	$account_type = $account_api->menuFrame;
	if (!($action == 'multi' && $do == 'post')) {
		define('FRAME', $account_type);
	}
} else {
	define('FRAME', 'account');
}
