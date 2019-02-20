<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/main.css">
<script src="../addons/str_takeout/template/resource/js/order.js"></script>
<script src="../addons/str_takeout/template/resource/js/dialog.js"></script>
<style type="text/css">
	<?php  if($store['comment_status'] == 1) { ?>
	.nav a{width:33.333%;}
	<?php  } ?>
</style>
<header class="menu">
	<span></span>
	確認訂單
</header>
<div class="container">
	<form name="cart_confirm_form" id="cart_confirm_form" action="<?php  echo $this->createMobileUrl('orderconfirm', array('sid' => $sid, 'mode' => $mode), true)?>" method="post">
		<section class="menu_wrap">
			<ul class="menu_list order_list" id="orderList">
			<?php  if(is_array($dish_info)) { foreach($dish_info as $li) { ?>
				<li id="<?php  echo $li['id'];?>">
					<div class="top">
						<div>
							<img src="<?php  echo tomedia($li['thumb']);?>" alt="">
						</div>
						<div>
							<h3><?php  echo $li['title'];?></h3>
							<div>
								<div class="fr" max="<?php  echo $li['total'];?>" data-first-order-limit="<?php  echo $li['first_order_limit'];?>" data-buy-limit="<?php  echo $li['buy_limit'];?>" data-first-order="<?php  echo $is_first_order;?>">
									<a href="javascript:void(0);" class="btn_n add active"></a>
								</div>
								<input autocomplete="off" class="number" type="hidden" name="dish[<?php  echo $li['id'];?>]" value="<?php  echo $dishes[$li['id']];?>">
								<span class="count"><?php  echo $dishes[$li['id']];?></span>
								<strong>￥<span class="unit_price"><?php  echo $li['member_price'];?></span></strong>
							</div>
						</div>
					</div>
				</li>
			<?php  } } ?>
			</ul>
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
								<strong>￥<span class="unit_price"><?php  echo $add_li['member_price'];?></span></strong>
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
			<div class="fixed">
				<p>
					<span class="fr">总计：<strong>￥<span id="totalPrice"></span></strong> / <span id="cartNum" class="has_num"></span>份</span>
					<?php  if($_GPC['mode'] == 2) { ?>
						配送费：￥<?php  echo $store['delivery_price'];?>
					<?php  } else { ?>
						配送费：￥0
					<?php  } ?>
				</p>
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
	});

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