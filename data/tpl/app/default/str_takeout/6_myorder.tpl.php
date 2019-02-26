<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/main.css">
<script src="../addons/str_takeout/template/resource/js/dialog.js"></script>
<style type="text/css">
	.nav div{width:80%;}
	.nav a{width:20%;}
</style>
<div class="container" id="order_page">
	<header class="top_nav"><a href="<?php  echo $_W['siteroot'];?>app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&&do=index&m=<?php  echo $_W['current_module']['name'];?>"><img src="../addons/str_takeout/template/resource/images/close.png" alt=""></a>越新科技</header>
	<header class="nav menu">
		<div class="nav_box">
			<div class="a_box">
				<div></div>
				<a href="<?php  echo $this->createMobileUrl('myorder', array('status' => '', 'sid' => $_GPC['sid']))?>" <?php  if($status == '') { ?>class="on"<?php  } ?>>全部</a>
			</div>
			<div class="a_box">
				<div></div>
				<a href="<?php  echo $this->createMobileUrl('myorder', array('status' => '1', 'sid' => $_GPC['sid']))?>" <?php  if($status == '1') { ?>class="on"<?php  } ?>>待支付</a>
			</div>
			<div class="a_box">
				<div></div>
				<a href="<?php  echo $this->createMobileUrl('myorder', array('status' => '3', 'sid' => $_GPC['sid']))?>" <?php  if($status == '3') { ?>class="on"<?php  } ?>>待評價</a>
			</div>
			<div class="a_box">
				<div></div>
				<a href="<?php  echo $this->createMobileUrl('myorder', array('status' => '9', 'sid' => $_GPC['sid']))?>" <?php  if($status == '9') { ?>class="on"<?php  } ?>>退款</a>
			</div>
			
			<!-- <a href="<?php  echo $this->createMobileUrl('myorder', array('status' => '1', 'sid' => $_GPC['sid']))?>" <?php  if($status == '1') { ?>class="on"<?php  } ?>>待确认</a> -->
			<!-- <a href="<?php  echo $this->createMobileUrl('myorder', array('status' => '2', 'sid' => $_GPC['sid']))?>" <?php  if($status == '2') { ?>class="on"<?php  } ?>>处理中</a> -->
		</div>
	</header>
	<section class="pay_wrap">
		<ul class="my_order">
			<?php  if(!empty($data)) { ?>
				<?php  if(is_array($data)) { foreach($data as $row) { ?>
					<li class="order_list">
						<a href="<?php  echo $this->createMobileUrl('orderdetail', array('id' => $row['id'], 'sid' => $row['sid']))?>">
							<div class="title">
								<div>提督馬路店</div>
								<div>
									<?php  if($row['status'] == 1) { ?>
										待支付
									<?php  } else if($row['status'] == 2) { ?>
										处理中
									<?php  } else if($row['status'] == 3) { ?>
										待評價
									<?php  } else if($row['status'] == 4) { ?>
										已取消
									<?php  } else if($row['status'] == 8) { ?>
										退款中
									<?php  } else if($row['status'] == 9) { ?>
										已退款
									<?php  } ?>
								</div>
							</div>
							
							<div class="details">
								<div class="details_box">
									<img src="http://118.89.40.174/yue/attachment/images/6/2018/12/n1O3d72O27o2d2vO32G3V7DvgoL7JZ.jpg" alt="">
								</div>
								<div class="details_box">
									<div class="details_message">
										<h3 class="highlight">牛排套餐</h3>
										<span>×<?php  echo $row['num'];?></span>
										<span>$<?php  echo $row['price'];?></span>
									</div>
									<div>下單時間：<?php  echo date('Y-m-d H:i', $row['addtime'])?></div>
								</div>
							</div>
							
							<div class="btn_box">
								<?php  if($row['status'] == 1) { ?>
									<div class="btn1">立即支付</div>
								<?php  } else if($row['status'] == 2) { ?>
									处理中
								<?php  } else if($row['status'] == 3) { ?>
									<div class="btn3">評價</div>
								<?php  } else if($row['status'] == 4) { ?>
									已取消
								<?php  } else if($row['status'] == 8) { ?>
									退款中
								<?php  } else if($row['status'] == 9) { ?>
									<div class="btn9">退款成功</div>
								<?php  } ?>	
							</div>
							
						</a>
					</li>
				<?php  } } ?>
			<?php  } else { ?>
				<li class="on-info">
					<div class="info_img"></div>
					<div class="tips">你還沒有下單哦</div>
					<div class="tips">快去選餐吧</div>
					<a href="<?php  echo $this->createMobileUrl('dish', array('sid' => $sid, 'mode' => 2));?>">去點餐</a>
				</li>
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
