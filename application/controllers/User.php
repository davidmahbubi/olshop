<?php 

defined('BASEPATH') or exit();

class User extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index(){

        $meta['title'] = 'Product Details';
        $req['user'] = isLoggedIn() ? $this->User_model->getUserById($this->session->userdata('user')['id']) : NULL;

        $this->load->view('templates/front-end/header', $meta);
        $this->load->view('templates/front-end/navbar', $req);
        $this->load->view('user/index', $req);
        $this->load->view('templates/front-end/footer');
    }
}