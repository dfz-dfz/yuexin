<?php

//decode by http://www.yunlu99.com/
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
$title = '预定管理';
$sid = $store['id'];
$do = 'reserve';
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'list';
if ($op == 'list') {
    $categorys = pdo_fetchall('select * from ' . tablename('str_tables_category') . ' where uniacid = :uniacid and sid = :sid', array(':uniacid' => $_W['uniacid'], ':sid' => $sid), 'id');
    $reserves = pdo_fetchall('select * from ' . tablename('str_reserve') . ' where uniacid = :uniacid and sid = :sid', array(':uniacid' => $_W['uniacid'], ':sid' => $sid));
    include $this->template('reserve');
}
if ($op == 'post') {
    $id = intval($_GPC['id']);
    if (checksubmit()) {
        $time = trim($_GPC['time']) ? trim($_GPC['time']) : message('预定时间段不能为空', '', 'error');
        $data = array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'time' => $time, 'table_cid' => intval($_GPC['table_cid']), 'addtime' => time());
        if (!empty($id)) {
            pdo_update('str_reserve', $data, array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
        } else {
            pdo_insert('str_reserve', $data);
        }
        message('编辑预定时间段成功', $this->createWebUrl('reserve', array('op' => 'list')), 'success');
    }
    if ($id > 0) {
        $item = pdo_get('str_reserve', array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
        if (empty($item)) {
            message('预定时间段不存在或已删除', referer(), 'error');
        }
    }
    $categorys = pdo_fetchall('select * from ' . tablename('str_tables_category') . ' where uniacid = :uniacid and sid = :sid', array(':uniacid' => $_W['uniacid'], ':sid' => $sid));
    if (empty($categorys)) {
        message('创建预订开放时间段前,请先添加桌台类型', $this->createWebUrl('table', array('op' => 'category_post')), 'info');
    }
    include $this->template('reserve');
}
if ($op == 'del') {
    $id = intval($_GPC['id']);
    pdo_delete('str_reserve', array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
    message('删除预订开放时间段成功', referer(), 'success');
}
if ($op == 'batch_post') {
    $title = '批量创建';
    if (checksubmit()) {
        $start = strtotime($_GPC['time']);
        for ($i = 0; $i < $_GPC['num']; $i++) {
            $data = array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'time' => date('H:i', $start + $i * $_GPC['time_space'] * 60), 'table_cid' => intval($_GPC['table_cid']), 'addtime' => time());
            pdo_insert('str_reserve', $data);
        }
        message('创建预定时间段成功', $this->createWebUrl('reserve', array('op' => 'list')), 'success');
    }
    $categorys = pdo_fetchall('select * from ' . tablename('str_tables_category') . ' where uniacid = :uniacid and sid = :sid', array(':uniacid' => $_W['uniacid'], ':sid' => $sid));
    if (empty($categorys)) {
        message('创建预订开放时间段前,请先添加桌台类型', $this->createWebUrl('table', array('op' => 'category_post')), 'info');
    }
    include $this->template('reserve');
}