<?php defined('IN_IA') or exit('Access Denied');?><?php  $config = get_config();?>
<footer data-role="footer" id="footer_role">

	<nav class="nav_common bar bar-tab footer">
		<ul class="box_nav">
			<li class="more <?php  if($_GPC['do'] == 'dish') { ?>on<?php  } ?>">
				<a class="tab-item external active" href="<?php  echo $this->createMobileUrl('index', array());?>">
					<img src="../addons/str_takeout/template/resource/images/dianpu.png" alt="">
					<label>首頁</label>
				</a>
			</li>
			<li class="<?php  if($_GPC['do'] == 'store') { ?>on<?php  } ?>">
				<a class="tab-item external" href="<?php  echo $this->createMobileUrl('myorder', array('sid' => $_GPC['sid']));?>">
					<img src="../addons/str_takeout/template/resource/images/dingdan.png" alt="">
					<label>訂單</label>
					<!-- <span class="badge">2</span> -->
				</a>
			</li>
			<li class="more <?php  if($_GPC['do'] == 'myorder' || $_GPC['do'] == 'orderdetail') { ?>on<?php  } ?>">
				<a class="tab-item external" href="<?php  echo murl('mc/home');?>">
					<img src="../addons/str_takeout/template/resource/images/wode.png" alt="">
					<label>我的</label>
				</a>
			</li>
		</ul>
	</nav>
</footer>

<script src="../addons/str_takeout/template/resource/js/nav.js"></script>
<!--<script src="<?php   echo $_W['siteroot'];?>/web/resource/js/lib/langguage.js?v=20180817"></script>-->
<script type="text/javascript">
    // 微商城分享
    wx.ready(function () {
        sharedata = {
            title: "<?php  echo $store['title'];?>",
            desc: '<?php  echo cutstr(str_replace("\r\n", "", strip_tags($store['description'])), 64, true);?>',
            link: "<?php  echo $_W['siteurl'];?>",
            imgUrl: "<?php  echo tomedia($store['logo']);?>"
        };
        wx.onMenuShareAppMessage(sharedata);
        wx.onMenuShareTimeline(sharedata);
    });
</script>