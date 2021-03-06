<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="we7-page-title">用户管理 </div>
<ul class="we7-page-tab">
	<li><a href="<?php  echo url('user/myxiaji');?>">用户管理</a></li>
	<li <?php  if($_GPC['do'] == 'check_display') { ?>class="active"<?php  } ?>><a href="<?php  echo url('user/myxiaji/check_display');?>">审核用户</a></li>
	<li <?php  if($_GPC['do'] == 'recycle_display') { ?>class="active"<?php  } ?>><a href="<?php  echo url('user/myxiaji/recycle_display');?>">用户回收站</a></li>
	<li class="active"><a href="<?php  echo url('user/myxiajiadd');?>">添加用户</a></li>
</ul>
<script type="text/javascript">
		$('#form-user').submit(function(e){
			if($.trim($(':text[name="username"]').val()) == '') {
				util.message('没有输入用户名.', '', 'error');
				return false;
			}
			if($('#password').val() == '') {
				util.message('没有输入密码.', '', 'error');
				return false;
			}
			if($('#password').val().length < 8) {
				util.message('密码长度不能小于8个字符.', '', 'error');
				return false;
			}
			if($('#password').val() != $('#repassword').val()) {
				util.message('两次输入的密码不一致.', '', 'error');
				return false;
			}
			if($('#groupid option:selected').val() == '') {
				util.message('请选择所属用户组.', '', 'error');
				return false;
			}

		});
</script>
<div class="clearfix">
	<form action="<?php  echo url('user/myxiajiadd')?>" method="post" class="form-horizontal ajaxfrom" role="form" id="form-user">
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
				<input id="repassword" type="password" class="form-control" value="" autocomplete="off" />
				<span class="help-block">重复输入密码，确认正确输入</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">所属用户组</label>
			<div class="col-sm-10 col-lg-9 col-xs-12">
				<select name="groupid" class="form-control" id="groupid">
					<option value="0">请选择所属用户组</option>
					<?php  if(is_array($groups)) { foreach($groups as $row) { ?>
					<option value="<?php  echo $row['id'];?>"><?php  echo $row['name'];?></option>
					<?php  } } ?>
				</select>
				<span class="help-block">分配用户所属用户组后，该用户会自动拥有此用户组内的模块操作权限</span>
				<span class="help-block"><strong class="text-danger">设置用户组后，系统会根据对应用户组的服务期限对用户的服务开始时间和结束时间进行初始化</strong></span>
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
			<div class="col-sm-offset-2 col-md-offset-2 col-lg-offset-1 col-xs-12 col-sm-10 col-md-10 col-lg-11">
				<input type="submit" class="btn btn-primary span3" name="submit" value="确认注册" />
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			</div>
		</div>
	</form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>

