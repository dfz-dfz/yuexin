<?php defined('IN_IA') or exit('Access Denied');?><?php  if($_W['is_manager'] == 1) { ?>
<div class="page_fixed" style="font-size:30px;z-index:10000;bottom:100px;left:10px">
	<a style="color:#FFF;" href="<?php  echo $this->createMobileUrl('manage', array('sid' => $_GPC['sid']))?>"><i class="fa fa-cog" style="position:absolute;top:10px;right:14px;"></i></a>
</div>
<?php  } ?>
<?php  $footer_off = ''; $_W['page']['footer'] = '<a href="'.$store['copyright']['url'].'">'.$store['copyright']['name'].'</a>';?>
