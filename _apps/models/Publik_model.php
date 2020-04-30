<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publik_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	public function laman_show($varParma = ''){
		$hasil = false;
		if($varParma <> ''){
			$strSQL = "SELECT * 
			FROM tweb_posts 
			WHERE (ID='".fixSQL($varParma)."') OR (post_name='".fixSQL($varParma)."')";
			$query = $this->db->query($strSQL);
			if($query){
				if($query->num_rows() > 0){
					$hasil=$query->result_array()[0];
				}else{
					$hasil = $strSQL;
				}
			}else{
				$hasil = $strSQL;
			}
		}else{
			
		}
		return $hasil;
	}
	
	function laman_load($varID = 0){
		$hasil = false;
		if($varID > 0){
			$strSQL = "SELECT * FROM tweb_posts WHERE ID=".$varID;
			$query = $this->db->query($strSQL);
			if($query->num_rows() > 0){
				$hasil=$query->result_array();
			}
		}
		return $hasil;
	}
	
	function post_list($varKategori='',$varPage=''){
		$varPage = ($varPage=='')? 1:$varPage;
		$offset = ($varPage - 1) * LIMIT_PENDEK;
		$hasil = false;
		$clause_kategori = "AND (p.post_categories LIKE '%".fixSQL($varKategori)."%')";
		$strSQL = "
		SELECT p.*,u.nama as unama 
		FROM tweb_posts p
			LEFT JOIN tweb_users u ON p.post_author=u.id 
		WHERE p.`post_type`='post' AND p.`post_status`='publish' 
		LIMIT ".$offset.", ".LIMIT_PENDEK;
		
		$query = $this->db->query($strSQL);
		if($query->num_rows() > 0){
			$hasil=$query->result_array();
		}
		return $hasil;
	}
	
	function post_load($varParma=''){
		$hasil = false;
		$strSQL = "SELECT p.*,u.nama as unama 
		FROM tweb_posts p
			LEFT JOIN tweb_users u ON p.post_author=u.id
		 WHERE (p.`post_type`='post') AND ((p.`post_name`='".fixSQL($varParma)."') OR (p.`ID`='".fixSQL($varParma)."')) ";
		$query = $this->db->query($strSQL);
		if($query->num_rows() > 0){
			$hasil=$query->result_array()[0];
		}else{
			$hasil = $strSQL;
		}
		return $hasil;
	}
	
	function post_categories($varID=0){
		$hasil = false;
		if($varID > 0){
			$strSQL = "SELECT * FROM tweb_posts_category WHERE `id`=".$varID;
		}else{
			$strSQL = "SELECT * FROM tweb_posts_category WHERE 1";
		}
		$query = $this->db->query($strSQL);
		if($query->num_rows() > 0){
			$query->result_array();
			foreach($query->result_array() as $rs){
				$hasil[$rs['parma']] = array("id"=>$rs['id'], "nama"=>$rs['nama'],"parma"=>$rs['parma']);
			}
		}
		return $hasil;
	}
	
	function lembaga_load($varID=0){
		$hasil = false;
		$tk_nama = _tingkat_wilayah();
		
		if($varID > 0){
			/*
			 * Muat data seroang semua pengguna kecuali admin
			 * 
			 * */
			$strSQL = "
			SELECT u.*,
				(SELECT COUNT(id) as n FROM tweb_users WHERE lembaga_id=u.id) as nuser,
				w.nama as wnama  
			FROM tweb_lembaga u
				LEFT JOIN tweb_wilayah w ON u.kodewilayah=w.kode 
			WHERE (u.id='".$varID."')
			";
			$query = $this->db->query($strSQL);
			if($query->num_rows() > 0){
				$rs = $query->result()[0];
				$nama_wilayah = $tk_nama[_tingkat_by_len_kode($rs->kodewilayah)] ." ". $rs->wnama;
				$logo = base_url('assets/img/').$rs->kodewilayah.".jpg";
				if(strlen($rs->foto) > 0){
					$strFoto = FCPATH."assets/uploads/".$rs->foto;
					if(file_exists($strFoto)){
						$logo = base_url('assets/uploads/').str_replace(".","-m.",$rs->foto);
					}
				}
				
				$hasil = array(
						"id"=>$rs->id,
						"nama"=>$rs->nama,
						"parma"=>$rs->parma,
						"ndesc"=>$rs->ndesc,
						"foto"=>$rs->foto,
						"logo"=>$logo,
						"alamat"=>$rs->alamat,
						"kodewilayah"=>$rs->kodewilayah,
						"namawilayah"=>$nama_wilayah,
						"kode_org"=>$rs->kode_org,
						"kodepos"=>$rs->kodepos,
						"url"=>$rs->url,
						"email"=>$rs->email,
						"telp"=>$rs->telp,
						"fax"=>$rs->fax,
						"nuser"=>$rs->nuser,
						);
			}

		}else{
			$strSQL = "
			SELECT u.*,
				(SELECT COUNT(id) as n FROM tweb_users WHERE lembaga_id=u.id) as nuser,
				w.nama as wnama  
			FROM tweb_lembaga u
				LEFT JOIN tweb_wilayah w ON u.kodewilayah=w.kode 
			WHERE 1
			";
			$query = $this->db->query($strSQL);
			if($query->num_rows() > 0){
				$hasil = array();
				foreach($query->result() as $rs){
					$nama_wilayah = $tk_nama[_tingkat_by_len_kode($rs->kodewilayah)] ." ". $rs->wnama;
					$logo = base_url('assets/img/').$rs->kodewilayah.".jpg";
					if(strlen($rs->foto) > 0){
						$strFoto = FCPATH."assets/uploads/".$rs->foto;
						if(file_exists($strFoto)){
							$logo = base_url('assets/uploads/').str_replace(".","-m.",$rs->foto);
						}
					}
					
					$hasil[$rs->id] = array(
							"id"=>$rs->id,
							"nama"=>$rs->nama,
							"parma"=>$rs->parma,
							"ndesc"=>$rs->ndesc,
							"foto"=>$rs->foto,
							"logo"=>$logo,
							"alamat"=>$rs->alamat,
							"kodewilayah"=>$rs->kodewilayah,
							"namawilayah"=>$nama_wilayah,
							"kode_org"=>$rs->kode_org,
							"kodepos"=>$rs->kodepos,
							"url"=>$rs->url,
							"email"=>$rs->email,
							"telp"=>$rs->telp,
							"fax"=>$rs->fax,
							"nuser"=>$rs->nuser,
							);
				}
			}else{
				$hasil = $strSQL;
			}			
		}
		return $hasil;		
	}
	
	function lembaga_list($varKode=''){
		$hasil = false;
		$rangkuman_id = 0;
		
		if($varKode <> ''){
			$tk_nama = _tingkat_wilayah();
			
			$tahun = array();
			$strSQL = "SELECT lembaga_id,tahun FROM `tweb_apbd` WHERE ((wilayah_kode='".$varKode."')) GROUP BY lembaga_id,tahun";
			$query = $this->db->query($strSQL);
			foreach ($query->result_array() as $rs){
				$tahun[$rs['lembaga_id']][] = $rs['tahun'];
			}

			$strSQL = "
			SELECT u.*, 
				w.nama as wnama   
			FROM tweb_lembaga u
				LEFT JOIN tweb_wilayah w ON u.kodewilayah=w.kode 
			WHERE ((u.kodewilayah='".$varKode."')) ORDER BY u.nama
			";
			$org = array();
			$query = $this->db->query($strSQL);
			foreach ($query->result() as $rs){
				
				$nama_wilayah = $tk_nama[_tingkat_by_len_kode($rs->kodewilayah)] ." ". $rs->wnama;
				
				$logo = base_url('assets/img/').$rs->kodewilayah.".jpg";
				if(strlen($rs->foto) > 0){
					$strFoto = FCPATH."assets/uploads/".$rs->foto;
					if(file_exists($strFoto)){
						$logo = base_url('assets/uploads/').str_replace(".","-m.",$rs->foto);
					}
				}
				$apbd = (array_key_exists($rs->id,$tahun)) ? $tahun[$rs->id]:false;

				if($rs->kode_org != 0){
					$org[$rs->id] = array(
												"id"=>$rs->id,
												"nama"=>$rs->nama,
												"parma"=>$rs->parma,
												"ndesc"=>$rs->ndesc,
												"foto"=>$rs->foto,
												"logo"=>$logo,
												"alamat"=>$rs->alamat,
												"kodewilayah"=>$rs->kodewilayah,
												"namawilayah"=>$nama_wilayah,
												"kode_org"=>$rs->kode_org,
												"kodepos"=>$rs->kodepos,
												"url"=>$rs->url,
												"email"=>$rs->email,
												"apbd"=>$apbd,
												);
				}else{
					$rangkuman_id = $rs->id;
				}
				
			}
			$hasil = array('org'=>$org,'id'=>$rangkuman_id);
		}
		return $hasil;
	}
	
	function program_nangkis_by_wilayah($varKode,$limit=5){
		$hasil = false;
		
		$strSQL = "
		SELECT a.kode_program,a.uraian,a.tahun,a.lembaga_id,l.nama as lembaga  
		FROM `tweb_apbd` a 
			LEFT JOIN tweb_lembaga l ON a.lembaga_id=l.id
		WHERE (
			(a.nangkis_pro=1) AND 
			(a.wilayah_kode='".$varKode."') 
			)
		GROUP BY a.kode_program 
		ORDER BY LENGTH(a.kode_program) LIMIT ".$limit;
		
		$query = $this->db->query($strSQL);
		if($query){
			$hasil = array();
			foreach ($query->result() as $rs){
				$hasil[$rs->kode_program] = array(
					'program'=>$rs->kode_program,
					'nama'=>$rs->uraian,
					'tahun'=>$rs->tahun,
					'lembaga_id'=>$rs->lembaga_id,
					'lembaga'=>$rs->lembaga,
				);
			}
		}
		
		return $hasil;
	}
	
	function kegiatan_nangkis_by_wilayah($varKode,$limit=5){
		$hasil = false;
		
		$strSQL = "
		SELECT a.kode_kegiatan,a.uraian,a.tahun,a.lembaga_id,l.nama as lembaga  
		FROM `tweb_apbd` a 
			LEFT JOIN tweb_lembaga l ON a.lembaga_id=l.id
		WHERE (
			(a.nangkis_giat=1) AND 
			(a.wilayah_kode='".$varKode."') 
			)
		GROUP BY a.kode_kegiatan 
		ORDER BY LENGTH(a.kode_kegiatan) LIMIT ".$limit;
		
		$query = $this->db->query($strSQL);
		if($query){
			$hasil = array();
			foreach ($query->result() as $rs){
				$hasil[$rs->kode_kegiatan] = array(
					'program'=>$rs->kode_kegiatan,
					'nama'=>$rs->uraian,
					'tahun'=>$rs->tahun,
					'lembaga_id'=>$rs->lembaga_id,
					'lembaga'=>$rs->lembaga,
				);
			}
		}
		
		return $hasil;
	}
	
	function post_by_wilayah($varKode){
		$hasil =false;

		$strSQL = "
		SELECT p.* 
		FROM tweb_posts_lembaga pl 
			LEFT JOIN tweb_lembaga l ON pl.lembaga_id=pl.post_id
			LEFT JOIN tweb_posts p ON pl.post_id=p.id 
		WHERE l.kodewilayah='".$varKode."'";

		$query = $this->db->query($strSQL);

		if($query){
			$hasil = array();
			foreach ($query->result() as $rs){
				$hasil[$rs->id] = $rs["post_title"] ." - ".$rs["post_author"];
			}
		}

		return $hasil;
	}
	
	function program_nangkis_by_org($varKode){
		$hasil = false;
		$strSQL = "SELECT 
		FROM ";
		return $strSQL;
	}
	
	function kegiatan_nangkis_by_org($varKode){
		$hasil = false;
		$strSQL = "SELECT 
		FROM ";
		return $strSQL;
	}
	
	function post_by_org($varKode){
		return $varKode;
	}
	
	
	
}
