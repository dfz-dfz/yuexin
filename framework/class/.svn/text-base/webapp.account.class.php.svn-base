<?php
/**
 */

defined('IN_IA') or exit('Access Denied');

class WebappAccount extends WeAccount {
	public function __construct($account = array()) {
		$this->menuFrame = 'webapp';
		$this->type = ACCOUNT_TYPE_WEBAPP_NORMAL;
		$this->typeName = 'WEBAPP';
		$this->typeTempalte = '-webapp';
	}

	public function checkIntoManage() {
		if (empty($this->account) || (!empty($this->uniaccount['account']) && $this->uniaccount['type'] != ACCOUNT_TYPE_WEBAPP_NORMAL && !defined('IN_MODULE'))) {
			return false;
		}
		return true;
	}

	public function fetchAccountInfo() {
		$account_table = table('account');
		$account = $account_table->getWebappAccount($this->uniaccount['acid']);
		return $account;
	}

	public function accountDisplayUrl() {
		return url('webapp/display');
	}
}