<?php
/**
 */

defined('IN_IA') or exit('Access Denied');
load()->table('account');
class WxappTable extends AccountTable {
	
	protected $tableName ='wxapp_versions';
	private $version_table = 'wxapp_versions';
	
	
	public function latestVersion($uniacid) {
		if (empty($uniacid)) {
			return array();
		}
		return $this->query->from($this->version_table)
				->where('uniacid', $uniacid)
				->orderby('id', 'desc')->limit(4)->getall('id');
	}


	public function last($uniacid) {
		return $this->query->from($this->version_table)
			->where('uniacid', $uniacid)
			->orderby('id', 'desc')->limit(1)->get();
	}

	public function wxappInfo($uniacid) {
		return $this->query->from('account_wxapp')->where('uniacid', $uniacid)->getall('uniacid');
	}

}