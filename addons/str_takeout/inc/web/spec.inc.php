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
$title = '套餐規格管理';
$sid = $store['id'];
$do = 'spec';
$colors = array('block-gray', 'block-red', 'block-primary', 'block-success', 'block-orange');
$bgcolor = array('#FF5722','#FFB800','#009688','#2F4056','#1E9FFF','#666');
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'spec_list';
if($op == 'spec_list'){
    $data = pdo_fetchall('select * from ' . tablename('str_spec_cate') . ' where uniacid = :uniacid and sid = :sid', array(':uniacid' => $_W['uniacid'], ':sid' => $sid));
    foreach ($data as $key => $cate){
        $info = pdo_fetchall('select * from ' . tablename('str_specification') . ' where pid = :pid', array(':pid' => $cate['id']));
        foreach ($info as &$item){
            $num = mt_rand(0,5);
            $item['bgcolor'] = $bgcolor[$num];
        }
        $data[$key]['list'] = $info;
    }
    include $this->template('spec-cate');
}
if($op == 'spec_post'){
    $id = intval($_GPC['id']);
    $cateName = trim($_GPC['cateName']) ? trim($_GPC['cateName']) : message('名称不能为空', '', 'error');
    if(!$_W['uniacid'] && !$sid){
        message('參數錯誤', '', 'error');
    }
    $data = array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'cateName' => $cateName);
    if(!empty($id)){
        $status = pdo_update('str_spec_cate', $data, array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
    }else{
        $status = pdo_insert('str_spec_cate', $data);
    }
    if($status){
        message('提交成功', '', 'success');
    }else{
        message('提交失敗', '', 'error');
    }
}
if($op == 'spec_del'){
    $id = intval($_GPC['id']);
    pdo_delete('str_spec_cate', array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
    pdo_delete('str_specification', array('pid' => $id));
    message('刪除類型成功', referer(), 'success');
}
if($op == 'spec_add'){
    $id = intval($_GPC['id']);
    $specId = intval($_GPC['specId']);
    $specInfo = pdo_get('str_spec_cate',array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
    if($specId){
        $dataList = pdo_get('str_specification',array('id' => $specId));
    }
    if (checksubmit()) {
        $specName = trim($_GPC['specName']) ? trim($_GPC['specName']) : message('規格名稱不能為空', '', 'error');
        $price = is_numeric($_GPC['price']) ? $_GPC['price'] : message('價格應為數字', '', 'error');
        $data = array('specName'=>$specName,'price'=>$price,'pid'=>$id);
        if (!empty($specId)) {
            pdo_update('str_specification', $data, array('id' => $specId));
        } else {
            pdo_insert('str_specification', $data);
        }
        message('提交規格成功', $this->createWebUrl('spec', array('op' => 'spec_list')), 'success');
    }
    include $this->template('spec-cate');

}
if($op == 'spec_view'){
    $id = intval($_GPC['id']);
    $data = pdo_fetchall('select * from ' . tablename('str_specification') . ' where pid = :pid', array(':pid' => $id));
    $specInfo = pdo_get('str_spec_cate',array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
//    var_dump($data);exit;
    include $this->template('spec-cate');
}
if($op == 'spec_item_del'){
    $id = $_GPC['id'];
    pdo_delete('str_specification', array('id' => $id));
    message('刪除類型成功', referer(), 'success');
}