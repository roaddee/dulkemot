<?php
/*
 * Apbd_model.php
 * 
 * Copyright 2017 Isnu Suntoro <isnusun@gmail.com>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Apbd_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	
	function _apbd_tahun_by_lembaga($varID = 0){
		$hasil = false;
		if($varID > 0){
			$strSQL = "SELECT tahun FROM tweb_apbd WHERE lembaga_id='".$varID."' GROUP BY tahun ORDER BY tahun DESC";
			$query = $this->db->query($strSQL);
			foreach($query->result_array() as $rs){
				$hasil[]  = $rs['tahun'];
			}
		}
		return $hasil;
	}
	
	function apbd_lembaga_home($varID=0,$varThn){
		
		$strSQL = "
		SELECT akuntansi,uraian 
		FROM tweb_apbd WHERE ((akuntansi > 0) AND (lembaga_id='".$varID."') AND (LENGTH(akuntansi) = 4)) 
		GROUP BY akuntansi 
		ORDER BY akuntansi";
		$data = array();
		$query = $this->db->query($strSQL);
		foreach($query->result_array() as $rs){
			$data[]  = $rs;
		}

		$akuntansi = array();
		foreach($varThn as $tahun){

			$strSQL = "SELECT nominal,akuntansi FROM tweb_apbd WHERE ((tahun='".$tahun."') AND (lembaga_id='".$varID."') AND (LENGTH(akuntansi) = 4))";
			$query = $this->db->query($strSQL);
			
			if($query){
				if($query->num_rows() > 0){
					foreach($query->result_array() as $rs){
						$akuntansi[$tahun][$rs['akuntansi']] = $rs['nominal'];
					}
				}
			}
		}
		$hasil = array('data'=>$data,'akun'=>$akuntansi);
		return $hasil;
	}
	
	function apbd_lembaga_by_rek($varID=0,$varKodeRek=0,$varThn=0){
		/* 
		 * $varID = LembagaID
		 * $varKodeRek = Kode Rekening 
		 * $varThn = Tahun tertentu
		 * */
		$hasil = false;
		$strL = (strlen($varKodeRek)==1) ? strlen($varKodeRek) + 1 : strlen($varKodeRek) + 4 ;
		$strSQL = "
		SELECT akuntansi,uraian 
		FROM tweb_apbd WHERE ((akuntansi > 0) AND (lembaga_id='".$varID."') AND (akuntansi LIKE '".$varKodeRek."%') AND (LENGTH(akuntansi) = '".$strL."')) 
		GROUP BY akuntansi 
		ORDER BY akuntansi";
		$data = array();
		$query = $this->db->query($strSQL);
		foreach($query->result_array() as $rs){
			$data[]  = $rs;
		}
		
		
		if($varKodeRek > 0){
			if($varThn == 0){
				/*
				$strSQL = "SELECT tahun,nominal_sebelum, nominal_sesudah, nominal_perubahan, nominal_persen 
				FROM tweb_apbd WHERE akuntansi='".fixSQL($varKodeRek)."' AND lembaga_id=".$varID." GROUP BY tahun";
				$row = array();
				$query = $this->db->query($strSQL);
				if($query){
					if($query->num_rows() > 0){
						$row = $query->result_array();
					}
				}
				*/ 
				$akuntansi = array();
				foreach($varThn as $tahun){

					$strSQL = "SELECT nominal,akuntansi 
					FROM tweb_apbd 
					WHERE ((tahun='".$tahun."') AND (lembaga_id='".$varID."') AND (LENGTH(akuntansi) = '".$strL."'))";
					$query = $this->db->query($strSQL);
					
					if($query){
						if($query->num_rows() > 0){
							foreach($query->result_array() as $rs){
								$akuntansi[$tahun][$rs['akuntansi']] = $rs['nominal'];
							}
						}
					}
				}				
				
			}else{
				$akuntansi = array();
				foreach($varThn as $tahun){

					$strSQL = "SELECT nominal,akuntansi 
					FROM tweb_apbd 
					WHERE ((tahun='".$tahun."') AND (lembaga_id='".$varID."') AND (akuntansi LIKE '".$varKodeRek."%') AND (LENGTH(akuntansi) = '".$strL."'))";
					$query = $this->db->query($strSQL);
					
					if($query){
						if($query->num_rows() > 0){
							foreach($query->result_array() as $rs){
								$akuntansi[$tahun][$rs['akuntansi']] = $rs['nominal'];
							}
						}
					}
				}				
				
			}
			$hasil = array('data'=>$data,'akun'=>$akuntansi);
		}
		return $hasil;
	}
	
	function apbd_load($varID=0,$varTahun=0){
		$hasil =false;
		$berkas = array();
		$data = array();
		$tags = array();
		$strSQL = "
			SELECT a.berkas_id,
				b.nasli,b.created_at,b.uploaded_from, 
				c.nama as unama
			FROM tweb_apbd a
				LEFT JOIN tweb_berkas b ON a.berkas_id=b.id 
				LEFT JOIN tweb_users c ON c.id=b.created_by 
			WHERE a.lembaga_id=".$varID." AND a.tahun='".$varTahun."'
			GROUP BY a.berkas_id ORDER BY a.berkas_id";
		$query = $this->db->query($strSQL);
		foreach($query->result_array() as $rs){
			$berkas[$rs['berkas_id']]  = $rs;
		}
		
		$strSQL1 = "
			SELECT at.id,at.tag_id,at.rekening,t.parma,t.nama 
			FROM tweb_apbd_tags at 
				LEFT JOIN tweb_tags t ON at.tag_id=t.id
			WHERE at.lembaga_id='".$varID."' AND at.tahun='".$varTahun."'";
		$query = $this->db->query($strSQL1);
		foreach($query->result_array() as $rs){
			$tags[$rs['rekening']]  = $rs;
		}
		
		$strSQL2 = "SELECT * FROM tweb_apbd WHERE lembaga_id=".$varID." AND tahun='".$varTahun."'";
		$query = $this->db->query($strSQL2);
		foreach($query->result_array() as $rs){
			$data[$rs['id']]  = $rs;
		}
//		$hasil = array('berkas'=>$strSQL,'data'=>$strSQL1,'tags'=>$strSQL2);
		$hasil = array('berkas'=>$berkas,'data'=>$data,'tags'=>$tags);
		return $hasil;
	}
	
	function apbd_by_rekening($varID=0,$varThn=0,$varRek=''){
		$hasil = false;
		$data = array();
		
		if($varID > 0){
			if($varRek){
				
				$strL = (strlen($varRek)==1) ? strlen($varRek) + 1 : strlen($varRek) + 4 ;

				$strSQL = "SELECT id,akuntansi,uraian,nominal,rekening_kode 
					FROM tweb_apbd 
					WHERE ((tahun='".$varThn."') AND (lembaga_id='".$varID."') AND (akuntansi LIKE '".fixSQL($varRek)."%') AND (LENGTH(akuntansi) = '".$strL."'))";

				$query = $this->db->query($strSQL);
				
				if($query){
					if($query->num_rows() > 0){
						foreach($query->result_array() as $rs){
							$data[$rs['akuntansi']] = array(
								'id'=>$rs['id'], 
								'nominal'=>$rs['nominal'],
								'uraian'=>$rs['uraian'],
								'akuntansi'=>$rs['akuntansi'],
								'rekening_kode'=>$rs['rekening_kode'],
								);
						}
					}
				}

				$hasil = $data;
								
			}else{

				$strSQL = "SELECT id,akuntansi,uraian,nominal,rekening_kode FROM tweb_apbd WHERE ((tahun='".$varThn."') AND (lembaga_id='".$varID."') AND (LENGTH(akuntansi) = 4))";
				$query = $this->db->query($strSQL);
				
				if($query){
					if($query->num_rows() > 0){
						foreach($query->result_array() as $rs){
							$data[$rs['akuntansi']] = array(
								'id'=>$rs['id'], 
								'nominal'=>$rs['nominal'],
								'uraian'=>$rs['uraian'],
								'akuntansi'=>$rs['akuntansi'],
								'rekening_kode'=>$rs['rekening_kode'],
								);
						}
					}
				}

				$hasil = $data;
								
			}
		}
		return $hasil;
	}
	
	function  apbd_swicth_stat($apa,$todo,$kode,$orgID,$thn){
		$hasil = false;
		$todo = ($todo == 'add') ? 1:0;
		if($apa == 'pro'){
			$strSQL = "UPDATE tweb_apbd 
				SET nangkis_pro='".$todo."' 
				WHERE 
					lembaga_id='".$orgID."' AND 
					tahun='".$thn."' AND 
					kode_program='".$kode."' 
					";
			if($this->db->query($strSQL)){
				$hasil = array($todo,$strSQL);
			}
		}elseif($apa == 'kg'){
			$strSQL = "UPDATE tweb_apbd 
				SET nangkis_giat='".$todo."' 
				WHERE 
					lembaga_id='".$orgID."' AND 
					tahun='".$thn."' AND 
					kode_program='".$kode."' 
					";
			if($this->db->query($strSQL)){
				$hasil = array($todo,$strSQL);
			}
		}
		return $hasil;
	}
	
	function tags_load($varID =0,$varOpts=false){
		$hasil = false;
		if($varID > 0){
			$strSQL = "SELECT * FROM tweb_tags WHERE id=".$varID;
			$query = $this->db->query($strSQL);
			if($query->num_rows() > 0){
				$hasil = $query->result_array()[0];
			}
		}else{
			$strSQL = "SELECT * FROM tweb_tags WHERE 1";
			$query = $this->db->query($strSQL);
			if($query->num_rows() > 0){
				$hasil = array();
				foreach($query->result_array() as $rs){
					if($varOpts){
						$hasil[$rs['id']] = $rs['nama'];
					}else{
						$hasil[$rs['id']] = $rs;
					}
				}
			}
		}
		return $hasil;
	}
	
	function simpan_tags($varNama='',$varNdesc){
		$user = $this->session->userdata;
		$hasil =false;
		if(strlen($varNama) > 0){
			$parma = fixNamaUrl(fixSQL($varNama));
			$strSQL = "SELECT id FROM tweb_tags WHERE nama='".$parma."'";
			$query = $this->db->query($strSQL);
			if($query->num_rows() > 0){
				$strMsg = "Tags <strong>".$varNama."</strong> sudah terdaftar";
			}else{
				$strSQL = "INSERT INTO tweb_tags (nama,parma,ndesc,created_by) 
					VALUES('".fixSQL($varNama)."','".fixSQL($parma)."','".fixSQL($varNdesc)."','".$user['id']."')";
				$query = $this->db->query($strSQL);
				if($query){
					$strMsg = "Tags <strong>".$varNama."</strong> berhasil disimpan";
				}
			}
			$hasil = array('stat'=>'success','msg'=>$strMsg);
		}
		return $hasil;
	}
	
	function apbd_by_tags($varID = 0){
		$hasil = false;
		if($varID > 0){
			$strSQL = "
				SELECT a.*,ap.rekening_kode,ap.uraian,ap.nominal,ap.tahun,l.nama as lembaga_nama,
					w.nama as wnama 
				FROM tweb_apbd_tags a 
					LEFT JOIN tweb_lembaga l ON a.lembaga_id=l.id 
					LEFT JOIN tweb_apbd ap ON a.apbd_id=ap.id 
					LEFT JOIN tweb_wilayah w ON w.kode=l.kodewilayah 
				WHERE a.tag_id='".$varID."' 
				ORDER BY a.lembaga_id,a.tahun";
			$query = $this->db->query($strSQL);
			if($query->num_rows() > 0){
				$hasil = array();
				foreach($query->result_array() as $rs){
					$hasil[$rs['id']] = $rs;
				}
			}

		}
		
		return $hasil;
	}
	
	function apbd_tags($varID,$varThn){
		$hasil = false;
		$strSQL = "SELECT * FROM tweb_apbd_tags WHERE lembaga_id='".$varID."' AND tahun='".$varThn."'";
		$query = $this->db->query($strSQL);
		if($query->num_rows() > 0){
			$hasil = array();
			foreach($query->result_array() as $rs){
				$hasil[$rs['apbd_id']][$rs['tag_id']] = $rs;
			}
		}else{
			$hasil[0][0] = 0;
		}
		return $hasil;
	}
	
	function apbd_tags_by_area($varKode){
		
		$tagnya = array();
		$apbd  = array();
		
		$strSQL = "SELECT 
		t.tag_id,
		tg.nama  as tag_nama 
		FROM tweb_apbd_tags t
			LEFT JOIN tweb_tags tg ON t.tag_id=tg.id 
		GROUP BY t.tag_id";
		$query = $this->db->query($strSQL);
		if($query->num_rows() > 0){
			foreach($query->result_array() as $rs){
				$tagnya[$rs['tag_id']] = $rs['tag_nama'];
			}
		}
				
		$strSQL = "
		SELECT t.id,t.apbd_id,t.tag_id,t.lembaga_id,
			a.rekening_kode,a.uraian,a.nominal,a.tahun,
			l.nama as lnama 
		FROM tweb_apbd_tags t 
			LEFT JOIN tweb_apbd a ON t.apbd_id=a.id 
			LEFT JOIN tweb_lembaga l ON t.lembaga_id=l.id 
		WHERE  t.kode_wilayah='".$varKode."'
		";
		
		$query = $this->db->query($strSQL);
		if($query->num_rows() > 0){
			foreach($query->result_array() as $rs){
				$apbd[$rs['id']] = $rs;
			}
		}
		
		$hasil = array('tags'=>$tagnya,'apbd'=>$apbd);
		return $hasil;
	}
	
	function nama_rekening($varRek = 0,$varLembaga=0){
		$hasil = false;
		if($varRek > 0){
			$strSQL = "SELECT uraian FROM tweb_apbd WHERE ((lembaga_id='".$varLembaga."') AND (akuntansi ='".fixSQL($varRek)."'))";
			$query = $this->db->query($strSQL);
			if($query->num_rows() > 0){
				$rs = $query->result_array()[0];
				$hasil = $rs['uraian'];
			}
		}else{
			$hasil = "";
		}
		return $hasil;
	}
	
	function program_list_by_lembaga($varID=0){
		
		$hasil =false;
		
		$strSQL = "
			SELECT id 
				FROM tweb_apbd 
			WHERE ((kode_program > 0) AND (lembaga_id='".$varID."')) 
			GROUP BY kode_program ORDER BY kode_program
			";

		$strSQL = "
			SELECT rekening_kode,kode_program,uraian,tahun,nominal,akuntansi  
				FROM tweb_apbd 
			WHERE ((kode_program > 0) AND (lembaga_id='".$varID."') AND (akuntansi='')) 
			
			";
			// GROUP BY kode_program ORDER BY kode_program
		$query = $this->db->query($strSQL);
		if($query){
			if($query->num_rows() > 0){
				$hasil = array();
				foreach($query->result_array() as $rs){
					$hasil[$rs['tahun']][] = $rs;
				}
			}
		}else{
			$hasil = "Opo iki";
		}
			
		return $hasil;
			
	}
	
}
