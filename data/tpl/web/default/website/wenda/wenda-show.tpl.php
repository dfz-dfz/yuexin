<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-wenda', TEMPLATE_INCLUDEPATH)) : (include template('common/header-wenda', TEMPLATE_INCLUDEPATH));?>
<style>
.qa-ask{width:20px;height:20px;overflow:hidden;line-height:20px;font-size:12px;margin-right:7px;margin-top:-3px;display:-moz-inline-box;-moz-box-orient:vertical;display:inline-block;vertical-align:middle;border-radius:2px;color:#fff;background:#63bd65;text-align:center}
.qa-answer{width:20px;height:20px;overflow:hidden;line-height:20px;font-size:12px;margin-right:7px;margin-top:-3px;display:-moz-inline-box;-moz-box-orient:vertical;display:inline-block;vertical-align:middle;border-radius:2px;color:#fff;background:#70abea;text-align:center}
.qa-answer2{color:#fff;background:#70abea;padding-left:1px}
</style>
<div class="we7-page-title">使用教程</div>
<?php  if($do == 'list') { ?>
<div class="clearfix">
	<div class="panel panel-default">
		<div class="panel-body">
				<form action="" method="get" class="form-horizontal" role="form">
				<input type="hidden" name="c" value="website">
				<input type="hidden" name="a" value="wenda-show">
				<input type="hidden" name="do" value="list">
				<input type="hidden" name="cateid" value="<?php  echo $_GPC['cateid'];?>">
				<input type="hidden" name="mid" value="<?php  echo $_GPC['mid'];?>">
				<input type="hidden" name="createtime" value="<?php  echo $_GPC['createtime'];?>">
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">问题分类</label>
					<div class="col-sm-8 col-lg-9 col-xs-12">
						<div class="btn-group">
							<a href="<?php  echo filter_url('cateid:0');?>" class="btn <?php  if($_GPC['cateid'] == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
							<a href="<?php  echo filter_url('cateid:1');?>" class="btn <?php  if($_GPC['cateid'] == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">模块教程</a>
							<a href="<?php  echo filter_url('cateid:2');?>" class="btn <?php  if($_GPC['cateid'] == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">基础教程</a>
							<a href="<?php  echo filter_url('cateid:3');?>" class="btn <?php  if($_GPC['cateid'] == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">小程序教程</a>
							<a href="<?php  echo filter_url('cateid:4');?>" class="btn <?php  if($_GPC['cateid'] == 4) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">微官网教程</a>
							<a href="<?php  echo filter_url('cateid:5');?>" class="btn <?php  if($_GPC['cateid'] == 5) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">PC站教程</a>
							<a href="<?php  echo filter_url('cateid:6');?>" class="btn <?php  if($_GPC['cateid'] == 6) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">APP教程</a>
						</div>
					</div>
				</div>
				<div class="form-group" <?php  if($_GPC['cateid'] > 1) { ?>style="display: none"<?php  } ?>>
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">隶属模块</label>
					<div class="col-sm-8 col-lg-9 col-xs-12">
						<select name="modid" id="modid" class="form-control">
							<option value="">==请选择隶属模块==</option>
							<?php  if(is_array($modules)) { foreach($modules as $module) { ?>
							<option value="<?php  echo $module['mid'];?>" <?php  if($wenda['modid'] == $module['mid']) { ?>selected<?php  } ?>><?php  echo $module['title'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">添加时间</label>
					<div class="col-sm-8 col-lg-9 col-xs-12">
						<div class="btn-group">
							<a href="<?php  echo filter_url('createtime:0');?>" class="btn <?php  if($_GPC['createtime'] == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
							<a href="<?php  echo filter_url('createtime:3');?>" class="btn <?php  if($_GPC['createtime'] == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">三天内</a>
							<a href="<?php  echo filter_url('createtime:7');?>" class="btn <?php  if($_GPC['createtime'] == 7) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">一周内</a>
							<a href="<?php  echo filter_url('createtime:30');?>" class="btn <?php  if($_GPC['createtime'] == 30) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">一月内</a>
							<a href="<?php  echo filter_url('createtime:90');?>" class="btn <?php  if($_GPC['createtime'] == 90) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">三月内</a>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">标题</label>
					<div class="col-sm-8 col-lg-3 col-xs-12">
						<input class="form-control" name="title" id="" type="text" value="<?php  echo $_GPC['title'];?>">
					</div>
					<div class="pull-left col-xs-12 col-sm-2 col-lg-4">
						<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					<?php  if($_W['isfounder']) { ?>
					<div class="pull-right">
						<a href="<?php  echo url('website/wenda/post',array('cateid' => 1,modid => $_GPC['modid']));?>" class="btn btn-primary we7-padding-horizontal">添加该模块教程</a>
					</div>
					<?php  } ?>
					</div>
					
				</div>
					
			</form>
		</div>
				<?php  if(!empty($wenda)) { ?>
				<div class="form-group">
					<ul class="list-group">
						<?php  if(is_array($wenda)) { foreach($wenda as $da) { ?>
						<li class="list-group-item">
							<h5 style="font-size:16px;text-align:left"><span class="qa-ask">问</span><?php  echo $da['title'];?></h5>
							<p>
								<span class="qa-answer">答</span><?php  echo cutstr_num($da['content'],'188');?>
							  <a href="<?php  echo url('website/wenda-show/detail', array('id' => $da['id']));?>" target="_blank" class="qa-answer2">查看更多 </a>
							  </p>
						</li>
						<?php  } } ?>
					</ul>
				</div>
				<div class="text-right">
					<?php  echo $pager;?>
				</div>
				<?php  } else { ?>
				<div class="text-center">暂无数据</div>
				<?php  } ?>
			
	</div>
</div>
	<?php  } ?>
	<?php  if($do == 'detail') { ?>
	<div class="clearfix">
			<h4 class="text-center"><?php  echo $wenda['title'];?></h4>
			<div class="panel-body we7-padding">
				<?php  echo html_entity_decode($wenda['content'], ENT_QUOTES)?>
			</div>
	</div>
	<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
