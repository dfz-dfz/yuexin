<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/weixin.css">
<?php  if($op == 'index') { ?>
<div style="height:100%;">
	<div id="queue-index-page"> 
		<div class="ddb-nav-header">
			<div class="nav-left-item">
				<i class="fa fa-angle-left"></i>
			</div>
			<div class="header-title">
				微信排號
			</div>
		</div> 
		<div class="main-view"> 
			<div class="space-12"></div> 
			<div class="guest-op-section section"> 
				<a class="guest-op-option"  onclick="location.reload(true);"> 
					<div class="icon label-orange"> 
						<i class="fa fa-refresh"></i> 
					</div> 
					<div class="text">
						刷新狀態
					</div>
				</a> 
				<a class="guest-op-option" href="<?php  echo $this->createMobileUrl('assign', array('op' => 'post', 'sid' => $sid));?>"> 
					<div class="icon label-green"> 
						<i class="fa fa-send"></i> 
					</div>
					<div class="text">
						我要取號
					</div>
				</a>
			</div>
			<div class="space-12"></div> 
			<div class="queue-index-section section"> 
				<?php  if(is_array($data)) { foreach($data as $da) { ?>
					<div class="queue-setting list-item"> 
						<i class="fa fa-dot-circle-o"></i> 
						<span><?php  echo $da['title'];?></span> 
						<span></span> 
					</div>
				<?php  } } ?>
			</div>
		</div>
	</div>
</div>
<?php  } ?>

<?php  if($op == 'post') { ?>
<div style="height:100%;">
	<div id="queue-index-page"> 
		<div class="ddb-nav-header">
			<div class="nav-left-item" onclick="window.history.go(-1)">
				<i class="fa fa-angle-left"></i>
			</div>
			<div class="header-title">
				我要排號
			</div>
			<div class="nav-right-item">
				<div class="operation-button" id="form-submit">保存</div>
			</div>
		</div> 
		<div class="main-view"> 
			<?php  if($store['assign_mode'] == 2) { ?>
				<div class="space-12"></div> 
				<div class="section" id="new-guest-queue-section">
					<div class="list-item">选择队列</div>
					<div class="list-item">
						<?php  if(is_array($data)) { foreach($data as $da) { ?>
							<div class="choose-queue-setting-label" data-id="<?php  echo $da['id'];?>">
								<div class="text"><?php  echo $da['title'];?></div>
							</div>
						<?php  } } ?>
					</div>
				</div>
			<?php  } ?>
			<div class="space-12"></div> 
			<div class="section" id="new-guest-queue-section">
				<div class="list-item ddb-form-control">
					<div class="ddb-form-label">客人數量</div>
					<input type="text" class="ddb-form-input" name="guest_num" id="guest_num" placeholder="填寫人數">
				</div>
				<div class="list-item ddb-form-control">
					<div class="ddb-form-label">手機號</div>
					<input type="text" class="ddb-form-input" name="mobile" id="mobile" placeholder="填寫手機號">
				</div>
			</div>
		</div>
	</div>
</div>
<?php  } ?>

<?php  if($op == 'mine') { ?>
<div style="height:100%;">
	<div id="queue-index-page"> 
		<div class="ddb-nav-header">
			<div class="nav-left-item">
				<i class="fa fa-angle-left"></i>
			</div>
			<div class="header-title">
				微信排號
			</div>
		</div> 
		<div class="main-view"> 
			<div class="queue-state-section section"> 
				<div class="queue-state-items"> 
					<div class="queue-state-wait-num">
						還需等待
						<span style="font-size:24px"><?php  echo $count;?></span> 桌，您的號碼是
					</div> 
					<div class="guest-num">
						<?php  echo $mine['number'];?>
					</div> 
					<div class="current-queue-setting-state label-orange"> 
						<i class="fa fa-dot-circle-o"></i> <?php  echo $queue['title'];?>，已叫號碼至<?php  echo $now_number;?>
					</div> 
					<div style="height: 20px;"></div> 
				</div>
			</div>
			<div class="space-12"></div> 
			<div class="guest-op-section section"> 
				<a class="guest-op-option" onclick="location.reload(true);"> 
					<div class="icon label-orange"> 
						<i class="fa fa-refresh"></i> 
					</div> 
					<div class="text">
						刷新狀態
					</div>
				</a> 
				<a class="guest-op-option cancel-board" href="javascript:;" data-id="<?php  echo $mine['id'];?>"> 
					<div class="icon label-green"> 
						<i class="fa fa-ban"></i> 
					</div>
					<div class="text">
						取消排隊
					</div>
				</a>
				<a class="guest-op-option" href="<?php  echo $this->createMobileUrl('dish', array('sid' => $sid, 'mode' => 3));?>"> 
					<div class="icon label-green"> 
						<i class="fa fa-list-alt"></i> 
					</div>
					<div class="text">
						預點菜
					</div>
				</a>
			</div>
			<div class="space-12"></div> 
			<div class="queue-index-section section"> 
				<?php  if(is_array($data)) { foreach($data as $da) { ?>
					<div class="queue-setting list-item"> 
						<i class="fa fa-dot-circle-o"></i> 
						<span><?php  echo $da['title'];?></span> 
						<?php  if(!empty($wait[$da['id']]) && $wait[$da['id']]['num'] > 0) { ?>
							<span style="color:red">,<?php  echo $wait[$da['id']]['num'];?>人正在排隊</span>
						<?php  } ?>
					</div>
				<?php  } } ?>
			</div>
		</div>
	</div>
</div>
<?php  } ?>

<script type="text/javascript">
	<?php  if($op == 'mine') { ?>
		function refresh() {
			location.reload();
		}
		setTimeout(refresh, 60000);
	<?php  } ?>

	$('.cancel-board').click(function(){
		if(!confirm('確認取消排隊?')) return false;
		var id = $(this).data('id');
		$.post("<?php  echo $this->createMobileUrl('assign', array('op' => 'cancel', 'sid' => $sid));?>", {id: id}, function(data){
			location.href = "<?php  echo $this->createMobileUrl('assign', array('op' => 'index', 'sid' => $sid));?>";
			return false;
		});
	});

	$('#new-guest-queue-section .choose-queue-setting-label').click(function(){
		$('.choose-queue-setting-label').removeClass('checked');
		$(this).addClass('checked');
		return;
	});

	$('#form-submit').click(function(){
		var queue_id = 0;
		<?php  if($store['assign_mode'] == 2) { ?>
			if(!$('#new-guest-queue-section .choose-queue-setting-label.checked').size()) {
				alert('請選擇排隊隊列');
				return false;
			}
			queue_id = $('#new-guest-queue-section .choose-queue-setting-label.checked').data('id');
		<?php  } ?>
		var guest_num = parseInt($.trim($('#guest_num').val()));
		if(isNaN(guest_num) || !guest_num) {
			alert('客人數量錯誤');
			return false;
		}

		var mobile = $.trim($('#mobile').val());
		// var reg = /^1[34578][0-9]{9}$/;
		// // if(!mobile || !reg.test(mobile)) {
		// // 	alert('手机号有误');
		// // 	return false;
		// // }
		$.post("<?php  echo $this->createMobileUrl('assign', array('op' => 'post', 'sid' => $sid));?>", {queue_id: queue_id, guest_num: guest_num, mobile: mobile}, function(data){
			var data = $.parseJSON(data);
			if(data.message.errno == -1) {
				alert(data.message.message);
			} else {
				location.href = "<?php  echo $this->createMobileUrl('assign', array('op' => 'mine', 'sid' => $sid));?>";
			}
			return false;
		});
	});
</script>
<script src="../addons/str_takeout/template/resource/js/langguage.js"></script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>