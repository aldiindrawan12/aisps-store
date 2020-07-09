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
		$data["produk_minggu"] = $this->home_model->getprodukminggu();
		$data["status"] = $_SESSION["status"];
		$data["halaman"] = "utama";
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

	public function add_produk(){

		$config['upload_path'] = './assets/img/'; //letak folder file yang akan diupload
        $config['allowed_types'] = 'gif|jpg|png|img|jpeg'; //jenis file yang dapat diterima

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar-produk')) {
            $this->upload->data();
            $gambar =  $this->upload->data('file_name');
        }

		date_default_timezone_set('Asia/Bangkok'); //set timezone waktu
		$data_produk = array(
			"nama_produk" => $this->input->post("nama-produk"),
			"deskripsi" => $this->input->post("deskripsi-produk"),
			"harga" => $this->input->post("harga-produk"),
			"ukuran" => $this->input->post("ukuran-produk"),
			"kategori_produk" => $this->input->post("kategori-produk"),
			"tipe_produk" => $this->input->post("tipe-produk"),
			"stok_produk" => $this->input->post("stok-produk"),
			"diskon" => $this->input->post("diskon-produk"),
			"gambar" => $gambar,
			"tanggal_masuk" => date("Y-m-d H-i-s")
		);
		$this->home_model->add_produk($data_produk);
		redirect(base_url());
	}

	public function edit_produk($asal){

		$config['upload_path'] = './assets/img/'; //letak folder file yang akan diupload
        $config['allowed_types'] = 'gif|jpg|png|img|jpeg'; //jenis file yang dapat diterima

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('vgambar')) {
            $this->upload->data();
            $gambar =  $this->upload->data('file_name');
        }

		$data_produk = array(
			"id_produk" => $this->input->post("vid"),
			"nama_produk" => $this->input->post("vnama"),
			"deskripsi" => $this->input->post("vdeskripsi"),
			"harga" => $this->input->post("vharga"),
			"ukuran" => $this->input->post("vukuran"),
			"kategori_produk" => $this->input->post("vkategori"),
			"tipe_produk" => $this->input->post("vtipe"),
			"stok_produk" => $this->input->post("vstok"),
			"diskon" => $this->input->post("vdiskon"),
			"gambar" => $gambar
		);
		$this->home_model->edit_produk($data_produk);
		if($asal == "pria"){
			redirect(base_url('index.php/kategori/pria'));
		}else if($asal == "wanita"){
			redirect(base_url('index.php/kategori/wanita'));
		}else if($asal == "anak"){
			redirect(base_url('index.php/kategori/anak'));
		}else{
			redirect(base_url());
		}
	}

	public function hapus_produk($id_produk,$asal){
		$this->home_model->hapus_produk($id_produk);
		if($asal == "pria"){
			redirect(base_url('index.php/kategori/pria'));
		}else if($asal == "wanita"){
			redirect(base_url('index.php/kategori/wanita'));
		}else if($asal == "anak"){
			redirect(base_url('index.php/kategori/anak'));
		}else{
			redirect(base_url());
		}
	}
	
	public function search($halaman,$search){
		$search_produk = str_replace('%20', ' ', $search);
		$data["produk_search"] = $this->home_model->search($halaman,$search_produk);
		if($halaman != "utaman"){
			$data["title"] = $halaman;
		}else{
			$data["title"] = "Minggu Ini";
		}
		$this->load->view('home/search',$data);
	}

}
