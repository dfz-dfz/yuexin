<?php
/**
 * [WECHAT 2017]
 * [WECHAT  a free software]
 */
defined('IN_IA') or exit('Access Denied');

load()->model('user');
load()->func('file');

$dos = array('edit_base', 'edit_modules_tpl', 'edit_account');
$do = in_array($do, $dos) ? $do: 'edit_base';
//uni_user_permission_check('system_user_post');

$_W['page']['title'] = '编辑用户 - 用户管理';

$uid = intval($_GPC['uid']);
$user = user_single($uid);
if (empty($user)) {
	itoast('访问错误, 未找到该操作员.', url('user/myxiaji'), 'error');
} else {
	if ($user['status'] == 1) itoast('访问错误，该用户未审核通过，请先审核通过再修改！', url('user/myxiaji/check_display'), 'error');
	if ($user['status'] == 3) itoast('访问错误，该用户已被禁用，请先启用再修改！', url('user/myxiaji/recycle_display'), 'error');
}
myxiajicheck($uid);
$founders = explode(',', $_W['config']['setting']['founder']);
$profile = pdo_get('users_profile', array('uid' => $uid));
if (!empty($profile)) $profile['avatar'] = tomedia($profile['avatar']);

if ($do == 'edit_base') {
	$user['last_visit'] = date('Y-m-d H:i:s', $user['lastvisit']);
	$user['joindate'] = date('Y-m-d H:i:s', $user['joindate']);
	$user['end'] = $user['endtime'] == 0 ? '永久' : date('Y-m-d', $user['endtime']);
	$user['endtype'] = $user['endtime'] == 0 ? 1 : 2;
	if(checksubmit('submit')) {
		if(!$_W['isfounder']){
			$user['agentid']=$_W['uid'];
			$group = pdo_fetch("SELECT id,timelimit,price FROM ".tablename('users_group')." WHERE id = :id", array(':id' => $user['groupid']));
			$price = $_GPC['credit2'];
			if($price>0){
				$credit = $_W['user']['credit2']-$price;
			}else{
				itoast('不能填写负数','','error');
			}
			
			if($credit < 0){
				itoast('账户余额不足，帮下级充值需要：'.$price,url('shop/member/member'));
			}
			pdo_update('users',array('credit2'=>$credit),array('uid'=>$_W['uid']));
			$data =array(
			'uid'=>$_W['uid'],
			'credittype'=>'credit2',
			'num'=>-$price,
			'createtime'=>TIMESTAMP,
			'remark'=>'下级充值'
			);
			pdo_insert('users_credits_record',$data);
			$update = array(
				'credit2' => $_GPC['credit2'],
			);
			pdo_update('users', $update, array('uid' => $uid));
            itoast('设置成功！', '', 'success');
		}
		itoast('充值失败！','','error');
			
    }
	if (!empty($profile)) {
		$profile['reside'] = array(
			'province' => $profile['resideprovince'],
			'city' => $profile['residecity'],
			'district' => $profile['residedist']
		);
		$profile['birth'] = array(
			'year' => $profile['birthyear'],
			'month' => $profile['birthmonth'],
			'day' => $profile['birthday'],
		);
		$profile['resides'] = $profile['resideprovince'] . $profile['residecity'] . $profile['residedist'] ;
		$profile['births'] =($profile['birthyear'] ? $profile['birthyear'] : '--') . '年' . ($profile['birthmonth'] ? $profile['birthmonth'] : '--') . '月' . ($profile['birthday'] ? $profile['birthday'] : '--') .'日';
	}
	template('user/myxiajiedit');
}