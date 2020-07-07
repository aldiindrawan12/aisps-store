<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}
	public function index()
	{
		$data["username"] = $username = $_SESSION["pelanggan_user"];
		$data["login"] = "tue";
		$data["pengguna"] = $this->home_model->getpengguna($username);
        $this->load->view('header',$data);
		$this->load->view('home/home',$data);
	}
}
