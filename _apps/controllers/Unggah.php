<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unggah extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('siteman_model');
		$this->load->model('lembaga_model');
		$this->load->library('form_validation');
	}

  function index(){
		$data['user'] = $this->session->userdata;
			
    $this->load->view('siteman/unggah',$data);
  }
}
