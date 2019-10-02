<?php 

defined('BASEPATH') or exit();

class Admin extends Ci_Controller{

    
    public function index(){

        if(!isAdmin()){
            redirect('auth/admin_login');
        }
        $meta['title'] = "Admin - MHB's Shop";

        $this->load->view('templates/back-end/header', $meta);
        $this->load->view('templates/back-end/sidebar');
        $this->load->view('templates/back-end/topbar');
        $this->load->view('admin/index');
        $this->load->view('templates/back-end/footer');
    }
}