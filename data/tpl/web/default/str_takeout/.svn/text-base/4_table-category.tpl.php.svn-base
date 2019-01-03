<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/style.css">
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('nav', TEMPLATE_INCLUDEPATH)) : (include template('nav', TEMPLATE_INCLUDEPATH));?>
<div class="clearfix">
	<div class="panel panel-default">
		<div class="panel-body">
			<ul class="nav nav-pills">
				<li <?php  if($op == 'category_list' ||  $op == 'category_post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('table', array('op' => 'category_list'));?>">桌台类型</a></li>
				<li <?php  if($op == 'table_list' || $op == 'table_post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('table', array('op' => 'table_list'));?>">桌台管理</a></li>
				<li <?php  if($op == 'table_qrcode_mode') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('table', array('op' => 'table_qrcode_mode'));?>">桌台二维码模式</a></li>
			</ul>
			<?php  if($op == 'category_list') { ?>
				<h3>桌台类型 列表</h3>
				<hr>
				<a href="<?php  echo $this->createWebUrl('table', array('op' => 'category_post'));?>" class="btn btn-primary">新建 桌台类型</a>
				<table class="table table-hover table-bordered" style="margin-top:20px">
					<thead>
						<tr>
							<th>名字</th>
							<th>最低消费</th>
							<th>预定预付款</th>
							<th>桌子数量</th>
							<th>操作</th>
						</tr>
					</thead>
					<?php  if(is_array($data)) { foreach($data as $da) { ?>
						<tr>
							<td><?php  echo $da['title'];?></td>
							<td><?php  echo $da['limit_price'];?></td>
							<td><?php  echo $da['reservation_price'];?></td>
							<td><?php  echo $tables[$da['id']]['num'];?></td>
							<td>
								<a href="<?php  echo $this->createWebUrl('table', array('op' => 'table_post', 'cid' => $da['id']));?>" class="btn btn-default">添加桌台</a>
								<a href="<?php  echo $this->createWebUrl('table', array('op' => 'category_post', 'id' => $da['id']));?>" class="btn btn-default">编辑</a>
								<a href="<?php  echo $this->createWebUrl('table', array('op' => 'category_del', 'id' => $da['id']));?>" onclick="if(!confirm('确定删除吗')) return false;" class="btn btn-default">删除</a>
							</td>
						</tr>
					<?php  } } ?>
				</table>
			<?php  } ?>

			<?php  if($op == 'category_post') { ?>
				<h3>新建 桌台类型</h3>
				<hr>
				<form class="form-horizontal" action="" method="post" id="form-category">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>名字</label>
						<div class="col-sm-6 col-xs-6">
							<input type="text" class="form-control" name="title" placeholder="" value="<?php  echo $item['title'];?>">
						</div>
					</div>			
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>最低消费</label>
						<div class="col-sm-6 col-xs-6">
							<input type="number" class="form-control" name="limit_price" placeholder="例如:2" value="<?php  echo $item['limit_price'];?>">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>预定预付款</label>
						<div class="col-sm-6 col-xs-6">
							<input type="number" class="form-control" name="reservation_price" placeholder="" value="<?php  echo $item['reservation_price'];?>">
							<span class="help-block">仅预订订座时需要预付款的金额</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span></label>
						<div class="col-sm-6 col-xs-6">
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
							<input type="submit" name="submit" value="提交" class="btn btn-primary">
						</div>
					</div>
				</form>
			<?php  } ?>

			<?php  if($op == 'table_post') { ?>
				<h3>编辑 桌台</h3>
				<hr>
				<form class="form-horizontal" action="" method="post" id="form-set">

					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span></label>
						<div class="col-sm-6 col-xs-6">
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
							<input type="submit" name="submit" value="更新 排号模式" class="btn btn-primary">
						</div>
					</div>
				</form>
			<?php  } ?>
		</div>
	</div>
</div>
<script type="text/javascript">
require(['clockpicker'], function(){
	$('#form-category').submit(function(){
		if(!$.trim($(':text[name="title"]').val())) {
			util.message('名称不能为空', '', 'error');
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