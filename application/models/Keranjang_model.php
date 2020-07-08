<?php
error_reporting(0); //menyembunyikan error
class Keranjang_model extends CI_model
{
    public function getpengguna($username){
        $user =  $this->db->get_where("user",array("username"=>$username))->row_array();
        return $this->db->get_where("pengguna",array("id_pengguna"=>$user["id_pengguna"]))->row_array();
    }
    public function getkeranjang($id_pengguna){
        $this->db->join("produk","produk.id_produk = keranjang.id_produk");
        return $this->db->get_where("keranjang",array("id_pengguna"=>$id_pengguna))->result_array();
    }
    public function hapus_keranjang($id_keranjang){
        $this->db->where("id_keranjang",$id_keranjang);
        return $this->db->delete("keranjang");
    }
    public function update_jumlah($id_keranjang,$operasi){
        $data = $this->db->get_where("keranjang",array("id_keranjang"=>$id_keranjang))->row_array();
        $produk = $this->db->get_where("produk",array("id_produk"=>$data["id_produk"]))->row_array();
        $harga = $produk["harga"];
        if($operasi == "min"){
            $new_jumlah_barang = $data["jumlah_barang"] - 1;
        }else{
            $new_jumlah_barang = $data["jumlah_barang"] + 1;
        }

        if($new_jumlah_barang > $produk["stok_produk"]){
            $new_jumlah_barang = $produk["stok_produk"];
        }

        $new_total_harga = $new_jumlah_barang * $harga;
        $this->db->where("id_keranjang",$id_keranjang);
        $this->db->set('jumlah_barang',$new_jumlah_barang ); 
        $this->db->set('total_harga',$new_total_harga ); 
        return $this->db->update('keranjang');
    }
}