<?php defined('IN_IA') or exit('Access Denied');?><ul class="nav nav-tabs">
	<li><a href="<?php  echo $this->createWebUrl('store');?>"><i class="fa fa-reply-all"></i> 返回门店列表</a></li>
	<li <?php  if($do == 'store' && $op == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('store', array('op' => 'post', 'id' => $sid));?>">门店信息</a></li>
	<li <?php  if($op == 'cate_list' || $op == 'cate_post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'cate_list'));?>">菜品分类</a></li>
	<li <?php  if($op == 'dish_list' || $op == 'dish_post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'dish_list'));?>">菜品列表</a></li>
	<?php  if($op == 'dish_post' && $id) { ?> <li><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'dish_post', array('id' => $id)));?>">编辑菜品</a></li><?php  } ?>
	<li <?php  if($op == 'order' || $op == 'orderdetail') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'order', array('id' => $id)));?>">订单管理</a></li>
	<li <?php  if($op == 'stat_detail' || $op == 'stat_day') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'stat_detail'));?>">订单统计</a></li>
	<li <?php  if($op == 'print_list' || $op == 'print_post') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'print_list'));?>">打印机管理</a></li>
	<?php  if($op == 'print_log') { ?><li class="active"><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'print_log', 'id' => $id));?>">打印记录</a></li><?php  } ?>
	<li <?php  if($op == 'clerk_post' || $op == 'clerk_list' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'clerk_list'));?>">店员管理</a></li>
	<li <?php  if($op == 'trash_list' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'trash_list'));?>">黑名单</a></li>
	<li <?php  if($op == 'comment_list' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'comment_list'));?>">评论列表</a></li>
	<li <?php  if($op == 'back_order') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'back_order'));?>">后台点餐</a></li>
	<li <?php  if($do == 'assign') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('assign');?>">排号管理</a></li>
	<li <?php  if($do == 'table') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('table');?>">桌台管理</a></li>
	<li <?php  if($do == 'reserve') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('reserve');?>">预定管理</a></li>
	<li <?php  if($do == 'spec') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('spec');?>">套餐規格管理</a></li>
</ul>
