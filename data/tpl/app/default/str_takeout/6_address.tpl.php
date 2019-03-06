<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/main.css">
<script src="../addons/str_takeout/template/resource/js/dialog.js"></script>
<style type="text/css">
	.line a:hover, .line a:focus{color:#FFF; text-decoration:none}
</style>
<?php  if($op == 'list') { ?>
<div data-role="container" class="container addresslist">
	<section data-role="body">
		<ul class="list">
			<?php  if(is_array($addresses)) { foreach($addresses as $address) { ?>
			<li>
				<table cellpadding="0" cellspacing="0">
					<tbody>
						<tr>
							<td class="td_radio"><input class="addressChecked" <?php  if($address['is_default'] == 1) { ?>checked<?php  } ?> type="radio" data-id="<?php  echo $address['id'];?>"></td>
							<td>
							<div class="text"><span><?php  echo $address['realname'];?></span><label><?php  echo $address['mobile'];?></label></div>
							<div class="text"><?php  echo $address['address'];?></div>
							</td>
							<td class="td_edit"><a href="<?php  echo $this->createMobileUrl('address', array('op' => 'post', 'id' => $address['id'],'sid' => $sid, 'r' => $_GPC['r'], 'mode' => $_GPC['mode']))?>" class="edit_icon"><span></span></a></td>
						</tr>
					</tbody>
				</table>
			</li>
			<?php  } } ?>
		</ul>
		<div class="btn_div"><a href="<?php  echo $this->createMobileUrl('address', array('op' => 'post', 'sid' => $sid, 'r' => $_GPC['r'], 'mode' => $_GPC['mode']))?>" class="add"><span><i></i>新增收件地址</span></a></div>
	</section>
</div>
<?php  } else if($op == 'post') { ?>
<div data-role="container" class="container addressedit">
	<section data-role="body">
		<div class="info">
			<div class="line"><input type="text" name="realname" value="<?php  echo $address['realname'];?>" placeholder="姓名"></div>
			<div class="line"><input type="text" name="mobile" value="<?php  echo $address['mobile'];?>" placeholder="手机"></div>
			<?php  if($store['mobile_verify']['takeout_verify'] && !$address['is_verify'] && $_W['str_takeout']['sms']['status'] == 1) { ?>
				<div class="line"><a href="javascript:;" class="comm_btn" id="send_code" style="width:100%; text-align:center;">获取验证码</a></div>
				<div class="line"><input type="text" name="code" value="" placeholder="短信验证码"></div>
			<?php  } ?>
			<div class="line address addr1"><input name="address" value="<?php  echo $address['address'];?>" type="text" placeholder="详细地址">
				<i class="getposition"></i>
			</div>
		</div>
		<div class="btn_div" <?php  if(!$address) { ?>style="display: none;"<?php  } ?>><a id="deladdress"><span>删除该地址</span></a></div>
	</section>
	<footer data-role="footer">
		<nav class="nav_common">
			<ul class="box_nav" style="bottom:40px">
				<li>
					<a href="javascript:history.go(-1);" class="middle">
						<span class="cacel">&nbsp;</span>
						<label>取消</label>
					</a>
				</li>
				<li id="submit">
					<a class="middle">
						<span class="sure">&nbsp;</span>
						<label>确定</label>
					</a>
				</li>
			</ul>
		</nav>
	</footer>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?>
</div>
<?php  } ?>
<script type="text/javascript">
	$(function(){
		var r = "<?php  echo $_GPC['r'];?>";
		var return_url = "<?php  echo $this->createMobileUrl('order', array('sid' => $sid, 'r' => 1, 'mode' => $_GPC['mode']));?>";
		$('.addressChecked').click(function(){
			var address_id = $(this).attr('data-id');
			if(address_id) {
				$.post("<?php  echo $this->createMobileUrl('address', array('op' => 'default', 'sid' => $sid))?>", {'id':address_id},function(){
					if(r) {
						location.href=return_url + '&address_id='+address_id;
					} else {
						location.href = "<?php  echo $this->createMobileUrl('address', array('op' => 'list'));?>"
					}
				});
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
			var reg = /^[123456789][0-9]{10}/;
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
			var id = '<?php  echo $id;?>';
			var realname = $.trim($(':text[name="realname"]').val());
			if(!realname) {
				alert('预定人不能为空');
				return false;
			}
			var mobile = $.trim($(':text[name="mobile"]').val());
			if(!mobile) {
				alert('手机号不能为空');
				return false;
			}
            var reg = /^[123456789][0-9]{10}/;
			if(!reg.test(mobile)) {
				alert('手机号格式错误');
				return false;
			}
			var code = '';
			<?php  if($store['mobile_verify']['takeout_verify'] == 1 && !$address['is_verify'] && $_W['str_takeout']['sms']['status'] == 1) { ?>
				code = $.trim($(':text[name="code"]').val());
				if(!code) {
					alert('请输入短信验证码');
					return false;
				}
			<?php  } ?>
			var address = $.trim($(':text[name="address"]').val());
			if(!address) {
				alert('收件地址不能为空');
				return false;
			}
			$.post("<?php  echo $this->createMobileUrl('address', array('op' => 'post', 'sid' => $sid))?>", {'id':id,'realname':realname, 'mobile':mobile, 'address':address, 'code':code}, function(data){
				var data = $.parseJSON(data);
				if(!data.errorno) {
					if(r) {
						location.href=return_url + '&address_id='+data.message;
					} else {
						location.href = "<?php  echo $this->createMobileUrl('address', array('op' => 'list'));?>"
					}
				} else {
					alert(data.message);
					return false;
				}
			});
		});

		$('#deladdress').click(function(){
			var id = '<?php  echo $id;?>';
			if(!id) {
				return false;
			}
			if(!confirm('确定删除吗')) return false;
			$.post("<?php  echo $this->createMobileUrl('address', array('op' => 'del', 'sid' => $sid))?>", {'id':id}, function(){
				var data = $.parseJSON(data);
				if(!data.errorno) {
					location.href = "<?php  echo $this->createMobileUrl('address', array('op' => 'list', 'r' => $_GPC['r']));?>"
				} else {
					alert(data.message);
					return false;
				}
			});
		});
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>