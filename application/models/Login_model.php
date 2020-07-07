<?php
error_reporting(0); //menyembunyikan error
class Login_model extends CI_model
{
    public function getuser($username){
        return $this->db->get_where("user",array("username"=>$username))->row_array();
    }
}