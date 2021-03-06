<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
	.require{color:red;}
	.note{cursor:pointer;}
	.info{padding:6px;width:400px;margin:-20px auto 3px auto;text-align:center;}
	.order-nav {margin: 0;width: 100%;min-width: 800px;}
	.order-nav > li > a {display: block;}
	.order-nav-tabs {background: #EEE;}
	.order-nav-tabs > li {line-height: 40px;float: left;list-style: none;display: block;text-align: -webkit-match-parent;}
	.order-nav-tabs > li > a {font-size: 14px;color: #666;height: 40px;line-height: 40px;padding: 0 10px;margin: 0;border: 1px solid transparent;border-bottom-width: 0px;-webkit-border-radius: 0;-moz-border-radius: 0;border-radius: 0;}
	.order-nav-tabs > li > a, .order-nav-tabs > li > a:focus {border-radius: 0 !important;background-color: #f9f9f9;color: #999;margin-right: -1px;position: relative;z-index: 11;border-color: #c5d0dc;text-decoration: none;}
	.order-nav-tabs >li >a:hover {background-color: #FFF;}
	.order-nav-tabs > li.active > a, .order-nav-tabs > li.active > a:hover, .order-nav-tabs > li.active > a:focus {color: #576373;border-color: #c5d0dc;border-top: 2px solid #4c8fbd;border-bottom-color: transparent;background-color: #FFF;z-index: 12;margin-top: -1px;box-shadow: 0 -2px 3px 0 rgba(0, 0, 0, 0.15);}	
</style>
<div class="alert alert-info info">
	<i class="fa fa-info-circle"></i>
	当前门店名称: <?php  echo $store['title'];?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('nav', TEMPLATE_INCLUDEPATH)) : (include template('nav', TEMPLATE_INCLUDEPATH));?>
	<div class="main">
		<div class="panel panel-info">
			<div class="panel-heading">筛选</div>
			<div class="panel-body">
				<form action="./index.php" method="get" class="form-horizontal" role="form">
					<input type="hidden" name="c" value="site">
					<input type="hidden" name="a" value="entry">
					<input type="hidden" name="m" value="str_takeout">
					<input type="hidden" name="do" value="manage"/>
					<input type="hidden" name="op" value="comment_list"/>
					<input type="hidden" name="status" value="<?php  echo $_GPC['status'];?>"/>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单id</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<input class="form-control" name="oid" placeholder="输入订单id" type="text" value="<?php  echo $_GPC['oid'];?>">
						</div>	
					</div>
					<div class="form-group clearfix">
						<label class="col-xs-12 col-sm-2 col-md-2 control-label">评论时间</label>
						<div class="col-sm-7 col-lg-8 col-md-8 col-xs-12">
							<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d', $starttime), 'end' => date('Y-m-d', $endtime)));?>
						</div>
						<div class="col-xs-12 col-sm-3 col-md-2 col-lg-1">
							<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<form class="form-horizontal" action="" method="post">
			<ul class="order-nav order-nav-tabs" style="background:none;float: left;margin-left: 0px;padding-left: 0px;border-bottom:1px #c5d0dc solid;">
				<li<?php  if(empty($status)) { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'comment_list', 'status' => 0))?>">全部评论</a></li>
				<li<?php  if($status == 3) { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'comment_list', 'status' => 3))?>">待审核</a></li>
				<li<?php  if($status == 1) { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'comment_list', 'status' => 1))?>">审核通过</a></li>
				<li<?php  if($status == 2) { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'comment_list', 'status' => 2))?>">审核未通过</a></li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-body table-responsive" style="overflow:inherit">
					<table class="table table-hover">
						<thead class="navbar-inner">
							<tr>
								<th>评论用户</th>
								<th>订单id</th>
								<th>状态</th>
								<th>菜品口味</th>
								<th>服务态度</th>
								<th>配送速度</th>
								<th>评价</th>
								<th style="width:150px">评论时间</th>
								<th style="width:170px; text-align:right;">操作</th>
							</tr>
						</thead>
						<tbody>
							<?php  if(is_array($data)) { foreach($data as $dca) { ?>
							<tr>
								<td><b><?php  echo $dca['id'];?></b></td>
								<td><?php  echo $dca['oid'];?></td>
								<td>
									<?php  if($dca['status'] == 1) { ?>
										<span class="label label-success">审核通过</span>
									<?php  } else if($dca['status'] == 2) { ?>
										<span class="label label-danger">审核未通过</span>
									<?php  } else { ?>
										<span class="label label-default">审核中</span>
									<?php  } ?>
								</td>
								<td>
									<?php 
										for($i = 0; $i < $dca['taste']; $i++) {
											echo '<i class="fa fa-star"></i>';
										}
										for($i = $dca['taste']; $i < 5; $i++) {
											echo '<i class="fa fa-star-o"></i>';
										}
									?>
								</td>
								<td>
									<?php 
										for($i = 0; $i < $dca['serve']; $i++) {
											echo '<i class="fa fa-star"></i>';
										}
										for($i = $dca['serve']; $i < 5; $i++) {
											echo '<i class="fa fa-star-o"></i>';
										}
									?>
								</td>
								<td>
									<?php 
										for($i = 0; $i < $dca['speed']; $i++) {
											echo '<i class="fa fa-star"></i>';
										}
										for($i = $dca['speed']; $i < 5; $i++) {
											echo '<i class="fa fa-star-o"></i>';
										}
									?>
								</td>
								<td><span class="note" data-title="<?php  echo $dca['note'];?>"><?php  echo cutstr($dca['note'], 15, '...');?></span></td>
								<td><?php  echo date('Y-m-d H:i', $dca['addtime'])?></td>
								<td style="text-align:right;">
									<a href="<?php  echo $this->createWebUrl('manage', array('op' => 'comment_status', 'id' => $dca['id'], 'status' => 1))?>" class="btn btn-success btn-sm" title="审核通过" data-toggle="tooltip" data-placement="top">审核通过</a>
									<a href="<?php  echo $this->createWebUrl('manage', array('op' => 'comment_status', 'id' => $dca['id'], 'status' => 2))?>" class="btn btn-danger btn-sm" title="审核未通过" data-toggle="tooltip" data-placement="top">审核未通过</a>
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
	<script type="text/javascript">
		$('.note').hover(function(){
			$(this).popover({
				html : true,
				placement : 'bottom',
				trigger : 'manual',
				title : '',
				content : $(this).attr('data-title')
			});
			$(this).popover('toggle');
		});
		require(['util'], function(u){
			$('.print').click(function(){
				if(!confirm('确定打印该订单吗？')) {
					return false;
				}
				var id = $(this).attr('data-id');
				$.post("<?php  echo $this->createWebUrl('manage', array('op' => 'ajaxprint'))?>", {'id' : id}, function(data) {
					if(data != 'success') {
						u.message(data, '', 'error');
					} else {
						location.reload();
					}
				});
				return false;
			});

		});
	</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
