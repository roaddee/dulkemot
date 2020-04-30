<?php  

include("../common/app.init.php");
include("../common/app.common_function.php");
include("../common/app.common_var.php");

$berkas = $_REQUEST["berkas"];

$strFile = APP_ROOT."content/berkas/".$berkas;
if(is_file($strFile)){
	
	header('Content-type: text/csv');
	header('Content-Disposition: attachment; filename='.$berkas.'');
	readfile($strFile);

}

