<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apbd extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('siteman_model');
		$this->load->model('publik_model');
		$this->load->model('post_model');
		$this->load->model('apbd_model');
	}

  public function index($varKode = ''){
		
		$data['page'] = array(
			'title'=>'Pemerintah Daerah ',
			'desc' =>'Open Data APBD Pemerintah Daerah ',
			'image' => base_url('assets/img/logo.png'),
				);
		$data['about'] = $this->post_model->laman_load(2);
		$data['info'] = $this->siteman_model->configs();
    $this->load->view('pubs/publik_template',$data);
  }
  
  function pemda($varKode=''){
		$this->load->model('wilayah_model');
		if($varKode <> ''){
			$data['kodewilayah'] = $varKode;
			$data['wilayah'] = $this->wilayah_model->get_wilayah($varKode);
			$data['pageTitle'] = "Selamat Datang";
			$data['page'] = array(
				'title'=>'Pemerintah Daerah '.$data['wilayah'],
				'desc' =>'Open Data APBD Pemerintah Daerah '.$data['wilayah'],
				'image' => base_url('assets/img/logo.png'),
					);
			$data['info'] = $this->siteman_model->configs();
			$datawilayah = $this->publik_model->lembaga_list($varKode);

			$data['org'] = $datawilayah['org'];
			$data['tahuns'] = $this->apbd_model->_apbd_tahun_by_lembaga($datawilayah['id']);
			
			$data['summary'] = $this->apbd_model->apbd_lembaga_home($datawilayah['id'],$data['tahuns']);
			$data['lembagaID'] = $varKode;
			
			$data['program'] = $this->publik_model->program_nangkis_by_wilayah($varKode);
			$data['kegiatan'] = $this->publik_model->kegiatan_nangkis_by_wilayah($varKode);
			$data['posts'] = $this->publik_model->post_by_wilayah($varKode);
			
			/*
			 * Muat data APBD 0
			 * 
			 * */
			$varRek = (@$_REQUEST['r']) ? $_REQUEST['r']:0;
			$varThn = (@$_REQUEST['y']) ? $_REQUEST['y']:0;
			
			$data['rekening'] = $this->apbd_model->nama_rekening($varRek,$datawilayah['id']);
			
			if($varRek){
				$data['rekenin_title'] = "Detail Rekening <strong>".$data['rekening']."</strong> (dlm juta rupiah)";
				$data['summary'] = $this->apbd_model->apbd_lembaga_by_rek($datawilayah['id'],$varRek,$data['tahuns']);
				$data['pie'] = true;
			}else{
				// echo "Tidak Ada rek";
				$data['pie'] = false;
				$data['rekenin_title'] = "Rangkuman APBD (dlm juta rupiah)";
				$data['summary'] = $this->apbd_model->apbd_lembaga_home($datawilayah['id'],$data['tahuns']);
			}			
			
			$data['tags'] = $this->apbd_model->tags_load();
			
			$data['tags_area'] = $this->apbd_model->apbd_tags_by_area($varKode);
			
			//echo var_dump($data['tags_area']);

			$this->load->view('pubs/pemda',$data);
		}else{
			redirect('beranda');
		}
	}
	
	function opd($varID = '',$varUrl='',$varRek=''){
		
		$this->load->model('wilayah_model');
		if($varID  > 0){
			
			$data['tahuns'] = $this->apbd_model->_apbd_tahun_by_lembaga($varID);
			$varThn = @$_REQUEST['tahun'];
			if($varThn == 0){
				$varThn = (@$_REQUEST['tahun']) ? $_POST['tahun']:$varThn;
			}
			if(($varThn == 0)){
				$varThn = $data['tahuns'][0];
			}
			$data['tahun'] = $varThn;

			$data['lembaga'] = $this->publik_model->lembaga_load($varID);
			$data['org'] = $this->publik_model->lembaga_list($data['lembaga']['kodewilayah']);
			
			$data['wilayah'] = $this->wilayah_model->get_wilayah($data['lembaga']['kodewilayah']);
			$data['pageTitle'] = $data['lembaga']['nama'] ." - ". $data['lembaga']['namawilayah'];
			$data['page'] = array(
				'title'=>'APBD '. $data['lembaga']['nama'] ." - ". $data['lembaga']['namawilayah'] ." - ". $varThn,
				'desc' =>'Deskripsi',
				'image' => base_url('assets/img/logo.png'),
					);
			$data['info'] = $this->siteman_model->configs();	
			$data['apbd'] = $this->apbd_model->apbd_load($varID,$varThn);
			
			if($varRek){
				$data['summary'] = false;
				echo "Ada rek";
				
			}else{
				// echo "No Ada rek";
				$data['summary'] = $this->apbd_model->apbd_lembaga_home($varID,$data['tahuns']);
			}

			$data['program'] = $this->publik_model->program_nangkis_by_org($varID,$varThn);
			$data['kegiatan'] = $this->publik_model->kegiatan_nangkis_by_org($varID,$varThn);
			$data['posts'] = $this->publik_model->post_by_org($varID);

			$this->load->view('pubs/opd',$data);
		}else{
			
		}
		
	}
	
	function analisis($varID = ''){
		$varID = ($varID == '')? 0:$varID;
		$data['info'] = $this->siteman_model->configs();

		if($varID > 0){
			$data['page'] = array(
				'title'=>'APBD '. $data['lembaga']['nama'] ." - ". $data['lembaga']['namawilayah'] ." - ". $varThn,
				'desc' =>'Deskripsi',
				'image' => base_url('assets/img/logo.png'),
					);
				
			$this->load->view('pubs/analisis_detail',$data);
		}else{
			$data['page'] = array(
				'title'=>'Indeks Konten Analisis',
				'desc' =>'Konten Analisis atas data Anggaran Pendapatan Belanja Daerah',
				'image' => base_url('assets/img/logo.png'),
					);
			$data['posts'] = $this->publik_model->post_list();
			$this->load->view('pubs/analisis',$data);
		}
	}
	
  
  function tags($varID='',$varParma=''){
		$varID = ($varID == '')? 0:$varID;
		$data['info'] = $this->siteman_model->configs();
		$data['tags'] = false;
		if($varID > 0){
			$data['tag'] = $this->apbd_model->tags_load($varID);
			$data['apbd'] = $this->apbd_model->apbd_by_tags($varID);
			$data['page'] = array(
				'title'=>'OpenData berbasis Tag'. $data['tag']['nama'],
				'desc' =>'Layanan Data Terbuka utuk Anggaran dan Pendapatan Belanja Daerah',
				'image' => base_url('assets/img/logo.png'),
					);			
			
		}else{
			$data['tags'] = $this->apbd_model->tags_load();
			$data['page'] = array(
				'title'=>'OpenData berbasis Tag'. $data['tag']['nama'],
				'desc' =>'Layanan Data Terbuka utuk Anggaran dan Pendapatan Belanja Daerah',
				'image' => base_url('assets/img/logo.png'),
					);		}
		
		$this->load->view('pubs/bytags',$data);
	}
  
}
