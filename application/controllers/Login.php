<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('login_model');
	}
	public function index()
	{
		$this->load->view('login/login');
	}
	public function login(){
		//validasi form
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		//akhir validasi form
		if ($this->form_validation->run() == false) { //jika validasi tidak gagal
			$this->load->view('login/login');
		} else {
			$this->validationLogin();
		}
	}

	public function validationLogin(){
		$username = $this->input->post('username'); //ambil value dari form
		$password = $this->input->post('password'); //ambil value dari form
		$user = $this->login_model->getuser($username); //ambil data user
		
		if ($user) { //jika hasil ada
			$saved_password = password_hash($user['password'], PASSWORD_DEFAULT); 
			if(password_verify($password, $saved_password)){//cek kecocokan password
				//set session
				if($username == "admin12"){
					$_SESSION["status"] = "admin";
				}else{
					$_SESSION["status"] = "pengguna";
				}
				$_SESSION["login"] = true;
				$_SESSION["pelanggan_user"] = $username;
				$_SESSION["id_pelanggan"] = $user["id_pengguna"];
				//akhir set session
				redirect(base_url('index.php/home/index/'));
			} else {
				redirect(base_url('index.php/login/index'));
			}
		} else {
			redirect(base_url('index.php/login/index/'));
		}
		//redirect("http://localhost/aisps_store/");		
	}

	public function logout(){
		session_destroy();
		redirect(base_url('index.php/home/index/'));
	}
}
