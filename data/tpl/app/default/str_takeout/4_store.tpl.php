<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<script src="../addons/str_takeout/template/resource/js/swipe_min.js"></script>
<script src="../addons/str_takeout/template/resource/js/dialog.js"></script>
<script src="../addons/str_takeout/template/resource/js/main.js"></script>
<script src="../addons/str_takeout/template/resource/js/menu.js"></script>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/main.css">
<style type="text/css">
	<?php  if($store['comment_status'] == 1) { ?>
	.nav a{width:33.333%;}
	<?php  } ?>
</style>

<div class="container">
	<header class="nav menu">
		<div>
			<a href="<?php  echo $this->createMobileUrl('store', array('sid' => $_GPC['sid']))?>" class="on">门店详情</a>
			<?php  if($store['comment_status'] == 1) { ?>
			<a href="<?php  echo $this->createMobileUrl('comment_list', array('sid' => $_GPC['sid']));?>">用户评论</a>
			<?php  } ?>
			<a href="<?php  echo murl('mc/home');?>">会员中心</a>
		</div>
	</header>
	<section>
		<?php  if(!empty($store['thumbs'])) { ?>
			<div id="imgSwipe" class="img_swipe" style="visibility: visible;">
				<ul style="width: 0px;">
					<?php  if(is_array($store['thumbs'])) { foreach($store['thumbs'] as $li) { ?>
						<li><a href="<?php  echo $li['url'];?>"><img src="<?php  echo tomedia($li['image']);?>" /></a></li>
					<?php  } } ?>
				</ul>
				<ol id="swipeNum">
					<?php  if(is_array($store['thumbs'])) { foreach($store['thumbs'] as $li) { ?>
						<li class=""></li>
					<?php  } } ?>
				</ol>
			</div>
		<?php  } ?>
		<div class="mode_info">
			<span>
				<a href="<?php  echo $this->createMobileUrl('reserve', array('sid' => $sid, 'mode' => 4));?>" data-support="<?php  echo $store['is_reserve'];?>" <?php  if($store['is_reserve'] == 2) { ?>class="not-support"<?php  } ?>>
					<strong><i class="fa fa-dot-circle-o"></i></strong>
					预定
				</a>
			</span>
			<span>
				<a href="javascript:;" id="scanqrcode" data-support="<?php  echo $store['is_meal'];?>" <?php  if($store['is_meal'] == 2) { ?>class="not-support"<?php  } ?>>
					<strong><i class="fa fa-cutlery"></i></strong>
					点菜
				</a>
			</span>
			<span>
				<a href="<?php  echo $this->createMobileUrl('dish', array('sid' => $sid, 'mode' => 2));?>" data-support="<?php  echo $store['is_takeout'];?>" <?php  if($store['is_takeout'] == 2) { ?>class="not-support"<?php  } ?>>
					<strong><i class="fa fa-truck"></i></strong>
					外卖
				</a>
			</span>
			<span>
				<a href="<?php  echo $this->createMobileUrl('assign', array('sid' => $sid, 'mode' => 3));?>" data-support="<?php  echo $store['is_assign'];?>" <?php  if($store['is_assign'] == 2) { ?>class="not-support"<?php  } ?>>
					<strong><i class="fa fa-bell"></i></strong>
					排队
				</a>
			</span>
		</div>
		<?php  if($store['is_takeout'] == 1) { ?>
			<div class="store_info">
				<span><strong><?php  echo $store['delivery_time'];?></strong>送达/分钟</span>
				<span><strong><?php  echo $store['send_price'];?></strong>起送价/元</span>
				<span><strong><?php  echo $store['delivery_price'];?></strong>配送费/元</span>
			</div>
		<?php  } ?>
		<ul class="box">
			<li>
				<a href="tel:<?php  echo $store['telephone'];?>">
					<span><i class="ico_tel"></i></span>
					<strong>电话：<?php  echo $store['telephone'];?></strong>
					<span><i class="ico_arrow"></i></span>
				</a>
			</li>
			<li>
				<!--<a href="http://api.map.baidu.com/marker?location=<?php  echo $store['location_x'];?>,<?php  echo $store['location_y'];?>&title=<?php  echo $store['address'];?>&output=html">-->
					<a href="https://maps.google.com/maps?q=<?php  echo $store['location_x'];?>,<?php  echo $store['location_y'];?>(<?php  echo $store['address'];?>)&z=17&hl=en">
					<span><i class="ico_addres1"></i></span>
					<strong><?php  echo $store['address'];?></strong>
					<span><i class="ico_arrow"></i></span>
				</a>
			</li>
			<?php  if(!empty($store['sns']['qq'])) { ?>
				<li>
					<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php  echo $store['sns']['qq'];?>&site=qq&menu=yes">
						<span style="color:#ff5f32"><i class="fa fa-qq"></i></span>
						<strong><?php  echo $store['sns']['qq'];?></strong>
						<span><i class="ico_arrow"></i></span>
					</a>
				</li>
			<?php  } ?>
			<?php  if(!empty($store['sns']['weixin'])) { ?>
				<li>
					<a href="">
						<span style="color:#ff5f32"><i class="fa fa-weixin"></i></span>
						<strong><?php  echo $store['sns']['weixin'];?></strong>
						<span><i class="ico_arrow"></i></span>
					</a>
				</li>
			<?php  } ?>
		</ul>
		<?php  if($store['comment_status'] == 1) { ?>
			<ul class="box">
				<li>
					<a href="<?php  echo $this->createMobileUrl('comment_list', array('sid' => $_GPC['sid']))?>">
						<strong>门店评价</strong>
						<span><i class="ico_arrow"></i></span>
					</a>
				</li>
			</ul>
		<?php  } ?>
		<ul class="box">
			<li>营业时间： <?php  echo $hour_str;?></li>
			<li>服务半径：<?php  echo $store['serve_radius'];?>公里</li>
			<li>配送区域：<?php  echo $store['delivery_area'];?></li>
			<li>餐厅特色：<?php  echo $store['description'];?></li>
		</ul>
	</section>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?>
</div>
<div class="confirm_box" style="" id="qrcodeBox">
	<p>如果您已经到店,请点击'扫码下单'并扫描桌子上的二维码进行店内下单</p>
	<div>
		<span><a href="javascript:void(0);" class="comm_btn " id="qrcode_back" style="display: inline-block;background: #51C332;" >待会下单</a></span>
		<span><a href="javascript:void(0);" class="comm_btn" id="qrcode_go">扫码下单</a></span>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$('.mode_info a').click(function(){
		var support = $(this).data('support');
		if(support == 2) {
			return false;
		}
	});

	$('#scanqrcode').click(function(){
		var support = $(this).data('support');
		if(support == 2) {
			return false;
		}
		$('#qrcodeBox').dialog({title: '请确认已到店'});
		$("#qrcode_back").click(function(){
			$('#qrcodeBox').dialog('close');
			return false;
		});
		$("#qrcode_go").click(function(){
			wx.ready(function(){
				wx.scanQRCode({
					needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
					scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
					success: function (res) {
						var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
					}
				});
			});
		});
	});
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
