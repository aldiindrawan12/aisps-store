<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('checkout_model');
		$this->load->model('pesanan_model');
	}
	public function index()
	{
        $data["username"] = $username = $_SESSION["pelanggan_user"];
        $data["pengguna"] = $this->pesanan_model->getpengguna($username);
        $data["pesanan"] = $this->pesanan_model->getpesanan($data["pengguna"]["id_pengguna"]);
        
        $this->load->view("header",$data);
        $this->load->view("pesanan/pesanan",$data);
        $this->load->view("footer");
    }
}
