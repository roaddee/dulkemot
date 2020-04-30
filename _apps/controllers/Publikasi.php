<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publikasi extends CI_Controller {

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   *    http://example.com/index.php/welcome
   *  - or -
   *    http://example.com/index.php/welcome/index
   *  - or -
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/welcome/<method_name>
   * @see http://codeigniter.com/user_guide/general/urls.html
   */
	function __construct(){
		parent::__construct();

		$this->load->model('publik_model');
	}
   
  public function index($varKategori=''){
		/*
		 * Indeks semua post 
		 * 
		 * */
		$data['kategori'] = false;
		$data['pageTitle'] = "Indek Publikasi";
		$data['subtitle'] = "Daftar publikasi dalam ".APP_TITLE;
		if($varKategori <> ''){
			$data['kategori'] = $this->publik_model->post_categories($varKategori);
			$data['pageTitle'] = "Indek Publikasi dlm Kategori ".$data['kategori']['nama'];
			$data['subtitle'] = $data['kategori']['ndesc'];
		}
		$data['post_id'] = 0;
		$data['posts']= $this->publik_model->post_list();
    $this->load->view('publik_posts',$data);
  }

  public function baca($varParma=''){
		/*
		 * Indeks semua post dan view per ID
		 * */
		if(strlen($varParma) > 0){
			$data['post']= $this->publik_model->post_load($varParma);
			$data['post_id'] = $data['post']['ID'];
			$data['pageTitle'] = $data['post']['post_title'];
		}
		
		$this->load->view('publik_posts',$data);
  }
  
  public function kategori($varParma=''){
		/*
		 * Indeks semua post dalam kategori $varParma
		 * */
		$data['posts']= $this->publik_model->post_list();
    $this->load->view('publik_posts',$data);
  }
}
