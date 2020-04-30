<?php
/*
 * Ajax.php
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

class Ajax extends CI_Controller {

	function __construct(){
		parent::__construct();
		// session_start();
		$this->load->library('form_validation');
		$this->load->model('siteman_model');
		$this->load->model('lembaga_model');
	}
	   
  public function index(){
		ae_nocache();
		echo "Hello World";
	}
	
	function summernote_upload(){
		ae_nocache();
		$IMG_WIDTHS = array(
			"i"=>24,
			"c"=>40,
			"s"=>120,
			"t"=>300,
			"m"=>400,
			"a"=>800
		);

		$pathUL = FCPATH."assets/uploads/";
		if ($_FILES['image']['name']) {
			if (!$_FILES['image']['error']) {
				$name = md5(rand(100, 200));
				$tempfile =  "stm_".time();

				$file_type = $_FILES['image']['type'];
				$file_name = $_FILES['image']['name'];
				$file_size = $_FILES['image']['size'];
				$file_tmp = $_FILES["image"]["tmp_name"];

				$ext = substr($file_name,strrpos($file_name,"."));
				$filename = $tempfile . $ext;
				
				if($file_type == "image/pjpeg" || $file_type == "image/jpeg"||$file_type == "image/x-png" || $file_type == "image/png"||$file_type == "image/gif"){
					$fileBaru = $pathUL ."".$tempfile.$ext;
					if($file_type == "image/pjpeg" || $file_type == "image/jpeg"){
						$new_img = imagecreatefromjpeg($file_tmp);
					}elseif($file_type == "image/x-png" || $file_type == "image/png"){
							$new_img = imagecreatefrompng($file_tmp);
					}elseif($file_type == "image/gif"){
							$new_img = imagecreatefromgif($file_tmp);
					}
					
					list($width, $height) = getimagesize($file_tmp);
					$imgratio=$width/$height;
					
					foreach ($IMG_WIDTHS as $key=> $item){
						$ThumbWidth = $item;
						if ($imgratio>1){
							$newwidth = $ThumbWidth;
							$newheight = $ThumbWidth/$imgratio;
						}else{
							$newheight = $ThumbWidth;
							$newwidth = $ThumbWidth*$imgratio;
						}
						if (function_exists('imagecreatetruecolor')){
							$resized_img = imagecreatetruecolor($newwidth,$newheight);
						}else{
							die("Error: Please make sure you have GD library ver 2+");
						}
						$fileBaru = $pathUL."".$tempfile."-".$key.$ext;
						imagecopyresized($resized_img, $new_img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
						ImageJpeg ($resized_img,$fileBaru);
					}
					
					$tujuan = $pathUL.$filename;
					move_uploaded_file($file_tmp, $tujuan);
					$strMsg = date("Y-m-d H:i:s") .": ".base_url("assets/uploads/").$filename."\n";
					
					echo base_url("assets/uploads/").$filename;
					
				}
			}else{
				$strMsg = 'Ooops! Anda mengunggah berkas yang mengakibatkan error:  '.$_FILES['image']['error'];
			}
		}
	}
	
	function siteman_periksa_email(){
		/* RECEIVE VALUE 
		$validateValue=$_POST['validateValue'];
		$validateId=$_POST['validateId'];
		$validateError=$_POST['validateError'];
		*/
		ae_nocache();
		header('Content-Type: application/json');
		$hasil = $this->siteman_model->periksa_email(@$_REQUEST['fieldValue'],@$_REQUEST['fieldId']);
		echo json_encode($hasil);
	}
	function siteman_periksa_username(){
		/* RECEIVE VALUE 
		$validateValue=$_POST['validateValue'];
		$validateId=$_POST['validateId'];
		$validateError=$_POST['validateError'];
		*/
		ae_nocache();
		header('Content-Type: application/json');
		$hasil = $this->siteman_model->periksa_username(@$_REQUEST['fieldValue'],@$_REQUEST['fieldId']);
		echo json_encode($hasil);
	}
	
	function wilayah(){
		$this->load->model('wilayah_model');
		$strCari = @$_REQUEST["q"];
		
		if(strlen($strCari) >= 3){
			$data = $this->wilayah_model->cari_wilayah_by_nama($strCari);
			header('Content-Type: application/json');
			echo "{ \"total_count\": ".count($data).", \"incomplete_results\": false, \"items\":".json_encode($data)."}";
		}
	}

	function lembaga(){
		$this->load->model('lembaga_model');
		$strCari = @$_REQUEST["q"];
		
		if(strlen($strCari) >= 3){
			$data = $this->lembaga_model->cari_lembaga($strCari);
			header('Content-Type: application/json');
			echo "{ \"total_count\": ".count($data).", \"incomplete_results\": false, \"items\":".json_encode($data)."}";
		}
	}
	
	function siteman_wilayah($varDefault=''){

		$varKode = @$_POST['depdrop_parents'][0];
		$this->load->model('wilayah_model');
		$n = strlen($varKode);
		$varKode = ($n==10) ? $varKode."00":$varKode;
		$data = $this->wilayah_model->subwilayah($varKode);

		$n = strlen($varKode);
		$json_output = array();
		$out = array();
		$default = $varDefault;

		switch ($n)
		{
			case 0:
				$default = substr(KODE_BASE,0,2);
				foreach($data as $key=>$item){
					$out[] = array('id'=>$key, 'name'=>$item['nama']);
				}
				break;

			case 2:
				$default = substr(KODE_BASE,0,4);
				foreach($data as $key=>$item){
					$out[] = array('id'=>$key, 'name'=>$item['nama']);
				}
				break;

			default:
				foreach($data as $key=>$item){
					$out[] = array('id'=>$key, 'name'=>$item['nama']);
				}
		}
		echo json_encode(['output'=>$out, 'selected'=>$default]);
		
	}
	
	function tags_list(){
		$strSQL = "SELECT id,nama FROM tweb_tags WHERE nama LIKE '%".@$_GET['query']."%' LIMIT 10";
		$result = $this->db->query($strSQL);

		$json = array();
		foreach($result->result_array() as $row){
				 $json[] = $row['nama'];
		}
		echo json_encode($json);
		
	}
		
}
