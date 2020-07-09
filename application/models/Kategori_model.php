<?php
error_reporting(0); //menyembunyikan error
class Kategori_model extends CI_model
{
    public function getprodukpria(){
        return $this->db->get_where("produk",array("kategori_produk"=>"Pria"))->result_array();
    }
    public function getprodukwanita(){
        return $this->db->get_where("produk",array("kategori_produk"=>"Wanita"))->result_array();
    }
    public function getprodukanak(){
        return $this->db->get_where("produk",array("kategori_produk"=>"Anak-Anak"))->result_array();
    }
}