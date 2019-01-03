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
<?php  if($op == 'dish_post') { ?>
	<form class="form-horizontal form" id="form1" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="sid" value="<?php  echo $sid;?>">
		<div class="main">
			<div class="panel panel-default">
				<div class="panel-heading">添加菜品</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>菜品名称</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" class="form-control" name="title" value="<?php  echo $item['title'];?>">
						</div>
					</div>	
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>菜品价格</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<div class="input-group">
								<input type="hidden" name="group[]" value="0">
								<span class="input-group-addon">原价</span>
								<input type="text" class="form-control" name="price[]" value="<?php  echo $item['price']['0'];?>">
								<span class="input-group-addon">元</span>
							</div>
							<br>
							<?php  if(is_array($groups)) { foreach($groups as $group) { ?>
								<div class="input-group">
									<input type="hidden" name="group[]" value="<?php  echo $group['groupid'];?>">
									<span class="input-group-addon"><?php  echo $group['title'];?></span>
									<input type="text" class="form-control" name="price[]" value="<?php  echo $item['price'][$group['groupid']];?>">
									<span class="input-group-addon">元</span>
								</div>
								<br>
							<?php  } } ?>
							<div class="help-block">原价必须填写.会员价如果不填写,默认为原价.ps:如果您不想设置会员组价格,可将会员组价格设置为和原价一样的价格并不显示会员组价格</div>
						</div>	
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>是否显示会员组价格</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<label class="radio-inline"><input type="radio" name="show_group_price" value="1" <?php  if($item['show_group_price'] == 1 || !$item['show_group_price']) { ?>checked<?php  } ?>> 显示</label>
							<label class="radio-inline"><input type="radio" name="show_group_price" value="2" <?php  if($item['show_group_price'] == 2) { ?>checked<?php  } ?>> 隐藏</label>
							<div class="help-block">设置为隐藏后,前台不会显示会员组价格</div>
							<div class="help-block">因前台页面空间有限,默认只显示3个会员组的价格</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>菜品单位</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" class="form-control" name="unitname" value="<?php  echo $item['unitname'];?>">
						</div>
					</div>	
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>菜品分类</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<select name="cid" id="cid" class="form-control">
								<?php  if(is_array($category)) { foreach($category as $li) { ?>
									<option value="<?php  echo $li['id'];?>" <?php  if($item['cid'] == $li['id'] || $_GPC['cid'] == $li['id']) { ?>selected<?php  } ?>><?php  echo $li['title'];?></option>
								<?php  } } ?>
							</select>
						</div>	
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>菜品图片</label>
						<div class="col-sm-9 col-xs-12">
							<?php  echo tpl_form_field_image('thumb', $item['thumb']);?>
							<div class="help-block">推荐大小为720x400</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>新用户专享</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<label class="radio-inline"><input type="radio" name="first_order_limit" value="1" <?php  if($item['first_order_limit'] == 1) { ?>checked<?php  } ?>> 是</label>
							<label class="radio-inline"><input type="radio" name="first_order_limit" value="2" <?php  if($item['first_order_limit'] == 2 || !$item['first_order_limit']) { ?>checked<?php  } ?>> 否</label>
							<div class="help-block">设置为新用户专享,只有首次下单的用户可以购买</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>每人限购</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<input type="text" class="form-control" name="buy_limit" value="<?php  echo $item['buy_limit'];?>">
							<div class="help-block">0为不限制</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>设为推送</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<label class="radio-inline"><input type="radio" name="recommend" value="1" <?php  if($item['recommend'] == 1) { ?>checked<?php  } ?>> 推送</label>
							<label class="radio-inline"><input type="radio" name="recommend" value="2" <?php  if($item['recommend'] == 2 || !$item['recommend']) { ?>checked<?php  } ?>> 不推送</label>
							<div class="help-block">设置为推送后,当客人没有点该菜品时,提交订单之前,系统会提示客人</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>自定义标签</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<input type="text" class="form-control" name="label" value="<?php  echo $item['label'];?>">
							<div class="help-block">可设置为：热卖，新品，爆款等。只能设置一个，不超过两个字</div>
						</div>	
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>总库存</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<input type="text" class="form-control" name="total" value="<?php  echo $item['total'];?>">
							<div class="help-block">-1为不限制被预订的菜品数</div>
						</div>	
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>已卖出</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<input type="text" class="form-control" name="sailed" value="<?php  echo $item['sailed'];?>">
							<div class="help-block">已卖出的份数默认会根据订单自动更新。您也可以手动设置</div>
						</div>	
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>赠送积分</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<input type="text" class="form-control" name="grant_credit" value="<?php  echo $item['grant_credit'];?>">
							<div class="help-block">设置赠送积分。用户购买该菜品并且付款成功后，系统会自动赠送积分给用户</div>
						</div>	
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>是否上架</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<label class="radio-inline"><input type="radio" name="is_display" value="1" <?php  if($item['is_display'] == 1 || !$item['is_display']) { ?>checked<?php  } ?>> 上架</label>
							<label class="radio-inline"><input type="radio" name="is_display" value="2" <?php  if($item['is_display'] == 2) { ?>checked<?php  } ?>> 下架</label>
						</div>	
					</div>

					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" class="form-control" name="displayorder" value="<?php  echo $item['displayorder'];?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">菜品详情</label>
						<div class="col-sm-9 col-xs-12">
							<textarea name="description" class="form-control" rows="4" placeholder="请将字数控制在200以内"><?php  echo $item['description'];?></textarea>
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
			$('#form1').submit(function(){
				if($.trim($(':text[name="title"]').val()) == '') {
					u.message('请填写菜品名称');
					return false;
				}
				var price = parseInt($.trim($(':text[name="price[]"]:first').val()));
				if(isNaN(price)) {
					u.message("菜品原价不能为空");
					return false;
				}
				if($.trim($(':text[name="unitname"]').val()) == '') {
					u.message('请填写菜品单位');
					return false;
				}
				var total = parseInt($.trim($(':text[name="total"]').val()));
				if(isNaN(total)) {
					u.message("总库存必须为整数");
					return false;
				}
				if(!$('#cid').val()) {
					u.message("请选择菜品分类");
					return false;					
				}
				if($.trim($(':text[name="thumb"]').val()) == '') {
					u.message('请添加菜品图片');
					return false;
				}
			});
		});
	</script>
<?php  } else if($op == 'dish_list') { ?>
	<style type="text/css">
		.status-toggle,.recommend-toggle{cursor:pointer;}
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
					<input type="hidden" name="op" value="dish_list"/>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>菜品分类</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<select name="cid" id="cid" class="form-control">
								<option value="">不限</option>
								<?php  if(is_array($category)) { foreach($category as $li) { ?>
									<option value="<?php  echo $li['id'];?>" <?php  if($li['id'] == $_GPC['cid']) { ?>selected<?php  } ?>><?php  echo $li['title'];?></option>
								<?php  } } ?>
							</select>
						</div>	
					</div>
					<div class="form-group clearfix">
						<label class="col-xs-12 col-sm-2 col-md-2 control-label">菜品名称</label>
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
					<a class="btn btn-success col-lg-1" href="<?php  echo $this->createWebUrl('manage', array('op' => 'dish_post'));?>"/><i class="fa fa-plus-circle"> </i> 添加菜品</a>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-body table-responsive">
					<table class="table table-hover">
						<thead class="navbar-inner">
							<tr>
								<th>缩略图</th>
								<th>菜品名称</th>
								<th>所属分类</th>
								<th>单位</th>
								<th>价格</th>
								<th>总库存</th>
								<th>已售出</th>
								<th>赠送积分</th>
								<th>是否上架</th>
								<th>是否推送</th>
								<th>标签</th>
								<th style="width:150px; text-align:right;">操作</th>
							</tr>
						</thead>
						<tbody>
							<?php  if(is_array($lists)) { foreach($lists as $item) { ?>
							<tr>
								<td><img src="<?php  echo tomedia($item['thumb']);?>" width="38" style="border-radius: 3px;"></td>
								<td><?php  echo $item['title'];?></td>
								<td><?php  echo $category[$item['cid']]['title'];?></td>
								<td><?php  echo $item['unitname'];?></td>
								<td>
									原价：<?php  echo $item['price']['0'];?>元 <br>
									<?php  if(is_array($groups)) { foreach($groups as $group) { ?>
										<?php  echo $group['title'];?>：<?php  echo $item['price'][$group['groupid']];?>元<br>
									<?php  } } ?>
								</td>
								<td><?php  if($item['total'] == -1) { ?>无限库存<?php  } else { ?><?php  echo $item['total'];?>份<?php  } ?></td>
								<td><?php  echo $item['sailed'];?> 份</td>
								<td><?php  echo $item['grant_credit'];?> 积分</td>
								<td>
									<?php  if($item['is_display'] == 1) { ?>
										<span class="btn btn-sm btn-success status-toggle" id="<?php  echo $item['id'];?>" data-toggle="2" title="点击修改">已上架</span>
									<?php  } else { ?>
										<span class="btn btn-sm btn-warning status-toggle" id="<?php  echo $item['id'];?>" data-toggle="1" title="点击修改">已下架</span>
									<?php  } ?>
								</td>
								<td>
									<?php  if($item['recommend'] == 1) { ?>
										<span class="btn btn-sm btn-success recommend-toggle" id="<?php  echo $item['id'];?>" data-toggle="2" title="点击修改">推送</span>
									<?php  } else { ?>
										<span class="btn btn-sm btn-warning recommend-toggle" id="<?php  echo $item['id'];?>" data-toggle="1" title="点击修改">不推送</span>
									<?php  } ?>
								</td>
								<td><?php  echo $item['label'];?></td>
								<td style="text-align:right;">
									<a href="<?php  echo $this->createWebUrl('manage', array('op' => 'dish_post', 'id' => $item['id']))?>" class="btn btn-default btn-sm" title="编辑" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"> </i></a>
									<a href="<?php  echo $this->createWebUrl('manage', array('op' => 'dish_del', 'id' => $item['id']))?>" class="btn btn-default btn-sm" title="删除" data-toggle="tooltip" data-placement="top" onclick="if(!confirm('删除后将不可恢复，确定删除吗?')) return false;"><i class="fa fa-times"> </i></a>
								</td>
							</tr>
							<?php  } } ?>
						</tbody>
					</table>
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
			$('.status-toggle').click(function(){
				var id = $(this).attr('id');
				var dvalue = $(this).attr('data-toggle');
				$.post('<?php  echo $this->createWebUrl('ajax', array('op' => 'status_dish'))?>', {'id':id, 'value':dvalue}, function(data){
					if(data == 'success') {
						location.reload();
					} else {
						u.message('编辑菜品显示状态失败');
					}
				});
			});
			$('.recommend-toggle').click(function(){
				var id = $(this).attr('id');
				var dvalue = $(this).attr('data-toggle');
				$.post('<?php  echo $this->createWebUrl('ajax', array('op' => 'recommend_dish'))?>', {'id':id, 'value':dvalue}, function(data){
					if(data == 'success') {
						location.reload();
					} else {
						u.message('编辑菜品是否推荐失败');
					}
				});
			});

		});

	</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>