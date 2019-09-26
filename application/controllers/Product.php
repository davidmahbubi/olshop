<?php 

defined('BASEPATH') or exit();

class Product extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Product_model');
    }

    public function index(){

        $meta['title'] = 'Product';
        $req['user'] = isLoggedIn() ? $this->User_model->getUserById($this->session->userdata('user')['id']) : NULL;

        $this->load->view('templates/front-end/header', $meta);
        $this->load->view('templates/front-end/navbar', $req);
        $this->load->view('product/index');
        $this->load->view('templates/front-end/footer');

    }

    public function details($id){

        $meta['title'] = 'Product Details';
        $req['user'] = isLoggedIn() ? $this->User_model->getUserById($this->session->userdata('user')['id']) : NULL;
        // Get and join
        $query = "
            SELECT `product_table`.*, `product_categories_table`.`name` AS 'category_name'
            FROM `product_table` JOIN `product_categories_table`
            ON `category_id` = `product_categories_table`.`id`
            WHERE `product_table`.`id` = 
        " . $id;
        $data['product'] = $this->Product_model->costumQuery($query, false);

        $this->load->view('templates/front-end/header', $meta);
        $this->load->view('templates/front-end/navbar', $req);
        $this->load->view('product/details', $data);
        $this->load->view('templates/front-end/footer');
    }
}