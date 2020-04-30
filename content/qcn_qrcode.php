<?php
$hawb = $_REQUEST["hawb"];
include("qrcode.php");

$qr = new qrcode();
//link

$qr->link("http://www.qcnexpress.com/track/".$hawb);
$qr->get_link();

