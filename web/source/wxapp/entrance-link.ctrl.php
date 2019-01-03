<?php
/**
 */
defined('IN_IA') or exit('Access Denied');

load()->model('module');
load()->model('wxapp');

$dos = array('entrance_link');
$do = in_array($do, $dos) ? $do : 'entrance_link';

$_W['page']['title'] = '入口页面 - 小程序 - 管理';

$uniacid = intval($_GPC['uniacid']);
$version_id = intval($_GPC['version_id']);
if (!empty($uniacid)) {
	$wxapp_info = wxapp_fetch($uniacid);
}
if (!empty($version_id)) {
	$version_info = wxapp_version($version_id);
	$wxapp_info = wxapp_fetch($version_info['uniacid']);
}

if ($do == 'entrance_link') {
	$wxapp_modules = pdo_getcolumn('wxapp_versions', array('id' => $version_id), 'modules');
	$module_info = array();
	if (!empty($wxapp_modules)) {
		$module_info = iunserializer($wxapp_modules);
		$module_info = pdo_getall('modules_bindings', array('module' => array_keys($module_info), 'entry' => 'page'));
	}
	template('wxapp/version-entrance');
}