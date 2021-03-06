<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
	.require{color:red;}
	.info{padding:6px;width:400px;margin:-20px auto 3px auto;text-align:center;}
</style>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('nav', TEMPLATE_INCLUDEPATH)) : (include template('nav', TEMPLATE_INCLUDEPATH));?>
<?php  if($op == 'print_post') { ?>
	<form class="form-horizontal form" id="form1" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="type" value="1">
		<div class="main">
			<div class="panel panel-default">
				<div class="panel-heading">添加打印机</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>是否启用打印机</label>
						<div class="col-sm-9 col-xs-12">
							<label class="radio-inline">
								<input type="radio" value="1" name="status" <?php  if($item['status'] == 1) { ?>checked<?php  } ?>> 启用
							</label>
							<label class="radio-inline">
								<input type="radio" value="0" name="status" <?php  if($item['status'] == 0) { ?>checked<?php  } ?>> 不启用
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>打印机名称</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" class="form-control" name="name" value="<?php  echo $item['name'];?>" placeholder="填写打印机名称">
							<div class="help-block">方便区分打印机</div>
						</div>
					</div>
                     <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">选择打印机</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="type" id="type" autocomplete="off">
                            <?php  if(is_array($printers)) { foreach($printers as $p) { ?> 
							<option value="<?php  echo $p['id'];?>" <?php  if($item['type']==$p['id']) { ?>selected<?php  } ?>><?php  echo $p['name'];?></option>
							<?php  } } ?>
                        </select>
						<div class="help-block">请先到全局打印机处添加打印机，然后在此选择使用。</div>
                    </div>
                </div>

					<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">移步全局打印机</label>
					<div class="col-sm-9 col-xs-12">
						<div class="help-block"><a href="./index.php?c=fournet&a=print&do=printlist&" target="_blank">移步全局打印机添加打印机</a></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">打印联数</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" class="form-control" name="print_nums" value="<?php  echo $item['print_nums'];?>">
							<div class="help-block">默认为1</div>
						</div>
					</div>
                    <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">打印方式</label>
                    <div class="col-sm-9">
                        <label for="print_type1" class="radio-inline"><input type="radio" name="print_type" value="0" id="print_type1" <?php  if($item['print_type']==0) { ?>checked="true"<?php  } ?>/>下单打印</label>
                        &nbsp;&nbsp;&nbsp;
                        <label for="print_type2" class="radio-inline"><input type="radio" name="print_type" value="1" id="print_type2"  <?php  if($item['print_type']==1) { ?>checked="true"<?php  } ?>/>打印付款订单</label>
                    </div>
                </div>


				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-9 col-xs-9 col-md-9">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
					<input name="submit" id="submit" type="submit" value="提交" class="btn btn-primary col-lg-1">
				</div>	
			</div>
		</div>
	</form>
	<script type="text/javascript">
		require(['util'], function(u){
			$('#post-add').click(function(){
				$('#tpl-container').append($('#tpl').html());
			});
		});
	</script>
<?php  } else if($op == 'print_list') { ?>
	<div class="clearfix">
		<form class="form-horizontal" action="" method="post">
			<div class="form-group">
				<div class="col-sm-12">
					<a class="btn btn-success col-lg-1" href="<?php  echo $this->createWebUrl('manage', array('op' => 'print_post'));?>"/><i class="fa fa-plus-circle"> </i>  添加打印机</a>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-body table-responsive">
					<table class="table table-hover">
						<thead class="navbar-inner">
							<tr>
								<th>打印机品牌</th>
								<th>打印机名称</th>
								<th>机器号</th>
								<th>打印机key</th>
								<th>打印联数</th>
								<th>状态</th>
								<th style="width:150px; text-align:right;">状态/修改/删除</th>
							</tr>
						</thead>
						<tbody>
							<?php  if(is_array($data)) { foreach($data as $item) { ?>
							<tr>
								<td>
									<?php  if($item['type'] == 1) { ?>
										<span class="label label-success">飞蛾打印机</span>
                                        <?php  } else if($item['type']=='2') { ?>
                                        <span class="label label-success">进云物联打印机</span>
                            
									<?php  } ?>
                                    
								</td>
								<td><?php  echo $item['name'];?></td>
								<td><?php  echo $item['print_no'];?></td>
								<td><?php  echo $item['key'];?></td>
								<td><?php  echo $item['print_nums'];?></td>
								<td>
									<?php  if($item['status'] == 1) { ?>
										<span class="label label-success">启用</span>
									<?php  } else { ?>
										<span class="label label-danger">停用</span>
									<?php  } ?>
								</td>
								<td style="text-align:right;">
									<a href="<?php  echo $this->createWebUrl('manage', array('op' => 'print_log', 'id' => $item['id']))?>" class="btn btn-default btn-sm" title="打印记录" data-toggle="tooltip" data-placement="top" ><i class="fa fa-print"> </i></a>
									<a href="<?php  echo $this->createWebUrl('manage', array('op' => 'print_post', 'id' => $item['id']))?>" class="btn btn-default btn-sm" title="编辑" data-toggle="tooltip" data-placement="top" ><i class="fa fa-edit"> </i></a>
									<a href="<?php  echo $this->createWebUrl('manage', array('op' => 'print_del', 'id' => $item['id']))?>" class="btn btn-default btn-sm" title="删除" data-toggle="tooltip" data-placement="top" onclick="if(!confirm('删除后将不可恢复，确定删除吗?')) return false;"><i class="fa fa-times"> </i></a>
								</td>
							</tr>
							<?php  } } ?>
						</tbody>
					</table>
				</div>
			</div>
		</form>
	</div>
<?php  } else if($op == 'print_log') { ?> 
	<div class="clearfix">
		<?php  if($item['type'] == '1') { ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<span class="text-danger"><?php  echo $item['name'];?></span>
			</div>
			<div class="panel-body">
				<form class="form-horizontal form">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">打印机状态：</label>
						<div class="col-sm-9 col-xs-12">
							<p class="form-control-static text-danger"><?php  echo $status;?></p>
						</div>
					</div>
				</form>
			</div>
		</div>
		<?php  } ?>
		<div class="panel panel-info">
			<div class="panel-heading">筛选</div>
			<div class="panel-body">
				<form action="./index.php" method="get" class="form-horizontal" role="form">
					<input type="hidden" name="c" value="site">
					<input type="hidden" name="a" value="entry">
					<input type="hidden" name="m" value="str_takeout">
					<input type="hidden" name="do" value="manage">
					<input type="hidden" name="op" value="print_log">
					<input type="hidden" name="id" value="<?php  echo $id;?>">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单id</label>
						<div class="col-sm-4 col-xs-4 col-md-4">
							<input type="text" value="<?php  echo $oid;?>" class="form-control" name="oid">
						</div>
						<div class="col-xs-12 col-sm-3 col-md-2 col-lg-1">
							<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="btn btn-success" style="margin-bottom:10px;" onclick="location.reload();"><i class="fa fa-refresh"></i> 刷新</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<table class="table">
					<thead>
						<tr>
							<th>订单id</th>
							<th>预定人</th>
							<th>手机号</th>
							<th>打印机品牌</th>
							<th>打印状态</th>
							<th>打印时间</th>
							<th>删除</th>
						</tr>
					</thead>
					<tbody>
						<?php  if(is_array($data)) { foreach($data as $da) { ?>
							<tr>
								<td><a title="查看订单" href="<?php  echo $this->createWebUrl('manage', array('op' => 'orderdetail', 'id' => $da['oid']));?>"><?php  echo $da['oid'];?></a></td>
								<td><?php  echo $da['realname'];?></td>
								<td><?php  echo $da['mobile'];?></td>
								<td>
									<?php  if($da['print_type'] == 1) { ?>
										<span class="label label-success">飞蛾打印机</span>
									<?php  } ?>
								</td>
								<td>
									<?php  if($da['status'] == 1) { ?>
										<span class="label label-success">已打印</span>
									<?php  } else { ?>
										<span class="label label-danger">未打印</span>
									<?php  } ?>
								</td>
								<td><?php  echo date('Y-m-d H:i:s', $da['addtime']);?></td>
								<td>
									<a href="<?php  echo $this->createWebUrl('manage', array('op' => 'log_del', 'id' => $da['id']));?>" class="btn btn-default btn-sm" onclick="if(!confirm('确定删除吗')) return false;" title="编辑" data-toggle="tooltip" data-placement="top" ><i class="fa fa-times"></i></a>
								</td>
							</tr>
						<?php  } } ?>
					</tbody>
				</table>
			</div>
		</div>
		<?php  echo $pager;?>
	</div>
<?php  } ?>
<script type="text/javascript">
	require(['util'], function(u){
		$('.btn').hover(function(){
			$(this).tooltip('show');
		},function(){
			$(this).tooltip('hide');
		});
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>