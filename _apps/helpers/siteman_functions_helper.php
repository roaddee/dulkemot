<?php

function _capil_status($varStat,$varDesc,$varDt){
	$hasil = false;
	switch ($varStat)
	{
		case 1:
			$hasil = "<button type=\"button\" class=\"btn btn-success btn-xs\" data-toggle=\"popover\" data-trigger=\"hover\" title=\"Status Sync CAPIL\" data-placement=\"right\" data-content=\"".$varDesc." pada ".date("j F Y H:i",strtotime($varDt))."\"><i class=\"fa fa-check\"></i></button>";
			
			break;
		case 2:
			$hasil = "<button type=\"button\" class=\"btn btn-danger btn-xs\" data-toggle=\"popover\" data-trigger=\"hover\" title=\"Status CAPIL\" data-placement=\"right\"  data-content=\"".$varDesc." pada ".date("j F Y H:i",strtotime($varDt))."\"><i class=\"fa fa-minus\"></i></button>";
			
			break;
		default:
			$hasil = "<button type=\"button\" class=\"btn btn-default btn-xs\" data-toggle=\"popover\" data-trigger=\"hover\" title=\"Status Sync CAPIL\" data-placement=\"right\" data-content=\"".$varDesc." pada ".date("j F Y H:i",strtotime($varDt))."\"><i class=\"fa fa-minus\"></i></button>";
	}
	return $hasil;
}

function _tingkat_by_len_kode($varStr){
	$x = strlen($varStr);
	switch ($x)
	{
		case 0:
			$tk = 0;
			break;
		case 2:
			$tk = 1;
			break;
		case 4:
			$tk = 2;
			break;
		case 7:
			$tk = 3;
			break;
		case 10:
			$tk = 4;
			break;
		case 12:
			$tk = 5;
			break;
		case 14:
			$tk = 6;
			break;
		case 16:
			$tk = 7;
			break;
		default:
			$tk = 2;
	}
	
	return $tk;
}

function _tingkat_wilayah(){
	
	$data = array(
		"0"=>"Nasional",
		"1"=>"Propinsi",
		"2"=>"Kabupaten",
		"3"=>"Kecamatan",
		"4"=>"Kelurahan",
		"5"=>"Kampung",
		"6"=>"RW",
		"7"=>"RT",
	);
	
	return $data;
}

function _tingkat_pengguna(){
	$data = array(
		0=>"Administrator Sistem",
		1=>"Administrator",
		2=>"Petugas Tingkat SKPD/Dinas/Kecamatan",
		3=>"Petugas Tingkat Kelurahan",
		4=>"Petugas Tingkat Rukun Warga",
		5=>"Petugas Umum",
	);
	return $data;
}

function _status_pengguna(){
	$data = array(
		0=>"Non Aktif",
		1=>"Aktif",
		2=>"Dihapus",
	);
	return $data;
}

function _siteman_UploadBerkas(){
	$newFile = "irt_".time()."csv";
  $vdir_upload = FCPATH."assets/uploads/";
  $vfile_upload = $vdir_upload .$newFile;
  if(move_uploaded_file($_FILES["berkas"]["tmp_name"], $vfile_upload)){
		return $newFile;
	}else{
		return false;
	}
}

function _siteman_UploadFoto(){
	$filename = "error";
	$IMG_WIDTHS = array(
		"i"=>24,
		"c"=>40,
		"s"=>120,
		"t"=>300,
		"m"=>400,
		"a"=>800
	);

	$pathUL = FCPATH."assets/uploads/";
	if ($_FILES['foto']['name']) {
		if (!$_FILES['foto']['error']) {
			
			$name = md5(rand(100, 200));
			
			$tempfile =  "stm_".time();

			$file_type = $_FILES['foto']['type'];
			$file_name = $_FILES['foto']['name'];
			$file_size = $_FILES['foto']['size'];
			$file_tmp = $_FILES["foto"]["tmp_name"];
			
			if(function_exists('pathinfo')){
				$ext = pathinfo($file_name, PATHINFO_EXTENSION);
			}else{
				$ext = substr($file_name,strrpos($file_name,"."));
			}

			$filename = $tempfile .".".$ext;
			
			if($file_type == "image/pjpeg" || $file_type == "image/jpeg"||$file_type == "image/x-png" || $file_type == "image/png"||$file_type == "image/gif"){
				
				$fileBaru = $pathUL ."".$tempfile .".".$ext;
				
				if($file_type == "image/pjpeg" || $file_type == "image/jpeg"){
					$new_img = imagecreatefromjpeg($file_tmp);
				}elseif($file_type == "image/x-png" || $file_type == "image/png"){
					$new_img = imagecreatefrompng($file_tmp);
				}elseif($file_type == "image/gif"){
					$new_img = imagecreatefromgif($file_tmp);
				}
				
				list($width, $height) = getimagesize($file_tmp);
				$imgratio=$width/$height;
				
				foreach ($IMG_WIDTHS as $key=> $item){
					$ThumbWidth = $item;
					if ($imgratio>1){
						$newwidth = $ThumbWidth;
						$newheight = $ThumbWidth/$imgratio;
					}else{
						$newheight = $ThumbWidth;
						$newwidth = $ThumbWidth*$imgratio;
					}
					
					if (function_exists('imagecreatetruecolor')){
						$resized_img = imagecreatetruecolor($newwidth,$newheight);
					}else{
						die("Error: Please make sure you have GD library ver 2+");
					}
					
					$fileBaru = $pathUL."".$tempfile."-".$key.".".$ext;
					imagecopyresized($resized_img, $new_img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					ImageJpeg ($resized_img,$fileBaru);
				}
				
				$tujuan = $pathUL.$filename;
				move_uploaded_file($file_tmp, $tujuan);
			}
		}else{
			$strMsg = 'Ooops!  Your upload triggered the following error:  '.$_FILES['image']['error'];
		}
	}
  return $filename;
}

function adaptiveResizeImage($imagePath, $width, $height, $bestFit)
{
	$hasil = false;
	if(extension_loaded('imagick')) {
    $imagick = new \Imagick(realpath($imagePath));
    $imagick->adaptiveResizeImage($width, $height, $bestFit);
    header("Content-Type: image/jpg");
    $hasil= $imagick->getImageBlob();
	}
	return $hasil;
}

//cuci konten sebelum masuk db
function fixSQL($str, $encode_ent = false) {
	$str  = @trim($str);	if($encode_ent) {		$str = htmlentities($str);	}
	if(version_compare(phpversion(),'4.3.0') >= 0) {if(get_magic_quotes_gpc()) {$str = stripslashes($str);}
		if(@mysqli_ping()) {	$str = mysqli_real_escape_string($str);}	else {$str = addslashes($str);}
	}else {if(!get_magic_quotes_gpc()) {$str = addslashes($str);}}
	return $str;
}

function br2nl($string){
	return preg_replace('#<br\s*?/?>#i', "\n", $string); 
}
// meng-encode alamat surel
function encode_email($e) {
		$output = "";
    for ($i = 0; $i < strlen($e); $i++) { $output .= '&#'.ord($e[$i]).';'; }
    return $output;
}

//baca data tanpa HTML Tags
function fixTag($varString){
	$isIn = true;	$strD="";
	for($i=0;$i<=strlen($varString);$i++){
		$mch = substr($varString,$i,1);
		if((ord($mch)==9)||(ord($mch)==10)||(ord($mch)==13)){$mch=" ";}
		if($mch=="<"){$isIn=true;}
		if($mch==">"){$isIn=false;}else{if($isIn==false){$strD.= $mch;}}
	}
	return trim($strD);
}

function fixNamaUrl($varStr){
	$tmp = fixTag($varStr);
	$tmp = strtolower(str_replace(" ",".",trim($varStr)));
	$tmp = str_replace(",","-",$tmp);
	$tmp = str_replace(".","-",$tmp);
	$tmp = str_replace(" ","-",$tmp);	
	$tmp = (strlen($tmp)>64) ? substr($tmp,0,64):$tmp;
	return $tmp;
}

//cache handling
function ae_nocache(){
  header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
}

//cookie manager
function ae_put_cookie($name, $value, $days=0){
	$cookie_host = preg_replace('|^www\.(.*)$|', '.\\1', $_SERVER['HTTP_HOST']);    
	if (substr(strval($days), 0, 1) == 'f'){
		$exp = 2147483640;
	}elseif(substr(strval($days), 0, 1) == 'r')    {
		$exp = 1; $value = '';    
	}else if ($days != 0){
		$exp = time() + intval($days)*86400;
	}else{
		$exp = 0;
	}
	setcookie($name, $value, $exp, '/', $cookie_host);
}
/* anti spam dalam kontent dari public
no more alerts / no javascripts /no PHP /even no HTML! */
function is_spamming($varText){
    $re_spam = array("alert\s*\(", "<[^>]*script", "<%", "<[^>]*");
    $found = 0;
    foreach($re_spam as $re) {
      $num = preg_match("/$re/i", $varText, $matches);
      $found += $num;}
    if ($found > 0) {return true;} else {return false;}
}

function _ipaddress(){
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
	else
			$ipaddress = 'UNKNOWN';
	return $ipaddress ;
}

/*
Fungsi Nambah Waktu/Rentang

yyyy	year
q	Quarter
m	Month
y	Day of year
d	Day
w	Weekday
ww	Week of year
h	Hour
n	Minute
s	Second
*/

function DateAdd($interval, $number, $vdate) {
  $date_time_array = getdate($vdate);
  
  $hours = $date_time_array['hours'];
  $minutes = $date_time_array['minutes'];
  $seconds = $date_time_array['seconds'];
  $month = $date_time_array['mon'];
  $day = $date_time_array['mday'];
  $year = $date_time_array['year'];

  switch ($interval) {

    case 'yyyy':
      $year+=$number;break;
    case 'q':
      $year+=($number*3);break;
    case 'm':
      $month+=$number;break;
    case 'y':
    case 'd':
    case 'w':
      $day+=$number;break;
    case 'ww':
      $day+=($number*7);break;
    case 'h':
      $hours+=$number;break;
    case 'n':
      $minutes+=$number;break;
    case 's':
      $seconds+=$number;break;            
  }
  $timestamp= mktime($hours,$minutes,$seconds,$month,$day,$year);
  return $timestamp;
}
/* Hitung beda waktu*/
function DateDiff($interval,$date1,$date2) {
    // get the number of seconds between the two dates 
	$timedifference = $date2 - $date1;
  switch ($interval) {
    case 'w':
			$retval = bcdiv($timedifference,604800);break;
    case 'd':
      $retval = bcdiv($timedifference,86400);break;
    case 'h':
      $retval =bcdiv($timedifference,3600);break;
    case 'n':
      $retval = bcdiv($timedifference,60);break;
    case 's':
      $retval = $timedifference;break;
  }
  return $retval;
}
/*Format Tanggalan Indonesia*/
function indonesian_date ($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = '') {
	if (trim ($timestamp) == ''){
		$timestamp = time ();
	}elseif (!ctype_digit ($timestamp)){
		$timestamp = strtotime ($timestamp);
	}
	# remove S (st,nd,rd,th) there are no such things in indonesia :p
	$date_format = preg_replace ("/S/", "", $date_format);
	$pattern = array (
		'/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
		'/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
		'/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
		'/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
		'/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
		'/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
		'/April/','/June/','/July/','/August/','/September/','/October/',
		'/November/','/December/',
	);
	$replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
		'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
		'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
		'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
		'Oktober','November','Desember',
	);
	$date = date ($date_format, $timestamp);
	$date = preg_replace ($pattern, $replace, $date);
	$date = "{$date} {$suffix}";
	return $date;
}

function fTampilTgl($sdate,$edate) {
	if($sdate==$edate){
		$tgl =  date("j M Y",strtotime($sdate));
	}elseif($edate>$sdate){
		if(date("Y",strtotime($sdate))==date("Y",strtotime($edate))){
			if(date("M Y",strtotime($sdate))==date("M Y",strtotime($edate))){
				if(date("j M Y",strtotime($sdate))==date("j M Y",strtotime($edate))){
					if(date("j M Y H",strtotime($sdate))==date("j M Y H",strtotime($edate))){
						$tgl = date("j M Y H:i",strtotime($sdate)) ." WIB";
					}else{
						$tgl = date("j M Y H:i",strtotime($sdate)) ." - ".date("H:i",strtotime($edate))." WIB";
					}
				}else{
					$tgl = date("j",strtotime($sdate))." - ".date("j M Y",strtotime($edate));
				}
			}else{
				$tgl = date("j M",strtotime($sdate))." - ".date("j M Y",strtotime($edate));
			}
		}else{
			$tgl = date("j M Y",strtotime($sdate))." - ".date("j M Y",strtotime($edate));
		}
	}
	return $tgl;
}

function time_since($ptime){
	$etime = time() - $ptime;

	if ($etime < 1){
		return 'baru saja';
	}

	$a = array( 12 * 30 * 24 * 60 * 60  =>  'tahun',
							30 * 24 * 60 * 60       =>  'bulan',
							24 * 60 * 60            =>  'hari',
							60 * 60                 =>  'jam',
							60                      =>  'menit',
							1                       =>  'detik'
							);

	foreach ($a as $secs => $str){
		$d = $etime / $secs;
		if ($d >= 1){
			$r = round($d);
			return $r . ' ' . $str . ' lalu';
		}
	}
}

function indonesian_number($varNum){
	return number_format($varNum,0,",",".");
}


/* Fungsi bikin warna gradasi:
 * Panduan: $HexFrom = warna awal, $HexTo = warna akhir, $ColorSteps = banyaknya warna
 * output berupa : array RGB color code
 * */
function Gradient($HexFrom='cc0000', $HexTo='0000ff', $ColorSteps){ 
	$FromRGB['r'] = hexdec(substr($HexFrom, 0, 2)); 
	$FromRGB['g'] = hexdec(substr($HexFrom, 2, 2)); 
	$FromRGB['b'] = hexdec(substr($HexFrom, 4, 2)); 
	 
	$ToRGB['r'] = hexdec(substr($HexTo, 0, 2)); 
	$ToRGB['g'] = hexdec(substr($HexTo, 2, 2)); 
	$ToRGB['b'] = hexdec(substr($HexTo, 4, 2)); 
	 
	$StepRGB['r'] = ($FromRGB['r'] - $ToRGB['r']) / ($ColorSteps); 
	$StepRGB['g'] = ($FromRGB['g'] - $ToRGB['g']) / ($ColorSteps); 
	$StepRGB['b'] = ($FromRGB['b'] - $ToRGB['b']) / ($ColorSteps); 
	 
	$GradientColors = array(); 
	 
	for($i = 0; $i <= $ColorSteps; $i++){ 
		$RGB['r'] = floor($FromRGB['r'] - ($StepRGB['r'] * $i)); 
		$RGB['g'] = floor($FromRGB['g'] - ($StepRGB['g'] * $i)); 
		$RGB['b'] = floor($FromRGB['b'] - ($StepRGB['b'] * $i)); 
		 
		$HexRGB['r'] = sprintf('%02x', ($RGB['r'])); 
		$HexRGB['g'] = sprintf('%02x', ($RGB['g'])); 
		$HexRGB['b'] = sprintf('%02x', ($RGB['b'])); 
		 
		$GradientColors[] = implode(NULL, $HexRGB); 
	}
	 
	return $GradientColors; 
} 

/* Convert hexdec color string to rgb(a) string 
 * 
 * courtesy of : http://mekshq.com/how-to-convert-hexadecimal-color-code-to-rgb-or-rgba-using-php/
 * terimakasih 
 * 
 * */
 
function hex2rgba($color, $opacity = false) {
 
	$default = 'rgb(0,0,0)';
 
	//Return default if no color provided
	if(empty($color))
          return $default; 
 
	//Sanitize $color if "#" is provided 
	if ($color[0] == '#' ) {
		$color = substr( $color, 1 );
	}

	//Check if color has 6 or 3 characters and get values
	if (strlen($color) == 6) {
					$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
					$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
					return $default;
	}

	//Convert hexadec to rgb
	$rgb =  array_map('hexdec', $hex);

	//Check if opacity is set(rgba or rgb)
	if($opacity){
		if(abs($opacity) > 1)
			$opacity = 1.0;
		$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
	} else {
		$output = 'rgb('.implode(",",$rgb).')';
	}

	//Return rgb(a) color string
	return $output;
}

function extract_img($varStr){
	$tmpString = $varStr;
	$hasil = false;
	if(strlen($tmpString) > 0 ){
		if(strpos($tmpString,"<img") > 0){
			$tmpImg = array();
			$i=1;
			while (strpos($tmpString,"<img")>0){
				$p1 = strpos($tmpString,"<img")+7;
				if($p1>7){
					$p2 = strpos($tmpString,">",$p1);
					if($p2>$p1){
						$p3 = $p2-$p1;
						$imghtml = htmlentities(trim(substr($tmpString,$p1,$p3)));
						
						$t1 = strpos($imghtml,"src=&quot;")+10;
						if($t1>=10){
							$t2 = strpos($imghtml,"&quot;",$t1)-1;
							if($t2>$t1){
								$fullUrl = trim(substr($imghtml,$t1,$t2-$t1+1));
								$nberkas = trim(substr($imghtml,strrpos($imghtml,"/")+1,$t2-strrpos($imghtml,"/")));
								$tmpImg[]=array($fullUrl,$nberkas);
							}
						}
					}
					$tmpString = substr($tmpString,$p2);
				}
				$i++;
			}
			$hasil = $tmpImg;
		}	
	}
	return $hasil;
}
function get_mime_type($filename) { 
	$mimePath = APPPATH.'config/mimes.php';
	$fileext = substr(strrchr($filename, '.'), 1); 
	if (empty($fileext)) return (false); 
	$regex = "/^([\w\+\-\.\/]+)\s+(\w+\s)*($fileext\s)/i"; 
	$lines = file("$mimePath/mime.types"); 
	foreach($lines as $line) { 
		if (substr($line, 0, 1) == '#') continue; // skip comments 
		$line = rtrim($line) . " "; 
		if (!preg_match($regex, $line, $matches)) continue; // no match to the extension 
		return ($matches[1]); 
	} 
	return (false); // no match at all 
} 


/*
 * Fungsi-fungsi terkait data PBDT
 * */

function pbdt_kitas($varValue){
	$hasil = "<ul>";
	switch ($varValue)
	{
		case 1:
			$hasil .= "<li>Akta Kelahiran</li>";
			break;
		case 2:
			$hasil .= "<li>Kartu Pelajar</li>";
			break;
		case 3:
			$hasil .= "<li>Akta Kelahiran</li><li>Kartu Pelajar</li>";
			break;
		case 4:
			$hasil .= "<li>KTP</li>";
			break;
		case 5:
			$hasil .= "<li>Akta Kelahiran</li><li>KTP</li>";
			break;
		case 6:
			$hasil .= "<li>Kartu Pelajar</li><li>KTP</li>";
			break;
		case 7:
			$hasil .= "<li>Akta Kelahiran</li><li>Kartu Pelajar</li><li>KTP</li>";
			break;
		case 8:
			$hasil .= "<li>SIM</li>";
			break;
		case 9:
			$hasil .= "<li>Akta Kelahiran</li><li>SIM</li>";
			break;
		case 10:
			$hasil .= "<li>Kartu Pelajar</li><li>SIM</li>";
			break;
		case 11:
			$hasil .= "<li>Akta Kelahiran</li><li>Kartu Pelajar</li><li>SIM</li>";
			break;
		case 12:
			$hasil .= "<li>KTP</li><li>SIM</li>";
			break;
		case 13:
			$hasil .= "<li>Akta Kelahiran</li><li>KTP</li><li>SIM</li>";
			break;
		case 14:
			$hasil .= "<li>Kartu Pelajar</li><li>KTP</li><li>SIM</li>";
			break;
		case 15:
			$hasil .= "<li>Akta Kelahiran</li><li>Kartu Pelajar</li><li>KTP</li><li>SIM</li>";
			break;
		default:
			$hasil .="<li>Tidak Memiliki</li>";
	}
	$hasil .="</ul>";
	return $hasil;
}

/* cURL function */

function cURLcheckBasicFunctions() { 
  if( !function_exists("curl_init") && 
      !function_exists("curl_setopt") && 
      !function_exists("curl_exec") && 
      !function_exists("curl_close") ) return false; 
  else return true; 
} 

/* 
 * Returns string status information. 
 * Can be changed to int or bool return types. 
 */ 
 
function cURL_POST($url,$varData) { 
  if( !cURLcheckBasicFunctions() ) return "ERROR. PHP pada server anda tidak mendukung penggunaan cURL."; 
  $ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, true);
	
  if($ch){ 
		$output = curl_exec($ch);
    if( !curl_setopt($ch, CURLOPT_POSTFIELDS, $varData)) { 
      curl_close($ch); // to match curl_init() 
      return "FAIL: curl_setopt(CURLOPT_URL)"; 
    }else{
      if( !curl_exec($ch) ){
	      curl_close($ch); 
      	return "FAIL: curl_exec()"; 
      }else{
				$output = curl_exec($ch);
      	return $output;
      } 
    } 
  }else{
  	return "FAIL: curl_init()"; 
  } 
} 

