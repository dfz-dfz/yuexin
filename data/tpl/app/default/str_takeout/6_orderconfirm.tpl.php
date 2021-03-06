<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/main.css">
<script src="../addons/str_takeout/template/resource/js/dialog.js"></script>
<style type="text/css">
	label{margin-bottom: 0;font-weight: normal;}
	.menu_list li .top > div:nth-of-type(3){background: none;}
</style>
<div class="container">
	<section class="pay_wrap">
		<ul class="box pay_box">
			<li><label>订单费用</label></li>
			<li>
				<a href="javascript:;">
					<strong>份数：<span class="text-strong"><?php  echo $cart['num'];?>份</span></strong>
					<span>
						合计：<span class="text-strong"><?php  echo $cart['price'];?>元</span>	
					</span>
				</a>
			</li>
			<?php  if($mode == 2) { ?>
				<li class="is_takeout">
					<a href="javascript:;">
						<strong>本店外卖<span class="text-strong"><?php  echo $store['send_price'];?></span>元起送</strong>
						<span>
							配送费：<span class="text-strong"><?php  echo $store['delivery_price'];?>元</span>	
						</span>
					</a>
				</li>
			<?php  } ?>
			<?php  if($cart['grant_credit'] > 0) { ?>
			<li>
				<a href="javascript:;">
					<strong>可赠送：<span class="text-strong"><?php  echo $cart['grant_credit'];?>积分</span></strong>
				</a>
			</li>
			<?php  } ?>
		</ul>
		<?php  if($mode > 0) { ?>
			<input type="hidden" name="order_type" value="<?php  echo $mode;?>">
		<?php  } else { ?>
			<ul class="box pay_type">
				<li><label>订单类型</label></li>
				<?php  if($store['is_meal'] == 1) { ?>
					<li><label><input type="radio" name="order_type" value="1" <?php  if(!$return) { ?>checked="checked"<?php  } ?> onclick="$('.is_takeout').slideUp();$('#is_meal').slideDown();">店内点餐</label></li>
				<?php  } ?>
				<?php  if($store['is_takeout'] == 1) { ?>
					<li><label><input type="radio" name="order_type" value="2" <?php  if($return || $store['is_meal'] == 2) { ?>checked="checked"<?php  } ?> onclick="$('#is_meal').slideUp();$('.is_takeout').slideDown();">外卖订餐</label></li>
				<?php  } ?>
			</ul>
		<?php  } ?>
		<?php  if($mobile_verify) { ?>
			<ul class="box pay_box is_takeout">
				<li><label>首次下单短信验证</label></li>
				<li>
					<a href="javascript:void(0);" style="width:100%">
						<input class="txt" name="mobile" placeholder="请填写手机号" id="mobile" value="">
					</a>
					<a href="javascript:;" class="comm_btn" id="send_code" style="width:100%; text-align:center; margin:10px 0; background:#5cb85c">获取验证码</a>
					<a href="javascript:void(0);" style="width:100%">
						<input class="txt" name="code" placeholder="短信验证码" id="code" value="">
					</a>
					<a href="javascript:;" class="comm_btn" id="submit" style="width:100%; text-align:center; margin:10px 0">开始验证</a>
				</li>
			</ul>
		<?php  } else { ?>
			<?php  if($mode == 1) { ?>
				<input type="hidden" name="table_id" id="table_id" value="<?php  echo $table['id'];?>">
				<input type="hidden" name="table_info" id="table_info" value="<?php  echo $table['ctitle'];?>-<?php  echo $table['title'];?>">
				<ul class="box pay_box" id="is_meal">
					<li><label>就餐信息</label></li>
					<li>
						<a href="javascript:;">
							<strong>用户姓名：</strong>
							<span>
								<input class="txt" name="realname" placeholder="用户姓名" id="realname" value="<?php  echo $member['realname'];?>">
							</span>
						</a>
					</li>
					<li>
						<a href="javascript:;">
							<strong>手机号码：</strong>
							<span>
								<input class="txt" type="num" name="mobile" placeholder="手机号" id="mobile" value="<?php  echo $member['mobile'];?>">
							</span>
						</a>
					</li>
					<li>
						<a href="javascript:;">
							<strong>就餐人数：</strong>
							<span>
								<input class="txt" type="num" name="person_num" placeholder="就餐人数" id="person_num" value="">
							</span>
						</a>
					</li>
					<li>
						<a href="javascript:;">
							<strong>订单备注：</strong>
							<span>
								<textarea class="txt" style="height:50px" name="note" placeholder="订单备注" id="note_meal"></textarea>
							</span>
						</a>
					</li>
				</ul>
			<?php  } ?>
			<?php  if($mode == 2) { ?>
				<ul class="box pay_box is_takeout">
					<li><label>外卖信息</label></li>
					<?php  if(empty($address)) { ?>
						<li>
							<a href="<?php  echo $this->createMobileUrl('address', array('sid' => $sid, 'mode' => $mode, 'r' => 1));?>">
								<strong>请添加送餐地址</strong>
								<span></span>
								<div><i class="ico_arrow"></i></div>
							</a>
						</li>
					<?php  } else { ?>
						<input type="hidden" name="address_id" value="<?php  echo $address['id'];?>" id="address_id">
						<li>
							<a href="<?php  echo $this->createMobileUrl('address', array('sid' => $sid, 'mode' => $mode, 'r' => 1));?>">
								<strong>
									<span id="showAddres"><?php  echo $address['address'];?></span><br>
									<span id="showName"><?php  echo $address['realname'];?></span>
									<span id="showTel"><?php  echo $address['mobile'];?></span>
								</strong>
								<span>收件地址</span>
								<div><i class="ico_arrow"></i></div>
							</a>
						</li>
					<?php  } ?>
					<li>
						<a href="javascript:void(0);" id="timeBtn">
							<strong>送达时间</strong>
							<span id="arriveTime">尽快送出</span>
							<div><i class="ico_arrow"></i></div>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);" id="remarkBtn">
							<strong>订单备注</strong>
							<span id="remarkTxt">点击添加订单备注</span>
							<div><i class="ico_arrow"></i></div>
						</a>
					</li>
				</ul>
			<?php  } ?>
		<?php  } ?>
	</section>
	<footer class="go_menu">
		<div class="fixed">
			<a id="submit_order" <?php  if($mobile_verify) { ?>class="disabled"<?php  } ?> href="javascript:void(0);">提交订单</a>
		</div>
	</footer>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?>
</div>

<div id="timeBox" class="timeBox">
	<div>
		<a href="javascript:void(0);">尽快送出</a>
		<?php  echo $str;?>
	</div>
</div>

<div class="addres_box" id="remarkBox">
	<ul>
		<li><textarea class="txt max" placeholder="请填写备注" id="userMark"></textarea></li>
		<li class="btns_wrap">
			<span><a href="javascript:void(0);" class="comm_btn higher disabled" id="cancleRemark">取消</a></span>
			<span><a href="javascript:void(0);" class="comm_btn higher" id="saveRemark">确认</a></span>
		</li>
	</ul>
</div>

<div class="confirm_box" id="dishBox">
	<p>本店外卖<?php  echo $store['send_price'];?>起送,您的菜品费少于起送价,现在去加菜？</p>
	<div>
		<span><a href="javascript:void(0);" class="comm_btn disabled" id="canceldish">取消</a></span>
		<span><a href="javascript:void(0);" class="comm_btn" id="confirmdish">去加菜</a></span>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		var _timeBox = $('#timeBox'),
			_remarkBox = $('#remarkBox'),
			_dishBox = $('#dishBox'),
			_remarkInput = _remarkBox.find('textarea');

		// 选择送餐时间
		$('#timeBtn').bind('click', function(){
			_timeBox.dialog({title: '选择送达时间'});
		});

		_timeBox.find('a').bind('click', function(){
			$('#arriveTime').text($(this).text());
			_timeBox.dialog('close');
		});

		// 添加备注
		$('#remarkBtn').bind('click', function(){
			var remark = $('#remarkTxt').text();
			if(remark == '点击添加订单备注') remark = '';
			$('#userMark').val(remark);
			_remarkBox.dialog({title: '添加备注'});
		});

		$('#cancleRemark').bind('click', function(){
			_remarkBox.dialog('close');
		});

		$('#saveRemark').bind('click', function(){
			$('#remarkTxt').text(_remarkInput.val());
			_remarkInput.val('');
			_remarkBox.dialog('close');
		});

		$("#canceldish").click(function(){
			$('#dishBox').dialog('close');
		});
		$("#confirmdish").click(function(){
			location.href="<?php  echo $this->createMobileUrl('dish', array('sid' => $store['id']))?>"
			return false;
		});

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

		$('#send_code').click(function(){
			if($(this).hasClass('disabled')) {
				return false;
			}
			var mobile = $.trim($(':text[name="mobile"]').val());
			if(!mobile) {
				alert('请输入手机号');
				return false;
			}
			var reg = /^1[34578][0-9]{9}/;
			if(!reg.test(mobile)) {
				alert('手机号格式错误');
				return false;
			}
			var $this = $(this);
			$this.addClass("disabled");
			var downcount = 60;
			$this.html(downcount + "秒后重新获取");

			var timer = setInterval(function(){
				downcount--;
				if(downcount <= 0){
					clearInterval(timer);
					$this.html("重新获取验证码");
					$this.removeClass("disabled");
					downcount = 60;
				}else{
					$this.html(downcount + "秒后重新获取");
				}
			}, 1000);

			$.post("<?php  echo $this->createMobileUrl('code', array('sid' => $sid))?>", {mobile: mobile}, function(data){
				if(data != 'success') {
					alert(data)
				}
			});
			return false;
		});

		$('#submit').click(function(){
			var mobile = $.trim($(':text[name="mobile"]').val());
			if(!mobile) {
				alert('手机号不能为空');
				return false;
			}
			var reg = /^1[34578][0-9]{9}/;
			if(!reg.test(mobile)) {
				alert('手机号格式错误');
				return false;
			}
			var code = $.trim($(':text[name="code"]').val());
			if(!code) {
				alert('请输入短信验证码');
				return false;
			}
			$.post("<?php  echo $this->createMobileUrl('verify', array('sid' => $sid, 'op' => 'first_order'))?>", {'mobile':mobile, 'code':code}, function(data){
				if(data == 'success') {
					location.reload();
				} else {
					alert(data);
					return false;
				}
			});
		});
	});
	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
		WeixinJSBridge.call('hideOptionMenu');
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
