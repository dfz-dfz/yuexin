<?php

if (empty($_W['isfounder'])) {
	message('友情提示:您无权使用此功能,请使用管理员账号登陆.');
}
load()->func('file');
defined('IN_IA') or die('Access Denied');
global $_W, $_GPC;
if (empty($_GPC['op'])) {
	$_GPC['op'] = 'display';
}
$ver = (include '010xr.php');
$ver = $ver['ver'];
$ver = substr($ver, -5);
$hosturl = urlencode('http://' . $_SERVER['HTTP_HOST']);
$hostip = $_SERVER['SERVER_ADDR'] ? $_SERVER['SERVER_ADDR'] : gethostbyname($SERVER_NAME);
$updatehost = 'http://wzup.010xr.com/update.php';
$lastver = file_get_contents($updatehost . '?a=check&v=' . $ver);
if ($_GPC['op'] == 'display') {
	$op = $_GPC['op'];
	$gettimeurl = $updatehost . '?a=client_check_time&v=' . $ver . '&u=' . $hosturl;
	$domain_time = file_get_contents($gettimeurl);
} elseif ($_GPC['op'] == 'chanage') {
	$op = $_GPC['op'];
	$ver = $ver + 0.1;
	$chosturl = $updatehost . '?a=chanage&v=' . $ver . '&u=' . $hosturl;
	$cinfo = file_get_contents($chosturl);
} elseif ($_GPC['op'] == 'update') {
	$op = $_GPC['op'];
	$updatehost = 'http://wzup.010xr.com/update.php';
	$updatehosturl = $updatehost . '?a=update&v=' . $ver . '&u=' . $hosturl . '&i=' . $hostip;
	$updatenowinfo = file_get_contents($updatehosturl);
	if (strstr($updatenowinfo, 'zip')) {
		$pathurl = $updatehost . '?a=down&f=' . $updatenowinfo;
		$updatedir = IA_ROOT . '/Temp/update';
		if (!is_dir($updatedir)) {
			mkdirs($updatedir);
		}
		$isgot = get_file($pathurl, $updatenowinfo, $updatedir);
		if ($isgot) {
			$updatezip = $updatedir . '/' . $updatenowinfo;
			require 'pclzip.lib.php';
			$thisfolder = new PclZip($updatezip);
			$isextract = $thisfolder->extract(PCLZIP_OPT_PATH, $updatedir);
			if ($isextract == 0) {
				message('解压更新包失败！', create_url('', array('op' => 'display')), 'success');
			}
			$archive = new PclZip($updatezip);
			$list = $archive->extract(PCLZIP_OPT_PATH, IA_ROOT, PCLZIP_OPT_REPLACE_NEWER);
			if ($list == 0) {
				message('远程升级文件不存在或站点没有修改权限。升级失败！', create_url('system/updatecache', array('op' => 'display')), 'success');
			}
			if (file_exists($updatedir . '/update.sql')) {
				$sqlfile = $updatedir . '/update.sql';
				runquery($sqlfile);
			}
			$newver = "<?php return array ('ver' => '{$lastver}');?>";
			$f = fopen('010xr.php', 'w+');
			fwrite($f, $newver);
			fclose($f);
			@unlink(IA_ROOT . '/update.sql');
			deldir($updatedir);
			message('恭喜您，本次已更新成功，已升级下一新版本！', create_url('system/updatecache', array('op' => 'display')), 'success');
		} else {
			message('查找不到更新包！', create_url('system/updatecache', array('op' => 'display')), 'success');
		}
	} else {
		message('友情提示:请检查授权状态，或者联系新睿社区授权! <br /> QQ:10373458 www.010xr.com！', create_url('system/updatecache', array('op' => 'display')), 'error');
	}
}
function get_file($url, $name, $folder = './')
{
	set_time_limit(24 * 60 * 60);
	$destination_folder = $folder . '/';
	$newfname = $destination_folder . $name;
	$file = fopen($url, 'rb');
	if ($file) {
		$newf = fopen($newfname, 'wb');
		if ($newf) {
			while (!feof($file)) {
				fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
			}
		}
	}
	if ($file) {
		fclose($file);
	}
	if ($newf) {
		fclose($newf);
	}
	return true;
}
function runquery($sql)
{
	$file_path = $sql;
	if (file_exists($file_path)) {
		if ($fp = fopen($file_path, "a+")) {
			$buffer = 1024;
			$str = "";
			while (!feof($fp)) {
				$str .= fread($fp, $buffer);
			}
		}
	}
	$query = $str;
	pdo_run($query);
}
function deldir($dir)
{
	$dh = opendir($dir);
	while ($file = readdir($dh)) {
		if ($file != "." && $file != "..") {
			$fullpath = $dir . "/" . $file;
			if (!is_dir($fullpath)) {
				unlink($fullpath);
			} else {
				deldir($fullpath);
			}
		}
	}
	closedir($dh);
	if (rmdir($dir)) {
		return true;
	} else {
		return false;
	}
}
template('cloud/010xr');