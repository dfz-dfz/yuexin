<?php
/**
 * [WECHAT 2017]
 * [WECHAT  a free software]
 */

$account_api = WeAccount::create();
if (is_error($account_api)) {
	message($account_api['message'], url('account/display'));
}
$check_manange = $account_api->checkIntoManage();

if (is_error($check_manange)) {
	$account_display_url = $account_api->accountDisplayUrl();
	itoast('', $account_display_url);
} else {
	$account_type = $account_api->menuFrame;
	define('FRAME', $account_type);
}
