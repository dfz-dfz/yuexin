<?php defined('IN_IA') or exit('Access Denied');?><ul class="we7-page-tab">
	<li <?php  if(($do == 'display' || $do == 'post') && $action == 'member') { ?> class="active"<?php  } ?>>
	<a href="<?php  echo url('mc/member')?>">会员管理</a>
	</li>
	<li <?php  if($_GPC['a'] == 'group') { ?> class="active"<?php  } ?>>
	<a href="<?php  echo url('mc/group')?>">会员组</a>
	</li>
	<li<?php  if($do == 'uc') { ?> class="active"<?php  } ?>>
	<a href="<?php  echo url('site/editor/uc')?>">会员中心</a>
	</li>
	<li <?php  if($do == 'quickmenu') { ?> class="active"<?php  } ?>>
	<a href="<?php  echo url('site/editor/quickmenu')?>">快捷菜单</a>
	</li>
	<li <?php  if($do == 'credit_setting') { ?> class="active"<?php  } ?>>
	<a href="<?php  echo url('mc/member/credit_setting')?>">积分设置</a>
	</li>
	<li <?php  if($do == 'register_setting') { ?> class="active"<?php  } ?>>
	<a href="<?php  echo url('mc/member/register_setting')?>">注册设置</a>
	</li>
	<li <?php  if($action == 'fields') { ?> class="active"<?php  } ?>>
	<a href="<?php  echo url('mc/fields')?>">会员字段管理</a>
	</li>
</ul>