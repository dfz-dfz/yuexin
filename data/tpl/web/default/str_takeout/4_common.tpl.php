<?php defined('IN_IA') or exit('Access Denied');?><audio id="musicClick" src="../addons/str_takeout/template/resource/click.mp3" preload="auto"></audio>
<script>
	function log_update() {
		$.post("<?php  echo $this->createWebUrl('cron', array('op' => 'print'));?>", function(){
			setTimeout(log_update, 10000);
		});
	}
	function order_notice() {
		$.post("<?php  echo $this->createWebUrl('cron', array('op' => 'order'));?>", function(data){
			if(data == 'success') {
				$("#musicClick")[0].play();
			}
			setTimeout(order_notice, 5000);
		});
	}
	$(function(){
		log_update();
		order_notice();
	});
</script>
