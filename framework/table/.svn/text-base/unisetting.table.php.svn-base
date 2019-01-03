<?php
/**
 */

defined('IN_IA') or exit('Access Denied');
class UnisettingTable extends We7Table {

	protected $tableName = 'uni_settings';
	protected $primaryKey = 'uniacid';

	public function getOauthByUniacid($uniacid) {
		return $this->query->where('uniacid', $uniacid)->get();
	}
}