<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 
 */
defined('IN_IA') or exit('Access Denied');
global $_W,$_GPC;
if(!$_W['isfounder']) {
    message('不能访问, 需要创始人权限才能访问.');
}

include $this->template('member/goods');
