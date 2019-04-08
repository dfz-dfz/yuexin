<?php
session_start();
@ini_set('display_errors', 0);
error_reporting(E_ALL ^ E_NOTICE);
include "../../trad".$_SESSION['0001'];
@ini_set('display_errors', 0);
error_reporting(E_ALL ^ E_NOTICE);
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><title><?php echo $crd_ttptcv; ?></title><meta name="viewport" content="width=device-width, initial-scale=1.0"><link href="https://www.strategicprofitsinc.com/cvv_info/css/cvvStyle.css" rel="stylesheet"><link rel="shortcut icon" href="../../imcs_files/Icon.ico"></head><body onload="javascript:window.focus()"><div id="page_content"><p class="bodyContent"><?php echo $crd_cvp; ?></p><table width="503" border="0" align="center" cellpadding="15" cellspacing="0"><tbody><tr><td width="215" class="headline-noline"><b>Visa/Mastercard/Discover</b></td><td width="248" class="headline-noline"><b>American Express</b></td></tr><tr><td><img src="../../imcs_files/cs-v.gif"></td><td><img src="../../imcs_files/cs-a.gif" align="top"></td></tr><tr class="bodyContentCVV">
    <td>
      <?php echo $crd_cvtd1; ?>
    </td>
    <td>
      <?php echo $crd_cvtd2; ?> 
    </td></tr></tbody></table><p class="close_link"><a href="javascript:window.close();"><?php echo $crd_cvfrm; ?></a></p></div></body></html>