<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('nav', TEMPLATE_INCLUDEPATH)) : (include template('nav', TEMPLATE_INCLUDEPATH));?>
<?php  if($op == 'trash_list') { ?>
<div class="clearfix">
	<form class="form-horizontal" action="" method="post">
		<div class="panel panel-default">
			<div class="panel-body table-responsive">
				<table class="table table-hover">
					<thead class="navbar-inner">
						<tr>
							<th>用户UID</th>
							<th>用户姓名</th>
							<th>手机号</th>
							<th>添加时间</th>
							<th style="width:150px; text-align:right;">操作</th>
						</tr>
					</thead>
					<tbody>
						<?php  if(is_array($data)) { foreach($data as $item) { ?>
						<tr>
							<td><?php  echo $item['uid'];?></td>
							<td><?php  echo $item['username'];?></td>
							<td><?php  echo $item['mobile'];?></td>
							<td><?php  echo date('Y-m-d H:i');?></td>
							<td style="text-align:right;">
								<a href="<?php  echo $this->createWebUrl('manage', array('op' => 'trash_del', 'uid' => $item['uid']))?>" class="btn btn-default btn-sm" title="" data-toggle="tooltip" data-placement="top" onclick="if(!confirm('确定从黑名单中移除吗?')) return false;"><i class="fa fa-times"> </i> 移除</a>
							</td>
						</tr>
						<?php  } } ?>
					</tbody>
				</table>
			</div>
		</div>
	</form>
</div>
<?php  } ?>
<script>
	$('.btn').hover(function(){
		$(this).tooltip('show');
	},function(){
		$(this).tooltip('hide');
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>