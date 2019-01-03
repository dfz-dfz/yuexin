<?php
/**
 * [WECHAT 2017]
 * [WECHAT  a free software]
 */
defined('IN_IA') or exit('Access Denied');
load()->model('module');
if (!empty($_W['uid'])) {
	header('Location: '.url('account/display'));
	exit;
}


$settings = $_W['setting'];

	if (!empty($settings['site_welcome_module'])) {
		$site = WeUtility::createModuleSystemWelcome($settings['site_welcome_module']);
		if (!is_error($site)) {
			exit($site->systemWelcomeDisplay());
		}
	}

$copyright = $settings['copyright'];
$copyright['slides'] = iunserializer($copyright['slides']);
if (isset($copyright['showhomepage']) && empty($copyright['showhomepage'])) {
	header("Location: ".url('user/login'));
	exit;
}
load()->model('article');
$notices = article_notice_home();
$news = article_news_home();
template('account/welcome');
