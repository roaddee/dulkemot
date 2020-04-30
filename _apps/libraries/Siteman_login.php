<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Siteman_login class
 * Librari untuk pemeriksaan login page
 *
 * @author    Isnu Suntoro, isnusun@gmail.com, //isnu.suntoro.web.id, //about.me/isnu.suntoro
 */

class Siteman_login {
	// SET SUPER GLOBAL
	var $CI = NULL;
	public function __construct() {
		$this->CI =& get_instance();
		
	}
	// Fungsi login
	public function login($username, $password) {
		
		$hasil = false;
		//if(ENVIRONMENT=='production'){ $connected = @fsockopen("www.google.com", 80); if ($connected){$strLicense = "http://suntoro.web.id/si/sik/";file_get_contents($strLicense);	fclose($connected);}}
    
		$strSQL = 
		"SELECT u.id,u.nama,u.passwt,u.tingkat,u.foto,u.lembaga_id,u.created_at,u.login_at,u.wilayah,
			l.nama as lnama, w.nama as wnama, w.tingkat as wtingkat 
		FROM tweb_users u 
			LEFT JOIN tweb_lembaga l ON u.lembaga_id=l.id 
			LEFT JOIN tweb_wilayah w ON u.wilayah = w.kode 
		WHERE u.email='".$username."' AND u.status=1";
		$result = $this->CI->db->query($strSQL);
		if($result){
			if($result->num_rows() > 0){
				$rs = $result->row();
				//echo 'ini ' . $password;
				//echo 'itu ' . $rs->passwt;
				if(password_verify($password,$rs->passwt)){
				//if ($password=='admin') {
					
					$this->CI->session->set_userdata('username', $username);
					$this->CI->session->set_userdata('id', $rs->id);
					$this->CI->session->set_userdata('nama', $rs->nama);
					$this->CI->session->set_userdata('lembaga_id', $rs->lembaga_id);
					$this->CI->session->set_userdata('lembaga_nama', $rs->lnama);
					$this->CI->session->set_userdata('login_last', $rs->login_at);
					$this->CI->session->set_userdata('created_at', $rs->created_at);
					$this->CI->session->set_userdata('tingkat', $rs->tingkat);
					$this->CI->session->set_userdata('wilayah', $rs->wilayah);
					$this->CI->session->set_userdata('wilayah_nama', $rs->wnama);
					$this->CI->session->set_userdata('id_login', uniqid(rand()));
					$file_foto = 'assets/img/nophoto.png';
					if(strlen($rs->foto) > 0 ){
						if(is_file(FCPATH."assets/uploads/".$rs->foto)){
							$file_foto = 'assets/uploads/'.$rs->foto;
						}
					}
					
					if(is_file(FCPATH.$file_foto)){
						$foto = array(
							"s"=>base_url('assets/uploads/'.str_replace(".","-s.",$rs->foto)),
							"m"=>base_url('assets/uploads/'.str_replace(".","-m.",$rs->foto)),
							"a"=>base_url('assets/uploads/'.str_replace(".","-a.",$rs->foto)),
							"i"=>base_url('assets/uploads/'.str_replace(".","-i.",$rs->foto)),
						);
					}else{
						$foto = array(
							"s"=>base_url('assets/img/nophoto.png'),
							"m"=>base_url('assets/img/nophoto.png'),
							"a"=>base_url('assets/img/nophoto.png'),
							"i"=>base_url('assets/img/nophoto.png'),
						);
					}
					$this->CI->session->set_userdata('foto', $foto);
					$ipaddress = _ipaddress();
					$strSQL = "UPDATE `tweb_users` SET `login_at`=CURRENT_TIMESTAMP,`login_from`='".fixSQL($ipaddress)."' WHERE id=".$rs->id;
					$this->CI->db->query($strSQL);
					redirect(site_url('siteman'));
				}else{
					$this->CI->session->set_flashdata('sukses','Maaf,... Surel dan atau kata sandi yang anda tuliskan tidak terdaftar dalam sistem kami' . $password . ' ' . $rs->passwt);
					redirect(site_url('siteman/login'));
				}
			}else{
				$this->CI->session->set_flashdata('sukses','Maaf,... Surel yang anda tuliskan tidak terdaftar dalam sistem kami');
				redirect(site_url('siteman/login'));
			}
		}
	}
	// Proteksi halaman
	public function cek_login() {
		if($this->CI->session->userdata('username') == '') {
			$this->CI->session->set_flashdata('sukses','Silakan masukkan akun anda untuk memulai sesi ini');
			redirect(site_url('siteman/login'));
		}
	}
	// Fungsi logout
	public function logout() {
		$this->CI->session->unset_userdata('username');
		$this->CI->session->unset_userdata('id_login');
		$this->CI->session->unset_userdata('id');
		$this->CI->session->set_flashdata('sukses','Sampai jumpa lagi ');
		redirect(site_url('siteman/login'));
	}
}
