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
$store = checkstore();
$sid = $store['id'];
$do = 'qrcode';
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'build';
if ($op == 'build') {
    if ($_W['account']['level'] != 4) {
        message('您的公众号没有创建二维码的权限', referer(), 'error');
    }
    $type = intval($_GPC['type']);
    if ($type == 1) {
        $sid = intval($_GPC['store_id']);
        $store = get_store($sid);
    }
    $table_id = intval($_GPC['table_id']);
    $types = array('1' => array('scene_str' => "str_takeout_store_{$sid}", 'keyword' => "str_takeout_store_{$sid}", 'name' => "{$store['title']}门店二维码"), '2' => array('scene_str' => "str_takeout_assign_{$sid}", 'keyword' => "str_takeout_assign_{$sid}", 'name' => "{$store['title']}排号二维码"), '3' => array('scene_str' => "str_takeout_table_{$sid}_{$table_id}", 'keyword' => "str_takeout_table_{$sid}_{$table_id}", 'name' => "{$store['title']}桌台{$table_id}二维码"));
    $acc = WeAccount::create($_W['acid']);
    $barcode = array('expire_seconds' => '', 'action_name' => '', 'action_info' => array('scene' => array()));
    $barcode['action_info']['scene']['scene_str'] = $types[$type]['scene_str'];
    $barcode['action_name'] = 'QR_LIMIT_STR_SCENE';
    $result = $acc->barCodeCreateFixed($barcode);
    if (is_error($result)) {
        message("生成微信二维码出错,错误详情:{$result['message']}", referer(), 'error');
    }
    $qrcode = array('uniacid' => $_W['uniacid'], 'acid' => $_W['acid'], 'qrcid' => '', 'scene_str' => $barcode['action_info']['scene']['scene_str'], 'keyword' => $types[$type]['keyword'], 'name' => $types[$type]['name'], 'model' => 1, 'ticket' => $result['ticket'], 'url' => $result['url'], 'expire' => $result['expire_seconds'], 'createtime' => TIMESTAMP, 'status' => '1', 'type' => 'str_takeout');
    pdo_insert('qrcode', $qrcode);
    $rule = array('uniacid' => $_W['uniacid'], 'name' => $types[$type]['name'], 'module' => 'str_takeout', 'status' => 1);
    pdo_insert('rule', $rule);
    $rid = pdo_insertid();
    $keyword = array('uniacid' => $_W['uniacid'], 'module' => 'str_takeout', 'content' => $types[$type]['keyword'], 'status' => 1, 'type' => 1, 'displayorder' => 1, 'rid' => $rid);
    pdo_insert('rule_keyword', $keyword);
    $kid = pdo_insertid();
    $data = array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'type' => $type, 'rid' => $rid, 'table_id' => $table_id);
    pdo_insert('str_reply', $data);
    $reply_id = pdo_insertid();
    $qrcode = array('ticket' => $result['ticket'], 'url' => $result['url']);
    if ($type == 1) {
        pdo_update('str_store', array('store_qrcode' => iserializer($qrcode)), array('uniacid' => $_W['uniacid'], 'id' => $sid));
    } elseif ($type == 2) {
        pdo_update('str_store', array('assign_qrcode' => iserializer($qrcode)), array('uniacid' => $_W['uniacid'], 'id' => $sid));
    } elseif ($type == 3) {
        pdo_update('str_tables', array('qrcode' => iserializer($qrcode)), array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $table_id));
    }
    message('生成微信二维码成功', referer(), 'success');
}