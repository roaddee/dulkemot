<?php  

include("../common/app.init.php");
include("../common/app.common_function.php");
include("../common/app.common_var.php");

		$strCari = @$_REQUEST["q"];
		if(strlen($strCari) >= 3){
			$strSQL = "
			SELECT r.* 
			FROM tweb_apbd_rekening r 
			WHERE ((r.nama LIKE '%".$strCari."%') OR (r.ndesc LIKE '%".$strCari."%')) ORDER BY LENGTH(r.nama),r.nama LIMIT 20";
			$data = array();
			if($db->Query($strSQL)){
				if($db->RowCount()>0){
					$db->MoveFirst();
					while (!$db->EndOfSeek())
					{
						$row = $db->RowArray();
						
						$keterangan = ($row["rangkuman"] ==1 )? "[AGREGASI]":"";
						$data[] = array(
							"id"=>$row["nama"],
							"rekening"=>$row["nama"],
							"uraian"=>$keterangan ." ".$row["ndesc"],
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
