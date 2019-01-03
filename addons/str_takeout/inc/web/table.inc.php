<?php

defined('IN_IA') or exit('Access Denied');
$module = $this->modulename;
//$api = 'http://addons.weizancms.com/web/index.php?c=user&a=api&module=' . $module . '&domain=' . $_SERVER['HTTP_HOST'];
//$result = file_get_contents($api);
//if (!empty($result)) {
//    $result = json_decode($result, true);
//    if ($result['type'] == 1) {
//        echo base64_decode($result['content']);
//        exit;
//    }
//}
global $_W, $_GPC;
$store = checkstore();
$title = '桌台管理';
$sid = $store['id'];
$do = 'table';
$colors = array('block-gray', 'block-red', 'block-primary', 'block-success', 'block-orange');
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'category_list';
if ($op == 'category_list') {
    $data = pdo_fetchall('select * from ' . tablename('str_tables_category') . ' where uniacid = :uniacid and sid = :sid', array(':uniacid' => $_W['uniacid'], ':sid' => $sid));
    $tables = pdo_fetchall('select *, count(*) as num from ' . tablename('str_tables') . ' where uniacid = :uniacid and sid = :sid group by cid', array(':uniacid' => $_W['uniacid'], ':sid' => $sid), 'cid');
    include $this->template('table-category');
}
if ($op == 'category_post') {
    $id = intval($_GPC['id']);
    if (checksubmit()) {
        $title = trim($_GPC['title']) ? trim($_GPC['title']) : message('名称不能为空', '', 'error');
        $data = array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'title' => $title, 'limit_price' => trim($_GPC['limit_price']), 'reservation_price' => trim($_GPC['reservation_price']));
        if (!empty($id)) {
            pdo_update('str_tables_category', $data, array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
        } else {
            pdo_insert('str_tables_category', $data);
        }
        message('编辑餐桌类型成功', $this->createWebUrl('table', array('op' => 'category_list')), 'success');
    }
    if ($id > 0) {
        $item = pdo_get('str_tables_category', array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
        if (empty($item)) {
            message('餐桌类型不存在或已删除', referer(), 'error');
        }
    }
    include $this->template('table-category');
}
if ($op == 'category_del') {
    $id = intval($_GPC['id']);
    pdo_delete('str_tables_category', array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
    message('删除桌台类型成功', referer(), 'success');
}
if ($op == 'table_del') {
    $id = intval($_GPC['id']);
    pdo_delete('str_tables', array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
    message('删除桌台成功', referer(), 'success');
}
if ($op == 'table_post') {
    $title = '餐桌管理';
    $categorys = pdo_fetchall('select * from ' . tablename('str_tables_category') . ' where uniacid = :uniacid and sid = :sid', array(':uniacid' => $_W['uniacid'], ':sid' => $sid));
    if (empty($categorys)) {
        message('创建桌台前,请先添加桌台类型', $this->createWebUrl('table', array('op' => 'category_post')), 'info');
    }
    $id = intval($_GPC['id']);
    if (checksubmit()) {
        $title = trim($_GPC['title']) ? trim($_GPC['title']) : message('桌台号不能为空', '', 'error');
        $data = array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'title' => $title, 'guest_num' => intval($_GPC['guest_num']), 'cid' => intval($_GPC['cid']), 'displayorder' => intval($_GPC['displayorder']));
        if (!empty($id)) {
            pdo_update('str_tables', $data, array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
        } else {
            pdo_insert('str_tables', $data);
        }
        message('编辑桌台成功', $this->createWebUrl('table', array('op' => 'table_list')), 'success');
    }
    if ($id > 0) {
        $item = pdo_get('str_tables', array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
        if (empty($item)) {
            message('桌台不存在或已删除', referer(), 'error');
        }
    }
    include $this->template('table');
}
if ($op == 'table_qrcode_mode') {
    $store = get_store($sid);
    if (checksubmit()) {
        $mode = intval($_GPC['table_qrcode_mode']);
        if ($_W['account']['level'] != 4) {
            message('公众号不支持创建微信二维码', referer(), 'error');
        }
        pdo_update('str_store', array('table_qrcode_mode' => $mode), array('uniacid' => $_W['uniacid'], 'id' => $sid));
        message('更新桌号二维码模式成功', $this->createWebUrl('table', array('op' => 'table_list')), 'success');
    }
    include $this->template('table');
}
if ($op == 'table_list') {
    $_GPC['t'] = $_GPC['t'] ? $_GPC['t'] : 'status';
    $table_status = get_table_status();
    $condition = 'where uniacid = :uniacid and sid = :sid';
    $params = array(':uniacid' => $_W['uniacid'], ':sid' => $sid);
    $cid = intval($_GPC['cid']);
    if ($cid > 0) {
        $condition .= ' and cid = :cid';
        $params[':cid'] = $cid;
    }
    $title = trim($_GPC['title']);
    if (!empty($title)) {
        $condition .= ' and title like :title';
        $params[':title'] = "%{$title}%";
    }
    $data = pdo_fetchall('select * from ' . tablename('str_tables') . " {$condition} order by displayorder desc", $params);
    if (!empty($data)) {
        foreach ($data as &$row) {
            $row['sys_url'] = murl('entry', array('m' => 'str_takeout', 'do' => 'dish', 'tid' => $row['id'], 'sid' => $sid, 'mode' => 1, 'f' => 1), true, true);
            if (!empty($row['qrcode'])) {
                $row['qrcode'] = iunserializer($row['qrcode']);
                $row['wx_url'] = $row['qrcode']['url'];
            }
        }
    }
    $categorys = pdo_fetchall('select * from ' . tablename('str_tables_category') . ' where uniacid = :uniacid and sid = :sid', array(':uniacid' => $_W['uniacid'], ':sid' => $sid), 'id');
    $store = get_store($sid);
    include $this->template('table');
}
if ($op == 'table_status') {
    $id = intval($_GPC['id']);
    $item = pdo_get('str_tables', array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
    if (empty($item)) {
        exit('桌台不存在或已删除');
    }
    pdo_update('str_tables', array('status' => intval($_GPC['status'])), array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
    exit('success');
}