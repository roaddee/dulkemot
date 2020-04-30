<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siteman_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	
	function config_load(){
		$hasil =false;
		$strSQL = "SELECT id,label,nama,data FROM tweb_config ORDER BY id";
		$query = $this->db->query($strSQL);
		$config = array();
		foreach ($query->result() as $rs){
			$config[$rs->id] = array("label"=>$rs->label,"nama"=>$rs->nama,"data"=>$rs->data);
		}
		return $config;
	}

	function configs(){
		$strSQL = "SELECT nama,data FROM tweb_config ORDER BY id";
		$query = $this->db->query($strSQL);
		$config = array();
		foreach ($query->result() as $rs){
			$config[$rs->nama] = $rs->data;
		}
		return $config;
	}
	
	function config_save(){
		
	}
	
	function load_pengguna($varID = 0, $varLembaga = ''){
		
		$hasil = false;
		$varLembaga = ($varLembaga <> '') ? $varLembaga:0;
		if($varLembaga == 0){
			if($varID > 0){
				/*
				 * Muat data seroang pengguna kecuali admin
				 * 
				 * */
				$strSQL = "
				SELECT u.*,l.nama as lembaga_nama,
				w.nama as wilayah_nama ,w.tingkat as wilayah_tingkat  
				FROM tweb_users u
					LEFT JOIN tweb_lembaga l ON u.lembaga_id=l.id 
					LEFT JOIN tweb_wilayah w ON u.wilayah=w.kode 
				WHERE (u.id='".$varID."')";
				$result = $this->db->query($strSQL);
				if($result){
					if($result->num_rows() > 0){
						$hasil  = $result->result_array()[0];
					}
				}				
			}else{
				/*
				 * List semua pengguna kecuali admin
				 * 
				 * */
				$strSQL = "
				SELECT u.*,l.nama as lembaga_nama  
				FROM tweb_users u
					LEFT JOIN tweb_lembaga l ON l.id = u.lembaga_id 
				WHERE (u.id>1)
				";
				$query = $this->db->query($strSQL);
				$hasil  = $query->result_array();
				/*
				$i = 0;
				while ($i < count($data)){
					if(strlen($data[$i]["nokk"]))
					$data[$i]["url"] = site_url("data_lokal/siapa/".$data[$i]["nokk"]."/".$data[$i]["kodeWilayah"]."");
					$i++;
				}
				*/
			}
		}else{
			/*
			 * List pengguna berbasis lembaga
			 * */
			
		}
		return $hasil;
	}
	
	function pengguna_hapus($varID=0){
		$hasil = false;
		$user = $this->session->userdata;
		if($user['tingkat'] <=1){
			$strSQL = "DELETE FROM tweb_users WHERE id=".$varID;
			$result = $this->db->query($strSQL);
			if($result){
				$hasil = "Data Telah Terhapus";
			}
		}
		return $hasil;
	}
	
	function simpan_pengguna(){
		$user = $this->session->userdata;
		$varID = @$_POST['id'];
		$hasil = false;
		$str_foto = "";
		if(@$_FILES){
			$str_foto = _siteman_UploadFoto();
		}
		if($varID  > 0){
			$strSQL = "UPDATE tweb_users SET 
				nama = '".fixSQL($_POST['nama'])."',
				userid = '".fixSQL($_POST['userid'])."',";
				if($_POST['pass1']){
					$strSQL .= "passwt = '".password_hash($_POST['pass1'],PASSWORD_DEFAULT)."',";
				}
				
				$strSQL .= "tingkat = '".fixSQL($_POST['tingkat'])."',
				status = 1,
				email = '".fixSQL($_POST['email'])."',
				url = '".fixSQL($_POST['url'])."',
				nohp = '".fixSQL($_POST['nohp'])."',
				alamat = '".fixSQL($_POST['alamat'])."',
				wilayah = '".fixSQL($_POST['kode_wilayah'])."',
				ndesc = '".fixSQL($_POST['ndesc'])."',
				created_by='".$user['id']."',
				";
				
			if($str_foto != "error")	{
				$strSQL .= "foto = '".fixSQL($str_foto)."',";
			}
			$strSQL .= "lembaga_id = '".fixSQL($_POST['lembaga_id'])."' WHERE id=".$varID;

			$strMsg = "Berhasil Menyimpan Data <strong>".$_POST['nama']."</strong>";
			//$strMsg = $strSQL;

		}else{
			$strSQL = "SELECT id FROM tweb_users WHERE email='".fixSQL($_POST['email'])."' OR userid='".fixSQL($_POST['userid'])."' ";
			$result = $this->db->query($strSQL);
			if($result){
				if($result->num_rows() > 0){
					$strMsg = "Maaf, data pengguna tidak tersimpan, Email atau UserID telah digunakan utk orang lain";
				}else{
					$strSQL = "INSERT INTO tweb_users(nama, userid, passwt, tingkat,`status`, email, url,nohp, alamat, ndesc, foto,lembaga_id,wilayah,created_by) 
					VALUES('".fixSQL($_POST['nama'])."','".fixSQL($_POST['userid'])."','".password_hash($_POST['pass1'],PASSWORD_DEFAULT)."','".fixSQL($_POST['tingkat'])."',
					1,'".fixSQL($_POST['email'])."','".fixSQL($_POST['url'])."','".fixSQL($_POST['nohp'])."','".fixSQL($_POST['alamat'])."',
					'".fixSQL($_POST['ndesc'])."','".fixSQL($str_foto)."','".fixSQL($_POST['lembaga_id'])."','".fixSQL($_POST['kode_wilayah'])."','".$user['id']."')";
					$strMsg = "Berhasil Memperbaharui Data <strong>".$_POST['nama']."</strong>";
				}
			}
		}
		if($this->db->query($strSQL)){
			$varID = ($varID > 0) ? $varID: $this->db->insert_id();
			$hasil = array('id'=>$varID, 'msg'=>$strMsg);
		}else{
			//$hasil = array('id'=>$varID, 'msg'=>"Error Query = " . $varID);
			$hasil = array('id'=>$varID, 'msg'=>$strMsg);
		}
		return $hasil;
	}

	function konfirmasi_email($varStr){
		$hasil = true;
		$strSQL = "SELECT id FROM tweb_users WHERE email='".fixSQL($varStr)."'";
		$result = $this->db->query($strSQL);
		if($result){
			if($result->num_rows() >0){
				$hasil = false;
			}
		}
		return $hasil;
	}
	function konfirmasi_user($varStr){
		
	}
	
	function periksa_email($validateValue='',$validateId=''){
		/* RETURN VALUE */
		$arrayToJs = array();
		$arrayToJs[0] = $validateId;

		$strSQL = "SELECT id FROM tweb_users WHERE email='".fixSQL($validateValue)."'";
		$result = $this->db->query($strSQL);
		if($result){
			if($result->num_rows() >0){		// validate??
				for($x=0;$x<1000000;$x++){
					if($x == 990000){
						$arrayToJs[1] = false;
						$arrayToJs[2] = "Akun ini sudah digunakan";
					}
				}
			}else{
				$arrayToJs[1] = true;			// RETURN TRUE
				$arrayToJs[2] = "Akun ini bisa digunakan";
			}
		}

		return $arrayToJs;
	}

	function periksa_username($validateValue,$validateId){
		/* RETURN VALUE */
		$arrayToJs = array();
		$arrayToJs[0] = $validateId;


		$strSQL = "SELECT id FROM tweb_users WHERE userid='".fixSQL($validateValue)."'";
		$result = $this->db->query($strSQL);
		if($result){
			if($result->num_rows() >0){		// validate??
				for($x=0;$x<1000000;$x++){
					if($x == 990000){
						$arrayToJs[1] = false;
						$arrayToJs[2] = "Akun ini sudah digunakan";
					}
				}
			}else{
				$arrayToJs[1] = true;			// RETURN TRUE
				$arrayToJs[2] = "Akun ini bisa digunakan";
			}
		}
		//return $strSQL;
		return $arrayToJs;
	}
	
	
	function periksa_passlama($varStr,$varID){
		$hasil = false;
		$strSQL = "SELECT passwt FROM tweb_users WHERE id='".$varID."' AND status=1";
		$result = $this->db->query($strSQL);
		if($result){
			if($result->num_rows() > 0){
				$rs = $result->row();
				if(password_verify($varStr,$rs->passwt)){
					$hasil = true;
				}
			}
		}
		return $strSQL;
	}
	function siteman_gantipass($varStr,$varID){
		$hasil = false;
		$strSQL = "UPDATE tweb_users SET passwt='".password_hash($varStr,PASSWORD_DEFAULT)."' WHERE id='".$varID."'";
		if($this->db->query($strSQL)){
			$hasil = true;
		}
		return $hasil;
	}

	function siteman_gantifoto($varID,$strFoto){
		$hasil = false;
		$strSQL = "UPDATE tweb_users SET foto='".fixSQL($strFoto)."' WHERE id='".$varID."'";
		if($this->db->query($strSQL)){
			$strSQL = "INSERT INTO tweb_users_foto(nama,userID) VALUES('".fixSQL($strFoto)."','".$varID."')";
			if($this->db->query($strSQL)){
				$hasil = true;
			}
		}
		return $hasil;
		
	}
	
	function siteman_user_arsipfoto($varID){
		$hasil =false;
		if($varID > 0){
			$strSQL = "SELECT id,nama FROM tweb_users_foto WHERE userID=".$varID;
			$result = $this->db->query($strSQL);
			if($result){
				if($result->num_rows() > 0){
					foreach($result->result() as $rs){
						$hasil[$rs->id] = $rs->nama;
					}
				}
			}
		}
		return $hasil;
	}

}
