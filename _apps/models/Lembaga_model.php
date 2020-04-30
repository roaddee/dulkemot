<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lembaga_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	
	function cari_lembaga($varString=''){
		$hasil =false;
		$tingkatan = _tingkat_wilayah();
		
		$strSQL = "SELECT l.id,l.kode_org,l.nama,l.kodewilayah, 
			w.nama as wnama,w.tingkat as tingkat 
			FROM tweb_lembaga l 
				LEFT JOIN tweb_wilayah w ON l.kodewilayah=w.kode
			WHERE l.nama LIKE '%".$varString."%' ORDER BY l.nama LIMIT 25";
		$query = $this->db->query($strSQL);
		if($query){
			foreach ($query->result() as $rs){
				$hasil[] = array(
						"id"=>$rs->id,
						"nama"=>$rs->nama ." - ".$tingkatan[$rs->tingkat]." ".$rs->wnama,
						"wnama"=>$rs->wnama,
						"kode"=>$rs->kode_org
						);
			}
		}
		return $hasil;
		
	}
	
	function lembaga_load($varID = 0){
		$hasil =false;
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
						$logo = base_url('assets/uploads/').str_replace(".","-m.",$rs->foto."jpg");
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
			}else{
				$hasil = $strSQL;
			}

		}else{
			/*
			 * List semua pengguna kecuali admin
			 * 
			 * */
			$strSQL = "
			SELECT u.*, 
				(SELECT COUNT(id) as n FROM tweb_users WHERE lembaga_id=u.id) as nuser,
				w.nama as wnama   
			FROM tweb_lembaga u
				LEFT JOIN tweb_wilayah w ON u.kodewilayah=w.kode 
			WHERE 1
			";
			$hasil =array();
			$query = $this->db->query($strSQL);
			foreach ($query->result() as $rs){
				//$foto = str_replace(".","-m.",$rs->foto);
				$nama_wilayah = $tk_nama[_tingkat_by_len_kode($rs->kodewilayah)] ." ". $rs->wnama;
				
				$logo = base_url('assets/img/').$rs->kodewilayah.".jpg";
				if(strlen($rs->foto) > 0){
					$strFoto = FCPATH."assets/uploads/".$rs->foto;
					if(file_exists($strFoto)){
						$logo = base_url('assets/uploads/').str_replace(".","-m.",$rs->foto."jpg");
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
												"nuser"=>$rs->nuser,
												);
			}
		}
		return $hasil;
	}
	
	function simpan_lembaga(){
		$varID = $_POST['id'];
		$hasil = false;
		$kodewilayah = (@$_POST['kab_id']) ? $_POST['kab_id']:$_POST['pro_id'];
		$str_foto = "";
		if($_FILES){
			$str_foto = _siteman_UploadFoto();
		}
		if($varID  > 0){
			$strSQL = "UPDATE tweb_lembaga SET 
				nama = '".fixSQL($_POST['nama'])."',
				kode_org = '".fixSQL($_POST['kode_org'])."',
				email = '".fixSQL($_POST['email'])."',
				url = '".fixSQL($_POST['url'])."',
				telp = '".fixSQL($_POST['telp'])."',
				fax = '".fixSQL($_POST['fax'])."',
				alamat = '".fixSQL($_POST['alamat'])."',
				kodewilayah = '".fixSQL($kodewilayah)."',
				";
			if($str_foto !="error")	{
				$strSQL .= "foto = '".fixSQL($str_foto)."',";
			}
			$strSQL .= " ndesc = '".fixSQL($_POST['ndesc'])."' WHERE id=".$varID;
			if($this->db->query($strSQL)){
				$strMsg = "Berhasil Memutakhirkan Data <strong>".$_POST['nama']."</strong>";
				$hasil = array('id'=>$varID, 'msg'=>$strMsg.$strSQL);
			}
		}else{
			$strSQL = "SELECT id FROM tweb_lembaga WHERE kode_org='".fixSQL($_POST['nama'])."'";
			$query = $this->db->query($strSQL);
			if($query){
				if($query->num_rows() > 0){
					$strMsg = "KODE Lembaga <strong>".$_POST['nama']."</strong> telah digunakan untuk ";
					$hasil = array('id'=>0,'msg'=>$strMSg);
				}else{
					$strSQL = "INSERT INTO tweb_lembaga(kode_org,nama, email, url,telp, fax, alamat, ndesc, foto,kodewilayah) 
					VALUES('".fixSQL($_POST['kode_org'])."','".fixSQL($_POST['nama'])."','".fixSQL($_POST['email'])."','".fixSQL($_POST['url'])."',
					'".fixSQL($_POST['telp'])."','".fixSQL($_POST['fax'])."','".fixSQL($_POST['alamat'])."',
					'".fixSQL($_POST['ndesc'])."','".fixSQL($str_foto)."','".fixSQL($kodewilayah)."')";
					if($this->db->query($strSQL)){
						$varID = $this->db->insert_id();
						$strMsg = "Berhasil Memutakhirkan Data <strong>".$_POST['nama']."</strong>";
						$hasil = array('id'=>$varID, 'msg'=>$strMsg);
					}else{
						$hasil = array('id'=>$varID, 'msg'=>"Error Query");
					}

				}
			}
		}
		return $hasil;
	}
	
}
