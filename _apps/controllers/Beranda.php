<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('siteman_model');
		$this->load->model('lembaga_model');
		$this->load->model('publik_model');
		$this->load->model('post_model');
	}

  public function index()
  {
		
		$data['pageTitle'] = "Selamat Datang";
		$data['page'] = array(
			'title'=>'Selamat Datang',
			'desc' =>'Deskripsi',
			'image' =>'image'
				);
		$data['info'] = $this->siteman_model->configs();
		$data['about'] = $this->post_model->laman_load(12);
		$data['posts'] = $this->publik_model->post_list();
    $this->load->view('pubs/beranda',$data);
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
