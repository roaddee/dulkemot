<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siteman extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('siteman_model');
	}
	   
  public function index(){
		$data['user'] = $this->session->userdata;
		
		$data["pageTitle"] = "Selamat Datang";
		$this->load->view('siteman/siteman_dashboard',$data);
		if(ENVIRONMENT=='development'){
			$this->output->enable_profiler(TRUE);
		}
  }
  public function login(){
		
		$data["form_action"] = site_url('siteman/auth');
		$data["pageTitle"] = "Halaman Authentikasi";
		$this->load->view('siteman/login',$data);
	}

  public function logout(){
		$this->siteman_login->logout();
	}
  
  public function auth(){
		$this->form_validation->set_rules('username','Username','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('password','Password','trim|required');
    	if ($this->input->post('submit')) {

			if($this->form_validation->run() == false) {
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$hasil = $this->siteman_login->login($username,$password, site_url('dasbor'), site_url('login'));
				echo $hasil;

				// 
			}else{
				$this->session->set_flashdata('formValidationError',  validation_errors('<p class="error">', '</p>'));
				redirect('siteman');
				//echo "Dal dul del";
			}
		}
	}
	
  public function profil($tab_aktif=0){
		$data['strMsg'] = (@$_SESSION['strMsg']) ? $_SESSION['strMsg']:false;
		$_SESSION['strMsg'] = "";
		$data['user'] = $this->session->userdata;
		$data['pengguna'] = $this->siteman_model->load_pengguna($data['user']['id']);

		switch ($tab_aktif)
		{
			case 2:
				$data['tab_profil_li'] = "";
				$data['tab_profil'] = "";
				$data['tab_sandi_li'] = "class=\"active\"";
				$data['tab_sandi'] = "active";
				$data['tab_foto_li'] = "";
				$data['tab_foto'] = "";
				break;
			case 1:
				$data['tab_profil_li'] = "";
				$data['tab_profil'] = "";
				$data['tab_sandi_li'] = "";
				$data['tab_sandi'] = "";
				$data['tab_foto_li'] = "class=\"active\"";
				$data['tab_foto'] = "active";
				break;
			case 0:
			default:
				$data['tab_profil_li'] = "class=\"active\"";
				$data['tab_profil'] = "active";
				$data['tab_sandi_li'] = "";
				$data['tab_sandi'] = "";
				$data['tab_foto_li'] = "";
				$data['tab_foto'] = "";
		}
		$data['arsip_foto'] = $this->siteman_model->siteman_user_arsipfoto($data['user']['id']);
		$data['form_profil'] = site_url('siteman/profil_update');
		$data['form_sandi'] = site_url('siteman/profil_update/sandi');
		$data['form_foto'] = site_url('siteman/profil_update/foto');
		$data['tab_aktif'] = $tab_aktif;
		$data['pageTitle'] = "Pengelolaan Data Profil";
		$this->load->view('siteman/siteman_profile',$data);
  }
  
  public function profil_update($varApa = ''){
		$data['user'] = $this->session->userdata;
		$strMsg = false;
		$tab = 0;
		switch ($varApa)
		{
			case "sandi":
				$tab = 2;
				if($this->siteman_model->periksa_passlama($_POST['passwt'],$data['user']['id'])){
					if($this->siteman_model->siteman_gantipass($_POST['passwt'],$data['user']['id'])){
						$strMsg = "Berhasil, password/kata sandi anda sudah berubah sesuai dengan keinginan anda!";
					}
				}else{
					$strMsg = "Maaf, password lama anda salah";
				}
				
				break;
			case "foto":
				$tab = 1;
				$strFoto = _siteman_UploadFoto();
				
				$fotonya = $this->siteman_model->siteman_gantifoto($data['user']['id'],$strFoto);
				if($fotonya){
					$this->session->unset_userdata('foto');
					$foto = array(
						"s"=>base_url('assets/uploads/'.str_replace(".","-s.",$strFoto)),
						"m"=>base_url('assets/uploads/'.str_replace(".","-m.",$strFoto)),
						"a"=>base_url('assets/uploads/'.str_replace(".","-a.",$strFoto)),
						"i"=>base_url('assets/uploads/'.str_replace(".","-i.",$strFoto)),
					);
					$sessfoto = array('foto'=>$foto);
					$this->session->set_userdata($sessfoto);
				}
				
				
				break;
			default:
				
		}
		$_SESSION['strMsg'] = $strMsg;
		redirect('siteman/profil/'.$tab);
		// $this->output->enable_profiler(TRUE);
	}
	
	function lupasandi(){
		$data['captcha_false'] =false;
		$this->load->library('form_validation');
		$this->load->helper('captcha');
		$data['pageTitle'] = "Kirim Sandi Saya";
		$data['form_action'] = site_url('siteman/lupasandi');
		
		/*
		 * Captcha var
		 * 
		 * */
		$vals = array(
			'img_path'      => FCPATH .'assets/captcha/',
			'img_url'       => base_url('assets/captcha/'),
			'font_path'			=> FCPATH .'assets/fonts/lato/lato-bold.ttf',
			'img_width'     => 200,
			'img_height'    => 50,
			'expiration'    => 3600,
			'word_length'   => 5,
			'font_size'     => 20,
			'img_id'        => 'Imageid',
			'pool'          => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',

			// White background and border, black text and red grid
			'colors'        => array(
				'background' => array(255, 255, 255),
				'border' => array(255, 255, 255),
				'text' => array(0, 0, 0),
				'grid' => array(255, 40, 40)
			)
		);
		
		if(@$_POST['kirimsandi']){
			$expiration = time() - 3600; // Two hour limit
			$this->db->where('captcha_time < ', $expiration)
							->delete('tweb_captcha');

			// Then see if a captcha exists:
			$sql = 'SELECT COUNT(*) AS count FROM tweb_captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?';
			$binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
			$query = $this->db->query($sql, $binds);
			$row = $query->row();
			
			$hasil =false;

			if ($row->count == 0){
				
				$data['captcha_false'] = array(true,'Anda harus mengisi kolom ini dgn huruf yang muncul pada gambar di bawah ini.');
				
				$this->load->helper('captcha');

				$cap = create_captcha($vals);
				
				if(function_exists('create_captcha')){
					$todb = array(
									'captcha_time'  => $cap['time'],
									'ip_address'    => $this->input->ip_address(),
									'word'          => $cap['word']
					);

					$query = $this->db->insert_string('tweb_captcha', $todb);
					$this->db->query($query);
					
					$data['capt_img'] = $cap['image'];

					$this->load->view('siteman/login_lupasandi',$data);
				}
				
			}else{
				/*
				 * SUKSES
				 * */
				$cek_email = $this->siteman_model->periksa_email($_POST['username']);

				if(!$cek_email[1]){
					
					/*
					 * Kirim Email
					 * */
					
					$hasil = array(
						'callout'=>'success', 
						'title'=>'Surel Perubahan Sandi Telah Terkirim',
						'pesan'=>'Kami sudah mengirimkan tautan cara mengubah kata sandi anda ke <strong>'.$_POST['username'].'</strong>');
					$data['captcha_false'] = array(true,$hasil);
					
				}else{
					$hasil = array(
						'callout'=>'danger', 
						'title'=>'Alamat Surel Tidak Dikenali',
						'pesan'=>'Maaf, kami tidak bisa memproses permintaan anda, karena alamat surel <strong>'.$_POST['username'].'</strong> tidak terdaftar');
					$data['captcha_false'] = array(true,$hasil);
				}
				$strSQL = "";
				/*
				 * Kirim Email Tautan utk 
				 * */
				$this->load->view('siteman/login_lupasandi_ok',$data);
			}
			 
		}else{

			$this->load->helper('captcha');

			$cap = create_captcha($vals);
			
			if(function_exists('create_captcha')){
				$todb = array(
								'captcha_time'  => $cap['time'],
								'ip_address'    => $this->input->ip_address(),
								'word'          => $cap['word']
				);

				$query = $this->db->insert_string('tweb_captcha', $todb);
				$this->db->query($query);
				
				$data['capt_img'] = $cap['image'];

				$this->load->view('siteman/login_lupasandi',$data);
			}
		}
	}
	
	function create_captcha(){
		$options = array(
			'img_path'=> './capt',
			'img_url'=> base_url('capt'),
			'img_width'=> 150,
			'img_height'=> 30,
			'expiration'=> 7200,
			);
		$cap = create_captcha($options);
		$image = $cap['image'];
		
		$this->session->set_userdata('captchaword',$cap['word']);
		
		return $image;
	}
	
	function siteman_chchap(){
		
	}
}
