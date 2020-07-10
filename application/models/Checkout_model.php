<?php
error_reporting(0); //menyembunyikan error
class Checkout_model extends CI_model
{
    public function addpesanan($data_pesanan){
        //hapus keranjang
        $this->db->where("id_pengguna = ",$data_pesanan["id_pengguna"]);
        $this->db->delete("keranjang");
        //akhir hapus keranjang
        
        return $this->db->insert("pesanan",$data_pesanan);
    }
}