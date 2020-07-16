<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model('laporan_model');
        $this->load->model('pesanan_model');
    }

    public function index(){
        $data["username"] = $username = $_SESSION["pelanggan_user"];
        $data["status"] = $_SESSION["status"];
        $data["halaman"] = "laporan";
        $data["produk"] = $this->laporan_model->getallproduk();
        $data["pengguna"] = $this->pesanan_model->getpengguna($username);
        $data["terjual"] = $this->laporan_model->getlaporan();
        $this->load->view('header',$data);
        $this->load->view('laporan/laporan',$data);
        $this->load->view('footer');
    }
    
}