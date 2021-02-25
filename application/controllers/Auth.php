<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Auth_model", "auth");
    }

	public function index()
	{
        $this->load->view('login/index');
    }
    
    public function validateLogin()
    {
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $result   = $this->auth->validateLogin($username, $password);
        if (count($result) > 0) {
            $this->session->set_userdata("session_userID", $result[0]["user_accountID"]);
            echo json_encode("true|Log In Successfully");
        } else {
            echo json_encode("false|Incorrect username/email or password");
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('session_userID');
        redirect(base_url());
    }
}
