<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/main.css">
<script src="../addons/str_takeout/template/resource/js/dialog.js"></script>
<style type="text/css">
	.but-post{display:block;height:30px;line-height:30px;border:none;width:640px;border-radius:3px;font-size:16px;font-weight:bold;color:#fff;background-color:#ff5f32;}
	.my_menu_list th{width:0;}
	.menu_list li .top > div:nth-of-type(3){background: none;}
</style>

<div class="container" id="orderdetail">
	<header class="top_nav"><a href="<?php  echo $_W['siteroot'];?>app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&&do=index&m=<?php  echo $_W['current_module']['name'];?>"><img src="../addons/str_takeout/template/resource/images/close.png" alt=""></a>越新科技</header>
	<section>
		<div class="my_order">
			<div class="status_box">
				<?php  if($order['status'] == 1) { ?>
					<div class="status">待确认</div>
				<?php  } else if($order['status'] == 2) { ?>
					<div class="status">处理中</div>
				<?php  } else if($order['status'] == 3) { ?>
					<div class="status">已完成</div>
				<?php  } else if($order['status'] == 4) { ?>
					<div class="status">已取消</div>
				<?php  } else if($order['status'] == 8) { ?>
					<div class="status">退款中</div>
				<?php  } else if($order['status'] == 9) { ?>
					<div class="status">已退款</div>
				<?php  } ?>
			</div>
			<div class="status_type">
				<span>已下單</span>
				<div></div>
				<span class="on">配送中</span>
				<div></div>
				<span>確認取餐</span>
			</div>
		</div>

		<div class="detailbox">
			<div class="addressbox">
				<h3 class="highlight"><?php  echo $store['title'];?></h3>
				<div>澳門提督馬路店20號地鋪1樓</div>
				<span></span>
			</div>

			<ul class="menu_list order_list" id="orderList">
				<?php  if(!empty($order['dish'])) { ?>
					<?php  if(is_array($order['dish'])) { foreach($order['dish'] as $da) { ?>
					<li id="<?php  echo $li['id'];?>" style="margin-bottom: 10px;">
						<div class="top">
							<div class="img_box">
								<img src="../addons/str_takeout/template/resource/images/gouwu.png" alt="">
							</div>
							<div class="detalis_message">
								<h3><?php  echo $da['dish_title'];?></h3>
								<!-- <div class="detalis">牛排，牛奶，正常冰</div> -->
							</div>
							<div class="num_box">×<span class="nums"><?php  echo $da['dish_num'];?></span></div>
							<div class="price_box">$<span class="unit_price"><?php  echo $da['dish_price'];?></span></div>
						</div>
					</li>
					<?php  } } ?>
				<?php  } ?>
				<div class="lunch_box">
					<div>餐盒費</div>
					<div class="lunch_price">$5</div>
				</div>
				<div class="dispatching_box">
					<div>配送費</div>
					<?php  if($_GPC['mode'] == 2) { ?>
						<div class="dispatching_price">$<?php  echo $store['delivery_price'];?></div>
					<?php  } else { ?>
						<div class="dispatching_price">$0</div>
					<?php  } ?>
				</div>
			</ul>
			<div class="pay_total">實付&nbsp;&nbsp;&nbsp;$<?php  echo $order['price'];?></div>
			<?php  if($order['is_usecard'] == 1) { ?>
				<div class="pay_total">實付&nbsp;&nbsp;&nbsp;$<?php  echo $order['card_fee'];?></div>
			<?php  } ?>
		</div>

		<ul class="box pay_box">
			<div class="dispatching">配送信息</div>
			<div class="time time_box">配送時間<span><?php  if($order['delivery_time']) { ?><?php  echo $order['delivery_time'];?><?php  } else { ?>尽快送出<?php  } ?></span></div>
			<div class="time">配送地址<span><?php  echo $order['address'];?></span></div>
			<div class="time tel_name"><span><?php  echo $order['mobile'];?>&nbsp;&nbsp;<?php  echo $order['username'];?></span></div>
			<div class="time">配送服務<span>澳覓轉送</span></div>
		</ul>

		<?php  if(!empty($logs)) { ?>
		<ul class="box pay_box">
			<div class="dispatching">訂單信息</div>
			<div class="time time_box">訂單號碼<span class="copy" data-clipboard-action="copy" data-clipboard-target="#target" id="copy_btn">複製</span><div></div><span id="target">79824114v</span></div>
			<?php  if(is_array($logs)) { foreach($logs as $log) { ?>
				<div class="time">下單時間<span><?php  echo date('Y-m-d H:i', $log['addtime']);?></span></div>
			<?php  } } ?>
			<div class="time">支付方式<span>現金支付</span></div>
		</ul>
		<?php  } ?>

		<ul class="box pay_box">
			<div class="dispatching">備註信息</div>
			<div class="time time_box"><?php  if($order['note']) { ?><?php  echo $order['note'];?><?php  } else { ?>无<?php  } ?></div>
		</ul>
		
		 <?php  if(empty($order['pay_type'])) { ?>
			<div class="detail_tools">
				<div><a href="<?php  echo $this->createMobileUrl('pay', array('id' => $order['id']))?>" class="comm_btn">在线支付</a></div>
				<div><a href="javascript:;" onclick="alert('请到收银台付款')" id="cash" class="comm_btn" style="background:#4fb07c">现金支付</a></div>
			</div>
		<?php  } ?>
		<?php  if($order['status'] == 3 && $store['comment_status'] == 1) { ?>
			<div class="detail_tools">
			<?php  if($order['comment'] == 1) { ?>
				<div><a href="<?php  echo $this->createMobileUrl('comment', array('id' => $order['id'], 'sid' => $order['sid']))?>" class="comm_btn">查看评价</a></div>
			<?php  } else { ?>
				<div><a href="<?php  echo $this->createMobileUrl('comment', array('id' => $order['id'], 'sid' => $order['sid']))?>" class="comm_btn">去评价</a></div>
			<?php  } ?>
			</div>
		<?php  } ?>
		<?php  if($order['order_type'] == 2 && $order['status'] == 2) { ?>
			<div class="detail_tools">
				<div><a href="javascript:;" class="comm_btn" id="confirmBtn">确认收货</a></div>
		<?php  } ?>
		<?php  if(($order['pay_type'] == 'credit' || $order['pay_type'] == 'wechat') && ($order['status'] == 2 || $order['status'] == 1)) { ?>
			<div class="detail_tools">
				<div><a href="javascript:;" class="comm_btn" id="confirmBtn2">申请退款</a></div>
			</div>
		<?php  } ?>
		</div>
	</section>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?>
</div>
<div class="confirm_box" id="confirmBox">
	<p>您确定已经收到该餐厅的外卖了吗？</p>
	<div>
		<span><a href="javascript:void(0);" class="comm_btn disabled" id="cancelConfirmDelivery">未收到</a></span>
		<span><a href="javascript:void(0);" class="comm_btn" id="confirmDelivery">已收到</a></span>
	</div>
</div>
<div class="confirm_box" id="confirmTK">
	<p>您确定还没收到餐，要退款吗？</p>
	<div>
		<span><a href="javascript:void(0);" class="comm_btn disabled" id="cancelConfirmTK">不退了</a></span>
		<span><a href="javascript:void(0);" class="comm_btn" id="confirmDTK">申请退款</a></span>
	</div>
</div>
<div class="dialog mask" style="display: none;">
	<div class="dialog_wrap">
		<div class="dialog_tt">确认删除订单</div>
		<div class="dialog_scroller"><div class="confirm_box dialog_content" id="confirmBox2" style="display: block;">
			<p>您确定要删除订单？</p>
		<div>
		<span><a href="javascript:void(0);" class="comm_btn disabled" id="cancelConfirmDelete">取消</a></span>
		<span><a href="" class="comm_btn" id="confirmDelete">确认删除</a></span>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		$('#confirmBtn').click(function(){
			$('#confirmBox').dialog({title: '确认送达'});
		});
		$("#cancelConfirmDelivery").click(function(){
			$('#confirmBox').dialog('close');
		});
		$("#confirmDelivery").click(function(){
			$.post("<?php  echo $this->createMobileUrl('ajaxorder', array('id' => $oid, 'sid' => $order['sid'], 'op' => 'editstatus'))?>",{},function(e){
				if(e.errno == 0) {
					location.reload();
				}else{
					alert(e.error);
					return false;
				}
			},"json");
		});
		$('#confirmBtn2').click(function(){
			$('#confirmTK').dialog({title: '申请退款'});
		});
		$("#cancelConfirmTK").click(function(){
			$('#confirmTK').dialog('close');
		});
		$("#confirmDTK").click(function(){
			$.post("<?php  echo $this->createMobileUrl('ajaxorder', array('id' => $oid, 'sid' => $order['sid'], 'op' => 'tk'))?>",{},function(e){
				if(e.errno == 0) {
					location.reload();
				}else{
					alert(e.error);
					return false;
				}
			},"json");
		});

		$("#deleteOrder").click(function(){
			$('#confirmBox2').dialog({title: '确认删除订单'});
		});
		$("#cancelConfirmDelete").click(function(){
			$('#confirmBox2').dialog('close');
		});
		$("#confirmDelete").click(function(){
			$.post("<?php  echo $this->createMobileUrl('ajaxorder', array('id' => $oid, 'op' => 'del'))?>",{},function(e){
				if(e.errno == 0) {
					location.href = e.error;
					return false;
				}else{
					alert(e.error);
					return false;
				}
			},"json");
		});

		$('.box_nav li:nth-of-type(1) a').removeClass('active');
		$('.box_nav li:nth-of-type(1) img').attr('src', '../addons/str_takeout/template/resource/images/dianpu1.png');
		$('.box_nav li:nth-of-type(2) a').addClass('active');
    	$('.box_nav li:nth-of-type(2) img').attr('src', '../addons/str_takeout/template/resource/images/dingdan.png');
    	$('.box_nav li:nth-of-type(3) a').removeClass('active');
		$('.box_nav li:nth-of-type(3) img').attr('src', '../addons/str_takeout/template/resource/images/wode1.png');
	});
	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
		WeixinJSBridge.call('hideOptionMenu');
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
