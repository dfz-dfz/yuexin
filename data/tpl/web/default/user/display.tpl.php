<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('user/user-header', TEMPLATE_INCLUDEPATH)) : (include template('user/user-header', TEMPLATE_INCLUDEPATH));?>
<div class="keyword-list-head clearfix we7-margin-bottom">
	<form action="" method="get">
		<input type="hidden" name="c" value="user">
		<input type="hidden" name="a" value="display">
		<input type="hidden" name="do" value="<?php  echo $_GPC['do'];?>">
		<input type="hidden" name="type" value="<?php  echo $_GPC['type'];?>">
		<label for="" class="col-sm-1 control-label">用户组</label>
		<div class="input-controls col-sm-3">
			<select name="groupid" class="we7-select form-control">
				<option value="" selected="selected">不限</option>
				<?php  if(is_array($user_groups)) { foreach($user_groups as $group) { ?>
				<option value="<?php  echo $group['id'];?>"<?php  if($group['id'] == $_GPC['groupid']) { ?> selected="selected"<?php  } ?>><?php  echo $group['name'];?></option>
				<?php  } } ?>
			</select>
		</div>
		<div class="input-group pull-left col-sm-4">
			<input type="text" name="search" id="" value="<?php  echo $_GPC['search'];?>" class="form-control"  placeholder="搜索用户名或手机号" />
			<span class="input-group-btn"><button class="btn btn-default"><i class="fa fa-search"></i></button></span>
		</div>
	</form>
	<div class="pull-right">
		<?php  if($_W['isfounder']) { ?><a href="<?php  echo url('system/uppinyin/users');?>" class="btn btn-primary">更新数据</a><?php  } ?>
		<?php  if($_GPC['type'] == 'display' || $_GPC['type'] == '') { ?><a href="<?php  echo url('user/create');?>" class="btn btn-primary">+添加用户</a><?php  } ?>
	</div>
</div>
<table class="table we7-table table-hover table-manage vertical-middle" id="js-users-display" ng-controller="UsersDisplay" ng-cloak>
	<col width="150px"/>
	<col width="150px">
	<col width="170px"/>
	<col width="100px"/>
	<col width="100px"/>
	<col width="80px"/>
	<col width="80px"/>
	<col width="130px"/>
	<col width="130px"/>
	<col width="150px"/>
	<tr>
		<th></th>
		<th class="text-left">用户名</th>
		<th>用户权限组</th>
		<th>公众号</th>
		<th>小程序</th>
		<th>pc</th>
		<th>APP</th>
		<th>注册时间</th>
		<th>到期时间</th>
		<th class="text-right">操作</th>
	</tr>
	<tr ng-repeat="user in users" ng-if="users">
		<td class="td-link">
			<a ng-href="{{links.edit}}uid={{user.uid}}">
				<img src="{{user.avatar}}" alt="" class="img-responsive icon"/>
			</a>
		</td>
		<td><span ng-bind="user.username"></span><br/><span ng-bind="user.mobile"></span></td>
		<td>
			<span class="color-default" ng-if="user.founder">管理员</span>
			<span class="color-default" ng-if="user.groupname && !user.founder" ng-bind="user.groupname"></span>
			<span class="color-default" ng-if="!user.groupname && !user.founder">未分配</span>
		</td>
		<td class="color-default" ng-bind="user.maxaccount"></td>
		<td class="color-default" ng-bind="user.maxwxapp"></td>
		<td class="color-default" ng-bind="user.maxwebapp"></td>
		<td class="color-default" ng-bind="user.maxphoneapp"></td>
		<td>
			<span ng-bind="user.joindate"></span>
		</td>
		<td>
			<span ng-bind="user.endtime"></span>
		</td>
		<td class="vertical-middle table-manage-td">
			<div class="link-group" ng-if="!user.founder">
				<a ng-href="{{links.edit}}uid={{user.uid}}" ng-if="type == 'display' || type == 'clerk'">编辑</a>
				<a href="javascript:;" ng-click="operate(user.uid, 'recycle')" ng-if="type == 'display' || type == 'clerk'" data-toggle="tooltip" data-placement="left" title="禁用后可在用户回收站查找到并重新启用。">禁用</a>
				<a href="javascript:;" ng-click="operate(user.uid, 'check_pass')" ng-if="type == 'check'">通过</a>
				<a href="javascript:;" ng-click="operate(user.uid, 'recycle')" ng-if="type == 'check'" data-toggle="tooltip" data-placement="left" title="拒绝后可在用户回收站查找到并启用。">拒绝</a>
				<a href="javascript:;" ng-click="operate(user.uid, 'recycle_restore')" ng-if="type == 'recycle'">启用</a>
				<a href="javascript:;" ng-click="operate(user.uid, 'recycle_delete')" class="del" ng-if="type == 'recycle'">删除</a>
			</div>
			<div class="manage-option text-right" ng-if="!user.founder">
				<a href="{{links.edit}}uid={{user.uid}}">基础信息</a>
				<a href="{{links.edit}}&do=edit_modules_tpl&uid={{user.uid}}">应用模板权限</a>
				<a href="{{links.edit}}&do=edit_account&uid={{user.uid}}">使用账号列表</a>
			</div>
		</td>
	</tr>
	<tr ng-if="!users">
		<td colspan="7" class="text-center">暂无数据</td>
	</tr>
</table>

<div class="text-right pager-pagination-float">
	<?php  echo $pager;?>
</div>
<span class="pager-total">共<?php  echo $total?>个</span>

<script type="text/javascript">
	$(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});
	angular.module('userManageApp').value('config', {
		type: "<?php echo !empty($_GPC['type']) ? $_GPC['type'] : 'display'?>",
		users: <?php echo !empty($users) ? json_encode($users) : 'null'?>,
		usergroups: <?php echo !empty($usergroups) ? json_encode($usergroups) : 'null'?>,
		links: {
			link: "<?php  echo url('user/display/operate')?>",
			edit: "<?php  echo url('user/edit')?>",
		},
	});
	angular.bootstrap($('#js-users-display'), ['userManageApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
