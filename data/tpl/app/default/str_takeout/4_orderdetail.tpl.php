<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/main.css">
<script src="../addons/str_takeout/template/resource/js/dialog.js"></script>
<style type="text/css">
	.but-post{display:block;height:30px;line-height:30px;border:none;width:640px;border-radius:3px;font-size:16px;font-weight:bold;color:#fff;background-color:#ff5f32;}
</style>
<div class="container">
	<section>
		<ul class="my_order">
			<li>
				<a href="<?php  echo $this->createMobileUrl('store', array('sid' => $order['sid']))?>">
					<div>
						<?php  if($order['status'] == 1) { ?>
							<div class="ico_status pending"><i></i>待确认</div>
						<?php  } else if($order['status'] == 2) { ?>
							<div class="ico_status inhand"><i></i>处理中</div>
						<?php  } else if($order['status'] == 3) { ?>
							<div class="ico_status complete"><i></i>已完成</div>
						<?php  } else if($order['status'] == 4) { ?>
							<div class="ico_status cancle"><i></i>已取消</div>
						<?php  } else if($order['status'] == 8) { ?>
							<div class="ico_status pending"><i></i>退款中</div>
						<?php  } else if($order['status'] == 9) { ?>
							<div class="ico_status complete"><i></i>已退款</div>
						<?php  } ?>
					</div>
					<div>
						<h3 class="highlight"><?php  echo $store['title'];?></h3>
						<p><?php  echo $order['num'];?>份/￥<?php  echo $order['price'];?></p>
						<div><?php  echo date('Y-m-d H:i', $order['addtime']);?></div>
					</div>
					<div class="w14"><i class="ico_arrow"></i></div>
				</a>
			</li>
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
		<style type="text/css">
			.my_menu_list th{width:0;}
		</style>
		<table class="my_menu_list">
			<thead>
				<tr>
					<th style="width:430px">美食列表</th>
					<th style="width:60px"><?php  echo $order['num'];?>份</th>
					<th style="width:150px"><strong class="highlight">￥<?php  echo $order['price'];?></strong></th>
				</tr>
			</thead>
			<tbody>
				<?php  if(!empty($order['dish'])) { ?>
					<?php  if(is_array($order['dish'])) { foreach($order['dish'] as $da) { ?>
						<tr>
							<td><?php  echo $da['dish_title'];?></td>
							<td>X<?php  echo $da['dish_num'];?></td>
							<td>￥<?php  echo $da['dish_price'];?></td>
						</tr>
					<?php  } } ?>
				<?php  } ?>
			</tbody>
		</table>
		<ul class="box pay_box">
			<li>订单信息</li>
			<li>订单金额:<?php  echo $order['price'];?> 元</li>
			<?php  if($order['is_usecard'] == 1) { ?>
				<li>使用优惠券减免金额:<?php  echo $order['price'] - $order['card_fee']?> 元</li>
				<li>实际支付金额:<?php  echo $order['card_fee'];?> 元</li>
			<?php  } ?>
			<li>
				支付方式：
				<?php  if(empty($order['pay_type'])) { ?>
					<label class="label label-danger">未支付</label>
				<?php  } else { ?>
					<label class="label label-success"><?php  echo $pay_types[$order['pay_type']];?></label>
				<?php  } ?>
			</li>
		</ul>
		<ul class="box pay_box">
			<li>订单类型：
				<span class="<?php  echo $types[$order['order_type']]['css'];?>"><?php  echo $types[$order['order_type']]['text'];?></span>
			</li>
			<li>送餐时间：<?php  echo date('Y-m-d H:i', $order['addtime']);?></li>
			<li>预定人：<?php  echo $order['username'];?></li>
			<li>手机：<?php  echo $order['mobile'];?></li>
			<?php  if($order['order_type'] == 1) { ?>
				<li>桌号：<?php  echo $order['table_info'];?> </li>
				<li>就餐人数：<?php  echo $order['person_num'];?> 人</li>
			<?php  } else { ?>
				<li>送餐地址：<?php  echo $order['address'];?></li>
				<li>送餐时间：<?php  if($order['delivery_time']) { ?><?php  echo $order['delivery_time'];?><?php  } else { ?>尽快送出<?php  } ?></li>
				<li>配送费：<span class="text-strong"><?php  echo $order['delivery_fee'];?>元</span></li>
			<?php  } ?>
			<li>总计：<span class="text-strong"><?php  echo $order['delivery_fee'] + $order['price']?>元</span></li>
			<li>
				赠送积分：<span class="text-strong"><?php  echo $order['grant_credit'];?>积分</span>
				<?php  if(empty($order['is_grant'])) { ?>
					<label class="label label-danger">未赠送</label>
				<?php  } else { ?>
					<label class="label label-success">已赠送</label>
				<?php  } ?>
			</li>
		</ul>
		<ul class="box pay_box">
			<li>备注</li>
			<li><?php  if($order['note']) { ?><?php  echo $order['note'];?><?php  } else { ?>无<?php  } ?></li>
		</ul>
		<?php  if(!empty($logs)) { ?>
		<ul class="box pay_box">
			<li>订单日志</li>
			<?php  if(is_array($logs)) { foreach($logs as $log) { ?>
				<li><i class="fa fa-info-circle"></i> <?php  echo date('Y-m-d H:i', $log['addtime']);?> <?php  echo $log['note'];?></li>
			<?php  } } ?>
		</ul>
		<?php  } ?>
		<div class="my_order_tips">如需取消订单，请与商家联系，谢谢！</div>
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
	});
	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
		WeixinJSBridge.call('hideOptionMenu');
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
