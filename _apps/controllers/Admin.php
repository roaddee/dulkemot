<?php
/*
 * Admin.php
 * 
 * Copyright 2016 Isnu Suntoro <isnusun@isnusun-X450LCP>
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

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('siteman_model');
		$this->load->model('lembaga_model');
		
		$this->load->library('form_validation');
	}
	   
  public function index(){
		echo "Hello World";
	}

	function konfigurasi(){
		$data["pageTitle"] = "Konfigurasi Aplikasi ".APP_TITLE;
		$data['config'] = $this->siteman_model->config_load();
		$data['msg'] = "";
		$data['user'] = $this->session->userdata;
		$data["boxTitle"] = "Konfigurasi Aplikasi ".APP_TITLE;
		$this->load->view('siteman/admin_config',$data);	
		
	}
	
	public function pengguna($varID = 0,$todo=''){
		$this->load->model('wilayah_model');
		$data["pageTitle"] = "Pengelolaan Data Pengguna Sistem";
		$data['user'] = $this->session->userdata;
		$data['user_status'] = _status_pengguna();
		$data['user_level'] = _tingkat_pengguna();
		$data['id'] = $varID;
		$data['msg'] = false;

		$data['wilayah_tingkat'] = _tingkat_wilayah();		
		$data["kecamatan"] = $this->wilayah_model->list_subwilayah(KODE_BASE,3);
		$data["desa"] = $this->wilayah_model->list_subwilayah(KODE_BASE,4);
		
		if($varID > 0){
			$data['pengguna'] = $this->siteman_model->load_pengguna($varID);
			switch ($todo)
			{
				case 'hapus':
					$data['todo'] = "hapus";
					$hasil = $this->siteman_model->pengguna_hapus($varID);
					if($hasil != false){
						redirect('admin/pengguna');
					}
					break;
				case 'ubah':
					$data['lembaga_list'] = $this->lembaga_model->lembaga_load(0);
					$data['todo'] = "ubah";
					$data["boxTitle"] = "Pemutakhiran Data Pengguna ".$data['pengguna']['nama'];
					$data['form_action'] = site_url('admin/pengguna_simpan');
					$this->load->view('siteman/admin_pengguna_form',$data);
					
					break;
				case 'lihat':
					$data['todo'] = "lihat";
					
					break;
				default:
					$data["boxTitle"] = "Profil ".$data['pengguna']['nama'];
					$this->load->view('siteman/admin_pengguna',$data);
					
			}
			
		}else{
			if($todo == 'baru'){
				$data['lembaga_list'] = $this->lembaga_model->lembaga_load(0);
				$data['pengguna'] = false;
				$data['lembaga_list'] = $this->lembaga_model->lembaga_load(0);
				$data['todo'] = "ubah";
				$data["boxTitle"] = "Penambahan Data Pengguna Baru";
				$data['form_action'] = site_url('admin/pengguna_simpan');
				$this->load->view('siteman/admin_pengguna_form',$data);
			}else{
				$data['pengguna'] = $this->siteman_model->load_pengguna(0);
				$data["boxTitle"] = "Data Daftar Pengguna Sistem";
				$this->load->view('siteman/admin_pengguna',$data);
			}
		}
		
	}
	
	function pengguna_simpan(){
		$data['debug'] = $_POST;
		$data["pageTitle"] = "Pengelolaan Data Pengguna Sistem";
		
		$data['user'] = $this->session->userdata;
		
		//echo var_dump($data['user']);
		$data['wilayah_tingkat'] = _tingkat_wilayah();		
		
		$data['user_status'] = _status_pengguna();
		$data['user_level'] = _tingkat_pengguna();		
		
		
		$data['msg'] = $this->siteman_model->simpan_pengguna();
		
		$data['id'] = $data['msg']['id'];
		$data['pengguna'] = $this->siteman_model->load_pengguna($data['id']);
		$referer = $this->input->post('referer');
		$re = explode("/",$referer);
		$data["boxTitle"] = "Pemutakhiran Data Pengguna ".$data['pengguna']['nama'];
		$this->load->view('siteman/admin_pengguna',$data);
		
	}

	function pengguna_hapus($varID = 0){
		
	}
	
	function pengguna_checkemail($varStr=''){
		$this->siteman_model->konfirmasi_email($varStr);
	}
	
	function lembaga($varID=0,$todo='',$page=1){
		$this->load->model('wilayah_model');
		
		$data['id'] = $varID;
		$data['user'] = $this->session->userdata;
		$data['pengguna'] = $this->lembaga_model->lembaga_load($varID);
		$data["pageTitle"] = "Pengelolaan Data Lembaga";
		$data['propinsi'] = $this->wilayah_model->subwilayah();
		
		if($varID > 0){
			switch ($todo)
			{
				case "ubah":
				$data['form_action'] = site_url('admin/lembaga_simpan');
				$data["boxTitle"] = "Formulir Penambahan Data Lembaga";
				$this->load->view('siteman/admin_lembaga_form',$data);
					
					break;
				default:
				$data["boxTitle"] = "Daftar Lembaga";
				$this->load->view('siteman/admin_lembaga',$data);
					
			}
			
		}else{
			if($todo == "baru"){
				$data['pengguna'] = false;
				$data['form_action'] = site_url('admin/lembaga_simpan');
				$data["boxTitle"] = "Formulir Penambahan Data Lembaga";
				$this->load->view('siteman/admin_lembaga_form',$data);
				
			}else{
				$data["boxTitle"] = "Daftar Lembaga";
				$this->load->view('siteman/admin_lembaga',$data);
			}
		}
		
	}
	
	function lembaga_simpan(){
		/*
		echo var_dump($_POST);
		*/
		$data['debug'] = $_POST;
		$data["pageTitle"] = "Pengelolaan Data Lembaga";
		$data['user'] = $this->session->userdata;
		
		$data['msg'] = $this->lembaga_model->simpan_lembaga();
		$data['id'] = $data['msg']['id'];
		$data['pengguna'] = $this->lembaga_model->lembaga_load($data['id']);
		$referer = $this->input->post('referer');
		$re = explode("/",$referer);
		$data["boxTitle"] = "Pemutakhiran Data Lembaga ".$data['pengguna']['nama'];
		$this->load->view('siteman/admin_lembaga',$data);	
	}
	
	function laman($varID=0,$todo=""){
		$this->load->model('post_model');
		$data["pageTitle"] = "Kelola Laman Statsi ".APP_TITLE;
		$data['msg'] = "";
		$data['user'] = $this->session->userdata;
		$data["boxTitle"] = "Halaman Statis ";
		if($todo=="hapus"){
			if($this->post_model->post_hapus($varID)){
				$data['msg'] = array("alert"=>"success","msg"=>"Halaman telah berhasil dihapus");
			}else{
				$data['msg'] = array("alert"=>"danger","msg"=>"Ada kesalahan dalam menghapus halaman");
			}
		}
		$data['posts'] = $this->post_model->laman_list();
		$this->load->view('siteman/admin_laman',$data);	
	}

	function laman_edit($varID=0){
		$this->load->model('post_model');
		$data['user'] = $this->session->userdata;
		$data["pageTitle"] = "Kelola Laman Statsi ".APP_TITLE;
		$data['msg'] = "";
		$data['form_action'] = site_url('admin/laman_simpan');
		$data["id"]=$varID;
		if($varID > 0){
			$data["boxTitle"] = "Form Pemutakhiran Halaman Statis";
			$data["post"] = $this->post_model->laman_load($varID);
		}else{
			$data["boxTitle"] = "Form Penulisan Halaman Statis";
			$data["post"] = false;
		}
		$this->load->view('siteman/admin_laman_form',$data);	
	}
	
	function laman_simpan(){

		$data['user'] = $this->session->userdata;
		$this->load->model('post_model');
		$hasil = $this->post_model->post_simpan();
		if($hasil){
			redirect('admin/laman');
		}
	}
	
}
