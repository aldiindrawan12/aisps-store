<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('kategori_model');
    }
    
	public function pria()
	{
		$data["username"] = $username = $_SESSION["pelanggan_user"];
		$data["pengguna"] = $this->home_model->getpengguna($username);
		$data["produk_pria"] = $this->kategori_model->getprodukpria();
		$data["status"] = $_SESSION["status"];
		$data["halaman"] = "Pria";
        $this->load->view('header',$data);
		$this->load->view('home/pria',$data);
		$this->load->view('footer');
	}
	
	public function wanita()
	{
		$data["username"] = $username = $_SESSION["pelanggan_user"];
		$data["pengguna"] = $this->home_model->getpengguna($username);
		$data["produk_wanita"] = $this->kategori_model->getprodukwanita();
		$data["status"] = $_SESSION["status"];
		$data["halaman"] = "Wanita";
        $this->load->view('header',$data);
		$this->load->view('home/wanita',$data);
		$this->load->view('footer');
    }
	
	public function anak()
	{
		$data["username"] = $username = $_SESSION["pelanggan_user"];
		$data["pengguna"] = $this->home_model->getpengguna($username);
		$data["produk_anak"] = $this->kategori_model->getprodukanak();
		$data["status"] = $_SESSION["status"];
		$data["halaman"] = "Anak-Anak";
        $this->load->view('header',$data);
		$this->load->view('home/anak',$data);
		$this->load->view('footer');
    }
}
