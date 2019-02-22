<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/main.css">
<script src="../addons/str_takeout/template/resource/js/order.js"></script>
<script src="../addons/str_takeout/template/resource/js/dialog.js"></script>
<style type="text/css">
	<?php  if($store['comment_status'] == 1) { ?>
	.nav a{width:33.333%;}
	<?php  } ?>
	body{background-color: #F7F7F7;}
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
				<div class="type_title">配送信息</div>
				<div class="type_details">
					<div>13568932001 吳先生</div>
					<div>東南亞商業中心</div>
				</div>
			</div>
			<!-- 類型詳情end -->
			<ul class="menu_list order_list" id="orderList">
				<div class="order_message">訂單信息</div>
			<?php  if(is_array($dish_info)) { foreach($dish_info as $li) { ?>
				<li id="<?php  echo $li['id'];?>">
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
			<div class="pay_total">實付  $40</div>
			<div class="tips" id="addtip" style="background-color:#e1943c;display:none" data-flag="0">亲，您可能还需要以下菜品</div>
			<!-- 提醒客户需要点的菜品（比如：米饭）-->
			<?php  if(!empty($dish_add)) { ?>
				<ul class="menu_list order_list" id="addList" style="display:none">
				<?php  if(is_array($dish_add)) { foreach($dish_add as $add_li) { ?>
					<li>
						<div>
							<img src="<?php  echo tomedia($add_li['thumb']);?>" alt="">
						</div>
						<div>
							<h3><?php  echo $add_li['title'];?></h3>
							<div>
								<div class="fr" max="<?php  echo $add_li['total'];?>">
									<a href="javascript:void(0);" class="btn_n add active"></a>
								</div>
								<input autocomplete="off" class="number" type="hidden" name="dish[<?php  echo $add_li['id'];?>]" value="0">
								<span class="count">0</span>
								<strong>$<span class="unit_price"><?php  echo $add_li['member_price'];?></span></strong>
							</div>
						</div>
					</li>
				<?php  } } ?>
				</ul>
			<?php  } ?>
			<div style="margin:15px 0 0 15px;">
				<a href="javascript:;" class="comm_btn" style="display: inline-block;background: #51C332;margin-right:15px" id="emptyBtn">重选</a>
			</div>
		</section>
		<footer class="order_fixed">
			<div class="fixed" style="bottom:0;padding: 0;">
				<a href="<?php  echo $this->createMobileUrl('dish', array('sid' => $sid, 'mode' => $mode, 'tid' => $_GPC['__z']));?>" class="add"><label><span>加菜</span></label></a>
				<a href="javascript:;" class="comm_btn submit_order" style="display: inline-block;">订单确认</a>
			</div>
		</footer>
	</form>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?>
</div>
<div class="confirm_box" style="" id="emptyBox">
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
	});

	// 配送類型
	$('#invite').click(function(){
		$(this).addClass('ative');
		$('#takeout').removeClass('ative');
		$('.invite_box').css('display','block');
		$('.takeout_box').css('display','none');
		$('.invite_time').css('display','block');
		$('.takeout_time').css('display','none');
	});

	$('#takeout').click(function(){
		$(this).addClass('ative');
		$('#invite').removeClass('ative');
		$('.invite_box').css('display','none');
		$('.takeout_box').css('display','block');
		$('.invite_time').css('display','none');
		$('.takeout_time').css('display','block');
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
	$('.submit_order').click(function(){
		var add_flag = parseInt($('#addtip').attr('data-flag'));
		if(!add_flag && is_add == 1) {
			$('#addBox').dialog({title: '亲，看看我们的推荐菜品嘛！'});
			$("#add_back").click(function(){
				$('#addtip').attr('data-flag', 1)
				$('#addBox').dialog('close');
				$('#addList, #addtip').slideDown(500);
				return false;
			});
			$("#add_go").click(function(){
				$('#cart_confirm_form').submit();
				return false;
			});
		} else {
			$('#cart_confirm_form').submit();
			return false;
		}
	});

	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
		WeixinJSBridge.call('hideOptionMenu');
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>