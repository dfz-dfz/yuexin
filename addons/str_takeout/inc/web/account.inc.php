<?php

//decode by http://www.yunlu99.com/
defined('IN_IA') or exit('Access Denied');
$module = $this->modulename;
//$api = 'http://addons.weizancms.com/web/index.php?c=user&a=api&module=' . $module . '&domain=' . $_SERVER['HTTP_HOST'];
//$result = file_get_contents($api);
//if (!empty($result)) {
//	$result = json_decode($result, true);
//	if ($result['type'] == 1) {
//		echo base64_decode($result['content']);
//		exit;
//	}
//}
global $_W, $_GPC;
$title = '设置门店独立账号';
$do = 'account';
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'list';
if ($op == 'list') {
    $stores = pdo_getall('str_store', array('uniacid' => $_W['uniacid']), array('id', 'title', 'logo'), 'id');
    $data = pdo_fetchall('select * from ' . tablename('str_account') . ' where uniacid = :uniacid', array(':uniacid' => $_W['uniacid']));
    if (!empty($data)) {
        $uids = array(0);
        foreach ($data as $da) {
            $uids[] = $da['uid'];
        }
        $uids = implode(',', $uids);
        $users = pdo_fetchall('select username,uid,status from ' . tablename('users') . "  where uid IN ({$uids})", array(), 'uid');
    }
}
if ($op == 'del') {
    $id = intval($_GPC['id']);
    pdo_delete('str_account', array('uniacid' => $_W['uniacid'], 'id' => $id));
    message('删除成功', referer(), 'success');
}
if ($op == 'post') {
    $id = intval($_GPC['id']);
    if ($id > 0) {
        $sql = 'SELECT * FROM ' . tablename('str_account') . " WHERE id = :id AND uniacid = :uniacid";
        $account = pdo_fetch($sql, array(':id' => $id, ':uniacid' => $_W['uniacid']));
        if (empty($account)) {
            message('账号不存在或已删除', referer(), 'error');
        }
        if ($account['uid'] > 0) {
            $user = pdo_get('users', array('uid' => $account['uid']));
            $account['username'] = $user['username'];
            $account['uid'] = $user['uid'];
        }
    }
    if (checksubmit()) {
        load()->model('user');
        $storeid = intval($_GPC['sid']) ? intval($_GPC['sid']) : message('请选择所属门店');
        if (!$account['uid']) {
            $user = array();
            $user['username'] = trim($_GPC['username']);
            if (!preg_match(REGULAR_USERNAME, $user['username'])) {
                message('必须输入用户名，格式为 3-15 位字符，可以包括汉字、字母（不区分大小写）、数字、下划线和句点。');
            }
            if (user_check(array('username' => $user['username']))) {
                message('非常抱歉，此用户名已经被注册，你需要更换注册名称！');
            }
            $user['password'] = trim($_GPC['password']);
            if (istrlen($user['password']) < 8) {
                message('必须输入密码，且密码长度不得低于8位。');
            }
            $user['status'] = intval($_GPC['status']);
            $account['uid'] = user_register($user);
            if (!$account['uid']) {
                message('注册账号失败');
            }
        } else {
            $_GPC['username'] = trim($_GPC['username']);
            if (!preg_match(REGULAR_USERNAME, $_GPC['username'])) {
                message('必须输入用户名，格式为 3-15 位字符，可以包括汉字、字母（不区分大小写）、数字、下划线和句点。');
            }
            $is_exist = pdo_fetchcolumn('SELECT uid FROM ' . tablename('users') . ' WHERE username = :username AND uid != :uid', array(':username' => $_GPC['username'], ':uid' => $account['uid']));
            if (!empty($is_exist)) {
                message('非常抱歉，此用户名已经被注册，你需要更换注册名称！');
            }
            $_GPC['password'] = trim($_GPC['password']);
            if (!empty($_GPC['password']) && istrlen($_GPC['password']) < 8) {
                message('必须输入密码，且密码长度不得低于8位。');
            }
            $record = array();
            $record['uid'] = $account['uid'];
            $record['salt'] = $account['salt'];
            $record['username'] = $_GPC['username'];
            $record['status'] = intval($_GPC['status']);
            if (!empty($_GPC['password'])) {
                $record['password'] = user_hash($_GPC['password'], $account['salt']);
            }
            pdo_update('users', $record, array('uid' => intval($account['uid'])));
        }
        $permission = 'str_takeout_menu_store';
        $permission_exist = pdo_get('users_permission', array('uniacid' => $_W['uniacid'], 'uid' => $account['uid'], 'type' => 'str_takeout'));
        if (empty($permission_exist)) {
            pdo_insert('users_permission', array('uniacid' => $_W['uniacid'], 'uid' => $account['uid'], 'type' => 'str_takeout', 'permission' => $permission));
        } else {
            pdo_update('users_permission', array('permission' => $permission), array('uniacid' => $_W['uniacid'], 'uid' => $account['uid'], 'type' => 'str_takeout'));
        }
        $account_user = pdo_get('uni_account_users', array('uniacid' => $_W['uniacid'], 'uid' => $account['uid']));
        if (empty($account_user)) {
            pdo_insert('uni_account_users', array('uniacid' => $_W['uniacid'], 'uid' => $account['uid'], 'role' => 'operator'));
        } else {
            pdo_update('uni_account_users', array('role' => 'operator'), array('uniacid' => $_W['uniacid'], 'uid' => $account['uid']));
        }
        $data = array('uniacid' => $_W['uniacid'], 'uid' => $account['uid'], 'sid' => $storeid);
        if (empty($account['id'])) {
            pdo_insert('str_account', $data);
        } else {
            pdo_update('str_account', $data, array('uniacid' => $_W['uniacid'], 'id' => $id));
        }
        message('编辑账号成功', $this->createWebUrl('account'), 'success');
    }
    $stores = pdo_getall('str_store', array('uniacid' => $_W['uniacid']), array('id', 'title'));
}
include $this->template('account');