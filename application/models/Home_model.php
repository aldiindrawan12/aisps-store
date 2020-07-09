<?php
error_reporting(0); //menyembunyikan error
class Home_model extends CI_model
{
    public function getpengguna($username){
        $user =  $this->db->get_where("user",array("username"=>$username))->row_array();
        return $this->db->get_where("pengguna",array("id_pengguna"=>$user["id_pengguna"]))->row_array();
    }
    public function getprodukminggu(){
        date_default_timezone_set('Asia/Bangkok'); //set timezone waktu
        $tanggal_minggu = date('Y-m-d', strtotime('-7 days', strtotime( date('Y-m-d') )))." 00-00-00";
        $this->db->where("tanggal_masuk >=",$tanggal_minggu);
        return $this->db->get("produk")->result_array();
    }
    public function getprodukbyid($id_produk){
        return $this->db->get_where("produk",array("id_produk"=>$id_produk))->row_array();
    }
    public function add_keranjang($data_keranjang){
        return $this->db->insert("keranjang", $data_keranjang);
    }
    public function add_produk($data_produk){
        return $this->db->insert("produk", $data_produk);
    }
    public function hapus_produk($id_produk){
        $this->db->where("id_produk",$id_produk);
        return $this->db->delete("produk");
    }
    public function getkeranjang($id_produk,$id_pengguna){
        return $this->db->get_where("keranjang",array("id_produk"=>$id_produk,"id_pengguna"=>$id_pengguna))->row_array();
    }
    public function update_jumlah($id_keranjang,$jumlah_barang){
        $data = $this->db->get_where("keranjang",array("id_keranjang"=>$id_keranjang))->row_array();
        $produk = $this->db->get_where("produk",array("id_produk"=>$data["id_produk"]))->row_array();
        $harga = $produk["harga"];
        if(($jumlah_barang + $data["jumlah_barang"]) > $produk["stok_produk"]){
            $new_jumlah_barang = $produk["stok_produk"];
        }else{
            $new_jumlah_barang = $data["jumlah_barang"] + $jumlah_barang;
        }
        $new_total_harga = $new_jumlah_barang * $harga;
        $this->db->where("id_keranjang",$id_keranjang);
        $this->db->set('jumlah_barang',$new_jumlah_barang ); 
        $this->db->set('total_harga',$new_total_harga ); 
        return $this->db->update('keranjang');
    }
    public function edit_produk($data_produk){
        $this->db->where('id_produk',$data_produk["id_produk"]);
        $this->db->update('produk', $data_produk);
    }

    
}