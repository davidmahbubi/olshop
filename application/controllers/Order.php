<?php 

defined('BASEPATH') or exit();

class Order extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if(!isLoggedIn()){
            redirect('404');
        }

        $this->load->model('User_model');
        $this->load->model('Payment_model');
    }
    
    public function index(){

        $meta['title'] = 'My Order';
        $req['user'] = isLoggedIn() ? $this->User_model->getUserById($this->session->userdata('user')['id']) : NULL;

        $query = "  SELECT * FROM `order_table` JOIN `order_identity_table`
                    ON `order_identity_table`.`order_id` = `order_table`.`id`
                    WHERE `order_identity_table`.`user_id` = " . $this->session->userdata('user')['id'];

        $data['order'] = $this->Payment_model->costumQuery($query);
        $data['status'] = [];

        foreach($data['order'] as $d){
            $data['status'][] = $this->Payment_model->getOrderStatusById($d['order_status']);
        }

        $this->load->view('templates/front-end/header', $meta);
        $this->load->view('templates/front-end/navbar', $req);
        $this->load->view('order/index', $data);
        $this->load->view('templates/front-end/footer');
    }
}