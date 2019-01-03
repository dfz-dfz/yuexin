<?php
/**
 */

defined('IN_IA') or exit('Access Denied');
class RuleTable extends We7Table {
	protected $tableName = 'rule';
	protected $primaryKey = 'id';
	protected $field = array('uniacid', 'name', 'module', 'containtype', 'displayorder', 'status', 'reply_type');
}