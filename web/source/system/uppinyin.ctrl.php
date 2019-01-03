<?php
/**
 * [WECHAT 2017]
 
 */
defined('IN_IA') or exit('Access Denied');
$dos = array('pinyin', 'users');
$do = in_array($do, $dos) ? $do : 'pinyin';
if($do == 'pinyin') {
	$module = pdo_getall('modules',array(),array('id','title'));
	foreach ($module as $p){
		$title_initial = get_first_pinyin($p['title']);
		pdo_update('modules',array('title_initial'=>$title_initial),array('id'=>$p['id']));
	}
	$account = pdo_getall('uni_account',array(),array('uniacid','name'));
	foreach ($account as $p){
		$title_initial = get_first_pinyin($p['name']);
		pdo_update('uni_account',array('title_initial'=>$title_initial),array('uniacid'=>$p['uniacid']));
	}
	message('公众号/模块拼音数据更新成功！', '', 'success');
}
if($do == 'users') {
	pdo_update('users',array('type'=>1),array('type'=>0));
	message('更新用户数据成功！', '', 'success');
}
