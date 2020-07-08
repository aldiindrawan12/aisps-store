<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keranjang extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('keranjang_model');
	}
	public function index()
	{
		$data["username"] = $username = $_SESSION["pelanggan_user"];
        $data["pengguna"] = $this->keranjang_model->getpengguna($username);
        $data["page"] = "keranjang";
        $data["keranjang"] = $this->keranjang_model->getkeranjang($data["pengguna"]["id_pengguna"]);
        $this->load->view('header',$data);
		$this->load->view('keranjang/keranjang',$data);
    }
    
    public function hapus_keranjang($id_keranjang){
        $this->keranjang_model->hapus_keranjang($id_keranjang);
        redirect(base_url("index.php/keranjang"));
    }

    public function update_jumlah($operasi){
        $id_keranjang = $this->input->get('id');
        $this->keranjang_model->update_jumlah($id_keranjang,$operasi);
        echo "berhasil";
    }
}
