<?php
// GET COUNTRY & TIME
    date_default_timezone_set('GMT');
    $dt=date("d-m-Y H:i:s"); 
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $result  = "Unknown";
    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ib = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ib = $forward;
    }
    else
    {
        $ib = $remote;
    }

    $ib_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ib));

    if($ib_data && $ib_data->geoplugin_countryCode != null)
    {
        $cntc = $ib_data->geoplugin_countryCode;
    }
    
    $ib_data2 = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ib));

    if($ib_data2 && $ib_data2->geoplugin_countryName != null)
    {
        $cntn = $ib_data2->geoplugin_countryName;
    }
// GET LNG
session_start();
$_SESSION['cntn']=$cntn;         
$_SESSION['cntc']=$cntc;       
$_SESSION['cntnn']=$cntn;   

if ($cntc == "FR" || $cntc == "DZ" || $cntc == "MA" || $cntc == "TN" || $cntc == "CD" || $cntc == "MG" || $cntc == "CM" || $cntc == "CA" || $cntc == "CI" || $cntc == "BF" || $cntc == "NE" || $cntc == "SN" || $cntc == "ML" || $cntc == "RW" || $cntc == "BE" || $cntc == "GF" || $cntc == "TD" || $cntc == "HT" || $cntc == "BI" || $cntc == "BJ" || $cntc == "CH" || $cntc == "TG" || $cntc == "CF" || $cntc == "CG" || $cntc == "GA" || $cntc == "KM" || $cntc == "GK" || $cntc == "DJ" || $cntc == "LU" || $cntc == "VU" || $cntc == "SC" || $cntc == "MC") {
    $_SESSION['0001']="/frlang.php";
} elseif ($cntc == "MX" || $cntc == "PH" || $cntc == "ES" || $cntc == "CO" || $cntc == "AR" || $cntc == "PE" || $cntc == "VE" || $cntc == "CL" || $cntc == "EC" || $cntc == "GT" || $cntc == "CU" || $cntc == "HN" || $cntc == "PY" || $cntc == "SV" || $cntc == "NI" || $cntc == "CR" || $cntc == "UY") {
    $_SESSION['0001']="/eslang.php";
} elseif ($cntc == "IT" || $cntc == "SM") {
   $_SESSION['0001']="/itlang.php";
}  elseif ($cntc == "PT" || $cntc == "BR" || $cntc == "AO" || $cntc == "MZ" || $cntc == "MO") {
    $_SESSION['0001']="/ptlang.php";
} 
 elseif ($cntc == "SE") {
    $_SESSION['0001']="/selang.php";
} elseif ($cntc == "DE" || $cntc == "CH") {
    $_SESSION['0001']="/delang.php";
}
else {
   $_SESSION['0001']="/worldlang.php";
}
?>