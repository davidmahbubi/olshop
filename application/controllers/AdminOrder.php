<?php 

defined('BASEPATH') or exit();

class AdminOrder extends CI_Controller{

    public function __construct(){
        parent::__construct();
        if(!isAdmin()){
            redirect('404');
            die;
        }
    }

    public function index(){

        $meta['title'] = 'Product - MHB\'s Shop';

        $this->load->view('templates/back-end/header', $meta);
        $this->load->view('templates/back-end/sidebar');
        $this->load->view('templates/back-end/topbar');
        $this->load->view('admin_order/index');
        $this->load->view('templates/back-end/footer');
    }
}