<?php 

defined('BASEPATH') or exit();

class Fail extends CI_Controller{

    public function index(){
        $this->load->view('fail/404');
    }
}