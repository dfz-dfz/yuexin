<?php
/**
 */
defined('IN_IA') or exit('Access Denied');

load()->model('wxapp');

$dos = array('front_download', 'domainset', 'code_uuid', 'code_gen', 'code_token', 'qrcode', 'checkscan', 'commitcode', 'preview', 'download');
$do = in_array($do, $dos) ? $do : 'front_download';

$_W['page']['title'] = '小程序下载 - 小程序 - 管理';

$uniacid = intval($_GPC['uniacid']);
$version_id = intval($_GPC['version_id']);
if (!empty($uniacid)) {
	$wxapp_info = wxapp_fetch($uniacid);
}
if (!empty($version_id)) {
	$version_info = wxapp_version($version_id);
	$wxapp_info = wxapp_fetch($version_info['uniacid']);
}
if ($do == 'domainset') {
	$appurl = $_W['siteroot'].'app/index.php';
	if($version_info) {
		$wxapp  = pdo_get('account_wxapp', array('uniacid'=>$version_info['uniacid']));
		if($wxapp && !empty($wxapp['appdomain'])) {
			$appurl = $wxapp['appdomain'];
		}
	}
	if($_W['ispost']) {
		$appurl = $_GPC['appurl'];
		if(! starts_with($appurl, 'https')) {
			itoast('域名必须以https开头');
			return;
		}
		if($version_info) {
			$update = pdo_update('account_wxapp', array('appdomain'=>$appurl), array('uniacid'=>$version_info['uniacid']));
			if($update) {
				itoast('更新小程序域名成功');
			}
			itoast('更新小程序域名失败');
		}
	}
	template('wxapp/version-front-download');
}
if ($do == 'front_download') {
	$appurl = $_W['siteroot'].'/app/index.php';
	$uptype = $_GPC['uptype'];
	if(!in_array($uptype, array('auto','normal'))) {
		$uptype = 'autoup';
	}
	$wxapp_versions_info = wxapp_version($version_id);
	//1上传待审核，2审核成功，3审核失败
	if($wxapp_info['status']==0){
		$show['sc']='未上传';
		$show['sh']='未审核';
		$show['sf']='未发布';
	}elseif($wxapp_info['status']==1){
		$show['sc']='已上传';
		$show['sh']='审核中';
		$show['sf']='未发布';
	}elseif($wxapp_info['status']==2){
		$show['sc']='已上传';
		$show['sh']='审核成功';
		$show['sf']='未发布';
	}elseif($wxapp_info['status']==3){
		$show['sc']='已上传';
		$show['sh']='审核失败';
		$show['sf']='未发布';
	}elseif($wxapp_info['status']==4){
		$show['sc']='已上传';
		$show['sh']='审核成功';
		$show['sf']='已发布';
	}
	if($wxapp_info['fail_reason']){
		$show['reason']=$wxapp_info['fail_reason'];
	}
	
	if(checksubmit()){
		$a_uniacid=intval($_GPC['a_uniacid']);
		pdo_update('account_wxapp',array('a_uniacid'=>$a_uniacid),array('uniacid'=>$wxapp_info['uniacid']));
		itoast('绑定成功！', referer(), 'success');
	}
	load()->model('account');
	$accounts=uni_account_list(array(),array());
	$accounts=$accounts['list'];
	template('wxapp/version-front-download');
}

if($do == 'code_uuid') {
	$data = wxapp_code_generate($version_id);
	echo json_encode($data);
}

if($do == 'code_gen') {
	$code_uuid = $_GPC['code_uuid'];
	$data = wxapp_check_code_isgen($code_uuid);
	echo json_encode($data);
}

if ($do == 'code_token') {
	$tokendata = wxapp_code_token();
	echo json_encode($tokendata);
}

if ($do == 'qrcode') {
	$code_token = $_GPC['code_token'];
	echo wxapp_code_qrcode($code_token);
}

if ($do == 'checkscan') {
	$code_token = $_GPC['code_token'];
	$last = $_GPC['last'];
	$data = wxapp_code_check_scan($code_token, $last);
	echo json_encode($data);
}

if($do == 'preview') {
	$code_token = $_GPC['code_token'];
	$code_uuid = $_GPC['code_uuid'];
	$data = wxapp_code_preview_qrcode($code_uuid, $code_token);
	echo json_encode($data);

}

if ($do == 'commitcode') {

	$user_version = $_GPC['user_version'];
	$user_desc = $_GPC['user_desc'];
	$code_token = $_GPC['code_token'];
	$code_uuid = $_GPC['code_uuid'];
	$data = wxapp_code_commit($code_uuid, $code_token, $user_version, $user_desc);
	echo json_encode($data);
}
