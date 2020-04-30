<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemda extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->load->model('lembaga_model');
	}

  public function index($varKode = ''){
		
		$data['pageTitle'] = "Selamat Datang";
		$data['info'] = array(
			"alamat_kantor"=>"Jl. Kaliurang Km. 5 Gg. Tejomoyo CT III/3 Yogyakarta  55281  Indonesia",
			"lat"=>98.0232,
			"lng"=>110.0232,
			"zoom"=>13,
			"telp"=>'0274 550 1283',
			"email"=>'perkumpulanidea@gmail.com',
			
				);
		$data['menu_atas'] = false;
		$data['menu_kiri'] = false;
		$data['posts'] = false;
    $this->load->view('pubs/publik_template',$data);
  }
  
  function nama($varKode=''){
		$data['pageTitle'] = "Selamat Datang";
		$data['info'] = array(
			"alamat_kantor"=>"Jl. Kaliurang Km. 5 Gg. Tejomoyo CT III/3 Yogyakarta  55281  Indonesia",
			"lat"=>98.0232,
			"lng"=>110.0232,
			"zoom"=>13,
			"telp"=>'0274 550 1283',
			"email"=>'perkumpulanidea@gmail.com',
			
				);
		$data['menu_atas'] = false;
		$data['menu_kiri'] = false;
		$data['posts'] = false;
    $this->load->view('pubs/publik_template',$data);
	}
  
}
