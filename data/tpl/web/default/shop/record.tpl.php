<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<h3 class="page-title">
    消费/充值记录 <small></small>
</h3>
<style type="text/css">
    .panel-body > ul{list-style:none;margin: 0px;padding: 0px}
    .panel-body > ul li{display: inline-block}
</style>
<div class="main">
<ul class="nav nav-tabs">
		<li <?php  if($do == 'member') { ?> class="active"<?php  } ?>><a href="<?php  echo url('shop/member');?>">在线充值</a></li>
		<li <?php  if($do == 'buypackage') { ?> class="active"<?php  } ?>><a href="<?php  echo url('shop/buypackage');?>">增值业务</a></li>
		<li <?php  if($do == 'record') { ?> class="active"<?php  } ?>><a href="<?php  echo url('shop/member/record');?>">消费记录</a></li>
		<li <?php  if($do == 'chongzhi') { ?> class="active"<?php  } ?>><a href="<?php  echo url('shop/member/chongzhi');?>">充值记录</a></li>
</ul>
<div class="clearfix">
	<?php  if($do == 'chongzhi') { ?>
	<div class="panel panel-default">
		<div class="panel-body table-responsive">
			<table class="table">
				<thead>
				<tr>
					<?php  if(($_W['isfounder'])) { ?><th class="row-first">会员账号</th><?php  } ?>
					<th>货币</th>
					<th>订单号</th>
                    <th>充值金额</th>
					<th>充值时间</th>
					<th>状态</th>
				</tr>
				</thead>
				<tbody>
                            <?php  if(is_array($list)) { foreach($list as $item) { ?>
                            <tr>
								<?php  if(($_W['isfounder'])) { ?><td class="col-sm-2"><?php  if($user[$item['uid']]['username']) { ?><?php  echo $user[$item['uid']]['username'];?><?php  } else { ?>改用户已删除<?php  } ?></td><?php  } ?>
                                <td class="col-sm-2"><?php  if($item['credittype']=='credit2') { ?>余额<?php  } else { ?>积分<?php  } ?></td>
                                <td><?php  echo $item['orderid'];?></td>
                                <td class="col-sm-1"><?php  echo $item['money'];?></td>
                                <td><?php  echo date('Y-m-d H:i',$item['order_time'])?></td>
                                <td><?php  if($item['status']==1) { ?><span class="label label-success">已付款</span><?php  } else { ?><span class="label label-warning">待付款</span><?php  } ?></td>
                            </tr>
                            <?php  } } ?>
                            </tbody>
                        </table>
						<?php  echo $pager;?>
        </div>
    </div>
    <?php  } ?>
	<?php  if($do == 'record') { ?>
        <div class="panel panel-default">
                    <div class="panel-heading">余额日志</div>
                    <div class="panel-body">
                        <table class="table mytable table-striped b-t text-sm">
                            <thead>
                            <tr>
                                <th width="20px"></th>
                                <?php  if(($_W['isfounder'])) { ?><th class="col-sm-2">会员账号</th><?php  } ?>
                                <th class="col-sm-2">金额</th>
                                <th width="200px">消费原因</th>
								<th width="150px">消费公众号</th>
                                <th class="col-sm-2"><?php  if($_GPC["type"]=='credit2') { ?>充值<?php  } else { ?>消费<?php  } ?>时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php  if(is_array($list)) { foreach($list as $item) { ?>
                            <tr>
                                <td width="20px"></td>
								<?php  if(($_W['isfounder'])) { ?><td class="col-sm-2"><?php  if($user[$item['uid']]['username']) { ?><?php  echo $user[$item['uid']]['username'];?><?php  } else { ?>改用户已删除<?php  } ?></td><?php  } ?>
                                <td><?php  echo $item['num'];?></td>
                                <td class="col-sm-3"><?php  echo htmlspecialchars_decode($item['remark'])?></td>
								<td><?php  if($uni[$item['uniacid']]['name']) { ?><?php  echo $uni[$item['uniacid']]['name'];?><?php  } else { ?>该公众号已删除<?php  } ?></th>
                                <td><?php  echo date('Y-m-d H:i',$item['createtime'])?></td>
                            </tr>
                            <?php  } } ?>
                            </tbody>
                        </table>
						<?php  echo $pager;?>
                    </div>
        </div>
    <?php  } ?>

    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>