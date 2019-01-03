<?php

defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
$store = checkstore();
$sid = $store['id'];
$do = 'assign';
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'index';
$title = '微信排號';
checkauth();
$store = get_store($sid, array('is_assign'));
if ($store['is_assign'] == 2) {
    message('商家已經關閉排號功能', $this->createMobileUrl('store', array('sid' => $sid)), 'error');
}
if ($op == 'index') {
    if ($_GPC['f'] == 'dish') {
        $cart = set_order_cart($sid);
    }
    $mine = pdo_get('str_assign_board', array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'uid' => $_W['member']['uid'], 'status' => 1));
    if (!empty($mine)) {
        header('Location:' . $this->createMobileUrl('assign', array('op' => 'mine', 'sid' => $sid)));
        die;
    }
    $data = pdo_fetchall('select * from ' . tablename('str_assign_queue') . ' where uniacid = :uniacid and sid = :sid and status = 1 order by guest_num asc', array(':uniacid' => $_W['uniacid'], ':sid' => $sid));
    include $this->template('assign');
}
if ($op == 'post') {
    $store = get_store($sid, array('id', 'assign_mode'));
    $data = pdo_fetchall('select * from ' . tablename('str_assign_queue') . ' where uniacid = :uniacid and sid = :sid and status = 1 order by guest_num asc', array(':uniacid' => $_W['uniacid'], ':sid' => $sid), 'id');
    $queue_ids = array();
    if (!empty($data)) {
        foreach ($data as $key => &$row) {
            if (strtotime($row['starttime']) > TIMESTAMP || strtotime($row['endtime']) < TIMESTAMP) {
                unset($data[$key]);
            }
        }
        $queue_ids = array_keys($data);
    }
    if ($_W['isajax']) {
        $guest_num = intval($_GPC['guest_num']) ? intval($_GPC['guest_num']) : message(error(-1, '客人數量錯誤'), '', 'ajax');
        $mobile = trim($_GPC['mobile']) ? trim($_GPC['mobile']) : message(error(-1, '手機號錯誤'), '', 'ajax');
        if ($store['assign_mode'] == 2) {
            $queue_id = intval($_GPC['queue_id']) ? intval($_GPC['queue_id']) : message(error(-1, '隊列錯誤'), '', 'ajax');
        } else {
            foreach ($data as $da) {
                if ($da['guest_num'] < $guest_num) {
                    continue;
                } else {
                    if (!$queue_id) {
                        $queue_id = $da['id'];
                    }
                }
            }
        }
        if (!in_array($queue_id, $queue_ids)) {
            message(error(-1, '不合法的隊列'), '', 'ajax');
        }
        $queue = $data[$queue_id];
        $today = strtotime(date('Y-m-d'));
        if ($queue['updatetime'] < $today) {
            pdo_update('str_assign_queue', array('position' => 1, 'updatetime' => TIMESTAMP), array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $queue_id));
            $queue['position'] = 1;
        }
        $data = array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'uid' => $_W['member']['uid'], 'queue_id' => $queue_id, 'openid' => $_W['openid'], 'mobile' => $mobile, 'guest_num' => $guest_num, 'position' => $queue['position'], 'number' => $queue['prefix'] . str_pad($queue['position'], 3, '0', STR_PAD_LEFT), 'status' => 1, 'is_notify' => 0, 'createtime' => TIMESTAMP);
        pdo_insert('str_assign_board', $data);
        $board_id = pdo_insertid();
        pdo_update('str_assign_queue', array('position' => $queue['position'] + 1, 'updatetime' => TIMESTAMP), array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $queue_id));
        wechat_notice_assign($sid, $board_id, 1);
        wechat_notice_clerk_assign($sid, $board_id);
        message(error(0, 'success'), 'ajax');
    }
    include $this->template('assign');
}
if ($op == 'mine') {
    $mine = pdo_get('str_assign_board', array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'uid' => $_W['member']['uid'], 'status' => 1));
    if (empty($mine)) {
        header('Location:' . $this->createMobileUrl('assign', array('op' => 'index', 'sid' => $sid)));
        die;
    }
    $data = pdo_fetchall('select * from ' . tablename('str_assign_queue') . ' where uniacid = :uniacid and sid = :sid and status = 1 order by guest_num asc', array(':uniacid' => $_W['uniacid'], ':sid' => $sid), 'id');
    if (!empty($data)) {
        $wait = pdo_fetchall('select count(*) as num, queue_id from ' . tablename('str_assign_board') . ' where uniacid = :uniacid and sid = :sid and status = 1 group by queue_id', array(':uniacid' => $_W['uniacid'], ':sid' => $sid), 'queue_id');
    }
    $queue = $data[$mine['queue_id']];
    $now_number = pdo_fetchcolumn('select number from ' . tablename('str_assign_board') . ' where uniacid = :uniacid and sid = :sid and status = 1 and queue_id = :queue_id and  id < :id order by id desc', array(':uniacid' => $_W['uniacid'], ':sid' => $sid, ':queue_id' => $mine['queue_id'], ':id' => $mine['id']));
    if (empty($now_number)) {
        $now_number = $mine['number'];
    }
    $count = pdo_fetchcolumn('select count(*) from ' . tablename('str_assign_board') . ' where uniacid = :uniacid and sid = :sid and status = 1 and id < :id and queue_id = :queue_id', array(':uniacid' => $_W['uniacid'], ':sid' => $sid, ':queue_id' => $mine['queue_id'], ':id' => $mine['id']));
    include $this->template('assign');
}
if ($op == 'cancel') {
    if ($_W['isajax']) {
        $id = intval($_GPC['id']);
        $board = get_assign_board($id);
        if (empty($board)) {
            exit('排隊的不存在');
        }
        pdo_update('str_assign_board', array('status' => 4), array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
        wechat_notice_assign($sid, $id, 4);
        wechat_notice_assign_queue($board['id'], $board['queue_id']);
        exit('success');
    }
}