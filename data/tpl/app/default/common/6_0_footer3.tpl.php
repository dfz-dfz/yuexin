<?php defined('IN_IA') or exit('Access Denied');?><footer data-role="footer" id="footer_role">
	<nav class="nav_common bar bar-tab footer">
		<ul class="box_nav">
			<li class="more <?php   if($_GPC['do'] == 'dish') { ?>on<?php   } ?>">
				<a class="tab-item external active" href="<?php   echo $this->createMobileUrl('index', array());?>">
					<img src="../addons/str_takeout/template/resource/images/dianpu.png" alt="">
					<label>首頁</label>
				</a>
			</li>
			<li class="<?php   if($_GPC['do'] == 'store') { ?>on<?php   } ?>">
				<a class="tab-item external" href="<?php   echo $this->createMobileUrl('myorder', array('sid' => $_GPC['sid']));?>">
					<img src="../addons/str_takeout/template/resource/images/dingdan1.png" alt="">
					<label>訂單</label>
					<!-- <span class="badge">2</span> -->
				</a>
			</li>
			<li class="more <?php   if($_GPC['do'] == 'myorder' || $_GPC['do'] == 'orderdetail') { ?>on<?php   } ?>">
				<a class="tab-item external" href="<?php   echo murl('mc/home');?>">
					<img src="../addons/str_takeout/template/resource/images/wode1.png" alt="">
					<label>我的</label>
				</a>
			</li>
		</ul>
	</nav>
</footer>