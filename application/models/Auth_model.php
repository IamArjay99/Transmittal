<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function validateLogin($username, $password)
    {
        $sql = "SELECT * FROM user_account WHERE (username = BINARY '$username' OR email = BINARY '$username') AND password = BINARY '$password'";
        $query  = $this->db->query($sql);
        return $query->result_array();
    }
}
