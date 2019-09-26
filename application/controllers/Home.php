<?php 

defined('BASEPATH') or exit();

class Home extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Product_model');
    }

    public function index(){

        $data = [];
        $meta['title'] = "MHB's Shop";
        $req['user'] = isLoggedIn() ? $this->User_model->getUserById($this->session->userdata('user')['id']) : NULL;

        // Get newest product limit 20 products
        $query = "
            SELECT * FROM `product_table`ORDER BY date_created DESC LIMIT 20
        ";
        $data['product'] = $this->Product_model->costumQuery($query);

        // Get product by rate limit 5
        $query = "
            SELECT * FROM `product_table` ORDER BY rating DESC LIMIT 5
        ";
        $data['ratedProduct'] = $this->Product_model->costumQuery($query);

        $this->load->view('templates/front-end/header', $meta);
        $this->load->view('templates/front-end/navbar', $req);
        $this->load->view('home/index', $data);
        $this->load->view('templates/front-end/footer');

    }
}