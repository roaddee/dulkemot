<?php  

include("../common/app.init.php");
include("../common/app.common_function.php");
include("../common/app.common_var.php");

$strCari = @$_REQUEST["q"];

$tahun = $_REQUEST['tahun'];
$wilayah = $_REQUEST['id'];
	if($id > 0)	{
		if(strlen($strCari) >= 3){
			$strSQL = "
			SELECT r.* 
			FROM tweb_apbd r 
			WHERE ((r.rangkuman=1) AND (r.tahun='".$tahun."') AND (wilayah_kode='".$wilayah."') AND ((r.uraian LIKE '%".$strCari."%') OR (r.rekening LIKE '%".$strCari."%')))  
			ORDER BY LENGTH(r.rekening) LIMIT 25";
			$data = array();
			if($db->Query($strSQL)){
				if($db->RowCount()>0){
					$db->MoveFirst();
					while (!$db->EndOfSeek())
					{
						$row = $db->RowArray();
						
						$keterangan = ($row["rangkuman"] ==1 )? "[AGREGASI]":"";
						$data[] = array(
							"id"=>$row["rekening_kode"],
							"rekening"=>$row["rekening_kode"],
							"uraian"=>$keterangan ." ".$row["uraian"],
							"agregasi"=>$row["rangkuman"],
							);
					}
					
				}
			}else{
				$data = array("kode"=>$db->Error(), "keterangan"=> $strSQL);
			}
			header('Content-Type: application/json');
			echo "{ \"total_count\": ".count($data).", \"incomplete_results\": false, \"items\":".json_encode($data)."}";
		}
	}
