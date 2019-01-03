<?php
/**
 * [WECHAT 2017]
 * [WECHAT  a free software]
 */
if ($action != 'display') {
	define('FRAME', 'system');
}
if ($controller == 'account' && $action == 'manage') {
	if ($_GPC['account_type'] == ACCOUNT_TYPE_APP_NORMAL) {
		define('ACTIVE_FRAME_URL', url('account/manage/display', array('account_type' => ACCOUNT_TYPE_APP_NORMAL)));
	}
}

$account_param = WeAccount::createByType($_GPC['account_type']);
define('ACCOUNT_TYPE', $account_param->type);
define('ACCOUNT_TYPE_NAME', $account_param->typeName);
define('ACCOUNT_TYPE_TEMPLATE', $account_param->typeTempalte);
