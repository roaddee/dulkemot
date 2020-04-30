<?php
/*
 * Publik.php
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

class Posts extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('publik_model');
		$this->load->model('post_model');
	}
	   
  public function index($varKategori='',$varPage=1){
		$data["pageTitle"] = "Modul Pengelolaan Publikasi ".APP_TITLE;
		$data['msg'] = "";
		$data['user'] = $this->session->userdata;
		$data["boxTitle"] = "Daftar Publikasi dlm ".APP_TITLE;
		$data['categories'] = $this->publik_model->post_categories($varKategori);
		$data['form_category'] = site_url('posts/post_category_simpan');
		if($varKategori <> ''){
			$data["boxTitle"] = "Daftar Publikasi dlm Kategori ".$data['categories'][$varKategori]['nama'];
		}
		$data['posts'] = $this->post_model->post_list($varKategori,$varPage);
		$this->load->view('siteman/admin_posts',$data);	
	}
	
	function post_edit($varID=0){
		$data["pageTitle"] = "Modul Pengelolaan Publikasi ".APP_TITLE;
		$data['msg'] = "";
		$data['user'] = $this->session->userdata;
		$data['categories'] = $this->publik_model->post_categories();
		$data['form_action'] = site_url('posts/post_simpan');
		$data['form_category'] = site_url('posts/post_category_simpan');
		$data['lembaga'] = $this->publik_model->lembaga_load();
		if($varID > 0){
			$data["boxTitle"] = "Formulir Pemutakhiran Konten Dinamis";
			$data['post'] = $this->publik_model->post_load($varID);

			$data['id'] = $varID;
		}else{
			$data["boxTitle"] = "Formulir Penulisan Konten Dinamis Baru";
			$data['post'] = false;
			$data['id'] = 0;
		}
		$this->load->view('siteman/admin_posts_form',$data);	
	}
	
	function post_simpan(){
		/*
		echo var_dump($_POST);
		*/ 
		$hasil = $this->post_model->post_simpan();
		if($hasil){
			$data['msg'] = $hasil['msg'];
			$data['alert'] = $hasil['alert'];
		}
		redirect('posts');
	}
	
	function post_category_simpan(){
		$hasil = $this->post_model->category_simpan();
		if($hasil){
			$data['msg'] = $hasil['msg'];
			$data['alert'] = $hasil['alert'];
		}
		redirect('posts');
	}
	
}
