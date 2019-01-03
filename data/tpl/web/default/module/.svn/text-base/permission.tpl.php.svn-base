<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php  if($do == 'display') { ?>
<div class="clearfix">
	<div class="we7-padding-bottom clearfix">
		<?php  if(empty($module['main_module'])) { ?>
		<div class="pull-right">
			<a href="<?php  echo url('module/permission/post', array('m' => $module_name))?>" class="btn btn-primary we7-padding-horizontal">添加操作员</a>
		</div>
		<?php  } ?>
	</div>
	<table class="table we7-table table-hover">
		<thead class="navbar-inner">
		<tr>
			<th class="text-center" style="width:100px;">操作员名称</th>
			<th class="text-center" style="width:150px">权限信息</th>
			<th class="text-right" style="width:100px;">操作</th>
		</tr>
		</thead>
		<tbody>
		<?php  if(!empty($user_permissions)) { ?>
		<?php  if(is_array($user_permissions)) { foreach($user_permissions as $item) { ?>
			<tr>
				<td class="text-center" style="width:50px;"><?php  echo $item['user_info']['username'];?></td>
				<td class="text-center">
					<?php  if(!empty($item['permission']) && !array_key_exists('all', $item['permission'])) { ?>
						<?php  if(is_array($item['permission'])) { foreach($item['permission'] as $permission) { ?>
						<span class="label label-primary"><?php  echo $permission;?></span>
						<?php  } } ?>
					<?php  } else { ?>
						<span class="label label-primary">所有</span>
					<?php  } ?>
				</td>
				<td style="width:100px;">
					<div class="link-group" >
						<?php  if(empty($module['main_module'])) { ?>
							<a href="<?php  echo url('module/permission/post', array('uid' => $item['uid'], 'm' => $module_name));?>">编辑</a>
							<a href="<?php  echo url('module/permission/delete', array('uid' => $item['uid'], 'm' => $module_name));?>" class="del">删除</a>
						<?php  } else { ?>
							<span>---</span>
						<?php  } ?>
					</div>
				</td>
			</tr>
		<?php  } } ?>
		<?php  } else { ?>
		<tr ng-if="!wechats">
			<td colspan="3" class="text-center">暂无数据</td>
		</tr>
		<?php  } ?>
		</tbody>
	</table>
</div>
<?php  } ?>
<?php  if($do == 'post') { ?>
<div class="clearfix">
	<form action="" method="post" class="form-horizontal ajaxfrom we7-form" role="form" id="form-user">
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">用户名</label>
			<div class="col-sm-10 col-lg-9 col-xs-12">
				<input id="" name="username" type="text" class="form-control" value="<?php  echo $user['username'];?>" />
				<span class="help-block">请输入用户名，用户名为 3 到 15 个字符组成，包括汉字，大小写字母（不区分大小写）</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">密码</label>
			<div class="col-sm-10 col-lg-9 col-xs-12">
				<input id="password" name="password" type="password" class="form-control" value="" autocomplete="off" />
				<span class="help-block">请填写密码，最小长度为 8 个字符</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">确认密码</label>
			<div class="col-sm-10 col-lg-9 col-xs-12">
				<input id="repassword" name="repassword" type="password" class="form-control" value="" autocomplete="off" />
				<span class="help-block">重复输入密码，确认正确输入</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">备注</label>
			<div class="col-sm-10 col-lg-9 col-xs-12">
				<textarea id="" name="remark" style="height:80px;" class="form-control"><?php  echo $user['remark'];?></textarea>
				<span class="help-block">方便注明此用户的身份</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">权限设置</label>
			<div class="col-sm-10 col-lg-10 col-xs-12">
				<?php  if(is_array($all_permission)) { foreach($all_permission as $key => $module_val) { ?>
					<div class="col-sm-10 col-lg-10 col-xs-12 plugin-name"><?php  echo $module_val['info']['title'];?><span class="color-gray">（不设置代表拥有所有权限）</span></div>
					<?php  if(is_array($module_val['permission'])) { foreach($module_val['permission'] as $sub_key => $permission) { ?>
					<div class="col-sm-4">
						<div class="checkbox">
							<input id="check-child-<?php  echo $key;?>-<?php  echo $sub_key;?>" type="checkbox" value="<?php  echo $permission['permission'];?>" name="module_permission[<?php  echo $module_val['info']['name'];?>][]" <?php  if(!empty($permission['checked'])) { ?>checked<?php  } ?>>
							<label for="check-child-<?php  echo $key;?>-<?php  echo $sub_key;?>"><?php  echo $permission['title'];?></label>
						</div>
					</div>
					<?php  } } ?>
				<?php  } } ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-md-offset-2 col-lg-offset-1 col-xs-12 col-sm-10 col-md-10 col-lg-11">
				<input type="submit" class="btn btn-primary span3" name="submit" value="提交" />
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			</div>
		</div>
	</form>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>