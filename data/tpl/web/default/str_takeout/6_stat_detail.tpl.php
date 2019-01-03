<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
	.require{color:red;}
	.info{padding:6px;width:400px;margin:10px auto 3px auto;text-align:center;}
	.padding-left{padding-left:50px;height:30px;line-height:30px;background:url('./resource/images/bg_repno.gif') no-repeat -245px -595px;}
	.table th,td{text-align: center}
	.order-nav {margin: 0;width: 100%;min-width: 800px;}
	.order-nav > li > a {display: block;}
	.order-nav-tabs {background: #EEE;}
	.order-nav-tabs > li {line-height: 40px;float: left;list-style: none;display: block;text-align: -webkit-match-parent;}
	.order-nav-tabs > li > a {font-size: 14px;color: #666;height: 40px;line-height: 40px;padding: 0 10px;margin: 0;border: 1px solid transparent;border-bottom-width: 0px;-webkit-border-radius: 0;-moz-border-radius: 0;border-radius: 0;}
	.order-nav-tabs > li > a, .order-nav-tabs > li > a:focus {border-radius: 0 !important;background-color: #f9f9f9;color: #999;margin-right: -1px;position: relative;z-index: 11;border-color: #c5d0dc;text-decoration: none;}
	.order-nav-tabs >li >a:hover {background-color: #FFF;}
	.order-nav-tabs > li.active > a, .order-nav-tabs > li.active > a:hover, .order-nav-tabs > li.active > a:focus {color: #576373;border-color: #c5d0dc;border-top: 2px solid #4c8fbd;border-bottom-color: transparent;background-color: #FFF;z-index: 12;margin-top: -1px;box-shadow: 0 -2px 3px 0 rgba(0, 0, 0, 0.15);}	
</style>
<?php  if($op == 'stat_detail') { ?>
<?php  if(!$is_print) { ?>
<div class="alert alert-info info">
	<i class="fa fa-info-circle"></i>
	当前门店名称: <?php  echo $store['title'];?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('nav', TEMPLATE_INCLUDEPATH)) : (include template('nav', TEMPLATE_INCLUDEPATH));?>
<div class="clearfix pull-left col-lg-12">
	<div class="panel panel-info">
		<div class="panel-heading">筛选</div>
		<div class="panel-body">
			<form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
				<input type="hidden" name="c" value="site">
				<input type="hidden" name="a" value="entry">
				<input type="hidden" name="m" value="str_takeout">
				<input type="hidden" name="do" value="manage"/>
				<input type="hidden" name="op" value="stat_detail"/>
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-2 col-md-2 control-label">下单时间</label>
					<div class="col-sm-7 col-lg-8 col-md-8 col-xs-12">
						<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d H:i:s', $starttime), 'end' => date('Y-m-d H:i:s', $endtime)), true);?>
					</div>
				</div>
			</form>
		</div>
	</div>
	<form class="form-horizontal" action="" method="post" onkeydown="if(event.keyCode == 13) return false;">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover table-bordered">
						<thead class="navbar-inner">
							<tr>
								<th width="300">时间</th>
								<th>营业额</th>
								<th>订单数</th>
								<th>现金支付</th>
								<th>微信支付</th>
								<th>支付宝支付</th>
								<th>余额支付</th>
								<th>货到支付</th>
								<th>查看详情</th>
							</tr>
						</thead>
						<tbody>
							<?php  if(is_array($return)) { foreach($return as $k => $dca) { ?>
							<tr>
								<th><?php  echo $k;?></th>
								<td><?php  echo sprintf('%.2f', $dca['price']);?> 元</td>
								<td><?php  echo intval($dca['count']);?> 单</td>
								<td><?php  echo sprintf('%.2f', $dca['cash']);?> 元</td>
								<td><?php  echo sprintf('%.2f', $dca['wechat']);?> 元</td>
								<td><?php  echo sprintf('%.2f', $dca['alipay']);?> 元</td>
								<td><?php  echo sprintf('%.2f', $dca['credit']);?> 元</td>
								<td><?php  echo sprintf('%.2f', $dca['delivery']);?> 元</td>
								<td>
									<a href="<?php  echo $this->createWebUrl('manage', array('op' => 'stat_day', 'day' => $k));?>" class="btn btn-success" target="_blank">详情</a>
								</td>
							</tr>
							<?php  } } ?>
							<tr>
								<th class="info">
									<?php  echo date('Y-m-d H:i', $starttime);?>
									~~
									<?php  echo date('Y-m-d H:i', $endtime);?>
								</th>
								<td class="info"><?php  echo sprintf('%.2f', $total['total_price']);?> 元</td>
								<td class="info"><?php  echo intval($total['total_count']);?> 单</td>
								<td class="info"><?php  echo sprintf('%.2f', $total['total_cash']);?> 元</td>
								<td class="info"><?php  echo sprintf('%.2f', $total['total_wechat']);?> 元</td>
								<td class="info"><?php  echo sprintf('%.2f', $total['total_alipay']);?> 元</td>
								<td class="info"><?php  echo sprintf('%.2f', $total['total_credit']);?> 元</td>
								<td class="info"><?php  echo sprintf('%.2f', $total['total_delivery']);?> 元</td>
								<td class="info">
									<a href="<?php  echo $this->createWebUrl('manage', array('op' => 'stat_day', 'start' => $starttime, 'end' => $endtime));?>" class="btn btn-danger" target="_blank">统计</a>
								</td>
							</tr>
						</tbody>
					</table>	
				</div>
			</div>
		</div>
		<a href="<?php  echo $this->createWebUrl('manage', array('op' => 'stat_detail', 'is_print' => 1, 'starttime' => $starttime, 'endtime' => $endtime));?>" target="_blank" class="btn btn-primary">打印统计</a>
	</form>
</div>
<?php  } else { ?>
<div class="clearfix pull-left col-lg-12">
	<div class="table-responsive" style="margin-top:50px">
	<table class="table table-hover table-bordered">
		<thead class="navbar-inner">
			<tr>
				<th width="300">时间</th>
				<th>营业额</th>
				<th>订单数</th>
				<th>现金支付</th>
				<th>微信支付</th>
				<th>支付宝支付</th>
				<th>余额支付</th>
				<th>货到支付</th>
			</tr>
		</thead>
		<tbody>
			<?php  if(is_array($return)) { foreach($return as $k => $dca) { ?>
			<tr>
				<th><?php  echo $k;?></th>
				<td><?php  echo sprintf('%.2f', $dca['price']);?> 元</td>
				<td><?php  echo intval($dca['count']);?> 单</td>
				<td><?php  echo sprintf('%.2f', $dca['cash']);?> 元</td>
				<td><?php  echo sprintf('%.2f', $dca['wechat']);?> 元</td>
				<td><?php  echo sprintf('%.2f', $dca['alipay']);?> 元</td>
				<td><?php  echo sprintf('%.2f', $dca['credit']);?> 元</td>
				<td><?php  echo sprintf('%.2f', $dca['delivery']);?> 元</td>
			</tr>
			<?php  } } ?>
			<tr>
				<th class="info">
					<?php  echo date('Y-m-d H:i', $starttime);?>
					~~
					<?php  echo date('Y-m-d H:i', $endtime);?>
				</th>
				<td class="info"><?php  echo sprintf('%.2f', $total['total_price']);?> 元</td>
				<td class="info"><?php  echo intval($total['total_count']);?> 单</td>
				<td class="info"><?php  echo sprintf('%.2f', $total['total_cash']);?> 元</td>
				<td class="info"><?php  echo sprintf('%.2f', $total['total_wechat']);?> 元</td>
				<td class="info"><?php  echo sprintf('%.2f', $total['total_alipay']);?> 元</td>
				<td class="info"><?php  echo sprintf('%.2f', $total['total_credit']);?> 元</td>
				<td class="info"><?php  echo sprintf('%.2f', $total['total_delivery']);?> 元</td>
			</tr>
		</tbody>
	</table>
</div>
</body>
</html>
<?php  exit();?>
<?php  } ?>
<?php  } else { ?>
<div class="alert alert-info info">
	<i class="fa fa-info-circle"></i>
	当前门店名称: <?php  echo $store['title'];?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('nav', TEMPLATE_INCLUDEPATH)) : (include template('nav', TEMPLATE_INCLUDEPATH));?>
<div class="clearfix pull-left col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong class="text-danger">				
			<?php  echo date('Y-m-d H:i', $start);?> ~~ <?php  echo date('Y-m-d H:i', $end);?>
			</strong> 
			订单统计
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-bordered">
					<thead class="navbar-inner">
						<tr>
							<th>营业额</th>
							<th>订单数</th>
							<th>现金支付</th>
							<th>微信支付</th>
							<th>支付宝支付</th>
							<th>余额支付</th>
							<th>货到支付</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php  echo sprintf('%.2f', $price);?> 元</td>
							<td><?php  echo intval($count);?> 单</td>
							<td><?php  echo intval($return['cash']['num'])?> 单/<?php  echo sprintf('%.2f', $return['cash']['price']);?> 元</td>
							<td><?php  echo intval($return['wechat']['num'])?> 单/<?php  echo sprintf('%.2f', $return['wechat']['price']);?> 元</td>
							<td><?php  echo intval($return['alipay']['num'])?> 单/<?php  echo sprintf('%.2f', $return['alipay']['price']);?> 元</td>
							<td><?php  echo intval($return['credit']['num'])?> 单/<?php  echo sprintf('%.2f', $return['credit']['price']);?> 元</td>
							<td><?php  echo intval($return['delivery']['num'])?> 单/<?php  echo sprintf('%.2f', $return['delivery']['price']);?> 元</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>			
	<ul class="order-nav order-nav-tabs" style="background:none;float: left;margin-left: 0px;padding-left: 0px;border-bottom:1px #c5d0dc solid;">
		<li<?php  if($orderby == 'num') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'stat_day', 'day' => $day, 'start' => $start, 'end' => $end, 'orderby' => 'num'))?>">按照销量排序</a></li>
		<li<?php  if($orderby == 'price') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage', array('op' => 'stat_day', 'day' => $day, 'start' => $start, 'end' => $end, 'orderby' => 'price'))?>">按照收入排序</a></li>
	</ul>
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="table-responsive" style="margin-top:20px">
				<table class="table table-hover table-bordered">
					<thead class="navbar-inner">
						<tr>
							<th>菜品</th>
							<th>销量</th>
							<th>收入</th>
							<th>查看</th>
						</tr>
					</thead>
					<tbody>
						<?php  if(!empty($data)) { ?>
							<?php  if(is_array($data)) { foreach($data as $row) { ?>
								<tr>
									<td><strong><?php  echo $row['dish_title'];?></strong></td>
									<td><?php  echo $row['num'];?> 份</td>
									<td><?php  echo $row['price'];?> 元</td>
									<td>
										<a href="<?php  echo $this->createWebUrl('manage', array('op' => 'dish_post', 'id' => $row['dish_id']));?>" class="btn btn-success" target="_blank">菜品详情</a>
									</td>
								</tr>
							<?php  } } ?>
						<?php  } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php  } ?>
<script type="text/javascript">
	require(['jquery', 'daterangepicker'], function($) {
		$('.daterange').on('apply.daterangepicker', function(ev, picker) {
			$('#form1')[0].submit();
		});
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
