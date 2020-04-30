<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	public function laman_show($varParma = ''){
		$hasil = array(
			"judul"=>"Judul Laman",
			"id"=>"Judul Laman",
			"nama"=>"Judul Laman",
			"ndesc"=>"Konten",
			"sampul"=>"Sampul",
			);
		return $hasil;
	}
	
	function laman_load($varID = 0){
		$hasil = false;
		if($varID > 0){
			$strSQL = "SELECT * FROM tweb_posts WHERE post_type='page' AND ID=".$varID;
			$query = $this->db->query($strSQL);
			if($query->num_rows() > 0){
				$hasil=$query->result_array()[0];
			}
		}
		return $hasil;
	}
	

	function laman_list(){
		$hasil = false;
		$strSQL = "SELECT p.*,u.nama as unama
		FROM tweb_posts p 
			LEFT JOIN tweb_users u ON u.id=p.post_author 
		WHERE p.post_type='page'";
		$query = $this->db->query($strSQL);
		if($query->num_rows() > 0){
			$hasil=$query->result_array();
		}
		return $hasil;
	}

	function post_load($varID = 0){
		$hasil = false;
		if($varID > 0){
			$strSQL = "SELECT * FROM tweb_posts WHERE post_type='post' AND ID=".$varID;
			$query = $this->db->query($strSQL);
			if($query->num_rows() > 0){
				$hasil=$query->result_array();
			}
		}
		return $hasil;
	}

	
	function post_hapus($varID){
		$hasil = false;
		$strSQL = "DELETE FROM tweb_posts WHERE id=".$varID;
		if($this->db->query($strSQL)){
			if($this->db->affected_rows() == 1){
				$hasil = true;
			}
		}
		return $hasil;
	}
	
	
	function post_simpan(){
		$hasil = false;
		$user = $this->session->userdata;
		$post_cats = "";
		
		$i=1;
		if($this->input->post('post_cats')){
			$n = count($this->input->post('post_cats'));
			foreach($this->input->post('post_cats') as $item){
				$strKoma = ($i < $n) ? ",":"";
				$post_cats .= $item . $strKoma;
				$i++;
			}
		}
		
		$post_tags = "";
		
		$i=1;
		if($this->input->post('post_tags')){
			$n = count($this->input->post('post_tags'));
			foreach($this->input->post('post_tags') as $item){
				$strKoma = ($i < $n) ? ", ":"";
				$post_tags .= $item . $strKoma;
				$i++;
			}
		}

		$fixUrl = (strlen($this->input->post('post_name')) > 0)? $this->input->post('post_name') : $this->input->post('post_title');
		$data = array(
			'post_title' => $this->input->post('post_title'),
			'post_content' => $this->input->post('post_content'),
			'post_type' => $this->input->post('post_type'),
			'post_name' => fixNamaUrl($fixUrl),
			'post_author' => $user['id'],
			'post_status' => $this->input->post('post_status'),
			'post_categories' => fixSQL($post_cats),
			'post_tags'=> fixSQL($post_tags),
			'post_date' => date("Y-m-d H:i:s")
		);
		$id = $this->input->post("id");

		if($id > 0){
			$strTitle = $this->db->escape($this->input->post('post_title'));
			$strContent = $this->db->escape($this->input->post('post_content'));
			$strSQL = "UPDATE tweb_posts SET 
			`post_name`='".fixSQL(fixNamaUrl($fixUrl))."',
			`post_title`='".fixSQL($_POST["post_title"])."',
			`post_content`='".fixSQL($_POST["post_content"])."',
			`post_status`='".fixSQL($_POST["post_status"])."',
			`post_categories`='".fixSQL($post_cats)."',
			`post_tags`='".fixSQL($post_tags)."',
			`post_author`='".$user['id']."' 
			WHERE `ID`=".$id;

			if($this->db->query($strSQL)){
				$hasil = true;
			}else{
				$hasil = $this->input->post('post_content').$strSQL;
			}
		}else{
			if($this->db->insert('tweb_posts', $data)){
				$id = $this->db->insert_id();
			}
		}
		
		/*
		 * Simpan gambar sbg lampiran/sampul
		 * */
		if($id > 0){
			// $this->load->helper('file');
			$img = extract_img($this->input->post('post_content'));
			if((is_array($img))&&(count($img) > 0)){
				$pathUL = FCPATH ."assets/uploads/";
				$i=0;
				foreach ($img as $key => $item){
					$file_name = $item[1];
					$strSQL = "SELECT id,nama FROM tweb_posts_attach WHERE nama='".fixSQL($item[1])."' AND post_id=".$id;
					$query = $this->db->query($strSQL); 
					if($query){
						if($query->num_rows()>0){
						}else{
							$theFile = $pathUL.$item[1];
							if(is_file($theFile)){
								//$file_type = @finfo_file($finfo, $theFile);
								$file_type = mime_content_type($theFile);
								$file_size = filesize($theFile);
								
								$strSQL = "INSERT INTO tweb_posts_attach(`nama`,`post_id`,`size`,`tipe`,created_by)";
								$strSQL .= " VALUES('".fixSQL($item[1])."',".$id.",".fixSQL($file_size).",'".fixSQL($file_type)."','".$_SESSION["user"]."')";
								if($this->db->query($strSQL)){
									$strSQL = "UPDATE tweb_posts SET post_cover='".fixSQL($item[1])."' WHERE id=".$id;
									if($this->db->query($strSQL)){
										$err = 0;
										$hasil = TRUE;
									}
								}
							}
						}
					}
					$i++;
				}
			}
		}else{
			echo "Ga ada ID";
		}
		
		$ret = array($hasil,$id);
		return $ret;		
	}
	
	function post_list($varKategori='',$varPage=1){
		$varPage = ($varPage=='')? 1:$varPage;
		$offset = ($varPage - 1) * LIMIT_TAMPIL;
		$hasil = false;
		$clause_kategori = "AND (p.post_categories LIKE '%".fixSQL($varKategori)."%')";
		$strSQL = "
		SELECT p.*,u.nama as unama 
		FROM tweb_posts p
			LEFT JOIN tweb_users u ON p.post_author=u.id 
		WHERE p.`post_type`='post' ";
		// LIMIT ".$offset.", ".LIMIT_PENDEK;
		$query = $this->db->query($strSQL);
		if($query->num_rows() > 0){
			$hasil=$query->result_array();
			
		}
		return $hasil;
	}
	
	
	function category_simpan(){
		$hasil =false;
		$user = $this->session->userdata;
		$id = $this->input->post("id");
		if($id > 0){
			$strSQL = "UPDATE tweb_posts_category SET nama='".fixSQL($this->input->post('nama'))."', parma='".fixSQL($this->input->post('parma'))."'";
			$strMsg = "Berhasil memperbarui kategori <strong>".$this->input->post('nama')."</strong>";
		}else{
			$strSQL = "INSERT INTO tweb_posts_category(nama,parma,created_by,created_at) 
				VALUES('".fixSQL($this->input->post('nama'))."','".fixSQL($this->input->post('parma'))."','".$user['id']."','".date('Y-m-d H:i:s')."')";
			$strMsg = "Berhasil menyimpan kategori <strong>".$this->input->post('nama')."</strong>";
		}
		if($this->db->query($strSQL)){
			$hasil = array("alert"=>"success","msg"=>$strMsg);
		}
		return $hasil;
	}
	
}
