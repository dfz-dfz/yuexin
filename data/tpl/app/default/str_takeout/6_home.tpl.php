<style>
	*,body{font-family:PingFangSC-Medium;}
	.top_nav{height: 44px;line-height: 44px;font-size: 18px;color: #0f0f0f;font-weight: 500;text-align: center;background-color: #fff;margin-bottom: 10px;}
	#homePage .mui-banner{height: 146px;}
	#homePage .mui-banner img{width: 65px;height: 65px;margin: 22px 12px 0 22px;left: 0;top: 0;}
	#homePage .mui-banner .mui-big a{height: 22px;line-height: 22px;font-weight: 500;font-size: 16px;color: #fff;}
	#homePage .mui-banner .mui-mt5 span{color:#fff;font-size: 14px;}
	.setting{display: none;}
	#homePage .mui-banner .mui-row{height: 63px;width: 219px;}
	#homePage .mui-banner .mui-row .mui-col-xs-6{border:0;}
</style>

<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php  if($do == 'display') { ?>
	<div class="mui-content mc-we7-home" id="homePage">
		<header class="top_nav">越新科技</header>

		<div class="mui-banner" style="background-image:url(<?php  if(!empty($ucpage['params'][0]['params']['bgImage'])) { ?>'<?php  echo $ucpage['params'][0]['params']['bgImage'];?>'<?php  } else { ?>'resource/images/head-bg.png'<?php  } ?>); background-repeat:no-repeat;background-size:cover;">
			<div class="setting"><a href="<?php  echo url('mc/bond/settings') . 'wxref=mp.weixin.qq.com#wechat_redirect'?>">设 置</a></div>
			<img src="<?php  if(!empty($profile['avatar'])) { ?><?php  echo tomedia($profile['avatar']);?><?php  } else { ?>./resource/images/member-header.png<?php  } ?>" alt="" class="mui-logo mui-img-circle" />
			<div class="mui-banner-info">
				<div class="mui-big"><?php  if(!empty($profile['nickname'])) { ?><span style="color:white"><?php  echo $profile['nickname'];?></span><?php  } else { ?><a href="<?php  echo url('mc/profile') . 'wxref=mp.weixin.qq.com#wechat_redirect'?>">设置昵称</a><?php  } ?></div>
				<div class="mui-mt5">
					<?php  if(!empty($profile['mobile'])) { ?>
						<span>賬號：<?php  echo $profile['mobile'];?></span><?php  } else { ?>
							<a href="<?php  echo url('mc/bond/mobile', array('op' => 'mobilechange'))?>" class="mui-btn mui-btn-outlined">绑定手机</a><?php  } ?>
				</div>
			</div>
			<div class="mui-row banner-nav">
				<!-- <div class="mui-col-xs-6 mui-text-center">
					<a href="<?php  echo url('mc/bond/credits', array('credittype' => 'credit2', 'type' => 'record', 'period' => '1'))?>">
						<span class="fa fa-rmb"></span>
						<?php  echo $creditnames[$behavior['currency']]['title'];?>: <span class="mui-ml5 mui-big"><?php  echo $credits[$behavior['currency']];?></span>
					</a>
				</div> -->
				<div class="mui-col-xs-6 mui-text-center">
					<a href="<?php  echo url('mc/bond/credits', array('credittype' => 'credit1', 'type' => 'record', 'period' => '1'))?>">
						<span class="fa fa-database"></span>
						<?php  echo $creditnames[$behavior['activity']]['title'];?>: <span class="mui-ml5 mui-big"><?php  echo $credits[$behavior['activity']];?></span>
					</a>
				</div>
			</div>
		</div>

		<div class="mui-table mui-table-inline mui-mt15 nav-action">
			<div class="mui-table-cell">
				<a href="<?php  echo url('entry', array('m' => 'recharge', 'do' => 'pay'));?>" class="mui-block">
					<img src="resource/images/sum-recharge.png" alt="" />
					余额充值
				</a>
			</div>
			<div class="mui-table-cell">
				<a href="javascript:;" id="scanqrcode">
					<img src="resource/images/scan-pay.png" alt="" />
					扫码付款
				</a>
			</div>
		</div>
		<?php  if(!empty($others) || !empty($groups)) { ?>
		<ul class="mui-table-view mui-table-view-chevron">
		<?php  if(!empty($others)) { ?>
			<?php  if(is_array($others)) { foreach($others as $nav) { ?>
			<li class="mui-table-view-cell">
				<a href="<?php  echo $nav['url']?>" class="mui-navigate-right">
					<?php  echo $nav['name'];?>
				</a>
			</li>
			<?php  } } ?>
		<?php  } ?>
		<?php  if(is_array($groups)) { foreach($groups as $name => $navs) { ?>
			<?php  if(is_array($navs)) { foreach($navs as $nav) { ?>
			<li class="mui-table-view-cell">
				<a href="<?php  echo $nav['url']?>" class="mui-navigate-right">
					<?php  echo $nav['name'];?>
				</a>
			</li>
			<?php  } } ?>
		<?php  } } ?>
		</ul>
		<?php  } ?>
		<?php  echo $ucpage['html'];?>
	</div>
<?php  } ?>

<script type="text/javascript">
	wx.ready(function(){
		$('#scanqrcode').click(function(){
			wx.scanQRCode({
				needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
				scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
				success: function (res) {
					var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
				}
			});
		});
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>


<?php defined('IN_IA') or exit('Access Denied');?><?php  if($_W['is_manager'] == 1) { ?>
<div class="page_fixed" style="font-size:30px;z-index:10000;bottom:100px;left:10px">
	<a style="color:#FFF;" href="<?php  echo $this->createMobileUrl('manage', array('sid' => $_GPC['sid']))?>"><i class="fa fa-cog" style="position:absolute;top:10px;right:14px;"></i></a>
</div>
<?php  } ?>
<?php  $footer_off = ''; $_W['page']['footer'] = '<a href="'.$store['copyright']['url'].'">'.$store['copyright']['name'].'</a>';?>

<?php defined('IN_IA') or exit('Access Denied');?>		<?php  if(empty($footer_off)) { ?>
			<div class="text-center footer" style="margin:10px 0; width:100%; text-align:center; word-break:break-all;">
				<?php  if(!empty($_W['page']['footer'])) { ?>
					<?php  echo $_W['page']['footer'];?>
				<?php  } ?>
				&nbsp;&nbsp;<?php  echo $_W['setting']['copyright']['statcode'];?>
			</div>
		<?php  } ?>
		<?php  if($_GPC['c'] == 'home' && $_GPC['a'] == 'page') { ?>
			<?php  if($bottom_menu) { ?>
				<?php  $site_quickmenu = modulefunc('site', 'site_quickmenu', array (
  'func' => 'site_quickmenu',
  'limit' => 10,
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 6,
  'acid' => 0,
)); if(is_array($site_quickmenu)) { $i=0; foreach($site_quickmenu as $i => $row) { $i++; $row['iteration'] = $i; ?><?php  } } ?>
			<?php  } ?>
		<?php  } else { ?>
			<?php  if($_GPC['m'] != 'paycenter') { ?>
				<?php  $site_quickmenu = modulefunc('site', 'site_quickmenu', array (
  'func' => 'site_quickmenu',
  'limit' => 10,
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 6,
  'acid' => 0,
)); if(is_array($site_quickmenu)) { $i=0; foreach($site_quickmenu as $i => $row) { $i++; $row['iteration'] = $i; ?><?php  } } ?>
			<?php  } ?>
		<?php  } ?>
	</div>
	<style>
		h5{color:#555;}
	</style>
	<?php
		$_share['title'] = !empty($_share['title']) ? $_share['title'] : $_W['account']['name'];
		$_share['imgUrl'] = !empty($_share['imgUrl']) ? $_share['imgUrl'] : '';
		if(isset($_share['content'])){
			$_share['desc'] = $_share['content'];
			unset($_share['content']);
		}
		$_share['desc'] = !empty($_share['desc']) ? $_share['desc'] : '';
		$_share['desc'] = preg_replace('/\s/i', '', str_replace('	', '', cutstr(str_replace('&nbsp;', '', ihtmlspecialchars(strip_tags($_share['desc']))), 60)));
		if(empty($_share['link'])) {
			$_share['link'] = '';
			$query_string = $_SERVER['QUERY_STRING'];
			if(!empty($query_string)) {
				parse_str($query_string, $query_arr);
				$query_arr['u'] = $_W['member']['uid'];
				$query_string = http_build_query($query_arr);
				$_share['link'] = $_W['siteroot'].'app/index.php?'. $query_string;
			}
		}
	?>
	<script type="text/javascript">
	$(function(){
		wx.config(jssdkconfig);
		var $_share = <?php  echo json_encode($_share);?>;
		if(typeof sharedata == 'undefined'){
			sharedata = $_share;
		} else {
			sharedata['title'] = sharedata['title'] || $_share['title'];
			sharedata['desc'] = sharedata['desc'] || $_share['desc'];
			sharedata['link'] = sharedata['link'] || $_share['link'];
			sharedata['imgUrl'] = sharedata['imgUrl'] || $_share['imgUrl'];
		}
		if(sharedata.imgUrl == ''){
			var _share_img = $('body img:eq(0)').attr("src");
			if(_share_img){
				sharedata['imgUrl'] = util.tomedia(_share_img);
			}
		}
		if(sharedata.imgUrl == ""){
			sharedata.imgUrl = window.sysinfo.attachurl + 'images/global/wechat_share.jpg';
		}
		if(sharedata.desc == ''){
			var _share_content = util.removeHTMLTag($('body').html());
			if(typeof _share_content == 'string'){
				sharedata.desc = _share_content.replace($_share['title'], '')
			}
		}
		wx.ready(function () {
			wx.onMenuShareAppMessage(sharedata);
			wx.onMenuShareTimeline(sharedata);
			wx.onMenuShareQQ(sharedata);
			wx.onMenuShareWeibo(sharedata);
		});
		<?php  if($controller == 'site' && $action == 'site') { ?>
			$('#category_show').click(function(){
				$('.head .order').toggleClass('hide');
				return false;
			});
			//文章点击和分享加积分
			<?php  if(!empty($_GPC['u'])) { ?>
				var url = "<?php  echo url('site/site/handsel/', array('id' => $detail['id'], 'action' => 'click', 'u' => $_GPC['u']), true);?>";
				$.post(url, function(dat){});
			<?php  } ?>
			sharedata.success = function(){
				var url = "<?php  echo url('site/site/handsel/', array('id' => $detail['id'], 'action' => 'share'));?>";
				$.post(url, function(dat){});
			}
		<?php  } ?>
		if ($('.js-quickmenu').size() > 0) {
			// var h = $('.js-quickmenu .nav-home').height()+20+'px';
			// $('body').css("padding-bottom",h);
			// $('body .mui-content').css("bottom",h);
		} else if($('.nav-menu-app').size() > 0) {
			var h = $('.nav-menu-app').height()+'px';
			$('body').css("padding-bottom",h);
			$('.mui-content').css('bottom',h);
		} else {
			$('body').css("padding-bottom", "0");
			$('.mui-content').css('bottom', "0");
		}
	});
	</script>
	
		<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>app/index.php?i=<?php  echo $_W['uniacid'];?>&c=utility&a=visit&do=showjs&m=<?php  echo $_W['current_module']['name'];?>"></script>
	
</body>
</html>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('str_takeout/common', TEMPLATE_INCLUDEPATH)) : (include template('str_takeout/common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('str_takeout/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('str_takeout/common/footer', TEMPLATE_INCLUDEPATH));?>
