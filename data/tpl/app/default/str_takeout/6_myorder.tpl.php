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
								<h3 class="highlight"><?php  echo $row['title'];?></h3>
								<p><?php  echo $row['num'];?>份/￥<?php  echo $row['price'];?></p>
								<div><?php  echo date('Y-m-d H:i', $row['addtime'])?></div>
							</div>
						</a>
					</li>
				<?php  } } ?>
			<?php  } else { ?>
				<li class="on-info">
					<div class="info_img"></div>
					<div class="tips">你還沒有下單哦</div>
					<div class="tips">快去選餐吧</div>
					<a href="">去點餐</a>
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
