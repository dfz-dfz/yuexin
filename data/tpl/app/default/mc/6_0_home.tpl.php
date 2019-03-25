<style>
	html{font-size: 20px!important;}
	.mui-table-view:before{display: none;}
	.mui-ios .mui-table-view-cell{height: 3rem;}
	.mui-table-view-chevron .mui-table-view-cell>a:not(.mui-btn){height: 3rem;line-height: 2rem;}

	.box_nav {
	    height: 49px;
	    position: fixed;
	    z-index: 200;
	    bottom: 0px;
	    width: 100%;
	    background: #fdfdfd;
	    list-style-type: none;
	    display: -webkit-box;
	    -webkit-box-orient: horizontal;
	    border-top: 1px solid #e7e7e7;
	    min-width: 320px;
	    max-width: 640px;
	    padding: 0;
    	margin-block-end: inherit;
	}
	.box_nav >li {
	    list-style: none;
	    -webkit-box-align: center;
	    -webkit-box-flex: 1;
	    border-left:none;
	    border: none;
	}
	.box_nav li.more {
	    position: relative;
	}
	.box_nav >li>a {
	    margin: 0 auto;
	    font-size: 10px;
	    line-height: 28px;
	    color: #848484;
	    -webkit-box-sizing: border-box;
	    box-sizing: border-box;
	    height: 100%;
	    text-align: center;
	    text-decoration: none;
	    width: 80px;
	    display: -webkit-box;
	}
	.box_nav li>a>img {
	    width: 32px;
	    height: 32px;
	    display: inline-block;
	    margin-top: 2px;
	}
	.box_nav li>a label {
	    width: 100%;
	    text-align: center;
	    overflow: hidden;
	    text-overflow: ellipsis;
	    white-space: nowrap;
	    font-weight: normal;
	    font-size: 10px;
	    height: 12px;
	    line-height: 12px;
	    margin-bottom: 8px;
	}
	.box_nav li>a.on, .box_nav li>a.active {
	    color: #2BA3DC;
	}
</style>

<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php  if($do == 'display') { ?>
	<div class="mui-content mc-we7-home">
		<div style="height: 2.25rem;text-align: center;line-height: 2.25rem;font-size:0.9rem;background-color: #fff;margin-bottom: 0.5rem;">
			上海小馆
		</div>

		<div class="mui-banner" style="background:linear-gradient(90deg,rgba(102,211,242,1) 0%,rgba(62,173,225,1) 100%);background-repeat:no-repeat;background-size:cover;height: 7.3rem;">
			<!-- <div class="setting"><a href="<?php  echo url('mc/bond/settings') . 'wxref=mp.weixin.qq.com#wechat_redirect'?>">设 置</a></div> -->
			<img src="<?php  if(!empty($profile['avatar'])) { ?><?php  echo tomedia($profile['avatar']);?><?php  } else { ?>./resource/images/member-header.png<?php  } ?>" alt="" class="mui-logo mui-img-circle" style="border:none;border-radius: 100%;"/>
			<div class="mui-banner-info">
				<div class="mui-big"><?php  if(!empty($profile['nickname'])) { ?><span style="color:white"><?php  echo $profile['nickname'];?></span><?php  } else { ?><a href="<?php  echo url('mc/profile') . 'wxref=mp.weixin.qq.com#wechat_redirect'?>" style="color:red;">设置昵称</a><?php  } ?></div>
				<div class="mui-mt5"><?php  if(!empty($profile['mobile'])) { ?><span style="color:white"><?php  echo $profile['mobile'];?></span><?php  } else { ?><a href="<?php  echo url('mc/bond/mobile', array('op' => 'mobilechange'))?>" class="mui-btn mui-btn-outlined">绑定手机</a><?php  } ?></div>
			</div>
			<div class="mui-row banner-nav" style="width:11rem;margin: 0 auto;height: 3rem;bottom: -1.5rem;background: url('../addons/str_takeout/template/resource/images/jifen.png') 0 0 no-repeat;background-size: 100% 100%;padding:0;">
				<!-- <div class="mui-col-xs-6 mui-text-center">
					<a href="<?php  echo url('mc/bond/credits', array('credittype' => 'credit2', 'type' => 'record', 'period' => '1'))?>">
						<span class="fa fa-rmb"></span>
						<?php  echo $creditnames[$behavior['currency']]['title'];?>: <span class="mui-ml5 mui-big"><?php  echo $credits[$behavior['currency']];?></span>
					</a>
				</div> -->
				<div class="mui-col-xs-6 mui-text-center" style="border:none;left: 1rem;top:0.8rem;">
					<a href="<?php  echo url('mc/bond/credits', array('credittype' => 'credit1', 'type' => 'record', 'period' => '1'))?>" style="color: #333;">
						<span style="background:url('../addons/str_takeout/template/resource/images/jifen1.png') 0 0 no-repeat;display: -webkit-inline-box;width:0.9rem;height:0.9rem;"></span>
						<?php  echo $creditnames[$behavior['activity']]['title'];?>: <span class="mui-ml5 mui-big"><?php  echo $credits[$behavior['activity']];?></span>
					</a>
				</div>
			</div>
		</div>
		
		<ul class="mui-table-view mui-table-view-chevron" style="margin: 2rem 0.6rem;border-radius: 0.6rem;">
			<li class="mui-table-view-cell">
				<a href="<?php  echo url('mc/profile/address') . 'wxref=mp.weixin.qq.com#wechat_redirect'?>" class="mui-navigate-right">
					收货地址
				</a>
			</li>
			<?php  if(empty($profile_hide)) { ?>
			<li class="mui-table-view-cell">
				<a href="" class="mui-navigate-right">我的評價</a>
			</li>
			<?php  } ?>
			<li class="mui-table-view-cell">
				<a href="<?php  echo url('mc/profile') . 'wxref=mp.weixin.qq.com#wechat_redirect'?>" class="mui-navigate-right">
					個人信息
				</a>
			</li>
		</ul>

		<ul class="box_nav">
			<li class="more">
				<a class="tab-item external" href="./index.php?i=6&amp;c=entry&amp;do=index&amp;m=str_takeout">
					<img src="../addons/str_takeout/template/resource/images/dianpu1.png" alt="">
					<label>首頁</label>
				</a>
			</li>
			<li class="">
				<a class="tab-item external" href="./index.php?i=6&amp;c=entry&amp;sid=13&amp;do=myorder&amp;m=str_takeout">
					<img src="../addons/str_takeout/template/resource/images/dingdan1.png" alt="">
					<label>訂單</label>
					<!-- <span class="badge">2</span> -->
				</a>
			</li>
			<li class="more on">
				<a class="tab-item external active" href="./index.php?i=6&amp;c=mc&amp;a=home&amp;">
					<img src="../addons/str_takeout/template/resource/images/wode.png" alt="">
					<label>我的</label>
				</a>
			</li>
		</ul>

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
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>