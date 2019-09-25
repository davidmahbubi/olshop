<?php 

defined('BASEPATH') or exit();

class Cart extends CI_Controller{

    public function __construct(){

        parent::__construct();
        if(!isLoggedIn()){
            $this->session->set_flashdata('msg', '
            <div class="alert mt-2 mb-2 alert-danger alert-dismissible fade show" role="alert">
                Please log in to use cart
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('auth');
            die;
        }
        $this->load->model('User_model');
    }

    public function index(){

        $data = [];
        $meta['title'] = "My Cart";
        $data['user'] = isLoggedIn() ? $this->User_model->getUserById($this->session->userdata('user')['id']) : NULL;

        $this->load->view('templates/front-end/header', $meta);
        $this->load->view('templates/front-end/navbar', $data);
        $this->load->view('cart/index', $data);
        $this->load->view('templates/front-end/footer');
    }
}