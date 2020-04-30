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

class Publik extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('siteman_model');
		$this->load->model('publik_model');
		$this->load->model('post_model');
	}
	   
  public function index(){
		echo "Hello World";
	}
	
	public function laman($varParma){

		$data['post'] = $this->publik_model->laman_show($varParma);
		
		$data['page'] = array(
			'title'=> $data['post']['post_title'],
			'desc' =>'Open Data APBD Pemerintah Daerah ',
			'image' => base_url('assets/img/logo.png'),
				);
		$data['about'] = $this->post_model->laman_load(2);
		$data['info'] = $this->siteman_model->configs();

    $this->load->view('pubs/laman',$data);
	}

	public function baca($varID,$varParma){
		$data['info'] = $this->siteman_model->configs();
		$data['post'] = $this->publik_model->laman_show($varParma);
		$data['page'] = array(
			'title'=> $data['post']['post_title'],
			'desc' =>'Open Data APBD Pemerintah Daerah ',
			'image' => base_url('assets/img/logo.png'),
				);
		$data['pageTitle'] = $data['post']['post_title'];
    $this->load->view('pubs/post',$data);
	}
	
}
