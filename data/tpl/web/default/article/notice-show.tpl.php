<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="notice-show">
	<?php  if($do == 'list') { ?>
		<div class="panel we7-panel">
			<div class="panel-heading">
				<span class="font-lg">公告列表</span>
			</div>
			<div class="panel-body we7-padding">
				<div class="btn-group we7-btn-group we7-margin-bottom btn-group-justified">
					<a href="<?php  echo url('article/notice-show/list');?>" class="btn <?php  if(!$cateid) { ?>active<?php  } ?>">全部</a>
					<?php  if(is_array($categroys)) { foreach($categroys as $key => $categroy) { ?>
					<?php  if($key) { ?>
						<a href="<?php  echo url('article/notice-show/list', array('cateid' => $categroy['id']));?>" class="btn <?php  if($cateid == $categroy['id']) { ?>active<?php  } ?>"><?php  echo $categroy['title'];?></a>
					<?php  } ?>
					<?php  } } ?>
				</div>
				<?php  if(!empty($data)) { ?>
				<div class="notice">
					<ul class="list-group">
						<?php  if(is_array($data)) { foreach($data as $da) { ?>
						<li class="list-group-item">
							<a href="<?php  echo url('article/notice-show/detail', array('id' => $da['id']));?>" target="_blank" class="text-over" style="<?php  if(!empty($da['style'])) { ?><?php  if(!empty($da['style']['color'])) { ?>color: <?php  echo $da['style']['color']?>;<?php  } ?><?php  if(!empty($da['style']['bold'])) { ?>font-weight:bold;<?php  } ?><?php  } ?>"><?php  echo $da['title'];?></a>
							<span class="time pull-right"><?php  echo date('Y-m-d', $da['createtime']);?></span>
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
	<div class="we7-padding">
		
		<ol class="breadcrumb we7-breadcrumb">
			<a href="<?php  echo url('account/welcome');?>"><i class="wi wi-back-circle"></i></a>
			<li class="active"><a href="<?php  echo url('article/notice-show/list');?>">公告列表</a></li>
			<li class="active"><?php  echo $notice['title'];?></li>
		</ol>
		<div class="panel we7-panel news-detail">
			<div class="panel-heading text-center">
				<h3 class="text-center"><?php  echo $notice['title'];?></h3>
				<div class="small text-center text-muted">
					<span><?php  echo date('Y-m-d H:i', $notice['createtime']);?></span>
					<span>阅读：<?php  echo $notice['click'];?>次</span>
				</div>
			</div>
			<div class="panel-body we7-padding">
				<?php  echo html_entity_decode($notice['content'], ENT_QUOTES)?>
			</div>
		</div>
	</div>
	<?php  } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
