<?php 

defined('BASEPATH') or exit();

class Home extends CI_Controller{

    public function index(){

        $meta['title'] = "MHB's Shop";

        $this->load->view('templates/front-end/header', $meta);
        $this->load->view('templates/front-end/navbar');
        $this->load->view('home/index');
        $this->load->view('templates/front-end/footer');

    }
}