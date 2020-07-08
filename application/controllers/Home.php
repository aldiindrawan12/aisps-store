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
		$data["pengguna"] = $this->home_model->getpengguna($username);
		$data["produk_bulan"] = $this->home_model->getprodukbulan();
        $this->load->view('header',$data);
		$this->load->view('home/home',$data);
	}

	//fungsi mendapatkan data tabel produk
    public function get_produk()
    {
        $id_produk = $this->input->get('id');
        $data = $this->home_model->getprodukbyid($id_produk);
        echo json_encode($data);
	}
	
	public function add_keranjang(){
		$data["username"] = $username = $_SESSION["pelanggan_user"];
		$data["pengguna"] = $this->home_model->getpengguna($username);
		$keranjang = $this->home_model->getkeranjang($this->input->post("v-id"),$data["pengguna"]["id_pengguna"]);
		if($this->input->post("v-jumlah") < 0){
			$jumlah_barang = 0;
		}else{
			$jumlah_barang = $this->input->post("v-jumlah");
		}

		if($keranjang){
			$this->home_model->update_jumlah($keranjang["id_keranjang"],$jumlah_barang);
		}else{
			$data_keranjang = array (
				"id_pengguna" => $data["pengguna"]["id_pengguna"],
				"id_produk" => $this->input->post("v-id"),
				"total_harga" => $this->input->post("v-harga")*$jumlah_barang,
				"jumlah_barang" => $jumlah_barang
			);
			$this->home_model->add_keranjang($data_keranjang);
		}
		redirect(base_url());
	}
}
