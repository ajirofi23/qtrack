<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_Model');
        if(!$this->session->userdata()){
          redirect('AuthController');
        }
    }

    public function index() {
        echo "Halaman User";
    }

    
}
