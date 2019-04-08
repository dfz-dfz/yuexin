<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
	.require{color:red;}
	.highlight{font-size:18px;font-color:#FFF;}
	.thumbnail{border-width:5px;}
	.thumbnail.active{border:5px solid;}
</style>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/style.css">
<script src="../addons/str_takeout/template/resource/js/jquery.qrcode.min.js"></script>
<ul class="nav nav-tabs">
	<li <?php  if($op == 'list') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('store', array('op' => 'list'));?>">门店列表</a></li>
	<?php  if($_W['role'] != 'operator') { ?><li <?php  if($op == 'post' && !$id) { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('store', array('op' => 'post'));?>">添加门店</a></li><?php  } ?>
	<?php  if($op == 'post' && $id) { ?><li class="active"><a href="<?php  echo $this->createWebUrl('store', array('op' => 'post', 'id' => $id));?>">编辑门店</a></li><?php  } ?>
</ul>

<?php  if($config['num_limit'] > 0) { ?>
<div class="alert alert-danger">
	<i class="fa fa-info-circle"></i>
	 您的公众只能添加 <strong class="highlight"><?php  echo $config['num_limit'];?> </strong>个门店,
	 目前已添加 <strong class="highlight"><?php  echo $now_store_num;?> </strong>个,
	 还能添加 <strong class="highlight"><?php  echo $config['num_limit'] - $now_store_num?> </strong>个。
</div>
<?php  } ?>
<?php  if($op == 'post') { ?>
<form class="form-horizontal form" id="form1" action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?php  echo $id;?>">
	<div class="panel panel-default">
		<div class="panel-body">
			<ul class="nav nav-pills">
				<li role="presentation" class="active"><a href="#basic" aria-controls="basic" role="tab" data-toggle="pill">基本信息</a></li>
				<li role="presentation"><a href="#high" aria-controls="high" role="tab" data-toggle="pill">高级设置</a></li>
				<li role="presentation"><a href="#page" aria-controls="page" role="tab" data-toggle="pill">页面设置</a></li>
			</ul>
		</div>
	</div>
	<div class="tab-content">
		<div class="panel panel-default tab-pane active" role="tabpanel" id="basic">
			<div class="panel-heading">门店基本信息</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>门店名称</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" class="form-control" name="title" value="<?php  echo $item['title'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>门店LOGO</label>
					<div class="col-sm-9 col-xs-12">
						<?php  echo tpl_form_field_image('logo', $item['logo']);?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>门店描述</label>
					<div class="col-sm-9 col-xs-12">
						<textarea class="form-control" name="content"><?php  echo $item['content'];?></textarea>
						<div class="help-block">粉丝分享时调用</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>门店电话</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" class="form-control" name="telephone" value="<?php  echo $item['telephone'];?>">
					</div>
				</div>
				<div id="hour">
					<div id="hour-tpl">
						<?php  if(!empty($item['business_hours'])) { ?>
							<?php  if(is_array($item['business_hours'])) { foreach($item['business_hours'] as $hour) { ?>
								<div class="form-group hour-item">
									<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>营业时间</label>
									<div class="col-sm-9 col-xs-4 col-md-3">
										<div class="input-group">
											<input type="text" name="business_start_hours[]" class="form-control" placeholder="8:00" value="<?php  echo $hour['s'];?>"> 
											<span class="input-group-addon">至</span>
											<input type="text" name="business_end_hours[]" class="form-control" placeholder="12:00" value="<?php  echo $hour['e'];?>"> 
										</div>
									</div>	
									<div class="col-sm-9 col-xs-4 col-md-3" style="padding-top:6px">
										<a href="javascript:;" onclick="delhouritem(this);"><i class="fa fa-times-circle" title="删除时间段"> </i></a>
									</div>	
								</div>
							<?php  } } ?>
						<?php  } else { ?>
							<div class="form-group hour-item">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>营业时间</label>
								<div class="col-sm-9 col-xs-4 col-md-3">
									<div class="input-group">
										<input type="text" name="business_start_hours[]" class="form-control" placeholder="8:00"> 
										<span class="input-group-addon">至</span>
										<input type="text" name="business_end_hours[]" class="form-control" placeholder="12:00"> 
									</div>
								</div>
								<div class="col-sm-9 col-xs-4 col-md-3" style="padding-top:6px">
									<a href="javascript:;" onclick="delhouritem(this);"><i class="fa fa-times-circle" title="删除时间段"> </i></a>
								</div>
							</div>
						<?php  } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<a href="javascript:;" id="hour-add"><i class="fa fa-plus-circle"></i> 添加营业时间</a>
						<div class="help-block">请完善营业时间信息。最多可添加3个时间段</div>
					</div>	
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>门店特色</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<textarea class="form-control richtext" name="description"><?php  echo $item['description'];?></textarea>
					</div>	
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>门店实景</label>
					<div class="col-sm-9 col-xs-9 col-md-9 thumbs">
						<a href="javascript:;" class="btn btn-primary" id="selectImage">选择图片</a>
						<br>
						<br>

						<?php  if(!empty($item['thumbs'])) { ?>
						<?php  if(is_array($item['thumbs'])) { foreach($item['thumbs'] as $slide) { ?>
							<div class="col-lg-3">
								<input type="hidden" name="thumbs[image][]" value="<?php  echo $slide['image'];?>">
								<div class="panel panel-default panel-slide">
									<div class="btnClose" onclick="$(this).parent().parent().remove()"><i class="fa fa-times"></i></div>
									<div class="panel-body">
										<img src="<?php  echo tomedia($slide['image']);?>" alt="" width="100%" height="170">
										<div>
											<input class="form-control last pull-right" placeholder="跳转链接" name="thumbs[url][]" value="<?php  echo $slide['url'];?>">
										</div>
									</div>
								</div>
							</div>
						<?php  } } ?>
						<?php  } ?>
						<div id="slideContainer"></div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>门店所在地区</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<?php  echo tpl_form_field_district('reside', $item['reside']);?>
					</div>	
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>详细地址</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<input type="text" name="address" class="form-control" value="<?php  echo $item['address'];?>">
						<div class="help-block">请勿重复填写省市区信息</div>
					</div>	
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>所属区域</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<select class="form-control" id="area_id" name="area_id">
							<option value="0">==选择所在区域==</option>
							<?php  if(is_array($area)) { foreach($area as $li) { ?>
								<option value="<?php  echo $li['id'];?>" <?php  if($item['area_id'] == $li['id']) { ?>selected<?php  } ?>><?php  echo $li['title'];?></option>
							<?php  } } ?>
						</select>
						<div class="help-block">还没有区域，点击 <a href="<?php  echo $this->createWebUrl('area');?>" target="_blank">添加区域</a></div>
					</div>	
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">地图标识</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<?php  echo tpl_form_field_coordinate('map', $item['map']);?>
					</div>	
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">商家QQ</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<input type="text" class="form-control" name="sns[qq]" value="<?php  echo $item['sns']['qq'];?>">
					</div>	
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">商家微信</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<input type="text" class="form-control" name="sns[weixin]" value="<?php  echo $item['sns']['weixin'];?>">
					</div>	
				</div>
				<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">打印机编码<div class="help-block"></div></label>
            <div class="col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="code" value="<?php  echo $item['code'];?>" >
            <div class="help-block">一般在打印机下面或者说明书上</div>   
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">打印机密钥<div class="help-block"></div></label>
            <div class="col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="secret" value="<?php  echo $item['secret'];?>" >
                <div class="help-block">一般在打印机下面或者说明书上</div>
            </div>
        </div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<input type="text" class="form-control" name="displayorder" value="<?php  echo $item['displayorder'];?>">
						<div class="help-block">数字越大，越靠前</div>
					</div>	
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<label class="radio-inline"><input type="radio" name="status" value="1" <?php  if($item['status'] == 1 || !$item['status']) { ?>checked<?php  } ?>> 显示</label>
						<label class="radio-inline"><input type="radio" name="status" value="2" <?php  if($item['status'] === 2) { ?>checked<?php  } ?>> 隐藏</label>
					</div>	
				</div>
			</div>
		</div>
		<div class="panel panel-default tab-pane" role="tabpanel" id="high">
			<div class="panel-heading">高级设置</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>打印订单设置</label>
					<div class="col-sm-9 col-xs-12">
						<label class="radio-inline">
							<input type="radio" value="1" name="print_type" <?php  if($item['print_type'] == 1 || $item['print_type'] == '') { ?>checked<?php  } ?>> 下单直接打印
						</label>
						<label class="radio-inline">
							<input type="radio" value="2" name="print_type" <?php  if($item['print_type'] == 2) { ?>checked<?php  } ?>> 打印已付款的订单
						</label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">排号功能</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<label class="radio-inline"><input type="radio" name="is_assign" value="1" <?php  if($item['is_assign'] == 1) { ?>checked<?php  } ?>> 开启</label>
						<label class="radio-inline"><input type="radio" name="is_assign" value="2" <?php  if($item['is_assign'] == 2) { ?>checked<?php  } ?>> 关闭</label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">预定功能</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<label class="radio-inline"><input type="radio" name="is_reserve" value="1" <?php  if($item['is_reserve'] == 1) { ?>checked<?php  } ?>> 开启</label>
						<label class="radio-inline"><input type="radio" name="is_reserve" value="2" <?php  if($item['is_reserve'] == 2) { ?>checked<?php  } ?>> 关闭</label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">店内点餐</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<label class="radio-inline"><input type="radio" name="is_meal" value="1" <?php  if($item['is_meal'] == 1) { ?>checked<?php  } ?>> 开启</label>
						<label class="radio-inline"><input type="radio" name="is_meal" value="2" <?php  if($item['is_meal'] == 2) { ?>checked<?php  } ?>> 关闭</label>
					</div>	
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">外卖订餐</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<label class="radio-inline"><input type="radio" name="is_takeout" value="1" <?php  if($item['is_takeout'] == 1) { ?>checked<?php  } ?> onclick="$('#takeout').show();"> 开启</label>
						<label class="radio-inline"><input type="radio" name="is_takeout" value="2" <?php  if($item['is_takeout'] == 2) { ?>checked<?php  } ?> onclick="$('#takeout').hide();"> 关闭</label>
					</div>
				</div>
				<div id="takeout" <?php  if($item['is_takeout'] == 2) { ?>style="display:none"<?php  } ?>>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>起送价</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<div class="input-group">
								<input type="text" class="form-control" name="send_price" value="<?php  echo $item['send_price'];?>">
								<span class="input-group-addon">元</span>
							</div>
						</div>	
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>配送费</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<div class="input-group">
								<input type="text" class="form-control" name="delivery_price" value="<?php  echo $item['delivery_price'];?>">
								<span class="input-group-addon">元</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>预计送达时间</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<div class="input-group">
								<input type="text" class="form-control" name="delivery_time" value="<?php  echo $item['delivery_time'];?>">
								<span class="input-group-addon">分钟</span>
							</div>
						</div>	
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>服务半径</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<div class="input-group">
								<input type="text" class="form-control" name="serve_radius" value="<?php  echo $item['serve_radius'];?>">
								<span class="input-group-addon">KM</span>
							</div>
						</div>	
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>配送区域</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<input type="text" class="form-control" name="delivery_area" value="<?php  echo $item['delivery_area'];?>">
						</div>	
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">点击门店直接跳转到<?php  echo $item['forward_mode'];?></label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<label class="radio-inline"><input type="radio" name="forward_mode" value="0" <?php  if(!$item['forward_mode']) { ?>checked<?php  } ?>> 默认页(门店详情页)</label>
						<label class="radio-inline"><input type="radio" name="forward_mode" value="2" <?php  if($item['forward_mode'] == 2) { ?>checked<?php  } ?>> 外卖</label>
						<label class="radio-inline"><input type="radio" name="forward_mode" value="4" <?php  if($item['forward_mode'] == 4) { ?>checked<?php  } ?>> 预定</label>
						<label class="radio-inline"><input type="radio" name="forward_mode" value="3" <?php  if($item['forward_mode'] == 3) { ?>checked<?php  } ?>> 排队</label>
					</div>
				</div>
				<?php  if($config['sms']['status'] == 1) { ?>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">首次下单短信验证</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<label class="radio-inline"><input type="radio" name="mobile_verify[first_verify]" value="1" <?php  if($item['mobile_verify']['first_verify'] == 1) { ?>checked<?php  } ?>> 验证</label>
							<label class="radio-inline"><input type="radio" name="mobile_verify[first_verify]" value="0" <?php  if(!$item['mobile_verify']['first_verify']) { ?>checked<?php  } ?>> 不验证</label>
							<span class="help-block">
								<strong class="text-danger"></strong>
							</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">外送地址手机号验证</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<label class="radio-inline"><input type="radio" name="mobile_verify[takeout_verify]" value="1" <?php  if($item['mobile_verify']['takeout_verify'] == 1) { ?>checked<?php  } ?>> 验证</label>
							<label class="radio-inline"><input type="radio" name="mobile_verify[takeout_verify]" value="0" <?php  if(!$item['mobile_verify']['takeout_verify']) { ?>checked<?php  } ?>> 不验证</label>
						</div>
					</div>
				<?php  } ?>
			</div>
		</div>
		<div class="panel panel-default tab-pane" role="tabpanel" id="page">
			<div class="panel-heading" id="aa">页面设置</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">菜品分类风格</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<input type="hidden" name="dish_style" value="<?php  echo $item['dish_style'];?>" id="dish_style">
						<a href="javascript:;" data-id="1" class="thumbnail <?php  if($item['dish_style'] == 1 || !$item['dish_style']) { ?>active<?php  } ?>" style="width:200px; float:left; margin-right:20px;">
							<img src="../addons/str_takeout/template/resource/images/dish_b.png">
						</a>
						<a href="javascript:;" data-id="2" class="thumbnail" <?php  if($item['dish_style'] == 2) { ?>active<?php  } ?> style="width:200px; float:left; margin-right:20px;">
							<img src="../addons/str_takeout/template/resource/images/dish_a.png">
						</a>
					</div>	
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">公告</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<input type="text" name="notice" value="<?php  echo $item['notice'];?>" class="form-control">
						<div class="help-block">手机端将以滚动的方式展示</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>是否开启评论</label>
					<div class="col-sm-9 col-xs-12">
						<label class="radio-inline">
							<input type="radio" value="1" name="comment_status" <?php  if($item['comment_status'] == 1) { ?>checked<?php  } ?>> 开启
						</label>
						<label class="radio-inline">
							<input type="radio" value="2" name="comment_status" <?php  if($item['comment_status'] == 2) { ?>checked<?php  } ?>> 不开启
						</label>
						<span class="help-block">开启评论后，用户在“下单并且订单的状态为已完成时”可对门店进行评价。</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>是否需要审核评论</label>
					<div class="col-sm-9 col-xs-12">
						<label class="radio-inline">
							<input type="radio" value="1" name="comment_set" <?php  if($item['comment_set'] == 1) { ?>checked<?php  } ?>> 不需要审核
						</label>
						<label class="radio-inline">
							<input type="radio" value="2" name="comment_set" <?php  if($item['comment_set'] == 2) { ?>checked<?php  } ?>> 需要审核
						</label>
						<span class="help-block">设置为"需要审核",用户评论后,需要管理员审核后才能显示到前台</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>是否在菜品上方显示幻灯片</label>
					<div class="col-sm-9 col-xs-12">
						<label class="radio-inline">
							<input type="radio" value="1" name="slide_status" <?php  if($item['slide_status'] == 1) { ?>checked<?php  } ?>> 显示
						</label>
						<label class="radio-inline">
							<input type="radio" value="2" name="slide_status" <?php  if($item['slide_status'] == 2 || !$item['slide_status']) { ?>checked<?php  } ?>> 不显示
						</label>
						<span class="help-block">开启显示后,将会调用门店实景图,显示到菜品上方。</span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>版权名称</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="copyright[name]" value="<?php  echo $item['copyright']['name'];?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>版权链接</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="copyright[url]" value="<?php  echo $item['copyright']['url'];?>" class="form-control">
						<span class="help-block">版权链接要以:"http://"或"https://"开头</span>
					</div>
				</div>
			</div>
		</div>
	<div>

	<div class="form-group">
		<div class="col-sm-9 col-xs-9 col-md-9">
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
			<input name="submit" id="submit" type="submit" value="提交" class="btn btn-primary col-lg-1">
		</div>
	</div>
</form>
<script type="text/javascript">
	function delhouritem(obj) {
		if($(':text[name="business_start_hours[]"]').length == 1) return false;
		$(obj).parent().parent().remove();
		return false;
	}
	$(function(){
		$(':text[name="map[lng]"]').css('margin-left', '-15px');
		$('#hour-add').click(function(){
			var hour_length = $('#hour .hour-item').length;
			if(hour_length < 3) {
				var html = '<div class="form-group hour-item">' +
								'<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>营业时间</label>'+
								'<div class="col-sm-9 col-xs-4 col-md-3">'+
									'<div class="input-group">'+
										'<input type="text" name="business_start_hours[]" class="form-control" placeholder="8:00"> '+
										'<span class="input-group-addon">至</span>'+
										'<input type="text" name="business_end_hours[]" class="form-control" placeholder="12:00"> '+
									'</div>'+
								'</div>'+	
								'<div class="col-sm-9 col-xs-4 col-md-3" style="padding-top:6px">'+
									'<a href="javascript:;" onclick="delhouritem(this);"><i class="fa fa-times-circle" title="删除时间段"> </i></a>'+
								'</div>'+
							'</div>';
				$('#hour').append(html);
			}		
		});

		$('.thumbnail').click(function(){
			$('.thumbnail').removeClass('active');
			$(this).addClass('active');
			$('#dish_style').val($(this).data('id'));
		});
		$('#selectImage').click(function(){
			util.uploadMultiPictures(function(images){
				var s = '';
				$.each(images, function(){
					s += '<div class="col-lg-3">'+
					'	<input type="hidden" name="thumbs[image][]" value="'+this.filename+'">' +
					'	<div class="panel panel-default panel-slide">'+
					'		<div class="btnClose" onclick="$(this).parent().parent().remove()"><i class="fa fa-times"></i></div>' +
					'		<div class="panel-body">'+
					'			<img src="'+this.url+'" width="100%" height="170">'+
					'			<div>'+
					'				<input class="form-control last pull-right" placeholder="跳转链接" name="thumbs[url][]">'+
					'			</div>'+
					'		</div>'+
					'	</div>'+
					'</div>'
				});
				$('#slideContainer').append(s);
			});
		});
	});
	require(['util'], function(u){
		u.editor($('.richtext')[0]);
		$('#form1').submit(function(){
			if($.trim($(':text[name="title"]').val()) == '') {
				u.message('请填写门店名称');
				return false;
			}
			if($.trim($(':text[name="logo"]').val()) == '') {
				u.message('请上传门店LOGO');
				return false;
			}
			if($.trim($(':text[name="telephone"]').val()) == '') {
				u.message('请填写门店电话');
				return false;
			}
			if($.trim($(':text[name="telephone"]').val()) == '') {
				u.message('请填写门店电话');
				return false;
			}
			var hour_flag = false;
			$(':text[name="business_start_hours[]"]').each(function(i){
				if($.trim($(this).val()) != '' && $.trim($(this).next().next().val()) != '') {
					hour_flag = true;
				} 
			});
			if(!hour_flag) {
				u.message('请填写有效的营业时间段');
				return false;
			}
			if($.trim(u.editor($('.richtext')[0]).getContent()) == "") {
				u.message('请填写门店特色说明');
				return false;
			}
			var is_takeout = $.trim($(':radio[name="is_takeout"]:checked').val());
			if(is_takeout == 1) {
				var send_price = parseInt($.trim($(':text[name="send_price"]').val()));
				if(isNaN(send_price)) {
					u.message("起送价必须为数字");
					return false;
				}
				var delivery_price = parseInt($.trim($(':text[name="delivery_price"]').val()));
				if(isNaN(delivery_price)) {
					u.message("配送费必须为数字");
					return false;
				}
				var delivery_time = parseInt($.trim($(':text[name="delivery_time"]').val()));
				if(isNaN(delivery_time)) {
					u.message("预计送达时间必须为数字");
					return false;
				}
				var serve_radius = parseInt($.trim($(':text[name="serve_radius"]').val()));
				if(isNaN(serve_radius)) {
					u.message("服务半径必须为数字");
					return false;
				}
				if($(':text[name="delivery_area"]').val() == '') {
					u.message("请填写配送区域");
					return false;
				}
			}
			if(!$('select[name="reside[province]"]').val() || !$('select[name="reside[city]"]').val()) {
				u.message("请选择省市区信息");
				return false;
			}
			if(!$.trim($(':text[name="address"]').val())) {
				u.message("请填写详细地址");
				return false;
			}
			return true;
		});
	});
</script>
<?php  } else if($op == 'list') { ?>
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
				<input type="hidden" name="do" value="store"/>
				<input type="hidden" name="op" value="list"/>
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">所在区域</label>
					<div class="col-sm-7 col-lg-8 col-md-8 col-xs-12">
						<select class="form-control" id="area_id" name="area_id">
							<option value="0">不限</option>
							<?php  if(is_array($area)) { foreach($area as $row) { ?>
								<option value="<?php  echo $row['id'];?>" <?php  if($area_id == $row['id']) { ?>selected<?php  } ?>><?php  echo $row['title'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">门店名称</label>
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
		<div class="panel panel-default">
			<div class="panel-body table-responsive">
				<table class="table table-hover">
					<thead class="navbar-inner">
						<tr>
							<th>门店logo</th>
							<th>门店名称</th>
							<th>门店电话</th>
							<th style="width:350px">门店地址</th>
							<th>区域</th>
							<th>点餐类型</th>
							<th>是否显示</th>
							<th style="width:300px; text-align:right;">操作</th>
						</tr>
					</thead>
					<tbody>
						<?php  if(is_array($lists)) { foreach($lists as $item) { ?>
						<tr>
							<td><img src="<?php  echo tomedia($item['logo']);?>" width="50"></td>
							<td><?php  echo $item['title'];?></td>
							<td><?php  echo $item['telephone'];?></td>
							<td><?php  echo $item['address'];?></td>
							<td><?php  echo $area[$item['area_id']]['title'];?></td>
							<td>
								<?php  if($item['is_meal'] == 1) { ?>
									<label class="label label-warning">店内</label>
								<?php  } ?>
								<?php  if($item['is_takeout'] == 1) { ?>
									<label class="label label-warning">外卖</label>
								<?php  } ?>
							</td>
							<td>
								<?php  if($item['status'] == 1) { ?>
									<span class="label label-success status-toggle" id="<?php  echo $item['id'];?>" data-toggle="2" title="点击修改">显示</span>
								<?php  } else { ?>
									<span class="label label-warning status-toggle" id="<?php  echo $item['id'];?>" data-toggle="1" title="点击修改">隐藏</span>
								<?php  } ?>
							</td>
							<td style="text-align:right;">
								<a href="javascript:;" class="btn btn-default show-qrcode" data-sys="<?php  echo $item['sys_url'];?>" data-wx="<?php  echo $item['wx_url'];?>" data-id="<?php  echo $item['id'];?>">二维码</a>								<a href="<?php  echo $this->createWebUrl('store', array('op' => 'post', 'id' => $item['id']))?>" class="btn btn-default btn-sm" title="编辑" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"> </i> 编辑</a>
								<a href="<?php  echo $this->createWebUrl('store', array('op' => 'del', 'id' => $item['id']))?>" class="btn btn-default btn-sm" title="删除" data-toggle="tooltip" data-placement="top" onclick="if(!confirm('删除后将不可恢复，确定删除吗?')) return false;"><i class="fa fa-times"> </i> 删除</a>
								<a href="<?php  echo $this->createWebUrl('switch', array('sid' => $item['id']))?>" class="btn btn-default btn-sm" title="管理门店" data-toggle="tooltip" data-placement="top" style="color:#D9534F;"><i class="fa fa-cog fa-spin"> </i> 管理</a>
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

<div class="modal fade" id="qrcode-modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">桌台二维码</h3>
			</div>
			<div class="modal-body">
				<div class="qrcode clearfix">
					<div class="panel panel-default" style="margin-right:35px;">
						<div class="panel-heading">系统二维码</div>
						<div class="panel-body">
							<span id="sys-qrcode"></span>
						</div>
					</div>
					<div class="panel panel-default" style="margin-left:35px;">
						<div class="panel-heading">微信二维码</div>
						<div class="panel-body">
							<span id="wx-qrcode">
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('.btn').hover(function(){
			$(this).tooltip('show');
		},function(){
			$(this).tooltip('hide');
		});

		$('.status-toggle').click(function(){
			var id = $(this).attr('id');
			var dvalue = $(this).attr('data-toggle');
			$.post('<?php  echo $this->createWebUrl('ajax', array('op' => 'status_store'))?>', {'id':id, 'value':dvalue}, function(data){
				if(data == 'success') {
					location.reload();
				} else {
					u.message('编辑门店显示状态失败');
				}
			});
		});

		$('.show-qrcode').click(function(){
			var option = {
				render: 'canvas',
				width: 260,
				height: 260,
				colorDark : "#000000",
				colorLight : "#ffffff"
			}
			var sys_url = $(this).data('sys');
			option.text = sys_url;
			$('#sys-qrcode').html('');
			new QRCode($('#sys-qrcode')[0],option);

			var wx_url = $(this).data('wx');
			if(wx_url) {
				option.text = wx_url;
				$('#wx-qrcode').html('');
				new QRCode($('#wx-qrcode')[0],option);
			} else {
				var sid = $(this).data('id');
				var url = "<?php  echo $this->createWebUrl('qrcode', array('op' => 'build', 'type' => 1));?>" + "&store_id=" + sid;
				var html = '<a href="'+url+'" onclick="if(!confirm(\'确定生成吗\')) return false;" class="btn btn-primary">生成微信二维码</a>';
				$('#wx-qrcode').html(html);
			}
			$('#qrcode-modal').modal('show');
		});
	});
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>