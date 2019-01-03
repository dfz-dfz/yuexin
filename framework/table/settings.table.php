<?php
/**
 */

defined('IN_IA') or exit('Access Denied');

class SettingsTable extends We7Table {
	public function searchSetting($key) {
		return $this->query->from('core_settings')
			->select('value')
			->where('key', $key)
			->get();
	}
}