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
}