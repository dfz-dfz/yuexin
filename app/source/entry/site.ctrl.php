<?php
/**
 * [WECHAT 2017]
 * [WECHAT  a free software]
 */

defined('IN_IA') or exit('Access Denied');

if (!empty($_W['uniacid'])) {
	$link_uniacid = app_link_uniaicd_info($entry['module']);
	if (!empty($link_uniacid)) {
		$_W['uniacid'] = $link_uniacid;
		$_W['account']['link_uniacid'] = $link_uniacid;
	}
}

$site = WeUtility::createModuleSite($entry['module']);
if(!is_error($site)) {
	$do_function = $site instanceof WeModuleSite ? 'doMobile' : 'doPage';
	$method = $do_function . ucfirst($entry['do']);
	exit($site->$method());
}
exit();