<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/main.css">
<script src="../addons/str_takeout/template/resource/js/dialog.js"></script>
<script src="../addons/str_takeout/template/resource/js/main.js"></script>
<script src="../addons/str_takeout/template/resource/js/menu.js"></script>
<div class="container" onselectstart="return true;" ondragstart="return false;">
	<header class="comment-stat clearfix">
		<div class="left">
			<span>80%</span>
			<div>好評率</div>
		</div>
		<div class="right">
			<span class="sales"><strong class="sale_9" style="width:<?php  echo round($comment_stat['avg_taste']/5, 2) * 100?>%"></strong></span>
			<div>共有123人評價</div>
		</div>
	</header>
	<section>
		<ul class="comment_list">
			<?php  if(is_array($data)) { foreach($data as $ds) { ?>
				<li>
					<div>
						<?php  if($ds['avatar']) { ?>
							<div><img src="<?php  echo tomedia($ds['avatar']);?>" alt=""></div>
						<?php  } else { ?>
							<div><img src="../addons/str_takeout/template/resource/images/noavatar_middle.gif" alt=""></div>
						<?php  } ?>								
					</div>
					<div>
						<h3 class="clearfix">
							<?php  if($ds['nickname']) { ?>
								<?php  echo $ds['nickname'];?>
							<?php  } else if($ds['realname']) { ?>
								<?php  echo $ds['realname'];?>
							<?php  } else { ?>
								<?php  echo str_pad($ds['uid'], 6, '0', STR_PAD_LEFT);?>
							<?php  } ?>
							<span class="pull-right"><?php  echo date('Y-m-d H:i', $ds['addtime']);?></span>
						</h3>
						<div class="center">
							<span>口味：<?php  echo sprintf('%.2f', $ds['taste']);?></span>
							<span>态度：<?php  echo sprintf('%.2f', $ds['serve']);?></span>
							<span>速度：<?php  echo sprintf('%.2f', $ds['speed']);?></span>
						</div>
						<div><?php  echo $ds['note'];?></div>
					</div>
				</li>
			<?php  } } ?>
		</ul>
		<div class="page"><?php  echo $pager;?></div>
	</section>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
