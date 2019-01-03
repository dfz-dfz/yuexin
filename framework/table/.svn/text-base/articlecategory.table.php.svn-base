<?php
/**
 */

defined('IN_IA') or exit('Access Denied');

class ArticlecategoryTable extends We7Table {
	protected $tableName = 'article_category';

	public function getNewsCategoryLists() {
		return $this->query->from($this->tableName)->where('type', 'news')->orderby('displayorder', 'DESC')->getall();
	}

	public function getNoticeCategoryLists() {
		return $this->query->from($this->tableName)->where('type', 'notice')->orderby('displayorder', 'DESC')->getall('id');
	}
}