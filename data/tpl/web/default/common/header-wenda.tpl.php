<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('common/header-base', TEMPLATE_INCLUDEPATH));?>
<div data-skin="default" class="skin-default <?php  if($_GPC['main-lg']) { ?> main-lg-body <?php  } ?>">
<?php  $frames = buildframes(FRAME);_calc_current_frames($frames);?>
<div class="head">
	<nav class="navbar navbar-default" role="navigation">
		<div class="container <?php  if(!empty($frames['section']['platform_module_menu']['plugin_menu'])) { ?>plugin-head<?php  } ?>">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php  echo $_W['siteroot'];?>">
					<img src="<?php  if(!empty($_W['setting']['copyright']['blogo'])) { ?><?php  echo tomedia($_W['setting']['copyright']['blogo'])?><?php  } else { ?>./resource/images/logo/logo.png<?php  } ?>" class="pull-left" width="110px" height="35px">
					<span class="version"><?php echo IMS_VERSION;?></span>
				</a>
			</div>
			<?php  if(!empty($_W['uid'])) { ?>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-left">
					<?php  global $top_nav?>
					<?php  if(is_array($top_nav)) { foreach($top_nav as $nav) { ?>
					<li<?php  if(FRAME == $nav['name']) { ?> class="active"<?php  } ?>><a href="<?php  if(empty($nav['url'])) { ?><?php  echo url('home/welcome/' . $nav['name']);?><?php  } else { ?><?php  echo $nav['url'];?><?php  } ?>" <?php  if(!empty($nav['blank'])) { ?>target="_blank"<?php  } ?>><?php  echo $nav['title'];?></a></li>
					<?php  } } ?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="wi wi-user color-gray"></i><?php  echo $_W['user']['username'];?> <span class="caret"></span></a>
						<ul class="dropdown-menu color-gray" role="menu">
							<li>
								<a href="<?php  echo url('user/profile');?>" target="_blank"><i class="wi wi-account color-gray"></i> 我的账号</a>
							</li>
							<?php  if($_W['isfounder']) { ?>
							<li class="divider"></li>
							<li><a href="<?php  echo url('cloud/upgrade');?>" target="_blank"><i class="wi wi-update color-gray"></i> 自动更新</a></li>
							<li><a href="<?php  echo url('system/updatecache');?>" target="_blank"><i class="wi wi-cache color-gray"></i> 更新缓存</a></li>
							<li class="divider"></li>
							<?php  } ?>
							<li>
								<a href="<?php  echo url('user/logout');?>"><i class="fa fa-sign-out color-gray"></i> 退出系统</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<?php  } else { ?>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown"><a href="<?php  echo url('user/register');?>">注册</a></li>
					<li class="dropdown"><a href="<?php  echo url('user/login');?>">登陆</a></li>
				</ul>
			</div>
			<?php  } ?>
		</div>
	</nav>
</div>
<?php  if(empty($_COOKIE['check_setmeal']) && !empty($_W['account']['endtime']) && ($_W['account']['endtime'] - TIMESTAMP < (6*86400))) { ?> 
<div class="system-tips we7-body-alert" id="setmeal-tips">
	<div class="container text-right">
		<div class="alert-info">
			<a href="<?php  if($_W['isfounder']) { ?><?php  echo url('user/edit', array('uid' => $_W['account']['uid']));?><?php  } else { ?>javascript:void(0);<?php  } ?>">
				您的服务有效期限：<?php  echo date('Y-m-d', $_W['account']['starttime']);?> ~ <?php  echo date('Y-m-d', $_W['account']['endtime']);?>.
				<?php  if($_W['account']['endtime'] < TIMESTAMP) { ?>
				目前已到期，请联系管理员续费
				<?php  } else { ?>
				将在<?php  echo floor(($_W['account']['endtime'] - strtotime(date('Y-m-d')))/86400);?>天后到期，请及时付费
				<?php  } ?>
			</a>
			<span class="tips-close" onclick="check_setmeal_hide();"><i class="wi wi-error-sign"></i></span>
		</div>
	</div>
</div>
<script>
	function check_setmeal_hide() {
		util.cookie.set('check_setmeal', 1, 1800);
		$('#setmeal-tips').hide();
		return false;
	}
</script>
<?php  } ?> 
<div class="main">
<?php  if(!defined('IN_MESSAGE')) { ?>
<div class="container">
	<?php  if(in_array(FRAME, array('account', 'system', 'wxapp', 'site', 'website')) && !in_array($_GPC['a'], array('news-show', 'notice-show'))) { ?>
		<a href="javascript:;" class="js-big-main button-to-big color-gray" title="加宽"><?php  if($_GPC['main-lg']) { ?>正常<?php  } else { ?>宽屏<?php  } ?></a>
	<div class="panel panel-content main-panel-content <?php  if(!empty($frames['section']['platform_module_menu']['plugin_menu'])) { ?>panel-content-plugin<?php  } ?>">
		<div class="content-head panel-heading main-panel-heading">
			<?php  if(FRAME == 'website') { ?>
				<span class="font-lg"><i class="wi wi-system-site"></i> 设置教程</span>
				<span class="pull-right"><a href="<?php  echo url('website/wenda-show/list')?>" class="color-default we7-margin-left"><i class="wi wi-cut color-default"></i>教程列表</a></span>

			<?php  } ?>
		</div>
	<div class="panel-body clearfix main-panel-body <?php  if(!empty($_W['setting']['copyright']['leftmenufixed'])) { ?>menu-fixed<?php  } ?>">
		<div class="left-menu">
			<div class="left-menu-content">
				<div class="panel panel-menu">
					<div class="panel-heading">
						<span class="no-collapse">基础设置教程<i class="wi wi-appsetting pull-right setting"></i></span>
					</div>
					<ul class="list-group">
						<li class="list-group-item list-group-more">
								<a href="<?php  echo url('website/wenda-show/list', array('cateid' => 2));?>"><span class="label label-more">点击进入</span></a>
						</li>
					</ul>
				</div>
				<div class="panel panel-menu">
					<div class="panel-heading">
						<span class="no-collapse">小程序应用教程<i class="wi wi-appsetting pull-right setting"></i></span>
					</div>
					<ul class="list-group">
						<?php  if(is_array($wxapps)) { foreach($wxapps as $wxapp) { ?>
							<li class="list-group-item <?php  if($wxapp['active']) { ?>active<?php  } ?>">
								<a href="<?php  echo $wxapp['url'];?>" class="text-over">
								<?php  echo $wxapp['title'];?>
								</a>
							</li>
						<?php  } } ?>
						<li class="list-group-item list-group-more">
								<a href="<?php  echo url('website/wenda-show/list', array('cateid' => 3));?>"><span class="label label-more">点击进入</span></a>
						</li>
					</ul>
				</div>
				<div class="panel panel-menu">
					<div class="panel-heading">
						<span class="no-collapse">公众号应用教程<i class="wi wi-appsetting pull-right setting"></i></span>
					</div>
					<ul class="list-group">
						<?php  if(is_array($modules)) { foreach($modules as $module) { ?>
							<li class="list-group-item <?php  if($modid == $module['mid']) { ?>active<?php  } ?>">
								<a href="<?php  echo url('website/wenda-show/list', array('cateid' => 1, 'modid' => $module['mid']));?>" class="text-over">
								<?php  echo $module['title'];?>
								</a>
							</li>
						<?php  } } ?>
					</ul>
				</div>
			</div>
			</div>
		<div class="right-content">
	<?php  } ?>
<?php  } ?>
