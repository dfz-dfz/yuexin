<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/style.css">
<script src="../addons/str_takeout/template/resource/js/jquery.qrcode.min.js"></script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('nav', TEMPLATE_INCLUDEPATH)) : (include template('nav', TEMPLATE_INCLUDEPATH));?>
<div class="clearfix">
	<div class="panel panel-default">
		<div class="panel-body">
			<ul class="nav nav-pills">
				<li <?php  if($op == 'board_list' ||  $op == 'board_detail') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('assign', array('op' => 'board_list'));?>">客人队列</a></li>
				<li <?php  if($op == 'queue_list' ||  $op == 'queue_post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('assign', array('op' => 'queue_list'));?>">队列设置</a></li>
				<li <?php  if($op == 'assign_mode') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('assign', array('op' => 'assign_mode'));?>">排号模式</a></li>
				<li <?php  if($op == 'assign_qrcode') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('assign', array('op' => 'assign_qrcode'));?>">排号二维码</a></li>
			</ul>
			<?php  if($op == 'queue_list') { ?>
				<h3>队列设置 列表</h3>
				<hr>
				<a href="<?php  echo $this->createWebUrl('assign', array('op' => 'queue_post'));?>" class="btn btn-primary">新建 队列设置</a>
				<div class="queue">
					<?php  if(is_array($data)) { foreach($data as $key => $da) { ?>
						<a class="list <?php  echo $colors[$key];?>" href="<?php  echo $this->createWebUrl('assign', array('op' => 'queue_post', 'id' => $da['id']));?>">
							<div class="name"><?php  echo $da['title'];?></div>
							<div class="status"><?php  if($da['status'] == 1) { ?>开放中<?php  } else { ?>已关闭<?php  } ?></div>
							<div class="button" data-id="<?php  echo $da['id'];?>"><i class="fa fa-times"></i></div>
						</a>
					<?php  } } ?>
				</div>
			<?php  } ?>

			<?php  if($op == 'queue_post') { ?>
				<h3>新建 队列设置</h3>
				<hr>
				<form class="form-horizontal" action="" method="post" id="form-queue">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>队列名称</label>
						<div class="col-sm-6 col-xs-6">
							<input type="text" class="form-control" name="title" placeholder="例如:1-2人桌" value="<?php  echo $item['title'];?>">
						</div>
					</div>			
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>客人数量少于等于多少人排入此队列</label>
						<div class="col-sm-6 col-xs-6">
							<input type="number" class="form-control" name="guest_num" placeholder="例如:2" value="<?php  echo $item['guest_num'];?>">
							<span class="help-block">设置为自动排号时，当排号客户的用餐人数少于等于此人数时，系统将自动为排号客户分配此队列,</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>开放排队时间</label>
						<div class="col-sm-3">
							<div class="input-group clockpicker">
								<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
								<input type="text" class="form-control" name="starttime" readonly placeholder="" value="<?php  echo $item['starttime'];?>">
							</div>
						</div>
					</div>			
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>关闭排队时间</label>
						<div class="col-sm-3">
							<div class="input-group clockpicker">
								<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
								<input type="text" class="form-control" name="endtime" readonly placeholder="" value="<?php  echo $item['endtime'];?>">
							</div>
							<span class="help-block">排队关闭时间必须大于开始时间</span>
						</div>
					</div>			
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">队列编号前缀</label>
						<div class="col-sm-6 col-xs-6">
							<input type="text" class="form-control" name="prefix" placeholder="例如:C-" value="<?php  echo $item['prefix'];?>">
							<span class="help-block">方便区分不同的队列</span>
						</div>
					</div>			
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>提前通知人数</label>
						<div class="col-sm-6 col-xs-6">
							<input type="text" class="form-control" name="notify_num" placeholder="例如:10" value="<?php  echo $item['notify_num'];?>">
							<span class="help-block">队列有状态变更时, 提前通知的人数</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span></label>
						<div class="col-sm-6 col-xs-6">
							<div class="checkbox-inline">
								<input type="checkbox" name="status" value="1" <?php  if($item['status'] == 1) { ?>checked<?php  } ?>> 开放中
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span></label>
						<div class="col-sm-6 col-xs-6">
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
							<input type="submit" name="submit" value="提交 队列设置" class="btn btn-primary">
						</div>
					</div>
				</form>
			<?php  } ?>

			<?php  if($op == 'assign_mode') { ?>
				<h3>编辑 排号设置</h3>
				<hr>
				<form class="form-horizontal" action="" method="post" id="form-set">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>模式</label>
						<div class="col-sm-6 col-xs-6">
							<label class="radio-inline">
								<input type="radio" value="1" name="assign_mode" <?php  if($store['assign_mode'] == 1) { ?>checked<?php  } ?>> 系统自动分配
							</label>
							<label class="radio-inline">
								<input type="radio" value="2" name="assign_mode" <?php  if($store['assign_mode'] == 2) { ?>checked<?php  } ?>> 用户自主选择
							</label>
							<span class="help-block">
								系统自动分配: 根据用户输入的人数自动分配队列. 队列可在队列设置中设置<br>
								用户自主选择: 用户可以自由选择不同的队列.
							</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span></label>
						<div class="col-sm-6 col-xs-6">
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
							<input type="submit" name="submit" value="更新 排号模式" class="btn btn-primary">
						</div>
					</div>
				</form>
			<?php  } ?>

			<?php  if($op == 'assign_qrcode') { ?>
				<h3>排号二维码</h3>
				<hr>
				<form class="form-horizontal" action="" method="post" id="form-set">
					<div class="panel panel-default clip">
					<div class="panel-body">
						<p style="margin: 0px"><strong>系统生成的排号网址 :</strong> <a href="javascript:;" title="点击复制链接"><?php  echo $sys_url;?></a></p>
						<?php  if(!empty($wx_url)) { ?>
						<p style="margin: 0px"><strong>微信生成的排号网址 :</strong> <a href="javascript:;" title="点击复制链接"><?php  echo $wx_url;?></a>  (推荐使用)</p>
						<?php  } ?>
						<p style="margin: 0px" class="text-danger">温馨提示: 您可以使用以上链接,在第三方网址自己生成二维码.</p>
					</div>
				</div>
					<div>
						<div class="panel panel-default qrcode-list">
							<div class="panel-heading">系统二维码</div>
							<div class="panel-body">
								<div id="sys-qrcode"></div>
							</div>
							<div class="panel-footer hide">
								<a href="<?php  echo $this->createWebUrl('qrcode', array('op' => 'down', 'type' => 2));?>" class="btn btn-default">下载</a>
							</div>
						</div>
						<div class="panel panel-default qrcode-list">
							<div class="panel-heading">微信二维码</div>
							<div class="panel-body">
								<div id="wx-qrcode"></div>
							</div>
							<div class="panel-footer">
								<?php  if(empty($wx_url)) { ?>
								<a href="<?php  echo $this->createWebUrl('qrcode', array('op' => 'build', 'type' => 2));?>" class="btn btn-success" onclick="if(!confirm('确定操作吗')) return false;">生成微信二维码</a>
								<?php  } else { ?>
								<?php  } ?>
							</div>
						</div>
					</div>
				</form>
			<?php  } ?>
		</div>
	</div>
</div>
<script type="text/javascript">
require(['clockpicker'], function(){
	$('.clip p a').each(function(){
		util.clip(this, $(this).text());
	});
	var option = {
		render: 'canvas',
		width: 259,
		height: 259,
		colorDark : "#000000",
		colorLight : "#ffffff",
	}
	option.text = "<?php  echo $sys_url;?>";
	new QRCode($('#sys-qrcode')[0], option);
	<?php  if(!empty($wx_url)) { ?>
		option.text = "<?php  echo $wx_url;?>";
		new QRCode($('#wx-qrcode')[0], option);
	<?php  } ?>

	$('.clockpicker').clockpicker({autoclose: true});
	$('#form-queue').submit(function(){
		if(!$.trim($(':text[name="title"]').val())) {
			util.message('队列名称不能为空', '', 'error');
			return false;
		}
		var guest_num = parseInt($.trim($(':number[name="guest_num"]').val()));
		if(isNaN(guest_num) || guest_num == 0) {
			util.message('客人数量少于等于多少人排入此队列只能为数字并且大于零', '', 'error');
			return false;
		}
		var notify_num = parseInt($.trim($(':number[name="notify_num"]').val()));
		if(isNaN(notify_num) || notify_num == 0) {
			util.message('提前通知人数只能为数字并且大于零', '', 'error');
			return false;
		}
		return true;
	});

	$('.queue .button').click(function(){
		if(!confirm('确定删除队列吗?')) return false;
		var id = $(this).data('id');
		location.href = "<?php  echo $this->createWebUrl('assign', array('op' => 'queue_del'))?>" + '&id=' + id;
		return false;
	});
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>