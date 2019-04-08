<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ol class="breadcrumb">
	<li><a href="./?refresh"><i class="fa fa-home"></i></a></li>
	<li><a href="<?php  echo url('system/welcome');?>">系统</a></li>
	<li class="active">域名绑定</li>
</ol>
<div class="clearfix">
	<form class="form-horizontal" action="" method="POST">
	    <div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">绑定域名</label>
			<div class="col-sm-3 col-xs-12">
				<input type="text" name="yuming" class="form-control" value="<?php  echo $yuming;?>" /> 不要带http://
			</div>
	    </div>
		<div class="form-group">
		<div class="col-sm-offset-2 col-md-offset-2 col-lg-offset-1 col-xs-12 col-sm-10 col-md-10 col-lg-11">
          <input type="submit" name="submit" class="btn btn-info" value="提交" />
          <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
		</div>
	</form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>