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
        $data["status"] = $_SESSION["status"];
        $this->load->view("header",$data);
        $this->load->view("pesanan/pesanan",$data);
        $this->load->view("footer");
    }

    public function get_pesanan(){
        $id_pesanan = $this->input->get('id');
        $data = $this->pesanan_model->getpesananbyid($id_pesanan);
        echo json_encode($data);
    }

    public function pesanan_lunas($id_pesanan){
        $this->pesanan_model->pesanan_lunas($id_pesanan);
        redirect(base_url("index.php/pesanan"));
    }

    public function pesanan_dikirim($id_pesanan){
        $resi = $this->input->post("no_resi");
        $this->pesanan_model->pesanan_dikirim($id_pesanan,$resi);
        redirect(base_url("index.php/pesanan/pesanan_pengguna"));
    }

    public function pesanan_cancel($id_pesanan){
        $this->pesanan_model->pesanan_cancel($id_pesanan);
        redirect(base_url("index.php/pesanan/pesanan_pengguna"));
    }

    public function pesanan_pengguna(){
        $data["username"] = $username = $_SESSION["pelanggan_user"];
        $data["pengguna"] = $this->pesanan_model->getpengguna($username);
        $data["pesanan"] = $this->pesanan_model->getallpesanan();
        $data["status"] = $_SESSION["status"];
        $this->load->view("header",$data);
        $this->load->view("pesanan/pesanan_pengguna",$data);
        $this->load->view("footer");
    }

}
