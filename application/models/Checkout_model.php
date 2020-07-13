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

    public function update_produk($id_produk,$jumlah_pesan){
        $produk = $this->db->get_where("produk",array("id_produk"=>$id_produk))->row_array();
        $stok_baru = $produk["stok_produk"] - $jumlah_pesan;
        $this->db->where("id_produk",$id_produk);
        $this->db->set("stok_produk",$stok_baru);
        return $this->db->update("produk");
    }
}