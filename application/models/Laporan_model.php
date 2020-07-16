<?php
//error_reporting(0); //menyembunyikan error
class Laporan_model extends CI_model
{
   public function getallproduk(){
       return $this->db->get("produk")->result_array();
   }
   public function getlaporan(){
    return $this->db->get("laporan_penjualan")->result_array();
}
}