<?php

/**
 */
defined('IN_IA') or exit('Access Denied');

class StoreModule extends WeModule {
	public function welcomeDisplay() {
		header('Location: ' . $this->createWebUrl('goodsbuyer', array('direct' => 1)));
		exit();
	}
}
