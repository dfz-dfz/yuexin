<?php
define('IN_MOBILE', true);
require '../framework/bootstrap.inc.php';
load()->app('common');
load()->app('template');
load()->model('mc');
load()->model('app');
$_W['uniacid'] = intval($_GPC['i']);

if (empty($_W['uniacid'])) {
	$_W['uniacid'] = intval($_GPC['weid']);
}


$_W['uniaccount'] = $_W['account'] = uni_fetch($_W['uniacid']);

if (empty($_W['uniaccount'])) {
	header('HTTP/1.1 404 Not Found');
	header('status: 404 Not Found');
	exit();
}


$_W['acid'] = $_W['uniaccount']['acid'];
$isdel_account = pdo_get('account', array('isdeleted' => 1, 'acid' => $_W['acid']));

if (!(empty($isdel_account))) {
	exit('指定公众号已被删除');
}


$_W['session_id'] = '';

if (isset($_GPC['state']) && !(empty($_GPC['state'])) && strexists($_GPC['state'], 'we7sid-')) {
	$pieces = explode('-', $_GPC['state']);
	$_W['session_id'] = $pieces[1];
	unset($pieces);
}


if (empty($_W['session_id'])) {
	$_W['session_id'] = $_COOKIE[session_name()];
}


if (empty($_W['session_id'])) {
	$_W['session_id'] = $_W['uniacid'] . '-' . random(20);
	$_W['session_id'] = md5($_W['session_id']);
	setcookie(session_name(), $_W['session_id']);
}


session_id($_W['session_id']);
load()->classs('wesession');
WeSession::start($_W['uniacid'], CLIENT_IP);

if (!(empty($_GPC['j']))) {
	$acid = intval($_GPC['j']);
	$_W['account'] = account_fetch($acid);

	if (is_error($_W['account'])) {
		$_W['account'] = account_fetch($_W['acid']);
	}
	 else {
		$_W['acid'] = $acid;
	}

	$_SESSION['__acid'] = $_W['acid'];
	$_SESSION['__uniacid'] = $_W['uniacid'];
}


if (!(empty($_SESSION['__acid'])) && ($_SESSION['__uniacid'] == $_W['uniacid'])) {
	$_W['acid'] = intval($_SESSION['__acid']);
	$_W['account'] = account_fetch($_W['acid']);
}


if ((!(empty($_SESSION['acid'])) && ($_W['acid'] != $_SESSION['acid'])) || (!(empty($_SESSION['uniacid'])) && ($_W['uniacid'] != $_SESSION['uniacid']))) {
	$keys = array_keys($_SESSION);

	foreach ($keys as $key ) {
		unset($_SESSION[$key]);
	}

	unset($keys, $key);
}


$_SESSION['acid'] = $_W['acid'];
$_SESSION['uniacid'] = $_W['uniacid'];

if (!(empty($_SESSION['openid']))) {
	$_W['openid'] = $_SESSION['openid'];
	$_W['unionid'] = $_SESSION['unionid'];
	$_W['fans'] = mc_fansinfo($_W['openid']);
	$_W['fans']['from_user'] = $_W['fans']['openid'] = $_W['openid'];
}


if (!(empty($_SESSION['uid'])) || (!(empty($_W['fans'])) && !(empty($_W['fans']['uid'])))) {
	$uid = intval($_SESSION['uid']);

	if (empty($uid)) {
		$uid = $_W['fans']['uid'];
	}


	_mc_login(array('uid' => $uid));
	unset($uid);
}


if (empty($_W['openid']) && !(empty($_SESSION['oauth_openid']))) {
	$_W['openid'] = $_SESSION['oauth_openid'];
	$_W['fans'] = array('openid' => $_SESSION['oauth_openid'], 'from_user' => $_SESSION['oauth_openid'], 'follow' => 0);
}


$unisetting = uni_setting_load();

if (!(empty($unisetting['oauth']['account']))) {
	$oauth = account_fetch($unisetting['oauth']['account']);

	if (!(empty($oauth)) && ($_W['account']['level'] <= $oauth['level'])) {
		$_W['oauth_account'] = $_W['account']['oauth'] = array('key' => $oauth['key'], 'secret' => $oauth['secret'], 'acid' => $oauth['acid'], 'type' => $oauth['type'], 'level' => $oauth['level']);
		unset($oauth);
	}
	 else {
		$_W['oauth_account'] = $_W['account']['oauth'] = array('key' => $_W['account']['key'], 'secret' => $_W['account']['secret'], 'acid' => $_W['account']['acid'], 'type' => $_W['account']['type'], 'level' => $_W['account']['level']);
	}
}
 else {
	$_W['oauth_account'] = $_W['account']['oauth'] = array('key' => $_W['account']['key'], 'secret' => $_W['account']['secret'], 'acid' => $_W['account']['acid'], 'type' => $_W['account']['type'], 'level' => $_W['account']['level']);
}

$_W['account']['groupid'] = $_W['uniaccount']['groupid'];
$_W['account']['qrcode'] = tomedia('qrcode_' . $_W['acid'] . '.jpg') . '?time=' . $_W['timestamp'];
$_W['account']['avatar'] = tomedia('headimg_' . $_W['acid'] . '.jpg') . '?time=' . $_W['timestamp'];
$_W['attachurl'] = $_W['attachurl_local'] = $_W['siteroot'] . $_W['config']['upload']['attachdir'] . '/';

if (!(empty($_W['setting']['remote'][$_W['uniacid']]['type']))) {
	$_W['setting']['remote'] = $_W['setting']['remote'][$_W['uniacid']];
}


if (!(empty($_W['setting']['remote']['type']))) {
	if ($_W['setting']['remote']['type'] == ATTACH_FTP) {
		$_W['attachurl'] = $_W['attachurl_remote'] = $_W['setting']['remote']['ftp']['url'] . '/';
	}
	 else if ($_W['setting']['remote']['type'] == ATTACH_OSS) {
		$_W['attachurl'] = $_W['attachurl_remote'] = $_W['setting']['remote']['alioss']['url'] . '/';
	}
	 else if ($_W['setting']['remote']['type'] == ATTACH_QINIU) {
		$_W['attachurl'] = $_W['attachurl_remote'] = $_W['setting']['remote']['qiniu']['url'] . '/';
	}
	 else if ($_W['setting']['remote']['type'] == ATTACH_COS) {
		$_W['attachurl'] = $_W['attachurl_remote'] = $_W['setting']['remote']['cos']['url'] . '/';
	}

}


$acl = array(
	'home' => array('default' => 'home'),
	'mc'   => array('default' => 'home')
	);
$controllers = array();
$handle = opendir(IA_ROOT . '/app/source/');

if (!(empty($handle))) {
	while ($dir = readdir($handle)) {
		if (($dir != '.') && ($dir != '..')) {
			$controllers[] = $dir;
		}

	}
}


if (!(in_array($controller, $controllers))) {
	$controller = 'home';
}


$init = IA_ROOT . '/app/source/' . $controller . '/__init.php';

if (is_file($init)) {
	require $init;
}


$actions = array();
$handle = opendir(IA_ROOT . '/app/source/' . $controller);

if (!(empty($handle))) {
	while ($dir = readdir($handle)) {
		if (($dir != '.') && ($dir != '..') && strexists($dir, '.ctrl.php')) {
			$dir = str_replace('.ctrl.php', '', $dir);
			$actions[] = $dir;
		}

	}
}


if (empty($actions)) {
	$str = '';

	if (uni_is_multi_acid()) {
		$str = '&j=' . $_W['acid'];
	}


	header('location: index.php?i=' . $_W['uniacid'] . $str . '&c=home?refresh');
}


if (!(in_array($action, $actions))) {
	$action = $acl[$controller]['default'];
}


if (!(in_array($action, $actions))) {
	$action = $actions[0];
}


require _forward($controller, $action);
function _forward($c, $a)
{
	$file = IA_ROOT . '/app/source/' . $c . '/' . $a . '.ctrl.php';
	return $file;
}
?>