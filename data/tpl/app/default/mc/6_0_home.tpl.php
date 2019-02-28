<style>
	*,body{font-family:PingFangSC-Medium;font-size: 12px;}
	.top_nav{height: 44px;line-height: 44px;font-size: 18px;color: #0f0f0f;font-weight: 500;text-align: center;background-color: #fff;margin-bottom: 10px;}
	#homePage .mui-banner{height: 146px;}
	#homePage .mui-banner img{width: 65px;height: 65px;margin: 22px 12px 0 22px;left: 0;top: 0;}
	#homePage .mui-banner .mui-big a{height: 22px;line-height: 22px;font-weight: 500;font-size: 16px;color: #fff;}
	#homePage .mui-banner .mui-mt5 span{color:#fff;font-size: 14px;}
	.setting{display: none;}
	#homePage .mui-banner .mui-row{height: 63px;width: 219px;background: url(../addons/str_takeout/template/resource/images/jifen.png) 0 0 no-repeat;position: absolute;left: 50%;margin-left: -110px;background-color: #fff;border-radius: 32px;bottom: -31px;display: flex;}
	#homePage .mui-banner .mui-row .mui-col-xs-6{border:0;}
	#homePage .mui-banner .mui-row .fa{background: url(../addons/str_takeout/template/resource/images/jifen1.png) 0 0 no-repeat;margin-top: 10%;}
	#homePage .mui-banner .mui-row .mui-col-xs-6{display: flex;justify-items: center;align-items: center;justify-content: center;width: 70%;}
	#homePage .mui-banner .mui-row .mui-col-xs-6 a{color: #333;display: flex;align-items: center;font-size: 16px;}
	#homePage .mui-banner .mui-row .mui-col-xs-6 a span{font-size: 20px!important;}

	#homePage .mui-table{margin-top: 45px!important;}

	#homePage .type_box{background-color: #fff;height: 186px;border-radius: 11px;margin: 0 12px;margin-top: 45px;padding: 0 10px;}
	#homePage .type_box div{height: 60px;border-bottom: 1px solid #f3f3f3;display: flex;justify-items: center;align-items: center;}
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
						<span class="fa"></span>
						積分: <span class="mui-ml5 mui-big"><?php  echo $credits[$behavior['activity']];?></span>
					</a>
				</div>
			</div>
		</div>
		
		<div class="type_box">
			<div>收貨地址</div>
			<div>我的評價</div>
			<div>個人信息</div>
		</div>
		<!-- <div class="mui-table mui-table-inline mui-mt15 nav-action">
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
		</div> -->
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