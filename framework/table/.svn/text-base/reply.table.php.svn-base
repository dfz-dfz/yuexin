<?php
/**
 */

defined('IN_IA') or exit('Access Denied');
class ReplyTable extends We7Table {

	public function getModuleReplayCount($modules, $rid) {
		$result['sum'] = 0;
		foreach ($modules as $module) {
			$result[$module] = $this->query->from($module.'_reply')->where('rid', $rid)->count();
			$result['sum'] += $result[$module];
		}
		return $result;
	}
}