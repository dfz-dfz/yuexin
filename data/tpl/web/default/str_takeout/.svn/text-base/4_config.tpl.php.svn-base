<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
	.require{color:red;}
	.info{padding:6px;width:400px;margin:-20px auto 3px auto;text-align:center;}
</style>
<ul class="nav nav-tabs">
	<li class="active"><a href="<?php  echo $this->createWebUrl('config');?>"> 参数设置</a></li>
	<li><a href="<?php  echo $this->createWebUrl('store');?>"> 返回门店列表</a></li>
</ul>
<form class="form-horizontal form" id="form1" action="" method="post" enctype="multipart/form-data">
	<div class="main">
		<div class="panel panel-default">
			<div class="panel-heading">外卖模式</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>版本设置</label>
					<div class="col-sm-9 col-xs-12">
						<label class="radio-inline">
							<input type="radio" value="2" name="version" <?php  if($config['version'] == 2) { ?>checked<?php  } ?>> 单店版本
						</label>
						<label class="radio-inline">
							<input type="radio" value="1" name="version" <?php  if($config['version'] == 1) { ?>checked<?php  } ?>> 多店版本
						</label>
						<div class="help-block text-danger">如果是独立版本，用户进入时，不会显示门店列表，直接跳转到该门店的菜单页</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>默认门店</label>
					<div class="col-sm-9 col-xs-12">
						<select class="form-control" name="default_sid">
							<option value="">==请选择默认门店==</option>
							<?php  if(is_array($stores)) { foreach($stores as $store) { ?>
							<option value="<?php  echo $store['id'];?>" <?php  if($config['default_sid'] == $store['id']) { ?>selected<?php  } ?>><?php  echo $store['title'];?></option>
							<?php  } } ?>
						</select>
						<div class="help-block text-danger">设置为单店版时,默认跳转的门店</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">短信设置</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>开启短信功能</label>
					<div class="col-sm-9 col-xs-12">
						<label class="radio-inline">
							<input type="radio" value="1" name="sms[status]" <?php  if($config['sms']['status'] == 1) { ?>checked<?php  } ?>> 开启
						</label>
						<label class="radio-inline">
							<input type="radio" value="0" name="sms[status]" <?php  if(!$config['sms']['status']) { ?>checked<?php  } ?>> 关闭
						</label>
						<div class="help-block text-danger">开启短信功能后,所有门店都可以使用该短信设置.使用短信的地方:首次下单短信验证手机号, 外送地址验证手机号.</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>短信平台账号</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="sms[name]" value="<?php  echo $config['sms']['name'];?>" class="form-control">
						<div class="help-block text-danger">使用短信提醒必须申请接口才能使用 <a href="http://www.dxton.com/" target="_blank">申请网址查看这里</a>.</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>短信平台密码</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="sms[password]" value="" class="form-control">
						<div class="help-block text-danger">因安全原因,密码不予显示.如果需要更改,请完善密码</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">微信消息通知</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>通知方式</label>
					<div class="col-sm-9 col-xs-12">
						<label class="radio-inline">
							<input type="radio" value="1" name="notice[type]" <?php  if($config['notice']['type'] == 1) { ?>checked<?php  } ?>> 客服消息通知
						</label>
						<label class="radio-inline">
							<input type="radio" value="2" name="notice[type]" <?php  if($config['notice']['type'] == 2) { ?>checked<?php  } ?>> 模板消息通知
						</label>
						<div class="help-block text-danger">此功能需要您的公众号为:"认证订阅号" 或 "认证服务号"</div>
						<div class="help-block text-danger">如果您的公众号类型为:"认证订阅号",只能设置为使用"客服消息".如果您的公众号类型为:"认证服务号",可以使用"客服消息" 或 "模板消息".</div>
					</div>
				</div>
				<div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">系统通知模板id</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<input type="text" class="form-control" name="notice[public_tpl]" value="<?php  echo $config['notice']['public_tpl'];?>">
							<div class="help-block">模板编号：OPENTM207042342。标题:系统通知. 行业:IT科技 - 互联网|电子商务. 您可以在公众平台查找该模板编号，获取模板id。该功能需要您的公众号为认证服务号</div>
						</div>
					</div>
				</div>
				<div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">排队通知模版ID</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<input type="text" class="form-control" name="notice[assign_tpl]" value="<?php  echo $config['notice']['assign_tpl'];?>">
							<div class="help-block">在模板库选择行业餐饮－餐饮，搜索“排号通知”编号为OPENTM383288748的模板.您可以在公众平台查找该模板编号，获取模板id。该功能需要您的公众号为认证服务号</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input name="submit" id="submit" type="submit" value="提交" class="btn btn-primary col-lg-1">
			</div>	
		</div>
	</div>
</form>
<script type="text/javascript">
require(['util'], function(util){
	$('#form1').submit(function(){
		if($(':radio[name="sms[status]"]:checked').val() == 1) {
			if(!$.trim($(':text[name="sms[name]"]').val())) {
				util.message('短信账号不能为空', '', 'error');
				return false;
			}
			if(!$.trim($(':text[name="sms[password]"]').val())) {
				util.message('短信密码不能为空', '', 'error');
				return false;
			}
		}
		return true;
	});
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>