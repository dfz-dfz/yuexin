<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/weixin.css">

<?php  if($op == 'index') { ?>
<div style="height:100%;">
	<div class="ddb-nav-header">
		<div class="nav-left-item">
			<i class="fa fa-angle-left"></i>
		</div>
		<div class="header-title">
			预订时间
		</div>
	</div>
	<div class="ddb-secondary-nav-header ddb-tab-bar time-point-date-nav">
		<div class="ddb-tab-item active" data-value="<?php  echo date('Y-m-d');?>">
			<div class="day">
				今天
			</div>
			<div class="date">
				<?php  echo date('m-d'); ?> <?php  echo date2week(time());?>
			</div>
		</div>
		<div class="ddb-tab-item" data-value="<?php  echo date('Y-m-d', strtotime('+1 days'));?>">
			<div class="day">
				明天
			</div>
			<div class="date">
				<?php  echo date('m-d', strtotime('+1 days')); ?> <?php  echo date2week(strtotime('+1 days'));?>
			</div>
		</div>
		<div class="ddb-tab-item" style="display:none" data-value="<?php  echo date('Y-m-d', strtotime('+2 days'));?>">
			<div class="day">
				后天
			</div>
			<div class="date">
				<?php  echo date('m-d', strtotime('+2 days')); ?> <?php  echo date2week(strtotime('+2 days'));?>
			</div>
		</div>
		<div class="ddb-tab-item" style="display:none" data-value="<?php  echo date('Y-m-d', strtotime('+3 days'));?>">
			<div class="day">
				<?php  echo date('m-d', strtotime('+3 days')); ?>
			</div>
			<div class="date">
				<?php  echo date2week(strtotime('+3 days'));?>
			</div>
		</div>
		<div class="ddb-tab-item" style="display:none" data-value="<?php  echo date('Y-m-d', strtotime('+4 days'));?>">
			<div class="day">
				<?php  echo date('m-d', strtotime('+4 days')); ?>
			</div>
			<div class="date">
				<?php  echo date2week(strtotime('+4 days'));?>
			</div>
		</div>
		<div class="ddb-tab-item" style="display:none" data-value="<?php  echo date('Y-m-d', strtotime('+5 days'));?>">
			<div class="day">
				<?php  echo date('m-d', strtotime('+5 days')); ?>
			</div>
			<div class="date">
				<?php  echo date2week(strtotime('+5 days'));?>
			</div>
		</div>
		<div class="ddb-tab-item" style="display:none" data-value="<?php  echo date('Y-m-d', strtotime('+6 days'));?>">
			<div class="day">
				<?php  echo date('m-d', strtotime('+6 days')); ?>
			</div>
			<div class="date">
				<?php  echo date2week(strtotime('+6 days'));?>
			</div>
		</div>
	</div>
	<div class="main-view" id="time-points-index">
		<div class="section">
		</div>
		<div>
			<div class="table-zone-item">
				<?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
					<div class="name"><?php  echo $category['title'];?></div>
					<div class="min_reservation_price">￥<?php  echo $category['reservation_price'];?>起订</div>
					<div class="time-points">
						<?php  if(is_array($reserves[$category['id']])) { foreach($reserves[$category['id']] as $row) { ?>
							<span class="button time-point border-red <?php  if(strtotime($row) < time()) { ?>time-disabled<?php  } ?>" data-value="<?php  echo $row;?>" data-cid="<?php  echo $category['id'];?>" data-flag="<?php  if(strtotime($row) < time()) { ?>0<?php  } else { ?>1<?php  } ?>">
								<?php  echo $row;?>
							</span>
						<?php  } } ?>
					</div>
					<div class="space-12"></div>
				<?php  } } ?>
			</div>
		</div>
	</div>
</div>
<?php  } ?>

<?php  if($op == 'post') { ?>
<div style="height:100%;">
	<div id="new-order-checkout-page">
		<div class="ddb-nav-header">
			<div class="nav-left-item">
				<i class="fa fa-angle-left"></i>
			</div>
			<div class="header-title">
				预定订单
			</div>
		</div>
		<div class="ddb-nav-footer orders-common-footer">
			<div class="button checkout-button right <?php  if($cart['price'] < $category['limit_price']) { ?>disable<?php  } ?>" id="btnselect">确认提交</div>
			<div class="quantity-total"><?php  echo $cart['num'];?></div>
			<div class="total-amount red">
				￥<?php  echo $cart['price'];?>
			</div>
		</div>
		<div id="new-reservation-order-form" class="main-view">
			<div class="section">
			</div>
			<div class="space-8"></div>
			<div class="section">
				<div class="list-item branch-name"><?php  echo $store['title'];?></div>
				<div class="list-item">
					<span class="table-zone"><?php  echo $category['title'];?></span>
					<span class="reservation-time"><?php  echo $date;?> <?php  echo $time;?></span>
				</div>
				<div class="list-item">
					<div class="prepayment-type" data-type="table">
						<div class="price">预付￥<?php  echo $category['reservation_price'];?></div>
						<div class="label">只订座</div>
						<div class="radio" style="margin:0"></div>
					</div>
					<div class="prepayment-type active" data-type="order">
						<div class="price">
						￥<?php  echo $category['limit_price'];?> 起订
						</div>
						<div class="label">提前下单</div>
						<div class="radio" style="margin:0"></div>
					</div>
				</div>
				<div class="list-item ddb-form-control">
					<div class="ddb-form-label">姓名</div>
					<div class="input-field">
						<input type="text" class="ddb-form-input" name="realname" id="realname" placeholder="输入您的姓名" value="<?php  echo $_W['member']['nickname'];?>">
					</div>
				</div>
				<div class="list-item ddb-form-control">
					<div class="ddb-form-label">电话</div>
					<div class="input-field">
						<input type="text" class="ddb-form-input" name="mobile" id="mobile" placeholder="输入您的联系电话" value="<?php  echo $_W['member']['mobile'];?>">
					</div>
				</div>
				<div class="list-item ddb-form-control">
					<textarea placeholder="请输入备注（可不填）" id="note"></textarea>
				</div>
			</div>
		</div>
	</div>
</div>
<?php  } ?>
<script type="text/javascript">
$(function(){
	var date = $('.ddb-tab-item.active').data('value');
	var today = "<?php  echo date('Y-m-d');?>";
	if(date == today) {
		$('.time-disabled').removeClass('border-red').addClass('border-gray');
	}

	$('.ddb-tab-item').click(function(){
		$('.ddb-tab-item').removeClass('active').hide();
		$(this).prev().show();
		$(this).next().show();
		$(this).addClass('active').show();

		var date = $('.ddb-tab-item.active').data('value');
		var today = "<?php  echo date('Y-m-d');?>";
		if(date == today) {
			$('.time-disabled').removeClass('border-red').addClass('border-gray');
		} else {
			$('.time-disabled').addClass('border-red').removeClass('border-gray');
		}
	});

	$('.time-point').click(function(){
		if($(this).hasClass('border-gray')) {
			return false;
		}
		var date = $('.ddb-tab-item.active').data('value');
		var time = $(this).data('value');
		var cid = $(this).data('cid');
		location.href = "<?php  echo $this->createMobileUrl('reserve', array('op' => 'post', 'sid' => $sid, 'mode' => 4))?>" + '&date=' + date + '&time=' + time + '&cid=' + cid;
	});

	$('.prepayment-type').click(function(){
		$('.prepayment-type').removeClass('active');
		$(this).addClass('active');
		if($(this).data('type') == 'order') {
			var date = "<?php  echo $date;?>";
			var time = "<?php  echo $time;?>";
			var cid = "<?php  echo $cid;?>";
			location.href = "<?php  echo $this->createMobileUrl('dish', array('sid' => $sid, 'mode' => 4))?>" + '&date=' + date + '&time=' + time + '&cid=' + cid;
		} else {
			$('#btnselect').removeClass('disable');
		}
	});

	$('#btnselect').click(function(){
		var type = $('.prepayment-type.active').data('type');
		if(!type) {
			alert('预定类型错误');
			return false;
		}
		if(type == 'table') {
			type = 3;
		} else {
			type = 4;
		}
		var realname = $.trim($('#realname').val());
		if(!realname) {
			alert('预定人不能为空');
			return false;
		}
		var mobile = $.trim($('#mobile').val());
		if(!realname) {
			alert('手机号不能为空');
			return false;
		}
		var note = $.trim($('#note').val());
		var date = "<?php  echo $date;?>";
		var time = "<?php  echo $time;?>";
		var cid = "<?php  echo $cid;?>";
		var params = {
			realname: realname,
			mobile: mobile,
			note: note,
			date: date,
			time: time,
			cid: cid,
			type: type,
		};
		$(this).addClass('disable');
		$.post("<?php  echo $this->createMobileUrl('reserve', array('sid' => $sid, 'op' => 'order'));?>", params, function(data){
			var result = $.parseJSON(data);
			if(result.message.errno != 0) {
				alert(data.message.message);
				$(this).removeClass('disable');
				return false;
			}
			var id = result.message.message;
			location.href = "<?php  echo $this->createMobileUrl('pay', array('sid' => $sid));?>" + '&id=' + id;
		});
	});
});
</script>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>