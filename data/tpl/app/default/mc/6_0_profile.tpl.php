<style>
	#avatar_box .mui-table-view{height: 143px;margin-top: 1px;}
	#avatar_box .mui-table-view .mui-table-view-cell{height: 143px;}
	#avatar_box .mui-table-view .mui-table-view-cell .webuploader-pick{height: 143px;text-indent: -999px;display: flex;justify-content: center;align-items: center;justify-items: center;}
	#avatar_box .mui-table-view .mui-table-view-cell .webuploader-pick a{height: 65px;display: flex;}
	#avatar_box .mui-table-view .mui-table-view-cell .webuploader-pick a img{width: 65px;height: 65px;margin: 0 auto;}

	.mui-table-view:before{display: none;}
	.mui-table-view:after{display: none;}
	.mui-navigate-right:after, .mui-push-left:after, .mui-push-right:after{display: none!important;}

	.address_box{font-size: 14px;color: #666;position: relative;}
	.address_box .edit{position: absolute;right: 0;top: 10px;padding-left: 16px;border-left: 1px solid #f3f3f3;}
</style>

<?php defined('IN_IA') or exit('Access Denied');?><?php  define('MUI', true);?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<header class="mui-bar mui-bar-nav" style="box-shadow: none;margin-bottom: 1px;background-color: #fff;">
	<div class="mui-row fixed-bar">
		<div class="mui-col-xs-4">
			<button class="mui-btn mui-btn-link mui-btn-nav mui-pull-left mui-action-back" style="margin-top: 8px;">
				<span class="mui-icon mui-icon-left-nav"></span>
			</button>
		</div>
		<div class="mui-col-xs-4 mui-text-center" style="font-size: 18px;font-weight: 500;color: #0f0f0f;">我的信息</div>
	</div>
</header>

<form class="tab-content clearfix js-ajax-form <?php  if($_W['container'] !== 'wechat') { ?>profile-form<?php  } ?>" action="<?php  echo url('mc/profile/editprofile');?>" method="post" enctype="multipart/form-data">
<div class="mui-content <?php  if($do == 'index') { ?>mc-profile<?php  } ?>">
<?php  if($do == 'index') { ?>
	<div id="avatar_box">
		<?php  if(!empty($mcFields['avatar'])) { ?>
		<?php  echo tpl_app_form_field_avatar('avatar', $profile['avatar']);?>
		<?php  } ?>
	</div>

	<div class="mui-input-group mui-mt15" style="margin-top: 20px!important;">
		<?php  if(!empty($mcFields['nickname'])) { ?>
		<div class="mui-input-row">
			<label>昵稱</label>
			<?php  echo tpl_app_fans_form('nickname', $profile['nickname'], $mcFields['nickname']['title']);?>
		</div>
		<?php  } ?>
		<?php  if(!empty($mcFields['telephone'])) { ?>
		<div class="mui-input-row">
			<label>電話</label>
			<?php  echo tpl_app_fans_form('telephone', $profile['telephone'], $mcFields['telephone']['title']);?>
		</div>
		<?php  } ?>
		<!-- <?php  if(!empty($mcFields['realname'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['realname']['title'];?></label>
			<?php  echo tpl_app_fans_form('realname', $profile['realname'], $mcFields['realname']['title']);?>
		</div>
		<?php  } ?> -->
		<?php  if(!empty($mcFields['gender'])) { ?>
		<div class="mui-input-row">
			<label>性別</label>
			<?php  echo tpl_app_fans_form('gender', $profile['gender'], $mcFields['gender']['title']);?>	
		</div>
		<?php  } ?>
		<?php  if(!empty($mcFields['birthyear'])) { ?>
		<div class="mui-input-row">
			<label>生日</label>
			<?php  echo tpl_app_fans_form('birth', array('year' => $profile['birthyear'], 'month' => $profile['birthmonth'], 'day' => $profile['birthday']), $mcFields['birthyear']['title']);?>
		</div>
		<?php  } ?>
		<!-- <?php  if(!empty($mcFields['resideprovince'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['resideprovince']['title'];?></label>
			<?php  echo tpl_app_fans_form('reside', array('province' => $profile['resideprovince'], 'city' => $profile['residecity'], 'district' => $profile['residedist']), $mcFields['resideprovince']['title']);?>
		</div>
		<?php  } ?> -->
	</div>
	<ul class="mui-table-view mui-table-view-chevron">
		<!-- <?php  if(empty($personal_info_hide)) { ?>
		<li class="mui-table-view-cell">
			<a href="<?php  echo url('mc/profile/personal_info') . 'wxref=mp.weixin.qq.com#wechat_redirect'?>" class="mui-navigate-right">个人信息</a>
		</li>
		<?php  } ?> -->
		<!-- <?php  if(empty($contact_method_hide)) { ?>
		<li class="mui-table-view-cell">
			<a href="<?php  echo url('mc/profile/contact_method') . 'wxref=mp.weixin.qq.com#wechat_redirect'?>" class="mui-navigate-right">联系方式</a>
		</li>
		<?php  } ?> -->
		<!-- <?php  if(empty($education_info_hide)) { ?>
		<li class="mui-table-view-cell">
			<a href="<?php  echo url('mc/profile/education_info') . 'wxref=mp.weixin.qq.com#wechat_redirect'?>" class="mui-navigate-right">教育信息</a>
		</li>
		<?php  } ?> -->
		<!-- <?php  if(empty($jobedit_hide)) { ?>
		<li class="mui-table-view-cell">
			<a href="<?php  echo url('mc/profile/jobedit') . 'wxref=mp.weixin.qq.com#wechat_redirect'?>" class="mui-navigate-right">工作信息</a>
		</li>
		<?php  } ?> -->
	</ul>
<?php  } ?>

<?php  if($do == 'personal_info') { ?>
	<div class="mui-content-padded mui-text-muted">请完善您的个人信息</div>
	<div class="mui-input-group mui-mt15">
		<?php  if(!empty($mcFields['idcard'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['idcard']['title'];?></label>
			<?php  echo tpl_app_fans_form('idcard', $profile['idcard'], $mcFields['idcard']['title']);?>
		</div>
		<?php  } ?>
		<?php  if(!empty($mcFields['height'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['height']['title'];?></label>
			<?php  echo tpl_app_fans_form('height', $profile['height'], $mcFields['height']['title']);?>
		</div>
		<?php  } ?>
		<?php  if(!empty($mcFields['weight'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['weight']['title'];?></label>
			<?php  echo tpl_app_fans_form('weight', $profile['weight'], $mcFields['weight']['title']);?>
		</div>
		<?php  } ?>
		<?php  if(!empty($mcFields['bloodtype'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['bloodtype']['title'];?></label>
			<?php  echo tpl_app_fans_form('bloodtype', $profile['bloodtype'], $mcFields['bloodtype']['title']);?>
		</div>
		<?php  } ?>
		<?php  if(!empty($mcFields['zodiac'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['zodiac']['title'];?></label>
			<?php  echo tpl_app_fans_form('zodiac', $profile['zodiac'], $mcFields['zodiac']['title']);?>
		</div>
		<?php  } ?>
		<?php  if(!empty($mcFields['constellation'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['constellation']['title'];?></label>
			<?php  echo tpl_app_fans_form('constellation', $profile['constellation'], $mcFields['constellation']['title']);?>
		</div>
		<?php  } ?>
		<?php  if(!empty($mcFields['site'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['site']['title'];?></label>
			<?php  echo tpl_app_fans_form('site', $profile['site'], $mcFields['site']['title']);?>
		</div>
		<?php  } ?>
		<?php  if(!empty($mcFields['affectivestatus'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['affectivestatus']['title'];?></label>
			<?php  echo tpl_app_fans_form('affectivestatus', $profile['affectivestatus'], $mcFields['affectivestatus']['title']);?>
		</div>
		<?php  } ?>
		<?php  if(!empty($mcFields['lookingfor'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['lookingfor']['title'];?></label>
			<?php  echo tpl_app_fans_form('lookingfor', $profile['lookingfor'], $mcFields['lookingfor']['title']);?>
		</div>
		<?php  } ?>
		<?php  if(!empty($mcFields['bio'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['bio']['title'];?></label>
			<?php  echo tpl_app_fans_form('bio', $profile['bio'], $mcFields['bio']['title']);?>
		</div>
		<?php  } ?>
		<?php  if(!empty($mcFields['interest'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['interest']['title'];?></label>
			<?php  echo tpl_app_fans_form('interest', $profile['interest'], $mcFields['interest']['title']);?>
		</div>
		<?php  } ?>
	</div>
<?php  } ?>
<?php  if($do == 'contact_method') { ?>
	<div class="mui-content-padded mui-text-muted">请完善您的联系方式</div>
	<div class="mui-input-group mui-mt15">
		<?php  if(!empty($mcFields['telephone'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['telephone']['title'];?></label>
			<?php  echo tpl_app_fans_form('telephone', $profile['telephone'], $mcFields['telephone']['title']);?>
		</div>
		<?php  } ?>
		<?php  if(!empty($mcFields['qq'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['qq']['title'];?></label>
			<?php  echo tpl_app_fans_form('qq', $profile['qq'], $mcFields['qq']['title']);?>
		</div>
		<?php  } ?>
		<?php  if(!empty($mcFields['msn'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['msn']['title'];?></label>
			<?php  echo tpl_app_fans_form('msn', $profile['msn'], $mcFields['msn']['title']);?>
		</div>
		<?php  } ?>
		<?php  if(!empty($mcFields['taobao'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['taobao']['title'];?></label>
			<?php  echo tpl_app_fans_form('taobao', $profile['taobao'], $mcFields['taobao']['title']);?>
		</div>
		<?php  } ?>
		<?php  if(!empty($mcFields['alipay'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['alipay']['title'];?></label>
			<?php  echo tpl_app_fans_form('alipay', $profile['alipay'], $mcFields['alipay']['title']);?>
		</div>
		<?php  } ?>
	</div>
<?php  } ?>
<?php  if($do == 'education_info') { ?>
	<div class="mui-content-padded mui-text-muted">请完善您的教育信息</div>
	<div class="mui-input-group mui-mt15">
		<?php  if(!empty($mcFields['education'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['education']['title'];?></label>
			<?php  echo tpl_app_fans_form('education', $profile['education'],$mcFields['education']['title']);?>
		</div>
		<?php  } ?>
		<?php  if(!empty($mcFields['graduateschool'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['graduateschool']['title'];?></label>
			<?php  echo tpl_app_fans_form('graduateschool', $profile['graduateschool'], $mcFields['graduateschool']['title']);?>
		</div>
		<?php  } ?>
		<?php  if(!empty($mcFields['studentid'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['studentid']['title'];?></label>
			<?php  echo tpl_app_fans_form('studentid', $profile['studentid'], $mcFields['studentid']['title']);?>
		</div>
		<?php  } ?>
	</div>
<?php  } ?>

<?php  if($do == 'jobedit') { ?>
	<div class="mui-content-padded mui-text-muted">请完善您的工作信息</div>
	<div class="mui-input-group mui-mt15">
		<?php  if(!empty($mcFields['company'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['company']['title'];?></label>
			<?php  echo tpl_app_fans_form('company', $profile['company'], $mcFields['company']['title']);?>
		</div>
		<?php  } ?>
		<?php  if(!empty($mcFields['occupation'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['occupation']['title'];?></label>
			<?php  echo tpl_app_fans_form('occupation', $profile['occupation'], $mcFields['occupation']['title']);?>
		</div>
		<?php  } ?>
		<?php  if(!empty($mcFields['position'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['position']['title'];?></label>
			<?php  echo tpl_app_fans_form('position', $profile['position'], $mcFields['position']['title']);?>
		</div>
		<?php  } ?>
		<?php  if(!empty($mcFields['revenue'])) { ?>
		<div class="mui-input-row">
			<label><?php  echo $mcFields['revenue']['title'];?></label>
			<?php  echo tpl_app_fans_form('revenue', $profile['revenue'], $mcFields['revenue']['title']);?>
		</div>
		<?php  } ?>
	</div>
<?php  } ?>
	<div class="mui-content-padded">
		<button class="mui-btn mui-btn-success mui-btn-block" type="submit" name="submit" value="提交">保存</button>
		<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
	</div>
</div>
</form>
<?php  if($do == 'address' && empty($_GPC['addid'])) { ?>
<div class="mui-content mc-address-list" style="padding-left: 12px;padding-right: 12px;">
	<ul class="mui-table-view"  style="border-radius: 11px;">
		<?php  if(empty($addresses)) { ?>
		<li class="mui-table-view-cell mui-text-center">
			暂无收货地址,请点击新增收货地址.
		</li>
		<?php  } ?>
		<?php  if(is_array($addresses)) { foreach($addresses as $address) { ?>
		<li class="mui-table-view-cell mui-table-view-chevron"  style="border-radius: 11px;">
			<div class="mui-slider-right mui-disabled">
				<?php  if(!$address['isdefault']) { ?>
				<a class="mui-btn mui-btn-yellow" href="<?php  echo url('mc/profile/address', array('op' => 'default', 'id' => $address['id'], address => $address['province'].$address['city'].$address['district'].$address['address']))?>">设为默认</a>
				<?php  } ?>
				<a class="mui-btn mui-btn-red" href="<?php  echo url('mc/profile/address', array('op' => 'delete', 'id' => $address['id']))?>">删除</a>
			</div>
			<a data-href="<?php  echo url('mc/profile/addressadd', array('addid' => $address['id']));?>" class="mui-slider-handle mui-navigate-right js-slider-handle">
				<div class="address_box">
					<div class="mui-ellipsis mui-mt10 mui-mb5" style="color: #333;"><?php  echo $address['province'];?> <?php  echo $address['city'];?> <?php  echo $address['district'];?> <?php  echo $address['address'];?></div>
					<?php  echo $address['mobile'];?><span class="tel mui-ml15"><?php  echo $address['username'];?></span>
					<?php  if($address['isdefault'] > 0) { ?>
					<span class="default-marker">默认</span>
					<?php  } ?>
					<span class="edit">編輯</span>
				</div>
			</a>
		</li>
		<?php  } } ?>
	</ul>

	<div style="margin-top: 100px;width: 100%;">
		<a href="<?php  echo url('mc/profile/addressadd', array('uid' => $address['openid']));?>" class="mui-text-center" style="background: #2BA3DC;border-radius: 8px;color: #fff;width: 100%;display: block;height: 44px;line-height: 44px;">
			<span class="fa fa-plus-circle mui-mr10"></span>添加地址
		</a>
	</div>
</div>
<script type="text/javascript">
<?php  if(($_W['account']['level'] == ACCOUNT_SUBSCRIPTION_VERIFY || $_W['account']['level'] == ACCOUNT_SERVICE_VERIFY) && empty($address)) { ?>
wx.ready(function () {
	wx.openAddress({
		success:function(result){
			username = result.userName;
			mobile = result.telNumber;
			zipcode = result.postalCode;
			province = result.provinceName;
			city = result.cityName;
			district = result.countryName;
			address = result.detailInfo;
			address_data = {'username':username, 'mobile':mobile, 'zipcode':zipcode, 'province':province, 'city':city,  'district':district, 'address': address};
			$.post('<?php  echo url("mc/profile/addressadd")?>', {address : address_data}, function(data) {
				data = $.parseJSON(data);
				if (data.type == 'success') {
					alert(data.message)
				};
				location.reload();
			});
		}
	});
});
<?php  } ?>
	$(document).on('tap', '.js-slider-handle', function(event){
		var href = $(this).data('href');
		var has = $(this).prev().hasClass('mui-selected');
		if (has) {
			$(this).prev().removeClass('mui-selected');
			$(this).parent().removeClass('mui-selected');
			$(this).removeAttr('style');
		} else {
			location.href = href;
		}
	});
</script>
<?php  } ?>
<?php  if($do == 'addressadd') { ?>
<form class="tab-content clearfix js-ajax-form <?php  if($_W['container'] !== 'wechat') { ?>profile-form<?php  } ?>" action="<?php  echo url('mc/profile/addressadd');?>" method="post" enctype="multipart/form-data" id="addressform">
<div class="mui-content">
	<div class="mui-content-padded mui-text-muted">请您填写收货地址</div>
	<div class="mui-input-group mui-mt15">
		<div class="mui-input-row">
			<label>聯繫人</label>
			<input type="text" value="<?php  echo $address['username'];?>" name="address[username]" placeholder="姓名"/>
		</div>
		<div class="mui-input-row">
			<label>電話</label>
			<input type="text" value="<?php  echo $address['mobile'];?>" name="address[mobile]" placeholder="手機號碼"/>
		</div>
		<!-- <div class="mui-input-row">
			<label>邮政编码</label>
			<input type="text" name="address[zipcode]" value="<?php  echo $address['zipcode'];?>" placeholder="邮政编码"/>
		</div> -->
		<div class="mui-input-row">
			<label>选择地区</label>
			<?php  echo tpl_app_form_field_district('address',array('province' => $address['province'],'city' => $address['city'],'district' => $address['district']));?>
		</div>
		<div class="mui-input-row">
			<label>详细地址</label>
			<input type="text" name="address[address]" class="form-control" value="<?php  echo $address['address'];?>" placeholder="详细地址"/>
		</div>
	</div>
	<div class="mui-content-padded">
		<button class="mui-btn mui-btn-success mui-btn-block" type="submit" value="提交" name="submit" style="background: #2BA3DC;border: 1px solid #2BA3DC;">保存</button>
		<input type="hidden" name="addid" value="<?php  echo $address['id'];?>">
		<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
	</div>
</div>
</form>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>