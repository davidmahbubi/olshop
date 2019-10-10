<?php 

defined('BASEPATH') or exit();

class Admin extends Ci_Controller{

    public function __construct(){

        parent::__construct();

        $this->load->model('Order_model');
        $this->load->model('Product_model');

    }

    public function index(){

        if(!isAdmin()){
            redirect('auth/admin_login');
        }
        
        $meta['title'] = "Admin - MHB's Shop";

        // Retrieve Data
        $data['pendingOrder'] = $this->Order_model->getPendingOrder();
        $data['monthlyOrder'] = $this->Order_model->getMonthlyOrder(time());
        $data['zeroStock'] = $this->Product_model->getEmptyStockProduct();
        $data['monthEarnings'] = formatPrice(array_sum($this->Order_model->getEarningsData(time())), 'Rp');

        $this->load->view('templates/back-end/header', $meta);
        $this->load->view('templates/back-end/sidebar');
        $this->load->view('templates/back-end/topbar');
        $this->load->view('admin/index', $data);
        $this->load->view('templates/back-end/footer');
    }
}