<?php
/*
 * Olahdata.php
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

class Olahdata extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('lembaga_model');
		$this->load->model('wilayah_model');
		$this->load->model('apbd_model');
	}
	   
  public function index(){
		
		$data['user'] = $this->session->userdata;
		$data["pageTitle"] = "Olah Data ".APP_TITLE;
		$data['msg'] = "";
		$data["boxTitle"] = "Pilih Data APBD";
		$data['hasil'] = false;
		$data['form_action'] = site_url('olahdata/apbd_go');
		$data['form_action_tag'] = site_url('olahdata/simpan_tags');
		$data['tags'] = $this->apbd_model->tags_load();

		$this->load->view('siteman/olahdata',$data);	
		
		if(ENVIRONMENT=='development'){
			$this->output->enable_profiler(TRUE);
		}
	}
	
	function apbd($varID = 0,$varThn= 0){
		$data['user'] = $this->session->userdata;
		$data["pageTitle"] = "Olah Data ".APP_TITLE;
		$data["boxTitle"] = "Pilih Data APBD";
		$data['hasil'] = false;

		$data['form_action'] = site_url('olahdata/apbd_go');
		
		if($varID > 0){
			
			$data['tahuns'] = $this->apbd_model->_apbd_tahun_by_lembaga($varID);
			if(($varThn == 0)){
				$varThn = $data['tahuns'][0];
			}
			$data['tahun'] = $varThn;
			$data['org']		= $this->lembaga_model->lembaga_load($varID);
			$data['url']		= current_url();
			
			$data['varRek'] = (@$_REQUEST['r']) ? $_REQUEST['r']:0;
			
			// $data['apbd'] = $this->apbd_model->apbd_by_rekening($varID,$varThn,$data['varRek']);
			$data['apbd'] = $this->apbd_model->apbd_load($varID,$varThn,$data['varRek']);
			$data['apbd_tags'] = $this->apbd_model->apbd_tags($varID,$varThn);
			$data["boxTitle"] = "Olah Data APBD ".$data['org']['nama']." - ".$data['org']['namawilayah'];
			
			$data['list_tags'] = $this->apbd_model->tags_load(0,true);
			$this->load->view('siteman/olahdata_lembaga',$data);	
		}
				
		if(ENVIRONMENT=='development'){
			$this->output->enable_profiler(TRUE);
		}
	}
	
	function apbd_go(){
		/*
		if($varID == 0){
			$varID = (@$_POST['lembaga_id']) ? $_POST['lembaga_id']:$varID;
		}
		if($varThn == 0){
			$varThn = (@$_POST['tahun']) ? $_POST['tahun']:$varThn;
		}
		*/
		redirect('olahdata/apbd/'.$_POST['lembaga_id'].'/'.$_POST['tahun']) ;
		
	}
	
	function check_nangkis(){
		// $strID = $org['id']."__".$rs['id']."__".$rs['kode_program']."__".$rs['kode_kegiatan'];
		if($_POST['id']){
			$a = explode("__",strtolower($_POST['id']));
			$b = explode("__",strtolower($_POST['access_token']));
			
			if($a[0]=='pro'){
				/*
				 * Update as Program Nangkis
				 * */
				$hasil = $this->apbd_model->apbd_swicth_stat($a[0],$a[1],$a[4],$b[0],$b[1]);
			}elseif($a[0]=='kg'){
				/*
				 * Update as Kegiatan Nangkis
				 * function  apbd_swicth_stat($apa,$todo,$kode,$val,$orgID,$thn){
				 * */
				$hasil = $this->apbd_model->apbd_swicth_stat($a[0],$a[1],$a[5],$b[0],$b[1]);
			}

			$strID = $b[0]."__".$a[3]."__".$a[4]."__".$a[5];

			if($a[0] == 'pro'){
				if($hasil[0]==1){
					echo "
					<div class=\"btn-group\">
					<button id=\"pro__stat_".$strID."\" class=\"btn btn-primary btn-xs\"><i class=\"fa fa-check\"></i></button>
					<button id=\"pro__rem__".$strID."\" class=\"btn btn-default btn-xs btn_pro\"><i class=\"fa fa-minus\"></i></button>
					</div>
					";
				}else{
					echo "<button id=\"pro__add__".$strID."\" class=\"btn btn-default btn-xs btn_pro\"><i class=\"fa fa-check\"></i></button>";
				}
			}elseif($a[0] == 'kg'){
				if($hasil[0]==1){
					echo "
						<div class=\"btn-group\">
						<button id=\"kg__stat_".$strID."\" class=\"btn btn-success btn-xs\"><i class=\"fa fa-check\"></i></button>
						<button id=\"kg__rem__".$strID."\" class=\"btn btn-default btn-xs btn_pro\"><i class=\"fa fa-minus\"></i></button>
						</div>
						";
					
				}else{
					echo "<button id=\"kg__add__".$strID."\" class=\"btn btn-default btn-xs btn_pro\"><i class=\"fa fa-check\"></i></button>";
				}
			}

		}

	}
	
	function simpan_apbd_tags($aID,$orgID,$thn,$varW){
		if($_POST['tags']){
			$user = $this->session->userdata;
			$strSQL = "DELETE FROM `tweb_apbd_tags` WHERE apbd_id='".$aID."' AND lembaga_id='".$orgID."' AND tahun='".$thn."'";
			if($this->db->query($strSQL)){
			}
			$strSQL = "INSERT INTO `tweb_apbd_tags`(`apbd_id`, `lembaga_id`, `tahun`, `tag_id`,`kode_wilayah`, `created_by`) VALUES";
			$i=1;
			$n = count($_POST['tags']);
			foreach($_POST['tags'] as $item){
				$strKoma = ($i<$n) ? ",":"";
				$strSQL .= "('".$aID."','".$orgID."','".$thn."','".$item."','".$varW."','".$user['id']."')".$strKoma;
				$i++;
			}
			$strSQL .=";";
			if($this->db->query($strSQL)){
				redirect('olahdata/apbd/'.$orgID.'/'.$thn);
			}

		}
		
	}
	
	function simpan_tags(){
		//echo var_dump($_POST);
		if($_POST['tag']){
			$hasil = $this->apbd_model->simpan_tags($_POST['tag']['nama'],$_POST['tag']['ndesc']);
			if($hasil){
				$_SESSION['strMsg'] = $hasil;
			}
			redirect('olahdata');
		}
	}
	
  function tags($varID=0,$varChar=''){
		if($varID > 0){
			
			$data['user'] = $this->session->userdata;
			
			$data["pageTitle"] = "Olah Data ".APP_TITLE;
			$data['hasil'] = false;
			$data['form_action_tag'] = site_url('olahdata/simpan_tags');
			$data['tag'] = $this->apbd_model->tags_load($varID);
			$data["boxTitle"] = "APBD dengan Tag <strong>".$data['tag']['nama']."</strong>";
			
			$data['rs'] = $this->apbd_model->apbd_by_tags($varID);
			
			$data['tags'] = $this->apbd_model->tags_load();

			$this->load->view('siteman/olahdata_tags',$data);	
			
			if(ENVIRONMENT=='development'){
				$this->output->enable_profiler(TRUE);
			}
			
		}
	}

	
}
