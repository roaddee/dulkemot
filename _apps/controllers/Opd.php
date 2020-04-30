<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opd extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('siteman_model');
		$this->load->model('publik_model');
		$this->load->model('post_model');
		$this->load->model('apbd_model');
	}


	function index($varID = '',$varUrl='',$varRek=''){
		
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
	
}
