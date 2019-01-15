<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<script type="text/javascript">
jQuery.browser={};
(function(){
	jQuery.browser.msie=false; 
	jQuery.browser.version=0;
	if(navigator.userAgent.match(/MSIE ([0-9]+)./)){ 
		jQuery.browser.msie=true;jQuery.browser.version=RegExp.$1;
	}
})();
(function($) {
  $.fn.sorted = function(customOptions) {
	var options = {
	  reversed: false,
	  by: function(a) { return a.text(); }
	};
	$.extend(options, customOptions);
	$data = $(this);
	arr = $data.get();
	arr.sort(function(a, b) {
	  var valA = options.by($(a));
	  var valB = options.by($(b));
	  if (options.reversed) {
		return (valA < valB) ? 1 : (valA > valB) ? -1 : 0;
	  } else {
		return (valA < valB) ? -1 : (valA > valB) ? 1 : 0;
	  }
	});
	return $(arr);
  };
})(jQuery);
</script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=6E7C75E41980283b39d3c61e81f16a39"></script>
<script src="../addons/str_takeout/template/resource/js/jquery.quicksand.js"></script>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/main.css">
<style>
	.modal-header{padding:10px 15px}
	.modal-body{padding:0 15px}
	.modal-body li{font-size: 12px;height: 40px;line-height: 40px;color: #666;text-indent: 1em;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;border-bottom: 1px solid #ECECEC;}
	.modal-body ul{width: 100%;overflow-y: scroll; padding: 0;background-color: #fff;height:300px;}
	.modal{top:100px;}
	.area{height:35px;line-height: 35px;background: #FFF;text-align: center;font-weight: 700;color:#696e74;border-bottom: 1px solid #e1e1e1;}
</style>
<div class="modal fade" id="area-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">選擇區域</h4>
			</div>
			<div class="modal-body">
				<ul>
					<li data-id="0">不限</li>
					<?php  if(is_array($area)) { foreach($area as $ar) { ?>
					<li data-id="<?php  echo $ar['id'];?>"><?php  echo $ar['title'];?></li>
					<?php  } } ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<header>
	<div class="search">
		<input type="text" value="<?php  echo $_GPC['key'];?>" id="searchTxt" placeholder="搜索店名">
	</div>
</header>
<?php  if($config['area_search'] == 1) { ?>
<div class="area" id="area"><?php  if(!empty($area[$area_id]['title'])) { ?><?php  echo $area[$area_id]['title'];?><?php  } else { ?>选择区域<?php  } ?> <i class="fa fa-caret-down"></i></div>
<?php  } ?>
<div id="position" style="background:#eeeeee;color:#888888;padding-left:10px;line-height:30px;font-size:12px;display:none">定位中...</div>
<div id="allmap"></div>
<div id="lat" class="hide"></div>
<div id="lng" class="hide"></div>
<div class="container">
	<section>
		<ul class="store_list" id="store_list">
			<?php  if(!empty($data)) { ?>
				<?php  if(is_array($data)) { foreach($data as $da) { ?>
					<li onclick="window.location.href='<?php  echo $da['url'];?>'" class="url" data-locax="<?php  echo $da['location_x'];?>" data-locay="<?php  echo $da['location_y'];?>">
						<div class="img_tt">
							<div>
								<div class="nopic" style="background-image:url(<?php  echo tomedia($da['logo']);?>);background-size: 100% 100%;"></div>
							</div>
						</div>
						<div class="main_info">	
							<?php  if(empty($da['business_hours_flag'])) { ?>
								<i class="ico_rest"></i>
							<?php  } else { ?>
								<i class="not_ico_rest"></i>
							<?php  } ?>
							<h3><?php  echo $da['title'];?></h3>
							<p class="sub_title"><?php  echo str_replace('+', '', $da['distirct']);?><?php  echo $da['address'];?></p>
							<div>
								<a href="tel:<?php  echo $da['telephone'];?>">電話:<?php  echo $da['telephone'];?></a>
								<span class="ml13"></span>
							</div>
						</div>
						<div class="right_info">
							<?php  if($da['is_meal'] == 1) { ?>
								<label class="label-type" style="background:red">店</label>
							<?php  } ?>
							<?php  if($da['is_takeout'] == 1) { ?>
								<label class="label-type" style="background:#ea6e4c">外</label>
							<?php  } ?>
						</div>
					</li>	
				<?php  } } ?>
			<?php  } else { ?>
				<li class="on-info"><i class="fa fa-info-circle"></i> 沒有符合條件的門店</li>
			<?php  } ?>
		</ul>
	</section>
</div>

<script type="text/javascript">
	$(function(){
		$('#area').click(function(){
			$('#area-modal').modal('show');
			$('#area-modal li').click(function(){
				var id = $(this).data('id');
				location.href="<?php  echo $this->createMobileUrl('index');?>&aid=" + id;
				return true;
			});
		});
	});

	function getFlatternDistance(lat1,lng1,lat2,lng2){
		var EARTH_RADIUS = 6378137.0;	//单位M
		var PI = Math.PI;

		function getRad(d){
			return d*PI/180.0;
		}

		var f = getRad((lat1 + lat2)/2);
		var g = getRad((lat1 - lat2)/2);
		var l = getRad((lng1 - lng2)/2);
		
		var sg = Math.sin(g);
		var sl = Math.sin(l);
		var sf = Math.sin(f);
		
		var s,c,w,r,d,h1,h2;
		var a = EARTH_RADIUS;
		var fl = 1/298.257;
		
		sg = sg*sg;
		sl = sl*sl;
		sf = sf*sf;
		
		s = sg*(1-sl) + (1-sf)*sl;
		c = (1-sg)*(1-sl) + sf*sl;
		
		w = Math.atan(Math.sqrt(s/c));
		r = Math.sqrt(s*c)/w;
		d = 2*w*a;
		h1 = (3*r -1)/2/c;
		h2 = (3*r +1)/2/s;
		
		return d*(1 + fl*(h1*sf*(1-sg) - h2*(1-sf)*sg));
	}
	var map = new BMap.Map("allmap");
	var point = new BMap.Point(116.331398,39.897445);
	map.centerAndZoom(point,12);

	$(function(){
		$('#position').show();
		var geolocation = new BMap.Geolocation();
		geolocation.getCurrentPosition(function(r){
			if(this.getStatus() == BMAP_STATUS_SUCCESS){
				var mk = new BMap.Marker(r.point);
				$('.url').each(function(){
					var loca_x =$(this).attr('data-locax');
					var loca_y =$(this).attr('data-locay');
					if(loca_x && loca_y) {
						var dist = getFlatternDistance(parseFloat(r.point.lat), parseFloat(r.point.lng), parseFloat(loca_x), parseFloat(loca_y));
						var _dist = dist.toFixed(2);
						dist = dist > 1000 ? ((dist/1000).toFixed(2) +' KM') : (parseInt(dist) + " M");
						$(this).find('.ml13').html('<i class="ico_addres"></i>距离:' + '<span data-dist="'+_dist+'">'+dist+'</span>');
					}
					$(this).removeClass('no-position');
				});
				var $applications = $('#store_list');
				var $data = $applications.clone();
				var $filteredData = $data.find('li');
				var $sortedData = $filteredData.sorted({
			   		by: function(v) {
				  		return parseFloat($(v).find('.ml13 span').attr('data-dist'));
					}
			  	});
				$applications.quicksand($sortedData, {});
	
				$('#lat').html(r.point.lat);
				$('#lng').html(r.point.lng);
				$('#position').hide();
			} else {
				$('#position').hide();
			}
		},{enableHighAccuracy: true});
		$('#searchTxt').on('keydown', function(e){
			if(e.keyCode == 13){
				var keyword = $.trim($("#searchTxt").val());
				location.href = "<?php  echo $this->createMobileUrl('index')?>" + '&key=' + keyword;
				return false;
			}
		});
	});
    wx.ready(function () {
        sharedata = {
            title: "智慧碼上微外賣，微信堂點，微信排號，微信預訂 智慧碼上微外賣",
            desc: '智慧碼上微外賣，微信堂點，微信外賣，微信排號，微信預訂一鍵搞定！',
            link: "<?php  echo $_W['siteurl'];?>",
            imgUrl: "<?php  echo $_W['siteroot'];?>/addons/str_takeout/icon.jpg"
        };
        wx.onMenuShareAppMessage(sharedata);
        wx.onMenuShareTimeline(sharedata);
    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>