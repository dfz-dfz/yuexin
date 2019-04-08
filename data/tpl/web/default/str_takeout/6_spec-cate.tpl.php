<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/style.css">
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('nav', TEMPLATE_INCLUDEPATH)) : (include template('nav', TEMPLATE_INCLUDEPATH));?>
<div class="clearfix">
	<div class="panel panel-default">
		<div class="panel-body">
			<?php  if($op == 'spec_list') { ?>
				<div>分類列表></div>
				<hr>
				<!--<a href="<?php  echo $this->createWebUrl('spec', array('op' => 'spec_post'));?>" data-toggle="modal" data-target=".bs-example-modal-sm" class="btn btn-primary">新建分類</a>-->
				<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
					新建分類
				</button>

				<!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog modal-sm" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">新建分類</h4>
							</div>
							<div class="modal-body">
								<input type="text" name="cateName" id="cateName" placeholder="請輸入分類名稱" class="form-control">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" onclick="saveForm()">保存</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
							</div>
						</div>
					</div>
				</div>
				<table class="table table-hover table-bordered" style="margin-top:20px">
					<thead>
						<tr>
							<th style="width: 150px">分類名稱</th>
							<th>現有分類</th>
							<th style="width: 200px">操作</th>
						</tr>
					</thead>
					<?php  if(is_array($data)) { foreach($data as $da) { ?>
						<tr>
							<td style="width: 150px"><input type="text" value="<?php  echo $da['cateName'];?>" id="spec_id<?php  echo $da['id'];?>" style="border: 0px;" onblur="changeName(<?php  echo $da['id'];?>)"></td>
							<td>
								<?php  if(is_array($da['list'])) { foreach($da['list'] as $spec) { ?>
									<span class="badge" style="background-color: #aaa;padding: 3px 10px;"><?php  echo $spec['specName'];?></span>
								<?php  } } ?>
							</td>
							<td style="width: 200px">
								<a href="<?php  echo $this->createWebUrl('spec', array('op' => 'spec_add', 'id' => $da['id']));?>" class="btn btn-default btn-sm">添加規格</a>
								<a href="<?php  echo $this->createWebUrl('spec', array('op' => 'spec_view', 'id' => $da['id']));?>" class="btn btn-default btn-sm">查看</a>
								<a href="<?php  echo $this->createWebUrl('spec', array('op' => 'spec_del', 'id' => $da['id']));?>" onclick="if(!confirm('确定删除吗')) return false;" class="btn btn-default btn-sm">删除</a>
							</td>
						</tr>
					<?php  } } ?>
				</table>
			<?php  } ?>

			<?php  if($op == 'spec_add') { ?>
				<div><a href="<?php  echo $this->createWebUrl('spec');?>">分類列表</a>><a href="<?php  echo $this->createWebUrl('spec', array('op' => 'spec_view',id=>$id));?>"><?php  echo $specInfo['cateName'];?></a>><?php  if($specId) { ?>修改規格<?php  } else { ?>新建規格<?php  } ?></div>
				<hr>
				<form class="form-horizontal" action="" method="post" id="form-category">
					<input type="hidden" name="id" value="<?php  echo $id;?>">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>規格名稱</label>
						<div class="col-sm-6 col-xs-6">
							<input type="text" class="form-control" name="specName" placeholder="" value="<?php  echo $dataList['specName'];?>">
						</div>
					</div>			
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>價格</label>
						<div class="col-sm-6 col-xs-6">
							<input type="number" class="form-control" name="price" placeholder="例如:2" value="<?php  echo $dataList['price'];?>">
							<span class="help-block"></span>
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

			<?php  if($op == 'spec_view') { ?>
			<div><a href="<?php  echo $this->createWebUrl('spec');?>">分類列表</a>><a href="<?php  echo $this->createWebUrl('spec', array('op' => 'spec_view',id=>$id));?>"><?php  echo $specInfo['cateName'];?></a>>規格列表</div>
			<hr>
			<a href="<?php  echo $this->createWebUrl('spec', array('op' => 'spec_add',id=>$id));?>" data-toggle="modal" data-target=".bs-example-modal-sm" class="btn btn-primary">新建規格</a>

			<table class="table table-hover table-bordered" style="margin-top:20px">
				<thead>
				<tr>
					<th>規格名稱</th>
					<th>價格</th>
					<th>操作</th>
				</tr>
				</thead>
				<?php  if(is_array($data)) { foreach($data as $da) { ?>
				<tr>
					<td><?php  echo $da['specName'];?></td>
					<td><?php  echo $da['price'];?></td>
					<td>
						<a href="<?php  echo $this->createWebUrl('spec', array('op' => 'spec_add', 'specId' => $da['id'],'id'=>$id));?>" class="btn btn-default btn-sm">修改規格</a>
						<a href="<?php  echo $this->createWebUrl('spec', array('op' => 'spec_item_del', 'id' => $da['id']));?>" onclick="if(!confirm('确定删除吗')) return false;" class="btn btn-default btn-sm">删除</a>
					</td>
				</tr>
				<?php  } } ?>
			</table>
			<?php  } ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	function saveForm(){
		var cateName = $('#cateName').val();
		var data = {};
		data.cateName = cateName;
	    $.ajax({
            type: "POST",
            url: "<?php  echo $this->createWebUrl('spec', array('op' => 'spec_post'));?>",
            data: data,
            success: function(msg){
                var data = JSON.parse(msg);
                if(data.type == 'success'){
                    util.message(data.message, '', 'success');
                }else {
                    util.message(data.message, '', 'error');
                }
                setTimeout(function () {
                    location.reload();
                },1000);
            }
        })
	}

	function changeName(id){
	    var cateName = $('#spec_id'+id).val();
	    var data = {};
	    data.cateName = cateName;
	    data.id = id;
        $.ajax({
            type: "POST",
            url: "<?php  echo $this->createWebUrl('spec', array('op' => 'spec_post'));?>",
            data: data,
            success: function(msg){
                var data = JSON.parse(msg);
                if(data.type == 'success'){
                    util.message(data.message, '', 'success');
				}else {
                    util.message(data.message, '', 'error');
				}
				setTimeout(function () {
                    location.reload();
                },1000);
            }
        })
	}
require(['clockpicker'], function(){
	$('#form-category').submit(function(){
		if(!$.trim($(':text[name="specName"]').val())) {
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