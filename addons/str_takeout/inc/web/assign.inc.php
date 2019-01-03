<?php

//decode by http://www.yunlu99.com/
defined('IN_IA') or exit('Access Denied');
//$module = $this->modulename;
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
$title = '排号管理';
$store = checkstore();
$sid = $store['id'];
$do = 'assign';
$colors = array('block-gray', 'block-red', 'block-primary', 'block-success', 'block-orange');
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'board_list';
if ($op == 'queue_list') {
    $data = pdo_fetchall('select * from ' . tablename('str_assign_queue') . ' where uniacid = :uniacid and sid = :sid order by guest_num asc', array(':uniacid' => $_W['uniacid'], ':sid' => $sid));
    include $this->template('assign-queue');
}
if ($op == 'queue_post') {
    $id = intval($_GPC['id']);
    if (checksubmit()) {
        $title = trim($_GPC['title']) ? trim($_GPC['title']) : message('队列名称不能为空', '', 'error');
        $guest_num = intval($_GPC['guest_num']) ? intval($_GPC['guest_num']) : message('客人数量少于等于多少人排入此队列必须大于0', '', 'error');
        $starttime = trim($_GPC['starttime']);
        $endtime = trim($_GPC['endtime']);
        if (strtotime(date('Y-m-d ') . $starttime) > strtotime(date('Y-m-d ') . $endtime)) {
            message('开放排队时间不能大于结束排队时间', '', 'error');
        }
        $notify_num = intval($_GPC['notify_num']) ? intval($_GPC['notify_num']) : message('提前通知人数必须大于0', '', 'error');
        $data = array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'title' => $title, 'guest_num' => $guest_num, 'notify_num' => $notify_num, 'starttime' => trim($_GPC['starttime']), 'endtime' => trim($_GPC['endtime']), 'prefix' => trim($_GPC['prefix']), 'status' => intval($_GPC['status']));
        if (!empty($id)) {
            pdo_update('str_assign_queue', $data, array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
        } else {
            pdo_insert('str_assign_queue', $data);
        }
        message('编辑队列成功', $this->createWebUrl('assign', array('op' => 'queue_list')), 'success');
    }
    if ($id > 0) {
        $item = pdo_get('str_assign_queue', array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
        if (empty($item)) {
            message('队列不存在或已删除', referer(), 'error');
        }
    } else {
        $item = array('starttime' => '00:00', 'endtime' => '23:59', 'status' => 1);
    }
    include $this->template('assign-queue');
}
if ($op == 'queue_del') {
    $id = intval($_GPC['id']);
    pdo_delete('str_assign_queue', array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
    pdo_delete('str_assign_board', array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'queue_id' => $id));
    message('删除队列成功', referer(), 'success');
}
if ($op == 'assign_mode') {
    if (checksubmit()) {
        $data = array('assign_mode' => intval($_GPC['assign_mode']));
        pdo_update('str_store', $data, array('uniacid' => $_W['uniacid'], 'id' => $sid));
        message('设置排号模式成功', referer(), 'success');
    }
    $store = get_store($sid);
    include $this->template('assign-queue');
}
if ($op == 'board_list') {
    $data = pdo_fetchall('select * from ' . tablename('str_assign_queue') . ' where uniacid = :uniacid and sid = :sid and status = 1 order by guest_num asc', array(':uniacid' => $_W['uniacid'], ':sid' => $sid));
    if (!empty($data)) {
        $wait = pdo_fetchall('select count(*) as num, queue_id from ' . tablename('str_assign_board') . ' where uniacid = :uniacid and sid = :sid and status = 1 group by queue_id', array(':uniacid' => $_W['uniacid'], ':sid' => $sid), 'queue_id');
    }
    include $this->template('assign-board');
}
if ($op == 'board_detail') {
    $queue_id = intval($_GPC['id']);
    $queue = pdo_get('str_assign_queue', array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $queue_id));
    if (empty($queue)) {
        message('队列不存在或已删除', referer(), 'error');
    }
    $colors = get_board_status();
    $condition = '';
    $params = array(':uniacid' => $_W['uniacid'], ':sid' => $sid, ':queue_id' => $queue_id);
    $status = isset($_GPC['status']) ? intval($_GPC['status']) : -1;
    if ($status != -1) {
        $condition .= ' and status = :status';
        $params['status'] = $status;
    }
    $pindex = max(1, intval($_GPC['page']));
    $psize = 50;
    $total = pdo_fetchcolumn('select count(*) from ' . tablename('str_assign_board') . " where uniacid = :uniacid and sid = :sid and queue_id = :queue_id {$condition}", $params);
    $data = pdo_fetchall('select * from ' . tablename('str_assign_board') . " where uniacid = :uniacid and sid = :sid and queue_id = :queue_id {$condition} order by id asc limit " . ($pindex - 1) * $psize . ", {$psize}", $params);
    $pager = pagination($total, $pindex, $psize);
    include $this->template('assign-board');
}
if ($op == 'board_status') {
    $id = intval($_GPC['id']);
    $status = intval($_GPC['status']);
    $board = get_assign_board($id);
    if (empty($board)) {
        message(error(-1, '排队不存在'), '', 'ajax');
    }
    pdo_update('str_assign_board', array('status' => $status), array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
    $status = wechat_notice_assign($sid, $id, $status);
    if (!is_error($status)) {
        pdo_update('str_assign_board', array('is_notify' => 1), array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
    }
    wechat_notice_assign_queue($board['id'], $board['queue_id']);
    message(error(0, ''), '', 'ajax');
}
if ($op == 'board_notity') {
    $id = intval($_GPC['id']);
    $status = intval($_GPC['status']);
    $board = get_assign_board($id);
    if (empty($board)) {
        message('排队不存在', referer(), 'error');
    }
    $status = wechat_notice_assign($sid, $id, 5);
    if (!is_error($status)) {
        pdo_update('str_assign_board', array('is_notify' => 1), array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
        message('通知成功', referer(), 'success');
    }
    message("通知失败:{$status['message']}", referer(), 'error');
}
if ($op == 'board_del') {
    $ids = $_GPC['id'];
    if (!is_array($ids)) {
        $ids = array($ids);
    }
    foreach ($ids as $id) {
        $id = intval($id);
        if ($id <= 0) {
            continue;
        }
        pdo_delete('str_assign_board', array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
    }
    message('删除排号成功', referer(), 'success');
}
if ($op == 'board_post') {
    $id = intval($_GPC['id']);
    $item = pdo_get('str_assign_board', array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
    if (empty($item)) {
        message('排号不存在或已经删除', referer(), 'error');
    }
    if (checksubmit()) {
        $number = trim($_GPC['number']) ? trim($_GPC['number']) : message('号码不能为空', '', 'error');
        $mobile = trim($_GPC['mobile']) ? trim($_GPC['mobile']) : message('手机不能为空', '', 'error');
        $data = array('number' => $number, 'mobile' => $mobile, 'guest_num' => intval($_GPC['guest_num']));
        pdo_update('str_assign_board', $data, array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
        message('更新客人队列成功', $this->createWebUrl('assign', array('op' => 'board_detail', 'id' => $item['queue_id'])), 'success');
    }
    include $this->template('assign-board');
}
if ($op == 'assign_qrcode') {
    $sys_url = murl('entry', array('m' => 'str_takeout', 'do' => 'assign', 'sid' => $sid), true, true);
    $store = get_store($sid);
    if (!empty($store['assign_qrcode'])) {
        $store['assign_qrcode'] = iunserializer($store['assign_qrcode']);
        if (is_array($store['assign_qrcode'])) {
            $wx_url = $store['assign_qrcode']['url'];
        }
    }
    include $this->template('assign-queue');
}