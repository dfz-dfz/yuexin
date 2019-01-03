<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
	.require{color:red;}
	.info{padding:6px;width:400px;margin:-20px auto 3px auto;text-align:center;}
</style>
<ul class="nav nav-tabs">
	<li <?php  if($op == 'list') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('account', array('op' => 'list'));?>"> 账号列表</a></li>
	<li <?php  if($op == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('account', array('op' => 'post'));?>">添加账号</a></li>
</ul>
<?php  if($op == 'post') { ?>
<div class="clearfix">
	<form class="form-horizontal form" id="form1" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php  echo $id;?>">
		<div class="panel panel-default">
			<div class="panel-heading">账号信息</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>登陆账号</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="username" value="<?php  echo $account['username'];?>" class="form-control">
						<div class="help-block">请输入登陆账号，登陆账号为 3 到 15 个字符组成，包括汉字，大小写字母（不区分大小写）</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>密码</label>
					<div class="col-sm-9 col-xs-12">
						<input type="password" name="password" value="" class="form-control">
						<div class="help-block">请填写密码，最小长度为 8 个字符.<?php  if($account['uid'] > 0) { ?>如果不更改密码此处请留空<?php  } ?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>确认密码</label>
					<div class="col-sm-9 col-xs-12">
						<input type="password" name="repassword" value="" class="form-control">
						<div class="help-block">重复输入密码，确认正确输入.<?php  if($account['uid'] > 0) { ?>如果不更改密码此处请留空<?php  } ?></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>所属门店</label>
					<div class="col-sm-9 col-xs-12">
						<select name="sid" class="form-control">
							<option value="">选择所属门店</option>
							<?php  if(is_array($stores)) { foreach($stores as $store) { ?>
							<option value="<?php  echo $store['id'];?>" <?php  if($store['id'] == $account['sid']) { ?>selected<?php  } ?>><?php  echo $store['title'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>状态</label>
					<div class="col-sm-9 col-xs-12">
						<label class="radio-inline">
							<input type="radio" name="status" value="2" <?php  if($account['status'] == 2 || !$account['status']) { ?>checked<?php  } ?>>启用
						</label>
						<label class="radio-inline">
							<input type="radio" name="status" value="1" <?php  if($account['status'] == 1) { ?>checked<?php  } ?>>禁用
						</label>
					</div>
				</div>

			</div>
		</div>
		<div class="form-group col-sm-12">
			<input name="submit" id="submit" type="submit" value="提交" class="btn btn-primary col-lg-1">
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		</div>
	</form>
</div>
<script>
	var id = '<?php  echo $id;?>';
	$('#form1').submit(function(){
		var username = $.trim($(':text[name="username"]').val());
		if (!username) {
			util.message('请填写登陆账号');
			return false;
		}
		<?php  if(!$account['uid']) { ?>
			var password = $.trim($('input[name="password"]').val());
			if (!password || password.length < 8) {
				util.message('密码不能小于8位数');
				return false;
			}
			var repassword = $.trim($('input[name="repassword"]').val());
			if (password != repassword) {
				util.message('两次密码输入不一致');
				return false;
			}
		<?php  } ?>

		var store_id = $.trim($('select[name="sid"]').val());
		if (!store_id) {
			util.message('请选择店员所在的门店.<br>');
			return false;
		}
		return true;
	});

</script>
<?php  } else if($op == 'list') { ?>
<div class="main table-responsive">
	<form method="post" class="form-horizontal" id="form1">
		<div class="panel panel-default">
			<div class="panel-body table-responsive">
				<table class="table table-hover">
					<thead>
					<tr>
						<th>门店logo</th>
						<th>门店名称</th>
						<th>登陆账号</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
					<?php  if(is_array($data)) { foreach($data as $item) { ?>
					<tr>
						<td><img src="<?php  echo tomedia($stores[$item['sid']]['logo']);?>" width="50"></td>
						<td><?php  echo $stores[$item['sid']]['title'];?></td>
						<td><?php  echo $users[$item['uid']]['username'];?></td>
						<td>
							<?php  if($users[$item['uid']]['status'] == 1) { ?>
								<span class="label label-danger">已禁用</span>
							<?php  } else { ?>
								<span class="label label-success">启用</span>
							<?php  } ?>
						</td>
						<td>
							<a href="<?php  echo $this->createWebUrl('account',array('op' => 'post', 'id' => $item['id']));?>" title="编辑" class="btn btn-default">编辑</a>
							<a href="<?php  echo $this->createWebUrl('account',array('op' => 'del', 'id' => $item['id']));?>" title="删除" class="btn btn-default" onclick="return confirm('此操作不可恢复，确认删除？');return false;">删除</a>
						</td>
					</tr>
					<?php  } } ?>
					</tbody>
				</table>
			</div>
		</div>
		<?php  echo $pager;?>
	</form>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>