<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('checkout_model');
		$this->load->model('keranjang_model');
	}
	public function index()
	{
		$data["username"] = $username = $_SESSION["pelanggan_user"];
		$data["status"] = $_SESSION["status"];
		$data["pengguna"] = $this->keranjang_model->getpengguna($username);
		$data["keranjang"] = $this->keranjang_model->getkeranjang($data["pengguna"]["id_pengguna"]);
		$data["halaman"] = "checkout";
		$this->load->view('header',$data);
		$this->load->view('checkout/checkout',$data);
		$this->load->view('footer');
	}
	
	public function addpesanan(){
		date_default_timezone_set('Asia/Bangkok'); //set timezone waktu
		$data["username"] = $username = $_SESSION["pelanggan_user"];
		$data["pengguna"] = $this->keranjang_model->getpengguna($username);

		//data dari form
		$nama = $this->input->post("nama");
		$alamat = $this->input->post("alamat");
		$no = $this->input->post("no");
		$pesan_pelanggan = $this->input->post("pesan-pelanggan");
		//akhir data dari form

		$keranjang = $this->keranjang_model->getkeranjang($data["pengguna"]["id_pengguna"]);

		$array_produk = Array (
		);

		foreach($keranjang as $value){
			$data_produk = array(
				"id_produk" => $value["id_produk"],
				"nama_produk" => $value["nama_produk"],
				"ukuran" => $value["ukuran"],
				"jumlah" => $value["jumlah_barang"],
				"total" => $value["total_harga"]
			);
			array_push($array_produk,$data_produk);
			$this->checkout_model->update_produk($value["id_produk"],$value["jumlah_barang"]);
		}
		
		//hitung total pembayaran
		$total = 0;
		foreach ($keranjang as $value){
			$total += $value["total_harga"];
		}

		// encode array to json
		$json = json_encode($array_produk);
		//$decode = json_decode($json,true);

		//data untuk isi database
		$data_pesanan = array(
			"nama_pemesan" => $nama,
			"alamat" => $alamat,
			"no" => $no,
			"status" => "Menunggu Pembayaran",
			"pesanan" => $json,
			"id_pengguna" => $data["pengguna"]["id_pengguna"],
			"total" => $total,
			"pesan_pelanggan" => $pesan_pelanggan,
			"tanggal_pesanan" => date("Y-m-d H-i-s")


		);		
		//akhir data untuk isi database
		$this->checkout_model->addpesanan($data_pesanan);
		redirect(base_url("index.php/pesanan"));
		
	}
}