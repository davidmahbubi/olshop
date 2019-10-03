<?php 

defined('BASEPATH') or exit();

class AdminOrder extends CI_Controller{

    public function __construct(){
        parent::__construct();
        if(!isAdmin()){
            redirect('404');
            die;
        }
        $this->load->model('Order_model');
        $this->load->model('Payment_model');
        $this->load->model('User_model');
    }

    public function index(){

        $meta['title'] = 'Product - MHB\'s Shop';

        $data['allOrder'] = $this->Order_model->getWholeOrder();

        $this->load->view('templates/back-end/header', $meta);
        $this->load->view('templates/back-end/sidebar');
        $this->load->view('templates/back-end/topbar');
        $this->load->view('admin_order/index', $data);
        $this->load->view('templates/back-end/footer');
    }

    public function search(){
        if($this->input->post('query')){
            $this->db->like('id', $this->input->post('query'));
            $result = $this->db->get('order_table')->result_array();
            echo json_encode($result);
        } else{
            redirect('404');
        }
    }

    public function details($orderId = NULL){
        
        if(is_null($orderId)){
            redirect('404');
            die;
        }

        $meta['title'] = 'Product Details';

        $data['order'] = $this->Order_model->getWholeOrderById($orderId);
        $data['ordered_product'] = $this->Payment_model->getOrderedProductByOid($data['order']['order_id']);
        $data['account'] = $this->User_model->getUserById($data['order']['user_id']);

        $this->load->view('templates/back-end/header', $meta);
        $this->load->view('templates/back-end/sidebar');
        $this->load->view('templates/back-end/topbar');
        $this->load->view('admin_order/details', $data);
        $this->load->view('templates/back-end/footer');
    }
}