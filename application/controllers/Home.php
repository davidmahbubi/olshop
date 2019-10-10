<?php 

defined('BASEPATH') or exit();

class Home extends CI_Controller{

    public function __construct(){

        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Product_model');
        
    }

    public function index(){

        $meta['title'] = "MHB's Shop";
        
        // Check user is logged in or not, if true, navbar will show exclusive login feature menu
        $req['user'] = isLoggedIn() ? $this->User_model->getUserById($this->session->userdata('user')['id']) : NULL;

        // Get newest product limit 20 products
        $data['product'] = $this->Product_model->getProductLimit(20);

        // Get product by rate limit 4
        $data['ratedProduct'] = $this->Product_model->getProductLimit(4, true, 'rating', 'DESC');

        $this->load->view('templates/front-end/header', $meta);
        $this->load->view('templates/front-end/navbar', $req);
        $this->load->view('home/index', $data);
        $this->load->view('templates/front-end/footer');

    }
}