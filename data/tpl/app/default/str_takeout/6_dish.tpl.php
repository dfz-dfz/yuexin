<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/main.css">
<script src="../addons/str_takeout/template/resource/js/swipe_min.js"></script>
<script src="../addons/str_takeout/template/resource/js/dialog.js"></script>
<script src="../addons/str_takeout/template/resource/js/iscroll-probe.js"></script>
<script src="../addons/str_takeout/template/resource/js/main.js"></script>
<script src="../addons/str_takeout/template/resource/js/menu.js"></script>
<script src="../addons/str_takeout/template/resource/js/common.js"></script>
<style type="text/css">
	<?php  if($store['comment_status'] == 1) { ?>
	.nav a{width:33.333%;}
	<?php  } ?>
</style>
<div class="container" onselectstart="return true;" ondragstart="return false;">
	<header class="top_nav"><img src="../addons/str_takeout/template/resource/images/close.png" alt="">店名店名店名</header>

	<header class="nav menu">
		<div class="title_message">
			<div style="margin-bottom: 6px;">
				<span style="font-size: 12px;margin-right: 5px;">[換門店]</span>
				<span style="margin-right:5px;font-size: 14px;color:#0f0f0f;">分店名分店名分店名</span>
				<span style="font-size: 11px;">地址地址地址</span>
			</div>
			<div>
				<span style="font-size: 11px;margin-right: 5px;">聯繫電話：0000000</span>
				<span style="font-size: 11px;">營業時間：7：00-18:00</span>
			</div>
		</div>
		<div>
			<a href="<?php  echo $this->createMobileUrl('dish', array('sid' => $_GPC['sid']))?>" class="on">點菜</a>
			<?php  if($store['comment_status'] == 1) { ?>
			<a href="<?php  echo $this->createMobileUrl('comment_list', array('sid' => $_GPC['sid']));?>">評價</a>
			<?php  } ?>
			<!-- <a href="<?php  echo murl('mc/home');?>">会员中心</a> -->
		</div>
	</header>
	<section>
	<?php  if(!empty($store['thumbs']) && $store['slide_status'] == 1) { ?>
		<div id="imgSwipe" class="img_swipe" style="visibility: visible;">
			<ul style="width: 0px;">
				<?php  if(is_array($store['thumbs'])) { foreach($store['thumbs'] as $li) { ?>
					<li><a href="<?php  echo $li['url'];?>"><img src="<?php  echo tomedia($li['image']);?>" /></a></li>
				<?php  } } ?>
			</ul>
			<ol id="swipeNum">
				<?php  if(is_array($store['thumbs'])) { foreach($store['thumbs'] as $li) { ?>
					<li class=""></li>
				<?php  } } ?>
			</ol>
		</div>
	<?php  } ?>
	</section>
	<?php  if(!empty($store['notice'])) { ?>
	<div class="notice">
		<div class="notice-box">
			<div class="scrollNotice">
				<span class="js-scroll-notice">
					公告: <?php  echo $store['notice'];?>
				</span>
			</div>
		</div>
	</div>
	<?php  } ?>
	<form name="cart_form" id="cart_form" action="<?php  echo $this->createMobileUrl('order', array('sid' => $sid, 'mode' => $mode), true);?>" method="post">
		<input type="hidden" name="more" value="<?php  echo $_GPC['more'];?>">
		<input type="hidden" name="dish_str" value="<?php  echo $dish_str;?>">
		<section class="menu_wrap <?php  if($store['dish_style'] == 1) { ?>skin1<?php  } ?>" id="menuWrap">
			<?php  if(!$store['business_hours_flag']) { ?>
				<div class="tips">本店休息中，<?php  echo $hour_str;?>营业</div>
			<?php  } ?>
			<?php  if($mode == 1 && !empty($table)) { ?>
				<div class="tips">您在 <?php  echo $table['ctitle'];?>-<?php  echo $table['title'];?> 点餐</div>
			<?php  } ?>
			<div id="menuNav" class="menu_nav">
				<div class="ico_menu_wrap clearfix"><span class="ico_menu" id="icoMenu"><i></i></span></div>
				<div class="side_nav" id="sideNav">
					<ul>
						<?php  if(is_array($category)) { foreach($category as $cate) { ?>
							<?php  $i++;?>
							<li><a href="javascript:void(0);" data-cid="<?php  echo $cate['id'];?>"><?php  echo $cate['title'];?></a></li>
						<?php  } } ?>
					</ul>
				</div>
			</div>
			<div class="menu_container">
				<section>
					<?php  if(!empty($store['thumbs']) && $store['slide_status'] == 1) { ?>
						<div id="imgSwipe" class="img_swipe" style="visibility: visible;">
							<ul style="width: 0px;">
								<?php  if(is_array($store['thumbs'])) { foreach($store['thumbs'] as $li) { ?>
									<li><a href="<?php  echo $li['url'];?>"><img src="<?php  echo tomedia($li['image']);?>" /></a></li>
								<?php  } } ?>
							</ul>
							<ol id="swipeNum">
								<?php  if(is_array($store['thumbs'])) { foreach($store['thumbs'] as $li) { ?>
									<li class=""></li>
								<?php  } } ?>
							</ol>
						</div>
					<?php  } ?>
				</section>
				<?php  if(is_array($category)) { foreach($category as $cate_row) { ?>
					<div class="menu_tt" id="cate-<?php  echo $cate_row['id'];?>"><h2><?php  echo $cate_row['title'];?></h2></div>
					<ul class="menu_list">
						<?php  if(is_array($cate_dish[$cate_row['id']])) { foreach($cate_dish[$cate_row['id']] as $ds) { ?>
							<li id="<?php  echo $ds['id'];?>" class="xian" onclick="showDetail(this)">
								<div class="top">
									<div>
										<?php  if(!empty($ds['label'])) { ?>
											<div class="dish_label"><?php  echo $ds['label'];?></div>
										<?php  } ?>
										<?php  if($ds['thumb']) { ?>
											<div><img src="<?php  echo tomedia($ds['thumb']);?>" alt=""></div>
										<?php  } else { ?>
											<div class="nopic"></div>
										<?php  } ?>
									</div>
									<div>
										<h3 style="font-size: 14px;color:#333;"><?php  echo $ds['title'];?></h3>
										<p style="font-size: 12px;color:#898989;">
											已售<span class="sale_num" style="font-size:12px;"><?php  echo $ds['sailed'];?></span><span class="sale_unit" style="font-size:12px;"><?php  echo $ds['unitname'];?></span>
											<?php  if($ds['total'] == 0) { ?>
												<span class="text-danger" style="font-size:12px;">已售完</span>
											<?php  } ?>
											<!-- 赠<?php  echo $ds['grant_credit'];?>积分 -->
										</p>
										<div class="info"><?php  echo $ds['description'];?></div>
										<?php  $i=0;?>
										<?php  if($ds['show_group_price'] == 1) { ?>
											<div>
												<?php  if(is_array($ds['price'])) { foreach($ds['price'] as $k => $v) { ?>
													<?php  $i++;?>
													<?php  if($i < 4) { ?>
														<?php  if(!$k) { ?>
															<span style="font-size: 18px;color:#333;">$<?php  echo $v;?></span>
														<?php  } else { ?>
															<span style="font-size: 14px;color:#c3c3c3;text-decoration: line-through;"><?php  echo $groups[$k]['title'];?>$<?php  echo $v;?></span>
														<?php  } ?>
													<?php  } ?>
												<?php  } } ?>
											</div>
										<?php  } ?>
									</div>
									<div class="price_wrap">
										<strong style="display: none;">$<span class="unit_price"><?php  echo $ds['member_price'];?></span></strong>
										<?php  if($store['business_hours_flag']) { ?>
											<?php  if($ds['total'] == -1 || $ds['total'] > 0) { ?>
											<div class="fr" max="<?php  echo $ds['total'];?>" data-first-order-limit="<?php  echo $ds['first_order_limit'];?>" data-buy-limit="<?php  echo $ds['buy_limit'];?>" data-first-order="<?php  echo $is_first_order;?>">
												<a href="javascript:void(0);" style="display: none;" class="btn_n add" data-num="<?php  echo $cart['data'][$ds['id']];?>"></a>
												<input autocomplete="off" class="h_num" type="hidden" name="dish[<?php  echo $ds['id'];?>]" value="<?php  echo $cart['data'][$ds['id']];?>">
												選規格
											</div>
											<?php  } ?>
										<?php  } ?>
									</div>
								</div>
							</li>
						<?php  } } ?>
					</ul>
				<?php  } } ?>
			</div>
		</section>
		<?php  if(!$store['business_hours_flag']) { ?>
			<footer class="shopping_cart" id="shopping_box">
				<div class="fixeds">
					本店已打烊
				</div>
			</footer>
		<?php  } else { ?>
			<?php  if($_GPC['mode'] == 2) { ?>
			<footer class="shopping_cart" id="shopping_box" style="display: none;">
				<!-- 購物車詳情 -->
				<div class="shopp_cat_details" style="display: none;">
					<div class="head">
						<span class="hadchoes">已選商品</span>
						<span class="empty">清空</span>
					</div>
					<div class="goods_list">
						<div class="list_top">
							<span>牛排套餐</span>
							<span>
								<?php  if($ds['total'] == -1 || $ds['total'] > 0) { ?>
									<div class="fr" max="<?php  echo $ds['total'];?>" data-first-order-limit="<?php  echo $ds['first_order_limit'];?>" data-buy-limit="<?php  echo $ds['buy_limit'];?>" data-first-order="<?php  echo $is_first_order;?>">
										<a href="javascript:void(0);" class="btn_n add" data-num="<?php  echo $cart['data'][$ds['id']];?>"></a>
										<input autocomplete="off" class="h_num" type="hidden" name="dish[<?php  echo $ds['id'];?>]" value="<?php  echo $cart['data'][$ds['id']];?>">
									</div>
								<?php  } ?>
							</span>
							<span>$40</span>
						</div>
						<div>牛排，牛奶，正常冰</div>
					</div>
				</div>
				<!-- 購物車詳情end -->
				<div class="fixed">
					<div class="cart_bgs">
						<div class="cart_nums">
							<img src="../addons/str_takeout/template/resource/images/gouwuche.png" alt="">
							購物車
						</div>
						<span id="cartNum"></span>
					</div>
					<div>$<span id="totalPrice">0</span></div>
					<div>
						<span class="comm_btn disabled">還差<span id="sendCondition"><?php  echo $store['send_price'];?></span>起送</span>
						<a id="settlement" href="javascript:document.cart_form.submit();" class="comm_btn" style="">結算</a>
					</div>
				</div>
			</footer>
			<?php  } else { ?>
			<footer class="shopping_cart" id="shopping_box" style="display: none;">
				<div class="fixed">
					<div class="cart_bgs">
						<div class="cart_nums">
							<img src="../addons/str_takeout/template/resource/images/gouwuche.png" alt="">
							購物車
						</div>
						<span id="cartNum"></span>
					</div>
					<div>$<span id="totalPrice">0</span></div>
					<div>
						<?php  if($mode == 3) { ?>
							<span class="comm_btn disabled"><span id="sendCondition" class="hide">0元</span>点餐</span>
							<a id="assignSubmit" href="javascript:;" class="comm_btn" style="display: none;">选好了</a>
						<?php  } else if($mode == 4) { ?>
							<span class="comm_btn disabled">还差<span id="sendCondition"><?php  echo $table_category['limit_price'];?>元</span>起送</span>
							<a id="reserveSubmit" href="javascript:;" class="comm_btn" style="display: none;">选好了</a>
						<?php  } else { ?>
							<a id="settlement" href="javascript:document.cart_form.submit();" class="comm_btn" style="">結算</a>
						<?php  } ?>
					</div>
				</div>
			</footer>
			<?php  } ?>
		<?php  } ?>
	</form>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?>
	<div class="menu_detail" id="menuDetail">
		<img style="display: none;">
		<div class="nopic"><img src=""></div>
		<a href="javascript:void(0);" class="comm_btn" id="detailBtn">来一份</a>
		<dl>
			<dt>价格：</dt>
			<dd class="highlight">$<span class="price"></span></dd>
		</dl>
		<p>月售<span class="sale_num"></span>份</p>
		<dl>
			<dt>介绍：</dt>
			<dd class="info"></dd>
		</dl>
	</div>
</div>

<script type="text/javascript">
$(function(){
	$('#assignSubmit').click(function(){
		var action = "<?php  echo $this->createMobileUrl('assign', array('sid' => $sid, 'op' =>'index', 'mode' => $mode, 'f' => 'dish'), true);?>";
		$('#cart_form').attr('action', action);
		$('#cart_form').submit();
	});

	$('#reserveSubmit').click(function(){
		var action = "<?php  echo $this->createMobileUrl('reserve', array('sid' => $sid, 'op' =>'post', 'mode' => 4, 'f' => 'dish', 'date' => $_GPC['date'], 'time' => $_GPC['time'], 'cid' => $_GPC['cid']), true);?>";
		$('#cart_form').attr('action', action);
		$('#cart_form').submit();
	});


});
//显示购物车详情
$('.cart_bgs').click(function() {
	$('.shopp_cat_details').show();
	return false;
});

var menu = {
	offsetAry: [0],
	_is_left_menu_addclass:true,
	init: function(id){
		var winH = $(window).height(),
			_this = this,			
			_icoMenu = $('#icoMenu'),
			_sideNav = $('#sideNav'),
			maxH = winH - (_icoMenu.parent().is(':visible') ? _icoMenu.outerHeight(true) : 0) - 45;

		this.el =  $(id);
		
		_sideNav.height(maxH);

		if(_sideNav.find('ul').height() > maxH)  new IScroll('#sideNav', { probeType: 3, mouseWheel: true ,click:true});

		$(window).bind('scroll', function(){
			_this.scroll.call(_this);
		});

		$('#icoMenu').click(function(){
			if(_sideNav.css('display') != 'none') {
				_sideNav.show();
			} else {
				_sideNav.hide();
			}
			if(_sideNav.find('ul').height() > maxH)  new IScroll('#sideNav', { probeType: 3, mouseWheel: true ,click:true});
		});

		$('.menu_tt h2').each(function(){
			_this.offsetAry.push($(this).offset().top);
		});

		this.el.find('a').click(function(){
			$(this).addClass('on').parent().siblings().find('a').removeClass('on');
			_this._is_left_menu_addclass=false;
			var t = $(window).scrollTop();
			var t1= _this.offsetAry[_this.el.find('a').index(this) + 1];
			var _t =Math.abs(t1-t);
			var _time =parseInt( Math.round(_t/3));
			$('html,body').animate({scrollTop: t1}, _time,"linear",function(){_this._is_left_menu_addclass=true;});
		});

		_this.offsetT = this.el.offset().top;	
	},
	getIndex: function(ary, value){
		var i = 0;
		for(; i < ary.length; i++){
			if(value >= ary[i] && value < ary[i + 1]){
				return i;
			}
		}
		return ary.length -1;
	},
	scroll: function(){
		var st = $(document).scrollTop(),
			index = this.getIndex(this.offsetAry, st),
			i = index - 1;

		if(this.curIndex !== index){ // 判断分类是否切换
			
			$('.menu_tt h2').removeClass('menu_fixed');
			if(this._is_left_menu_addclass==true)
				this.el.find('a').removeClass('on');
			if(i >= 0){
				this.el.addClass('menu_fixed');
				$('.menu_tt').eq(i).find('h2').addClass('menu_fixed');
				if(this._is_left_menu_addclass==true)
					this.el.find('a').eq(i).addClass('on');	
			}else{
				this.el.removeClass('menu_fixed');
			}
			this.curIndex = index;
		}
	}
}
$(function(){
	menu.init('#menuNav');
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
