<?php
error_reporting(0); //menyembunyikan error
class Pesanan_model extends CI_model
{
    public function getpengguna($username){
        $user =  $this->db->get_where("user",array("username"=>$username))->row_array();
        return $this->db->get_where("pengguna",array("id_pengguna"=>$user["id_pengguna"]))->row_array();
    }

    public function getpesanan($id_pengguna){
        return $this->db->get_where("pesanan",array("id_pengguna"=>$id_pengguna))->result_array();
    }
    public function getallpesanan(){
        return $this->db->get("pesanan")->result_array();
    }
    public function getpesananbyid($id_pesanan){
        return $this->db->get_where("pesanan",array("id_pesanan"=>$id_pesanan))->row_array();
    }
    public function pesanan_lunas($id_pesanan){
        $this->db->where("id_pesanan",$id_pesanan);
        $this->db->set("status","LUNAS");
        return $this->db->update("pesanan");
    }
    public function pesanan_dikirim($id_pesanan,$resi){
        $this->db->where("id_pesanan",$id_pesanan);
        $this->db->set("status","Dalam Pengiriman");
        $this->db->set("no_resi",$resi);
        return $this->db->update("pesanan");
    }
    public function update_produk($id_produk,$jumlah_pesan){
        $produk = $this->db->get_where("produk",array("id_produk"=>$id_produk))->row_array();
        $stok_baru = $produk["stok_produk"] + $jumlah_pesan;
        $this->db->where("id_produk",$id_produk);
        $this->db->set("stok_produk",$stok_baru);
        return $this->db->update("produk");
    }
    public function pesanan_cancel($id_pesanan){
        //update stok
        $pesanan = $this->getpesananbyid($id_pesanan);
        $produk_pesanan = json_decode($pesanan["pesanan"],true);
        for($i=0;$i<count($produk_pesanan);$i++){
            echo $produk_pesanan[$i]["id_produk"];
            $this->update_produk($produk_pesanan[$i]["id_produk"],$produk_pesanan[$i]["jumlah"]);
        }
        $this->db->where("id_pesanan",$id_pesanan);
        return $this->db->delete("pesanan");
    }
}