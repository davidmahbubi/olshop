<?php 

defined('BASEPATH') or exit();

class Admin extends Ci_Controller{

    
    public function index(){

        if(!isAdmin()){
            redirect('auth/admin_login');
        }
        $meta['title'] = "Admin - MHB's Shop";

        echo 'Sukses login';
    }
}