<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Institusi extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('siteman_model');
		$this->load->model('publik_model');
		$this->load->model('post_model');
		$this->load->model('apbd_model');
	}


	function opd($varID = '',$varUrl='',$varAll=''){
		
		$this->load->model('wilayah_model');
		if($varID  > 0){
			$data['lembaga'] = $this->publik_model->lembaga_load($varID);

			if($data['lembaga']){
				
				$data['tags'] = $this->apbd_model->tags_load();

				$data['tahuns'] = $this->apbd_model->_apbd_tahun_by_lembaga($varID);
				
				$varRek = (@$_REQUEST['r']) ? $_REQUEST['r']:0;
				$varThn = (@$_REQUEST['y']) ? $_REQUEST['y']:0;

				$data['tahun'] = $varThn;

				
				$data['org'] = $this->publik_model->lembaga_list($data['lembaga']['kodewilayah']);
				
				$data['wilayah'] = $this->wilayah_model->get_wilayah($data['lembaga']['kodewilayah']);
				$data['pageTitle'] = $data['lembaga']['nama'] ." - ". $data['lembaga']['namawilayah'];
				$data['page'] = array(
					'title'=>'APBD '. $data['lembaga']['nama'] ." - ". $data['lembaga']['namawilayah'] ." - ". $varThn,
					'desc' =>'Deskripsi',
					'image' => base_url('assets/img/logo.png'),
						);
				$data['info'] = $this->siteman_model->configs();	

				$data['rekening'] = $this->apbd_model->nama_rekening($varRek,$varID);
				$data['pie'] = false;
				$data['summary'] = false;
				$data['programs'] = false;
				$data['semua'] = false;
				
				if($varRek){
					$data['rekenin_title'] = "Detail Rekening <strong>".$data['rekening']."</strong> (dlm juta rupiah)";
					$data['summary'] = $this->apbd_model->apbd_lembaga_by_rek($varID,$varRek,$data['tahuns']);
					$data['pie'] = true;
				}else{
					// echo "Tidak Ada rek";
					if(!$varAll){
						$data['programs'] = $this->apbd_model->program_list_by_lembaga($varID);
						$data['rekenin_title'] = "Rangkuman APBD (dlm juta rupiah)";
						$data['summary'] = $this->apbd_model->apbd_lembaga_home($varID,$data['tahuns']);
					}else{
						
					}
				}
				
				if($varAll=='semua'){
					$thn = ($varThn == 0)? $data['tahuns'][0]:$varThn;
					$data['apbd'] = $this->apbd_model->apbd_load($varID,$thn);
				}
/*
				$data['programs'] = $this->publik_model->program_nangkis_by_org($varID,$varThn);
				$data['program'] = $this->publik_model->program_nangkis_by_org($varID,$varThn);
				$data['kegiatan'] = $this->publik_model->kegiatan_nangkis_by_org($varID,$varThn);
*/ 
				$data['posts'] = $this->publik_model->post_by_org($varID);

				$this->load->view('pubs/opd',$data);

			}else{
				show_404();
			}
		}else{
			
		}
		
	}
	
}
