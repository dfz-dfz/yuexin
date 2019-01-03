<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/main.css">
<script src="../addons/str_takeout/template/resource/js/dialog.js"></script>
<style type="text/css">
	.nav div{width:80%;}
	.nav a{width:20%;}
</style>
<div class="container">
	<header class="nav menu">
		<div>
			<a href="<?php  echo $this->createMobileUrl('myorder', array('status' => '', 'sid' => $_GPC['sid']))?>" <?php  if($status == '') { ?>class="on"<?php  } ?>>全部</a>
			<a href="<?php  echo $this->createMobileUrl('myorder', array('status' => '1', 'sid' => $_GPC['sid']))?>" <?php  if($status == '1') { ?>class="on"<?php  } ?>>待确认</a>
			<a href="<?php  echo $this->createMobileUrl('myorder', array('status' => '2', 'sid' => $_GPC['sid']))?>" <?php  if($status == '2') { ?>class="on"<?php  } ?>>处理中</a>
			<a href="<?php  echo $this->createMobileUrl('myorder', array('status' => '3', 'sid' => $_GPC['sid']))?>" <?php  if($status == '3') { ?>class="on"<?php  } ?>>已完成</a>
			<a href="<?php  echo $this->createMobileUrl('myorder', array('status' => '5', 'sid' => $_GPC['sid']))?>" <?php  if($status == '5') { ?>class="on"<?php  } ?>>待付款</a>
		</div>
	</header>
	<section class="pay_wrap">
		<ul class="my_order">
			<?php  if(!empty($data)) { ?>
				<?php  if(is_array($data)) { foreach($data as $row) { ?>
					<li>
						<a href="<?php  echo $this->createMobileUrl('orderdetail', array('id' => $row['id'], 'sid' => $row['sid']))?>">
							<div>
								<?php  if($row['status'] == 1) { ?>
									<div class="ico_status pending"><i></i>待确认</div>
								<?php  } else if($row['status'] == 2) { ?>
									<div class="ico_status inhand"><i></i>处理中</div>
								<?php  } else if($row['status'] == 3) { ?>
									<div class="ico_status complete"><i></i>已完成</div>
								<?php  } else if($row['status'] == 4) { ?>
									<div class="ico_status cancle"><i></i>已取消</div>
								<?php  } else if($row['status'] == 8) { ?>
									<div class="ico_status pending"><i></i>退款中</div>
								<?php  } else if($row['status'] == 9) { ?>
									<div class="ico_status complete"><i></i>已退款</div>
								<?php  } ?>
							</div>
							<div>
								<h3 class="highlight"><?php  echo $row['title'];?></h3>
								<p><?php  echo $row['num'];?>份/￥<?php  echo $row['price'];?></p>
								<div><?php  echo date('Y-m-d H:i', $row['addtime'])?></div>
							</div>
						</a>
					</li>
				<?php  } } ?>
			<?php  } else { ?>
				<li class="on-info"><i class="fa fa-info-circle"></i> 暂无订单</li>
			<?php  } ?>
		</ul>
	</section>	
	<div class="page"><?php  echo $pager;?></div>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?>
</div>
<script type="text/javascript">
	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
		WeixinJSBridge.call('hideOptionMenu');
	});
</script>  <!-- 新睿社区 www.010xr.com-->
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
