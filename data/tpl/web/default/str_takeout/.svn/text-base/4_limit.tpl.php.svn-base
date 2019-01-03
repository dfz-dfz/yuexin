<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
	.require{color:red;}
	.info{padding:6px;width:400px;margin:-20px auto 3px auto;text-align:center;}
</style>
<ul class="nav nav-tabs">
	<li class="active"><a href="<?php  echo $this->createWebUrl('store');?>"> 门店限制列表</a></li>
</ul>
<?php  if($op == 'list') { ?>
<div class="clearfix">
	<div class="alert alert-info">
		1.该页面仅限超级管理员可访问<br>
		2.如果没有给公众号设置可添加的门店数量，则代表可无限添加门店
	</div>
	<div class="panel panel-info">
		<div class="panel-heading">筛选</div>
		<div class="panel-body">
			<form action="./index.php" method="get" class="form-horizontal" role="form">
				<input type="hidden" name="c" value="site">
				<input type="hidden" name="a" value="entry">
				<input type="hidden" name="m" value="str_takeout">
				<input type="hidden" name="do" value="limit"/>
				<input type="hidden" name="op" value="list"/>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">当前公众号名称</label>
					<div class="col-sm-9 col-xs-12">
						<p class="form-control-static"><?php  echo $_W['account']['name'];?></p>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">公众号名称或uniacid</label>
					<div class="col-sm-7 col-lg-8 col-md-8 col-xs-12">
						<input class="form-control" name="title" id="" type="text" value="<?php  echo $_GPC['title'];?>">
					</div>
					<div class="col-xs-12 col-sm-3 col-md-2 col-lg-1">
						<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<form class="form-horizontal" action="" method="post">
		<div class="panel panel-default">
			<div class="panel-body table-responsive">
				<table class="table table-hover">
					<thead class="navbar-inner">
						<tr>
							<th>uniacid</th>
							<th>公众号名称</th>
							<th>可添加门店数量</th>
							<th style="width:200px; text-align:right;">操作</th>
						</tr>
					</thead>
					<tbody>
						<?php  if(is_array($accounts)) { foreach($accounts as $item) { ?>
						<tr>
							<td><?php  echo $item['uniacid'];?></td>
							<td><?php  echo $item['name'];?></td>
							<td>
								<?php  if(empty($limits[$item['uniacid']]['num_limit'])) { ?>
									<span class="label label-success">无限制</span>
								<?php  } else { ?>
									<span class="label label-danger"><?php  echo $limits[$item['uniacid']]['num_limit'];?></span>
								<?php  } ?>
							</td>
							<td style="text-align:right;">
								<a href="javascript:;" data-uniacid="<?php  echo $item['uniacid'];?>" data-num="<?php  echo $limits[$item['uniacid']]['num_limit'];?>" data-name="<?php  echo $item['name'];?>" class="btn btn-default num_limit">设置数量</a>
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
<?php  } else { ?>
<?php  } ?>
<!-- 模态框 -->
<div class="modal fade bs-example-modal-lg" id="num-madel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">设置可添加门店数量</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form" id="form1" action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">公众号名称</label>
						<div class="col-sm-9 col-xs-12">
							<p class="form-control-static" id="uniacid_name"></p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">数量</label>
						<div class="col-sm-9 col-xs-12">
							<input class="form-control" type="text" name="num_limit" id="num_limit" placeholder="设置可添加门店数量">
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				<button type="button" class="btn btn-primary">确定</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('.num_limit').click(function(){
		var uniacid = $(this).data('uniacid');
		var name = $(this).data('name');
		var num = $(this).data('num');
		$('#num-madel').find('#uniacid_name').html(name);
		$('#num-madel').find('#num_limit').val(num);
		$('#num-madel').modal('show');
		$('#num-madel .btn-primary').click(function(){
			var num = parseInt($('#num-madel #num_limit').val());
			if(!num) {
				require(['util'], function(u){
					u.message('请填写数量', '', 'error');
					return false;
				});
				return false;
			}
			$.post("<?php  echo $this->createWebUrl('limit', array('op' => 'num'));?>", {'uniacid':uniacid, 'num':num}, function(data){
				if(data == 'success') {
					location.reload();
				} else {
					require(['util'], function(u){
						u.message('设置数量失败', '', 'error');
					});
				}
				return false;
			});
			return false;
		});
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>