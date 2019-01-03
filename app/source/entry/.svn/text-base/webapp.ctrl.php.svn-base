<?php
/**
 */
defined('IN_IA') or exit('Access Denied');

if (!empty($_W['uniacid'])) {
	$link_uniacid = app_link_uniaicd_info($entry['module']);
	if (!empty($link_uniacid)) {
		$_W['uniacid'] = $link_uniacid;
		$_W['account']['link_uniacid'] = $link_uniacid;
	}
}

$site = WeUtility::createModuleWebapp($entry['module']);
$method = 'doPage' . ucfirst($entry['do']);
if(!is_error($site)) {
	exit($site->$method());
}
message('模块不存在或是 '.$method.' 方法不存在', '', 'error');