<?php  

include("../common/app.init.php");
include("../common/app.common_function.php");
include("../common/app.common_var.php");

		$strCari = @$_REQUEST["q"];
	if($id > 0)	{
		if(strlen($strCari) >= 3){
			$strSQL = "
			SELECT r.* 
			FROM tweb_apbd r 
			WHERE (r.lembaga_id=".$id.") AND ((r.uraian LIKE '%".$strCari."%') OR (r.rekening LIKE '%".$strCari."%')) ORDER BY LENGTH(r.rekening),r.uraian LIMIT 20";
			$data = array();
			if($db->Query($strSQL)){
				if($db->RowCount()>0){
					$db->MoveFirst();
					while (!$db->EndOfSeek())
					{
						$row = $db->RowArray();
						
						$keterangan = ($row["rangkuman"] ==1 )? "[AGREGASI]":"";
						$data[] = array(
							"id"=>$row["rekening"],
							"rekening"=>$row["rekening"],
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
