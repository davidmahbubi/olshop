<?php 

defined('BASEPATH') or exit();

class Home extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index(){

        $data = [];
        $meta['title'] = "MHB's Shop";
        $data['user'] = isLoggedIn() ? $this->User_model->getUserById($this->session->userdata('user')['id']) : NULL;

        $this->load->view('templates/front-end/header', $meta);
        $this->load->view('templates/front-end/navbar', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/front-end/footer');

    }
}