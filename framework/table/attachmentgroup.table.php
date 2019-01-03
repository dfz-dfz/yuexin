<?php
/**
 */
class AttachmentgroupTable extends We7Table {

	protected $tableName = 'attachment_group';
	protected $field = array('uid', 'uniacid', 'name', 'type');


	public function searchWithUniacidOrUid($uniacid, $uid) {
		if (empty($uniacid)) {
			$this->query->where('uid', $uid);
		} else {
			$this->query->where('uniacid', $uniacid);
		}
		return $this;
	}

	
	public function deleteByUniacid($uniacid) {
		return $this->where('uniacid', $uniacid)->delete();
	}
}