<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
	.require{color:red;}
	.info{padding:6px;width:400px;margin:-20px auto 3px auto;text-align:center;}
</style>
<div class="alert alert-info info">
	<i class="fa fa-info-circle"></i>
	当前门店名称: <?php  echo $store['title'];?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('nav', TEMPLATE_INCLUDEPATH)) : (include template('nav', TEMPLATE_INCLUDEPATH));?>
<?php  if($op == 'cate_post') { ?>
	<form class="form-horizontal form" id="form1" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="sid" value="<?php  echo $sid;?>">
		<div class="main">
			<div class="panel panel-default">
				<div class="panel-heading">添加菜品分类</div>
				<div class="panel-body">
					<div id="tpl">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>分类名称</label>
							<div class="col-sm-9 col-xs-12">
								<input type="text" class="form-control" name="title[]" value="">
							</div>
						</div>			
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">分类排序</label>
							<div class="col-sm-9 col-xs-12">
								<input type="text" class="form-control" name="displayorder[]" value="">
							</div>
						</div>
						<hr>
					</div>
					<div id="tpl-container"></div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">分类排序</label>
						<div class="col-sm-9 col-xs-12" style="padding-top:7px">
							<a href="javascipt:;" id="post-add"><i class="fa fa-plus-circle"></i> 继续添加</a>
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
<?php  } else if($op == 'cate_list') { ?>
	<style type="text/css">
		.status-toggle{cursor:pointer;}
	</style>
	<div class="main">
		<div class="panel panel-info">
			<div class="panel-heading">筛选</div>
			<div class="panel-body">
				<form action="./index.php" method="get" class="form-horizontal" role="form">
					<input type="hidden" name="c" value="site">
					<input type="hidden" name="a" value="entry">
					<input type="hidden" name="m" value="str_takeout">
					<input type="hidden" name="do" value="manage"/>
					<input type="hidden" name="op" value="cate_list"/>
					<div class="form-group clearfix">
						<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">分类名称</label>
						<div class="col-sm-7 col-lg-8 col-md-8 col-xs-12">
							<input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>">
						</div>
						<div class="col-xs-12 col-sm-3 col-md-2 col-lg-1">
							<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<form class="form-horizontal" action="" method="post">
			<div class="form-group">
				<div class="col-sm-12">
					<a class="btn btn-success col-lg-2" href="<?php  echo $this->createWebUrl('manage', array('op' => 'cate_post'));?>"/><i class="fa fa-plus-circle"> </i> 添加菜品分类</a>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-body table-responsive">
					<table class="table table-hover">
						<thead class="navbar-inner">
							<tr>
								<th>分类名称</th>
								<th>排序</th>
								<th>菜品数</th>
								<th style="width:150px; text-align:right;">操作</th>
							</tr>
						</thead>
						<tbody>
							<?php  if(is_array($lists)) { foreach($lists as $item) { ?>
							<tr>
								<input type="hidden" name="ids[]" value="<?php  echo $item['id'];?>">
								<td><input type="text" style="width:130px" name="title[]" class="form-control" value="<?php  echo $item['title'];?>"></td>
								<td><input type="text" style="width:100px" name="displayorder[]" class="form-control" value="<?php  echo $item['displayorder'];?>"></td>
								<td><?php  echo $nums[$item['id']]['num'];?></td>
								<td style="text-align:right;">
									<a href="<?php  echo $this->createWebUrl('manage', array('op' => 'dish_list', 'cid' => $item['id']))?>" class="btn btn-default btn-sm" title="查看菜品" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"> </i></a>
									<a href="<?php  echo $this->createWebUrl('manage', array('op' => 'dish_post', 'cid' => $item['id']))?>" class="btn btn-default btn-sm" title="添加菜品" data-toggle="tooltip" data-placement="top" ><i class="fa fa-plus"> </i></a>
									<a href="<?php  echo $this->createWebUrl('manage', array('op' => 'cate_del', 'id' => $item['id']))?>" class="btn btn-default btn-sm" title="删除" data-toggle="tooltip" data-placement="top" onclick="if(!confirm('删除后该分类下的菜品也会删除，确定删除吗?')) return false;"><i class="fa fa-times"> </i></a>
								</td>
							</tr>
							<?php  } } ?>
						</tbody>
					</table>
				</div>
			</div>
			<p>
				<span class="require">*</span><span style="color: #999;padding-left: 10px;">提示：排序數字越大越靠前；修改后請提交</span>
			</p>
			
			<div class="form-group">
				<div class="col-sm-12">
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
					<input type="submit" class="btn btn-primary col-lg-1" name="submit" value="提交" />
				</div>
			</div>
			<?php  echo $pager;?>
		</form>
	</div>
	<script type="text/javascript">
		require(['util'], function(u){
			$('.btn').hover(function(){
				$(this).tooltip('show');
			},function(){
				$(this).tooltip('hide');
			});
		});
	</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>