<?php 

defined('BASEPATH') or exit();

class Product extends CI_Controller{

    public function index(){

        $meta['title'] = 'Product';

        $this->load->view('templates/front-end/header', $meta);
        $this->load->view('templates/front-end/navbar');
        $this->load->view('product/index');
        $this->load->view('templates/front-end/footer');

    }
}