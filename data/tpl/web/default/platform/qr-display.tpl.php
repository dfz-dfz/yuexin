<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
	<div class="we7-page-title">二维码管理</div>
	<ul class="we7-page-tab">
		<li><a href="<?php  echo url('platform/qr/list');?>">二维码列表</a></li>
		<li class="active"><a href="<?php  echo url('platform/qr/display');?>">二维码扫描统计</a></li>
	</ul>
	<div class="we7-padding-bottom clearfix">
		<form action="./index.php" method="get" role="form">
			<input type="hidden" name="c" value="platform">
			<input type="hidden" name="a" value="qr">
			<input type="hidden" name="do" value="display">
			<div class="we7-form form-inline">
				<div class="pull-left we7-margin-right">
					<label class="control-label col-sm-3">时间范围</label>
					<div class="form-controls col-sm-8">
						<?php  echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d', $starttime),'endtime'=>date('Y-m-d', $endtime)));?>
					</div>
				</div>
				<div class="pull-left">
					<label class="control-label col-sm-3">二维码名称</label>
					<div class="form-controls col-sm-8">
						<div class="input-group">
							<input type="text" name="keyword" value="<?php  echo $_GPC['keyword'];?>" style="width:300px" class="form-control" placeholder="请输入场景名称">
							<span class="input-group-btn"><button class="btn btn-default"><i class="fa fa-search"></i></button></span>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="panel we7-panel" id="qr-scan-statistics" ng-controller="QrStatistics">
		<div class="panel-heading">
			详细数据&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-muted" style="color:red;">扫描次数：<?php  echo $count;?></span>
			<div class="pull-right" ><span style="vertical-align: 8px;">开启后只记录首次扫描次数：</span><a class="switch <?php  if($status) { ?> switchOn <?php  } ?>" style="display: inline-block;"  ng-click="changeStatus()"></a></div>
		</div>
	</div>
	<table class="table we7-table table-hover">
		<col/>
		<col width="210px"/>
		<col width="110px"/>
		<col width="180px"/>
		<tr>
			<th>二维码名称</th>
			<th>场景名称</th>
			<th>粉丝</th>
			<th>关注/扫描</th>
			<th>扫描时间</th>
		</tr>
		
		<?php  if(is_array($list)) { foreach($list as $row) { ?>
		<tr>
			<td class="font-defalut"><?php  echo $row['name'];?></td>
			<td class="font-defalut"><?php echo $row['qrcid'] == '0' ? $row['scene_str'] : '无' ?></td>
			<td class="font-defalut">
				<a href="#" title="<?php  echo $row['openid'];?>">
					<?php  if($nickname[$row['openid']]['nickname']) { ?>
						<?php  echo $nickname[$row['openid']]['nickname'];?>
					<?php  } else { ?>
						<?php  echo cutstr($row['openid'], 15)?>
					<?php  } ?>
				</a>
			</td>
			<td class="font-defalut"><?php  if($row['type'] ==1) { ?>关注<?php  } else { ?>扫描<?php  } ?></td>
			<td class="font-sm"><?php  echo date('Y-m-d H:i:s', $row['createtime']);?></td>
		</tr>
		<?php  } } ?>
	</table>
	<div class="text-right">
		<?php  echo $pager;?>
	</div>
	<script type="text/javascript">
		angular.module('qrApp').value('config', {
			link: {
				'changeStatus' : "<?php  echo url('platform/qr/change_status')?>"
			}
		});
		angular.bootstrap($('#qr-scan-statistics'), ['qrApp']);
	</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>