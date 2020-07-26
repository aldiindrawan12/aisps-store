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

    public function count_all(){
        return $this->db->count_all('pesanan'); 
    }

    public function filter($search, $limit, $start, $order_field, $order_ascdesc){    
        $this->db->like('nama_pemesan', $search); 
        $this->db->or_like('alamat', $search); 
        $this->db->or_like('status', $search); 
        $this->db->order_by($order_field, $order_ascdesc); 
        $this->db->limit($limit, $start); 
        return $this->db->get('pesanan')->result_array(); 
    }

    public function count_filter($search){    
        $this->db->like('nama_pemesan', $search); 
        $this->db->or_like('alamat', $search); 
        $this->db->or_like('status', $search); 
        return $this->db->get('pesanan')->num_rows(); 
    }

}