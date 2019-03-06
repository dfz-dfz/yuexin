<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/main.css">
<script src="../addons/str_takeout/template/resource/js/order.js"></script>
<script src="../addons/str_takeout/template/resource/js/dialog.js"></script>
<style type="text/css">
	<?php  if($store['comment_status'] == 1) { ?>
	.nav a{width:33.333%;}
	<?php  } ?> 
	body{background-color: #F7F7F7;}
	.order_fixed .fixed{bottom:0;padding: 0;height: 49px;width: 100%;display: flex;align-items: center;justify-content: space-between;}
	.order_fixed .fixed span{margin-left: 14px;font-size: 15px;color: #333;font-weight: 400;}
	.order_fixed .submit_order{width: 119px;height: 49px;margin: 0;line-height: 49px;font-size: 15px;}
	.confirm_box{position: fixed;bottom: 0;z-index: 9999;width: 100%;height: 265px;background-color: #fff;padding: 0;}
	.confirm_box .title{text-align: center;color: #333;font-size: 15px;height: 56px;line-height: 56px;border-top: 1px solid #f3f3f3;}
	.confirm_box ul li{height: 50px;line-height: 50px;display: flex;align-items: center;padding:0 13px;border-top: 1px solid #f3f3f3;}
	.confirm_box li div{font-size: 14px;color: #333;font-weight: 400px;}
	.confirm_box li span{width: 30px;height: 100%;margin-right: 10px;}
	.confirm_box li input{height: 18px;width: 18px;margin: 0;display: none;}
	.confirm_box li input+label{background: url('../addons/str_takeout/template/resource/images/checked.png') 0 0 no-repeat;width: 25px;height: 25px;margin: 0;}
	.confirm_box li .cash_pay{background:url('../addons/str_takeout/template/resource/images/cash_pay.png') 0 0 no-repeat;background-position-y: 15px;background-position-x: 2px;}
	.confirm_box li .weixin_pay{background:url('../addons/str_takeout/template/resource/images/weixin_pay.png') 0 0 no-repeat;background-position-y: 15px;background-position-x: 1px;}
</style>
<header class="menus">
	<span></span>
	確認訂單
</header>
<div class="container">
	<form name="cart_confirm_form" id="cart_confirm_form" action="<?php  echo $this->createMobileUrl('orderconfirm', array('sid' => $sid, 'mode' => $mode), true)?>" method="post">
		<section class="menu_wrap">
			<!-- 選擇按鈕 -->
			<div class="type_btn">
				<div class="left_btn">
					<a href="javascript:void(0);" class="ative" id="invite">自提</a>
					<a href="javascript:void(0);" id="takeout">外賣</a>
				</div>
				<div class="right_time">
					<div>立即取餐</div>
					<div class="invite_time">約20：30可取</div>
					<div class="takeout_time" style="display: none;">約20：30送達</div>
				</div>
			</div>
			<!-- 選擇按鈕end -->

			<!-- 類型詳情 -->
			<div class="type_box invite_box">
				<div class="type_title">自取門店</div>
				<div class="type_details">
					<div>澳門提督馬路店20號地鋪1樓</div>
					<div>提督馬路店</div>
				</div>
			</div>

			<div class="type_box takeout_box" style="display: none;">
			<input type="hidden" name="address_id" id="address_id" value="<?php echo $address['id'];?>">
				<div class="type_title">配送信息</div>
				<div onclick="window.location.href='<?php  echo $this->createMobileUrl('address', array('sid' => $sid, 'mode' => $mode, 'r' => 1));?>'" class="type_details">
					<div><?php  echo $address['mobile'];?> <?php  echo $address['realname'];?></div>
					<div><?php  echo $address['address'];?></div>
				</div>
			</div>
			<!-- 類型詳情end -->
			<ul class="menu_list order_list" id="orderList">
				<div class="order_message">訂單信息</div>
			<?php  if(is_array($dish_info)) { foreach($dish_info as $li) { ?>
				<li id="<?php  echo $li['id'];?>" style="margin-bottom: 10px;">
					<div class="top">
						<div class="img_box">
							<img src="<?php  echo tomedia($li['thumb']);?>" alt="">
						</div>
						<div class="detalis_message">
							<h3><?php  echo $li['title'];?></h3>
							<div class="detalis">牛排，牛奶，正常冰</div>
						</div>
						<div class="num_box">×<span class="nums"><?php  echo $dishes[$li['id']];?></span></div>
						<div class="price_box">$<span class="unit_price"><?php  echo $li['member_price'];?></span></div>
						<input type="hidden" calss="total_price" name="<?php  echo $dishes[$li['id']];?>*<?php  echo $li['member_price'];?>">
					</div>
				</li>
			<?php  } } ?>
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
			<div class="pay_total">實付  $0</div>
			<div onclick="window.location.href='<?php  echo $this->createMobileUrl('address', array('sid' => $sid, 'mode' => $mode, 'r' => 1));?>'" class="link">
				<div>聯繫方式</div>
				<div><?php echo $address['mobile'];?></div>
				<span></span>
			</div>
			
			<div class="pay_type">
				<div class="pay">
					<div>支付方式</div>
					<div id="pay">現金支付</div>
					<span></span>
				</div> 
				<div class="remarks">
					<div>備註</div>
					<div>備註加料、不辣等</div>
					<span></span>
				</div>
			</div>
		</section>
		<footer class="order_fixed">
			<div class="fixed">
				<span>合計<span class="pay_totals"></span></span>
				<a href="javascript:;" id="submit_order" class="comm_btn submit_order">提交訂單</a>
			</div>
		</footer>
	</form>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?>
</div>

<!-- <div class="confirm_box" style="" id="emptyBox">
	<p>确定清空已选菜品吗？</p>
	<div>
		<span><a href="javascript:void(0);" class="comm_btn disabled" id="cancel_empty">取消</a></span>
		<span><a href="javascript:void(0);" class="comm_btn" id="confirm_empty">确定</a></span>
	</div>
</div>
<div class="confirm_box" style="" id="addBox">
	<p>或许您对我们的推荐菜品感兴趣！！</p>
	<div>
		<span><a href="javascript:void(0);" class="comm_btn " id="add_back" style="display: inline-block;background: #51C332;" >去看看</a></span>
		<span><a href="javascript:void(0);" class="comm_btn" id="add_go">不需要，提交订单</a></span>
	</div>
</div> -->
<div class="confirm_box">
	<div class="title">選擇支付方式</div>
	<ul>
		<li id="cash_pay">
			<span class="cash_pay"></span>
			<div>現金支付</div>
			<input type="checkbox" checked="checked" id="cash"><label for="cash"></label>
		</li>
		<li id="weixin_pay">
			<span class="weixin_pay"></span>
			<div>微信支付</div>
			<input type="checkbox" id="weixin"><label for="weixin" style="visibility: hidden;"></label>
		</li>
	</ul>
</div>

<script type="text/javascript">
	$(function(){
		var amountCb = $.amountCb();
		$('.order_list li').each(function(){
			var count = parseInt($(this).find('.count').text()),
				_add = $(this).find('.add'),
				i = 0;

			for(; i < count; i++){
				amountCb.call(_add, '+');
			}
			_add.amount(count, amountCb);
		});

		//獲取實付總價格
		var arr = [];
		var arrs = [];
		var length = $('#orderList input[type="hidden"]').length;
		for(var n = 0;n < length;n++){
			var totals = $('#orderList input[type="hidden"]').eq(n).attr('name');
			arrs = totals.split('*');
			var total = Number(arrs[0])*Number(arrs[1]);
			arr.push(total);
		}
		var prices = parseInt(eval(arr.join('+')))+parseInt($('.lunch_price').text().substring(1))+parseInt($('.dispatching_price').text().substring(1));
		$('.pay_total').text('實付   $'+prices)
		$('.pay_totals').text('$'+prices)


		$("#submit_order").click(function(){
			if(!$(this).hasClass('disabled')){
				$(this).addClass('disabled');
				<?php  if($mode > 0) { ?>
					var order_type = "<?php  echo $mode;?>";
				<?php  } else { ?>
					var order_type = $(':radio[name="order_type"]:checked').val();
				<?php  } ?>
				if(order_type == 1) {
					var wo_user_name = $.trim($("#realname").val());
					var wo_receiver_mobile = $.trim($("#mobile").val());
					if(!wo_user_name) {
						alert('请填写预定人');
						$(this).removeClass('disabled');
						return false;
					}
					if(!wo_receiver_mobile || !/^.{5,20}$/gi.test(wo_receiver_mobile) || !/^(\+\s?)?(\d*\s?)?(?:\(\s?(\d+[-\s])?\d+\s?\)\s?)?\s?(\d+[-\s]?)+\d+$/gi.test(wo_receiver_mobile)) {
						alert('请填写有效的手机号');
						$(this).removeClass('disabled');
						return false;
					}
					var note = $.trim($('#note_meal').val())
					var person_num = parseInt($('#person_num').val());
					if(!person_num) {
						alert('请填写就餐人数');
						$(this).removeClass('disabled');
						return false;
					}
					var table_id = $('#table_id').val();
					var table_info = $('#table_info').val();
					var param = {
						'order_type' :1,
						'username':wo_user_name,
						'mobile':wo_receiver_mobile,
						'person_num':person_num,
						'table_id':table_id,
						'table_info':table_info,
						'note':note
					}
				} else if(order_type == 2) {
					var send_price = parseFloat("<?php  echo $store['send_price'];?>");
					var cart_price = parseFloat("<?php  echo $cart['price'];?>");
					if(cart_price < send_price) {
						_dishBox.dialog({title: '确定提交'});
						$(this).removeClass('disabled');
						return false;
					}
					
					var address_id = $("#address_id").val();
					if(!address_id) {
						alert('请选择送餐地址');
						$(this).removeClass('disabled');
						return false;
					}
					var wo_memo = $.trim($("#remarkTxt").html());
					if(wo_memo == '点击添加订单备注') {
						wo_memo = '';
					}
					var wo_delivery_time = $.trim($("#arriveTime").html());
					if(wo_delivery_time == '尽快送出'){
						wo_delivery_time = '';
					}
					var param = {
						'order_type' :2,
						'address_id':address_id,
						'note':wo_memo,
						'delivery_time':wo_delivery_time,
					}
				}

				$.post("<?php  echo $this->createMobileUrl('orderconfirm', array('sid' => $sid));?>", param, function(e){
					if(e.errno == 0) {
						$("#submit_order").html('已提交');
						$("#submit_order").addClass('disabled');
						window.location.href = e.url;
						return false;
					}else{
						alert(e.error);
						$("#submit_order").removeClass('disabled');
					}
				},'json');
			}
			return false;
		});
	});

	//支付方式
	$('.pay').click(function(){
		$('.confirm_box').show();
		return false;
	});
	$('#cash_pay').click(function() {
		$('#cash_pay input').attr('checked','checked');
		$('#weixin_pay input').removeAttr('checked');
		$('#cash+label').css('visibility','visible');
		$('#weixin+label').css('visibility','hidden');
		$('#pay').html('現金支付');
		$('.confirm_box').hide();
	});
	$('#weixin_pay').click(function() {
		$('#weixin_pay input').attr('checked','checked');
		$('#cash_pay input').removeAttr('checked');
		$('#cash+label').css('visibility','hidden');
		$('#weixin+label').css('visibility','visible');
		$('#pay').html('微信支付');
		$('.confirm_box').hide();
	});
	$('.confirm_box').click(function() {
		return false;
	});
	$(document).click(function(event) {
		$('.confirm_box').hide();
	});

	// 配送類型
	$('#invite').click(function(){
		$(this).addClass('ative');
		$('#takeout').removeClass('ative');
		$('.invite_box').show();
		$('.takeout_box').hide();
		$('.invite_time').show();
		$('.takeout_time').hide();
		$('.link').show();
	});

	$('#takeout').click(function(){
		$(this).addClass('ative');
		$('#invite').removeClass('ative');
		$('.invite_box').hide();
		$('.takeout_box').show();
		$('.invite_time').hide();
		$('.takeout_time').show();
		$('.link').hide();
	});
	// 配送類型end

	$('#emptyBtn').click(function(){
		$('#emptyBox').dialog({title: '确定重选菜品'});
	});

	$("#cancel_empty").click(function(){
		$('#emptyBox').dialog('close');
	});

	$("#confirm_empty").click(function(){
		location.href="<?php  echo $this->createMobileUrl('dish', array('sid' => $_GPC['sid'], 'f' => 1, 'mode' => $mode, 'tid' => $_GPC['__z']))?>";
		return false;
	});

	var is_add = "<?php  echo $is_add;?>";
//	$('.submit_order').click(function(){
		// var add_flag = parseInt($('#addtip').attr('data-flag'));
		// if(!add_flag && is_add == 1) {
		// 	$('#addBox').dialog({title: '亲，看看我们的推荐菜品嘛！'});
		// 	$("#add_back").click(function(){
		// 		$('#addtip').attr('data-flag', 1)
		// 		$('#addBox').dialog('close');
		// 		$('#addList, #addtip').slideDown(500);
		// 		return false;
		// 	});
		// 	$("#add_go").click(function(){
		// 		$('#cart_confirm_form').submit();
		// 		return false;
		// 	});
		// } else {
		// 	$('#cart_confirm_form').submit();
		// 	return false;
		// }
//		$('#cart_confirm_form').submit();
//		return false;
//	});

	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
		WeixinJSBridge.call('hideOptionMenu');
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>