<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
	.require{color:red;}
	.info{padding:6px;width:400px;margin:-20px auto 3px auto;text-align:center;}
	.order-nav {margin: 0;width: 100%;min-width: 800px;}
	.order-nav > li > a {display: block;}
	.order-nav-tabs {background: #EEE;}
	.order-nav-tabs > li {line-height: 40px;float: left;list-style: none;display: block;text-align: -webkit-match-parent;}
	.order-nav-tabs > li > a {font-size: 14px;color: #666;height: 40px;line-height: 40px;padding: 0 10px;margin: 0;border: 1px solid transparent;border-bottom-width: 0px;-webkit-border-radius: 0;-moz-border-radius: 0;border-radius: 0;}
	.order-nav-tabs > li > a, .order-nav-tabs > li > a:focus {border-radius: 0 !important;background-color: #f9f9f9;color: #999;margin-right: -1px;position: relative;z-index: 11;border-color: #c5d0dc;text-decoration: none;}
	.order-nav-tabs >li >a:hover {background-color: #FFF;}
	.order-nav-tabs > li.active > a, .order-nav-tabs > li.active > a:hover, .order-nav-tabs > li.active > a:focus {color: #576373;border-color: #c5d0dc;border-top: 2px solid #4c8fbd;border-bottom-color: transparent;background-color: #FFF;z-index: 12;margin-top: -1px;box-shadow: 0 -2px 3px 0 rgba(0, 0, 0, 0.15);}	
	.label{line-height: 2}
	.table-log tr:first-child td{border-top: 0}
	.table-log tr td{cursor:pointer;}
</style>
<div class="alert alert-info info">
	<i class="fa fa-info-circle"></i>
	当前门店名称: <?php  echo $store['title'];?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('nav', TEMPLATE_INCLUDEPATH)) : (include template('nav', TEMPLATE_INCLUDEPATH));?>
<?php  if($op == 'order') { ?>
	<div class="main">
		<div class="panel panel-info">
			<div class="panel-heading">筛选</div>
			<div class="panel-body">
				<form action="./index.php" method="get" class="form-horizontal" role="form">
					<input type="hidden" name="c" value="site">
					<input type="hidden" name="a" value="entry">
					<input type="hidden" name="m" value="str_takeout">
					<input type="hidden" name="do" value="manage"/>
					<input type="hidden" name="op" value="order"/>
					<input type="hidden" name="status" value="<?php  echo $_GPC['status'];?>"/>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">用户信息</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<input class="form-control" name="keyword" placeholder="输入用户名或手机号" type="text" value="<?php  echo $_GPC['keyword'];?>">
						</div>	
					</div>
					<div class="form-group clearfix">
						<label class="col-xs-12 col-sm-2 col-md-2 control-label">下单时间</label>
						<div class="col-sm-6 col-lg-6 col-md-5 col-xs-12">
							<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d', $starttime), 'end' => date('Y-m-d', $endtime)));?>
						</div>
						<div class="col-xs-12 col-sm-3 col-md-2 col-lg-1">
							<button class="btn btn-default"> 搜索</button>
						</div>
						<div class="col-xs-12 col-sm-2 col-md-2 col-lg-1">
							<button class="btn btn-default" name="out_put" value="output"> 导出</button>
						</div>
						<div class="col-xs-12 col-sm-2 col-md-3	 col-lg-2">
							<button class="btn btn-default" name="out_put" value="total_output">汇总导出</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="alert alert-info">
			<i class="fa fa-info-circle"></i> 管理员可在后台给每个订单设置优惠价,每个订单只能优惠一次.<br>
			<i class="fa fa-info-circle"></i> 变更订单状态后,系统将会给粉丝发送订单状态信息.<br>
			<i class="fa fa-info-circle"></i> <span class="text-danger">如果订单需要赠送积分,需要管理员手动设置订单状态为"已完成",才能赠送积分. 赠送积分后,不能取消赠送的积分</span><br>
		</div>
		<form class="form-horizontal" action="<?php  echo $this->createWebUrl('manage', array('op' => 'status'));?>" id="form1" method="post">
			<ul class="order-nav order-nav-tabs" style="background:none;float: left;margin-left: 0px;padding-left: 0px;border-bottom:1px #c5d0dc solid;">
				<li<?php  if(empty($status) && empty($pay_type)) { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'order', 'status' => 0))?>">全部订单</a></li>
				<li<?php  if($status == 1) { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'order', 'status' => 1))?>">待确认</a></li>
				<li<?php  if($status == 2) { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'order', 'status' => 2))?>">处理中</a></li>
				<li<?php  if($status == 3) { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'order', 'status' => 3))?>">已完成</a></li>
				<li<?php  if($status == 4) { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'order', 'status' => 4))?>">已取消</a></li>
				<li<?php  if($status == 8) { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'order', 'status' => 8))?>">退款申请</a></li>
				<li<?php  if($status == 9) { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'order', 'status' => 9))?>">已退款</a></li>
				<li<?php  if($pay_type == 'alipay') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'order', 'pay_type' => 'alipay'))?>">支付宝支付</a></li>
				<li<?php  if($pay_type == 'wechat') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'order', 'pay_type' => 'wechat'))?>">微信支付</a></li>
				<li<?php  if($pay_type == 'credit') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'order', 'pay_type' => 'credit'))?>">余额支付</a></li>
				<li<?php  if($pay_type == 'delivery') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'order', 'pay_type' => 'delivery'))?>">货到付款</a></li>
			</ul>
			<div class="panel panel-default">
				<div class="table-responsive" style="overflow:inherit">
					<table class="table table-hover">
						<thead class="navbar-inner">
							<tr>
								<th width="30"></th>
								<th width="50">订单id</th>
								<th width="105">预定人/电话</th>
								<th width="80">类型</th>
								<th width="10"></th>
								<th width="80">支付方式</th>
								<th width="90">订单状态</th>
								<th width="80">打印(份数)</th>
								<th width="100">份数/总价</th>
								<th width="70">优惠券</th>
								<th width="60">优惠后价格</th>
								<th width="130">下单时间</th>
								<th style="width:170px; text-align:right;">详情/删除/黑名单</th>
							</tr>
						</thead>
						<tbody>
							<?php  if(is_array($data)) { foreach($data as $dca) { ?>
							<tr>
								<td><input type="checkbox" name="id[]" value="<?php  echo $dca['id'];?>"></td>
								<td><b><?php  echo $dca['id'];?></b></td>
								<td><?php  echo $dca['username'];?><br><?php  echo $dca['mobile'];?></td>
								<td>
									<span class="<?php  echo $types[$dca['order_type']]['css'];?>"><?php  echo $types[$dca['order_type']]['text'];?></span>
									<?php  if($dca['is_back'] == 1) { ?>
										<br>
										<span class="label label-info">后台点餐</span>
									<?php  } ?>
									<?php  if($dca['order_type'] >= 3) { ?>
										<br>
										<span class="label label-info">时间:<?php  echo date('Y-m-d H:i', $dca['reserve_time']);?></span>
										<br>
										<span class="label label-info">桌台类型:<?php  echo $dca['table']['title'];?></span>
									<?php  } ?>
								</td>
								<td>
									<?php  if($dca['order_type'] == 1) { ?>
										<span class="table_info" title="" style="cursor:pointer" data-id="<?php  echo $dca['id'];?>"><?php  echo $dca['table_info'];?></span>
									<?php  } ?>
								</td>
								<td>
									<?php  if(empty($dca['pay_type'])) { ?>
										<span class="label label-default">未支付</span>
									<?php  } else if($dca['pay_type'] == 'alipay') { ?>
										<span class="label label-info">支付宝</span>
									<?php  } else if($dca['pay_type'] == 'wechat') { ?>
										<span class="label label-success">微信支付</span>
									<?php  } else if($dca['pay_type'] == 'credit') { ?>
										<span class="label label-danger">余额支付</span>
									<?php  } else if($dca['pay_type'] == 'delivery') { ?>
										<span class="label label-warning">餐到付款</span>
									<?php  } else { ?>
										<span class="label label-success">现金支付</span>
									<?php  } ?>
								</td>
								<td>
									<?php  if($dca['status'] == 1) { ?>
										<span class="label label-danger">待确认</span>
									<?php  } else if($dca['status'] == 2) { ?>
										<span class="label label-warning">处理中</span>
									<?php  } else if($dca['status'] == 3) { ?>
										<span class="label label-success">已完成</span>
									<?php  } else if($dca['status'] == 4) { ?>
										<span class="label label-default">已取消</span>
									<?php  } else if($dca['status'] == 8) { ?>
										<span class="label label-default">退款申请</span>
									<?php  } else if($dca['status'] == 9) { ?>
										<span class="label label-default">已退款</span>
									<?php  } else { ?>
										<span class="label label-default">未知</span>
									<?php  } ?>
									<?php  if($dca['grant_credit'] > 0) { ?>
										<br>
										<?php  if($dca['is_grant'] == 1) { ?>
											<span class="label label-success">已赠送<?php  echo $dca['grant_credit'];?>积分</span>
										<?php  } else { ?>
											<span class="label label-danger">需赠送<?php  echo $dca['grant_credit'];?>积分</span>
										<?php  } ?>
									<?php  } ?>
								</td>
								<td><a href="javascript:;" class="btn btn-default btn-sm print" data-id="<?php  echo $dca['id'];?>">
									<i class="fa fa-print"></i> 
									(
										<?php  if($dca['print_nums'] > 0) { ?>
											<span style="color:green"><?php  echo $dca['print_nums'];?></span>
										<?php  } else { ?>
											<span style="color:red"><?php  echo $dca['print_nums'];?></span>
										<?php  } ?>
									)</a>
								</td>
								<td><?php  echo $dca['num'];?>份/<?php  echo $dca['price'];?>元</td>
								<td>
									<?php  if($dca['is_usecard']) { ?>
										<?php  if($dca['card_type'] == 1) { ?>
											<span class="label label-success">微信卡券</span>
										<?php  } else if($dca['card_type'] == 2) { ?>
											<span class="label label-danger">系统卡券</span>
										<?php  } else { ?>
											<span class="label label-info">人工优惠</span>
										<?php  } ?>
									<?php  } else { ?>
										<span class="label label-default use_card" title="设置优惠价格" data-id="<?php  echo $dca['id'];?>" style="cursor:pointer">未使用</span>
									<?php  } ?>
								</td>
								<td><?php  if($dca['is_usecard']) { ?><?php  echo $dca['card_fee'];?>元<?php  } ?></td>
								<td><?php  echo date('Y-m-d H:i', $dca['addtime'])?></td>
								<td style="text-align:right; overflow:visible;">
									<div class="btn-group">
										<div class="btn-group">
											<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="订单状态" data-toggle="tooltip" data-placement="top">状态 <span class="caret"></span></button>
											<ul class="dropdown-menu">
												<li><a href="<?php  echo $this->createWeburl('manage', array('op' => 'status', 'id' => $dca['id'], 'status' => 2));?>" onclick="if(!confirm('确定修改订单状态?')) return false;">已确认，处理中</a></li>
												<li><a href="<?php  echo $this->createWeburl('manage', array('op' => 'status', 'id' => $dca['id'], 'status' => 3));?>" onclick="if(!confirm('确定修改订单状态?')) return false;">设为已完成</a></li>
												<li><a href="<?php  echo $this->createWeburl('manage', array('op' => 'status', 'id' => $dca['id'], 'status' => 4));?>" onclick="if(!confirm('确定修改订单状态?')) return false;">设为已取消</a></li>
												<li><a href="<?php  echo $this->createWeburl('manage', array('op' => 'status', 'id' => $dca['id'], 'status' => 5));?>" onclick="if(!confirm('确定设置为已支付?')) return false;">设为已支付</a></li>
												<?php  if($dca['status'] == 8) { ?><li><a href="<?php  echo $this->createWeburl('manage', array('op' => 'status', 'id' => $dca['id'], 'status' => 9));?>" onclick="if(!confirm('确定同意退款?')) return false;">同意退款</a></li><?php  } ?>
											</ul>
										</div>
										<a href="<?php  echo $this->createWebUrl('manage', array('op' => 'orderdetail', 'id' => $dca['id']))?>" class="btn btn-success btn-sm" title="查看详情" data-toggle="tooltip" data-placement="top">详情</a>
										<a href="<?php  echo $this->createWebUrl('manage', array('op' => 'orderdel', 'id' => $dca['id']))?>" class="btn btn-default btn-sm hide" title="删除" data-toggle="tooltip" data-placement="top" onclick="if(!confirm('删除后将不可恢复，确定删除吗?')) return false;"><i class="fa fa-times"> </i></a>
										<a href="<?php  echo $this->createWebUrl('manage', array('op' => 'trash_add', 'id' => $dca['id']))?>" class="btn btn-default btn-sm" title="加入黑名单" data-toggle="tooltip" data-placement="top" onclick="if(!confirm('确定加入黑名单吗?')) return false;" <?php  if(!empty($dca['is_trash'])) { ?>style="color:red"<?php  } ?>><i class="fa fa-trash"> </i></a>
									</div>
								</td>
							</tr>
							<?php  } } ?>
							<tr>
								<td><input type="checkbox" id="selectall"></td>
								<td colspan="9">
									<a href="javascript:;" data-id="2" class="btn btn-primary btn-order">已确认，处理中</a>
									<a href="javascript:;" data-id="3" class="btn btn-primary btn-order">设为已完成</a>
									<a href="javascript:;" data-id="4" class="btn btn-primary btn-order">设为已取消</a>
									<a href="javascript:;" data-id="5" class="btn btn-primary btn-order">设为已支付</a>
									<?php  if($status == 8) { ?><a href="javascript:;" data-id="9" class="btn btn-primary btn-order">同意退款</a><?php  } ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<?php  echo $pager;?>
			<input type="hidden" name="status" value="0" id="status">
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
		</form>
	</div>
	<script type="text/javascript">
		require(['util'], function(u){
			$('#selectall').click(function(){
				$('#form1 :checkbox').prop('checked', $(this).prop('checked'));
			});

			$('.btn-order').click(function(){
				if($('#form1 :checkbox:checked').length == 0) {
					u.message('请选择订单', '', 'error');
					return false;
				}
				if(!confirm('确定修改订单的状态吗')) {
					return false;
				}
				$('#form1 #status').val($(this).data('id'));
				$('#form1').submit();
				return false;
			});

			$('.table_info_').click(function(){
				$(this).popover({
					html : true,
					placement : 'bottom',
					trigger : 'manual',
					content : '<input type="text" class="form-control table_edit_id" placeholder="修改桌号" style="width:100px;float:left;margin-right:10px;"> <span class="btn btn-default popover-cancel">取消</span> <span class="btn btn-primary popover-submit">确定</span>'
				});
				$(this).popover('toggle');

				var btncancel = $(this).next().find('.popover-cancel');
				var btnsubmit = $(this).next().find('.popover-submit');
				var table_edit_num = $(this).next().find('.table_edit_id');
				var $this = $(this);
				table_edit_num.off('keyup').on('keyup', function(e){
					if(e.keyCode == 13) {
						btnsubmit.click();
					}
					return false;
				});
				btncancel.off('click').on('click', function(){
					$this.popover('hide');
				});
				btnsubmit.off('click').on('click', function(){
					var id = $this.attr('data-id');
					var table_id = $this.next().find('.table_edit_id').val();
					if(!table_id) {
						return false;
					}
					$.post("<?php  echo $this->createWebUrl('manage')?>", {'op':'edit_table_id', 'id':id, 'table_id':table_id}, function(data){
						if(data != 'success') {
							u.message(data, '', 'error');
							return false;
						} else {
							location.reload();
						}
					});
				});
			});

			$('.use_card').click(function(){
				$(this).popover({
					html : true,
					placement : 'bottom',
					trigger : 'manual',
					content : '<input type="text" class="form-control price" style="width:100px;float:left;margin-right:10px;"> <span class="btn btn-default popover-cancel">取消</span> <span class="btn btn-primary popover-submit">确定</span>'
				});
				$(this).popover('toggle')

				var btncancel = $(this).next().find('.popover-cancel');
				var btnsubmit = $(this).next().find('.popover-submit');
				var btnprice = $(this).next().find('.price');
				var $this = $(this);
				btnprice.off('keyup').on('keyup', function(e){
					if(e.keyCode == 13) {
						btnsubmit.click();
					}
					return false;
				});
				btncancel.off('click').on('click', function(){
					$this.popover('hide');
				});
				btnsubmit.off('click').on('click', function(){
					var id = $this.attr('data-id');
					var price = $this.next().find('.price').val();
					$.post("<?php  echo $this->createWebUrl('manage')?>", {'op':'use_card', 'id':id, 'price':price}, function(data){
						if(data != 'success') {
							u.message(data, '', 'error');
							return false;
						} else {
							location.reload();
						}
					});
				});
			});

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
<?php  } else if($op == 'orderdetail') { ?>
	<div class="main">
		<form action="./index.php" method="get" class="form-horizontal" role="form">
			<div class="panel panel-default">
				<div class="panel-heading">菜品信息【共 <strong><?php  echo $order['num'];?></strong> 份,总价 <strong><?php  echo $order['price'];?></strong> 元】</div>
				<div class="panel-body table-responsive">
					<table class="table table-hover">
						<thead class="navbar-inner">
							<tr>
								<th>菜品</th>
								<th>份数</th>
								<th>小计(元)</th>
								<th></th>
							</tr>
							<?php  if(!empty($order['dish'])) { ?>
								<?php  if(is_array($order['dish'])) { foreach($order['dish'] as $or) { ?>
									<tr>
										<td><?php  echo $or['dish_title'];?></td>
										<td><?php  echo $or['dish_num'];?> 份</td>
										<td><?php  echo $or['dish_price'];?> 元</td>
										<td>
											<a class="btn btn-success" target="_blank" href="<?php  echo $this->createWebUrl('manage', array('op' => 'dish_post', 'id' => $or['dish_id']));?>">菜品信息</a>
										</td>
									</tr>
								<?php  } } ?>
							<?php  } ?>
						</thead>
					</table>
				</div>
			</div>
			<?php  if(!empty($logs)) { ?>
			<div class="panel panel-default">
				<div class="panel-heading">订单日志</div>
				<div class="panel-body table-responsive">
					<table class="table table-hover table-log">
						<?php  if(is_array($logs)) { foreach($logs as $log) { ?>
						<tr>
							<td><i class="fa fa-info-circle"></i> <?php  echo date('Y-m-d H:i', $log['addtime']);?> <?php  echo $log['note'];?></td>
						</tr>
						<?php  } } ?>
					</table>
				</div>
			</div>
			<?php  } ?>
			<div class="col-lg-6" style="padding:0;">
				<div class="panel panel-default">
					<div class="panel-heading">订单信息</div>
					<div class="panel-body">
						<?php  if($order['order_type'] == 1) { ?>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单类型:</label>
								<div class="col-sm-9 col-xs-9 col-md-9">
									<label class="label label-success">店内订餐</label>
								</div>	
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">桌台信息:</label>
								<div class="col-sm-9 col-xs-9 col-md-9">
									<label class="label label-success"><?php  echo $order['table_info'];?></label>
								</div>	
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">总计:</label>
								<div class="col-sm-9 col-xs-9 col-md-9">
									<p class="form-control-static"><?php  echo $order['price'];?> 元</p>
								</div>	
							</div>
							<?php  if($order['is_usecard'] == 1) { ?>
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 control-label">实际支付:</label>
									<div class="col-sm-9 col-xs-9 col-md-9">
										<p class="form-control-static"><?php  echo $order['card_fee'];?> 元 <i class="fa fa-info-circle"></i> 使用优惠券减免<?php  echo $order['price'] - $order['card_fee'];?>元</p>
									</div>	
								</div>
							<?php  } ?>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">就餐人数:</label>
								<div class="col-sm-9 col-xs-9 col-md-9">
									<p class="form-control-static"><?php  echo $order['person_num'];?> 人</p>
								</div>	
							</div>
						<?php  } else if($order['order_type'] == 2) { ?>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单类型:</label>
								<div class="col-sm-9 col-xs-9 col-md-9">
									<p class="form-control-static">
										<label class="label label-success">外卖订餐</label>
									</p>
								</div>	
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送费:</label>
								<div class="col-sm-9 col-xs-9 col-md-9">
									<p class="form-control-static">
									<?php  echo $order['delivery_fee'];?>元
									</p>
								</div>	
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">菜品金额:</label>
								<div class="col-sm-9 col-xs-9 col-md-9">
									<p class="form-control-static">
									<?php  echo $order['price'];?>元
									</p>
								</div>	
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">总价:</label>
								<div class="col-sm-9 col-xs-9 col-md-9">
									<p class="form-control-static">
									<?php  echo ($order['price'] + $order['delivery_fee'])?>元
									</p>
								</div>	
							</div>
							<?php  if($order['is_usecard'] == 1) { ?>
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 control-label">实际支付:</label>
									<div class="col-sm-9 col-xs-9 col-md-9">
										<p class="form-control-static"><?php  echo $order['card_fee'];?>元 <i class="fa fa-info-circle"></i> 使用优惠券减免<?php  echo $order['price'] - $order['card_fee'];?>元</p>
									</div>	
								</div>
							<?php  } ?>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">赠送积分:</label>
								<div class="col-sm-9 col-xs-9 col-md-9">
									<p class="form-control-static">
										<?php  echo $order['grant_credit'];?> 积分
										<?php  if(!$order['is_grant']) { ?>
											<span class="label label-danger">未赠送</span>
										<?php  } else { ?>
											<span class="label label-success">已赠送</span>
										<?php  } ?>
									</p>
								</div>	
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送时间:</label>
								<div class="col-sm-9 col-xs-9 col-md-9">
									<p class="form-control-static"><?php  if($order['delivery_time']) { ?><?php  echo $order['delivery_time'];?><?php  } else { ?>尽快送出<?php  } ?></p>
								</div>	
							</div>
						<?php  } ?>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">备注:</label>
							<div class="col-sm-9 col-xs-9 col-md-9">
								<p class="form-control-static"><?php  if($order['note']) { ?><?php  echo $order['note'];?><?php  } else { ?>无<?php  } ?></p>
							</div>	
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">付款方式:</label>
							<div class="col-sm-9 col-xs-9 col-md-9">
								<p class="form-control-static">
									<?php  if(empty($order['pay_type'])) { ?>
									<label class="label label-danger">未支付</label>
									<?php  } else { ?>
									<label class="label label-success"><?php  echo $pay_types[$order['pay_type']];?></label>
									<?php  } ?>
								</p>
							</div>	
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单状态:</label>
							<div class="col-sm-9 col-xs-9 col-md-9">
								<p class="form-control-static">
									<?php  if($order['status'] == 1) { ?>
										<span class="label label-danger">待确认</span>
									<?php  } else if($order['status'] == 2) { ?>
										<span class="label label-warning">处理中</span>
									<?php  } else if($order['status'] == 3) { ?>
										<span class="label label-success">已完成</span>
									<?php  } else if($order['status'] == 4) { ?>
										<span class="label label-default">已取消</span>
									<?php  } else if($order['status'] == 8) { ?>
										<span class="label label-default">退款申请</span>
									<?php  } else if($order['status'] == 9) { ?>
										<span class="label label-default">已退款</span>
									<?php  } else { ?>
										<span class="label label-default">未知</span>
									<?php  } ?>
								</p>
							</div>	
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">下单时间:</label>
							<div class="col-sm-9 col-xs-9 col-md-9">
								<p class="form-control-static"><?php  echo date('Y-m-d H:i', $order['addtime']);?></p>
							</div>	
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6" style="padding:0 0 0 15px;">
				<div class="panel panel-default">
					<div class="panel-heading">用户信息</div>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">用户名:</label>
							<div class="col-sm-9 col-xs-9 col-md-9">
								<p class="form-control-static"><?php  echo $order['username'];?></p>
							</div>	
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">电话:</label>
							<div class="col-sm-9 col-xs-9 col-md-9">
								<p class="form-control-static"><?php  echo $order['mobile'];?></p>
							</div>	
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">送餐地址:</label>
							<div class="col-sm-9 col-xs-9 col-md-9">
								<p class="form-control-static"><?php  echo $order['address'];?></p>
							</div>	
						</div>
					</div>
				</div>
			</div>
			<?php  if($order['comment'] == 1) { ?>
			<div class="panel panel-default">
				<div class="panel-heading">评价信息 <small class="text-danger"><?php  echo date('Y-m-d H:i', $comment['addtime']);?></small></div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">菜品口味:</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<p class="form-control-static">
								<?php 
									for($i = 0; $i < $comment['taste']; $i++) {
										echo '<i class="fa fa-star"></i>';
									}
									for($i = $comment['taste']; $i < 5; $i++) {
										echo '<i class="fa fa-star-o"></i>';
									}
								?>
							</p>
						</div>	
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">服务态度:</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<p class="form-control-static">
								<?php 
									for($i = 0; $i < $comment['serve']; $i++) {
										echo '<i class="fa fa-star"></i>';
									}
									for($i = $comment['serve']; $i < 5; $i++) {
										echo '<i class="fa fa-star-o"></i>';
									}
								?>
							</p>
						</div>	
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送速度:</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<p class="form-control-static">
								<?php 
									for($i = 0; $i < $comment['speed']; $i++) {
										echo '<i class="fa fa-star"></i>';
									}
									for($i = $comment['speed']; $i < 5; $i++) {
										echo '<i class="fa fa-star-o"></i>';
									}
								?>
							</p>
						</div>	
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">评价:</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<p class="form-control-static"><?php  echo $comment['note'];?></p>
						</div>	
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">审核状态:</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<p class="form-control-static">
								<?php  if($comment['status'] == 1) { ?>
									<span class="label label-success">审核通过</span>
								<?php  } else if($comment['status'] == 2) { ?>
									<span class="label label-danger">审核未通过</span>
								<?php  } else { ?>
									<span class="label label-default">审核中</span>
								<?php  } ?>
							</p>
						</div>	
					</div>
				</div>
			</div>
			<?php  } ?>

			<div class="form-group">
				<div class="col-sm-9 col-xs-9 col-md-9">
					<a href="<?php  echo $this->createWeburl('manage', array('op' => 'status', 'id' => $order['id'], 'status' => 2));?>" class="btn btn-danger" onclick="if(!confirm('确定修改订单状态?')) return false;">已确认，处理中</a>
					<a href="<?php  echo $this->createWeburl('manage', array('op' => 'status', 'id' => $order['id'], 'status' => 3));?>" class="btn btn-primary" onclick="if(!confirm('确定修改订单状态?')) return false;">设为已完成</a>
					<a href="<?php  echo $this->createWeburl('manage', array('op' => 'status', 'id' => $order['id'], 'status' => 4));?>" class="btn btn-default" onclick="if(!confirm('确定修改订单状态?')) return false;">设为已取消</a>
					<a href="<?php  echo $this->createWeburl('manage', array('op' => 'status', 'id' => $order['id'], 'status' => 5));?>" class="btn btn-warning" onclick="if(!confirm('确定设置为已支付?')) return false;">设为已支付</a>
					<?php  if($order['status'] == 8) { ?><a href="<?php  echo $this->createWeburl('manage', array('op' => 'status', 'id' => $order['id'], 'status' => 9));?>" class="btn btn-warning" onclick="if(!confirm('确定退余额给用户?')) return false;">同意退款</a><?php  } ?>
				</div>	
			</div>
		</form>
	</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
