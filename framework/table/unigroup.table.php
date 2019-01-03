<?php
/**
 */

class UnigroupTable extends We7Table {

	protected $tableName = 'uni_group';
	protected $primaryKey = 'id';

	
	public function uniaccounts() {
		return $this->belongsMany('account', 'uniacid', 'id', 'uni_account_group', 'uniacid', 'groupid');
	}


}