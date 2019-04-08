<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/style.css">
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
			<?php  if($op == 'board_list') { ?>
				<h3>客人队列 列表</h3>
				<hr>
				<div class="board">
					<?php  if(is_array($data)) { foreach($data as $key => $da) { ?>
						<a class="list <?php  echo $colors[$key];?>" href="<?php  echo $this->createWebUrl('assign', array('op' => 'board_detail', 'id' => $da['id']));?>">
							<div class="name">当前排队人数：<?php  echo intval($wait[$da['id']]['num']);?></div>
							<div class="status"><?php  echo $da['title'];?></div>
						</a>
					<?php  } } ?>
				</div>
			<?php  } ?>

			<?php  if($op == 'board_detail') { ?>
				<h3>客人队列 列表</h3>
				<hr>
				<form class="form-horizontal" action="" method="post" id="board-detail">
					<div class="form-group">
						<div class="col-sm-8 col-lg-9 col-xs-12">
							<a href="<?php  echo $this->createWebUrl('assign', array('op' => 'board_detail', 'id' => $queue_id, 'status' => -1));?>" class="btn btn-default">所有</a>
							<a href="<?php  echo $this->createWebUrl('assign', array('op' => 'board_detail', 'id' => $queue_id, 'status' => 1));?>" class="btn btn-primary">排队中</a>
							<a href="<?php  echo $this->createWebUrl('assign', array('op' => 'board_detail', 'id' => $queue_id, 'status' => 2));?>" class="btn btn-success">已入号</a>
							<a href="<?php  echo $this->createWebUrl('assign', array('op' => 'board_detail', 'id' => $queue_id, 'status' => 3));?>" class="btn btn-danger">已取消</a>
							<a href="<?php  echo $this->createWebUrl('assign', array('op' => 'board_detail', 'id' => $queue_id, 'status' => 4));?>" class="btn btn-warning">已过号</a>
						</div>
					</div>
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th>号码</th>
								<th>状态</th>
								<th>是否通知</th>
								<th>电话</th>
								<th>客人数量</th>
								<th>排队时间</th>
								<th width="300">操作</th>
							</tr>
						</thead>
						<?php  if(is_array($data)) { foreach($data as $da) { ?>
							<tr>
								<td><?php  echo $da['number'];?></td>
								<td><span class="<?php  echo $colors[$da['status']]['css'];?>"><?php  echo $colors[$da['status']]['text'];?></span></td>
								<td>
									<?php  if($da['is_notify']) { ?>
										<span class="label label-success">已通知</span>
									<?php  } else { ?>
										<span class="label label-danger">未通知</span>
									<?php  } ?>
								</td>
								<td><?php  echo $da['mobile'];?></td>
								<td><?php  echo $da['guest_num'];?></td>
								<td><?php  echo date('Y-m-d H:i', $da['createtime']);?></td>
								<td style="overflow:visible;">
										<a href="javascript:;" class="board-status btn btn-success" data-id="<?php  echo $da['id'];?>" data-status="2">接受</a>
										<a href="javascript:;" class="board-status btn btn-warning" data-id="<?php  echo $da['id'];?>" data-status="3">过号</a>
										<a href="javascript:;" class="board-status btn btn-danger" data-id="<?php  echo $da['id'];?>" data-status="4">取消</a>
										<a href="<?php  echo $this->createWebUrl('assign', array('op' => 'board_post', 'id' => $da['id'],))?>" class="btn btn-default">编辑</a>
										<a href="<?php  echo $this->createWebUrl('assign', array('op' => 'board_notity', 'id' => $da['id'],))?>" class="btn btn-default" onclick="if(!confirm('确定操作吗?')) return false;">通知</a>
									</div>
								</td>
							</tr>
						<?php  } } ?>
					</table>
				</form>
			<?php  } ?>

			<?php  if($op == 'board_post') { ?>
				<h3>编辑 客人队列</h3>
				<hr>
				<form class="form-horizontal" action="" method="post" id="board-detail">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>号码</label>
						<div class="col-sm-6 col-xs-6">
							<input type="text" class="form-control" name="number" placeholder="" value="<?php  echo $item['number'];?>">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>手机</label>
						<div class="col-sm-6 col-xs-6">
							<input type="text" class="form-control" name="mobile" placeholder="" value="<?php  echo $item['mobile'];?>">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>客人数量</label>
						<div class="col-sm-6 col-xs-6">
							<input type="number" class="form-control" name="guest_num" placeholder="" value="<?php  echo $item['guest_num'];?>">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span></label>
						<div class="col-sm-6 col-xs-6">
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
							<input type="submit" name="submit" value="更新 客人队列" class="btn btn-primary">
						</div>
					</div>
				</form>
			<?php  } ?>
		</div>
	</div>
</div>
<script type="text/javascript">
require(['clockpicker'], function(){
	$('.board-status').click(function(){
		if(!confirm('确定更改状态吗?')) return false;
		var id = $(this).data('id');
		var status = $(this).data('status');
		$.post("<?php  echo $this->createWebUrl('assign', array('op' => 'board_status'));?>", {id: id, status: status}, function(data){
			var data = $.parseJSON(data);
			if(data.message.errno == -1) {
				util.message(data.message.message);
				return false;
			} else {
				location.reload();
			}
		});
	});

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