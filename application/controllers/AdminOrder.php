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
        $data['order_status'] = $this->Order_model->getAllStatus();

        if(isset($_POST['updateAirwayBill'])){
            $this->Order_model->addAirwayBill($orderId, htmlspecialchars($this->input->post('airwayBill')));
            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Airway Bill Updated !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('AdminOrder/details/' . $orderId);
        }

        if($this->input->post('orderStatus')){

            if($this->input->post('airwayBill')){
                $this->Order_model->updateStatus($orderId, htmlspecialchars($this->input->post('orderStatus')));
                $this->Order_model->addAirwayBill($orderId, htmlspecialchars($this->input->post('airwayBill')));
            }else{
                $this->Order_model->updateStatus($orderId, htmlspecialchars($this->input->post('orderStatus')));
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Details Updated !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('AdminOrder/details/' . $orderId);
        } else{
            $this->load->view('templates/back-end/header', $meta);
            $this->load->view('templates/back-end/sidebar');
            $this->load->view('templates/back-end/topbar');
            $this->load->view('admin_order/details', $data);
            $this->load->view('templates/back-end/footer');
        }
    }

    public function user($id = NULL){
        if(is_null($id)){

            redirect('404');

        } else{

            $data['user'] = $this->User_model->getUserById($id);

            $meta['title'] = 'User Details';

            $this->load->view('templates/back-end/header', $meta);
            $this->load->view('templates/back-end/sidebar');
            $this->load->view('templates/back-end/topbar');
            $this->load->view('admin_order/user', $data);
            $this->load->view('templates/back-end/footer');
        }
    }

    public function pendingOrder(){

        $meta['title'] = 'Product Details';

        $data['pendingOrder'] = $this->Order_model->getPendingOrder(true);

        $this->load->view('templates/back-end/header', $meta);
        $this->load->view('templates/back-end/sidebar');
        $this->load->view('templates/back-end/topbar');
        $this->load->view('admin_order/pending', $data);
        $this->load->view('templates/back-end/footer');
        
    }

    public function receipt($orderId = NULL){

        if(is_null($orderId)){
            redirect('404');
            die;
        }

        $data['order'] = $this->Order_model->getWholeOrderById($orderId);
        $this->load->view('admin_order/receipt', $data);
    }

    public function approve_order($orderId = NULL){
        
        if(is_null($orderId)){
            redirect('404');
            die;
        }

        $this->Order_model->updateStatus($orderId, 2);
        $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Order Approved
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('AdminOrder/details/' . $orderId);
    }

    public function decline_order($orderId = NULL){

        if(is_null($orderId)){
            redirect('404');
            die;
        }

        $this->Order_model->updateStatus($orderId, 7);
        $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Order Declined
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('AdminOrder/pendingorder');
    }

    public function orderByAjax(){

        if(!$this->input->post()){
            echo json_encode(['stats' => false]);
        } else{
            $data = $this->Order_model->getPendingOrder(true, $this->input->post('order_by'), 'ASC');
            foreach($data as $i=>$d){
                $data[$i]['order_date'] = date('d F Y', $d['order_date']);
            }
            echo json_encode($data);
        }
    }

    public function uncomplete(){

        $meta['title'] = 'Product Details';

        $data['uncompleteOrder'] = $this->Order_model->getUncompleteOrder();
        $data['proccessOwner'] = [];
        $data['onTheWay'] = [];
        $data['declined'] = [];

        foreach($data['uncompleteOrder'] as $uc){
            switch($uc['order_status']){
                case 2 :
                    $data['proccessOwner'][] = $uc;
                    break;
                case 3:
                    $data['onTheWay'][] = $uc;
                    break;
                case 7:
                    $data['declined'][] = $uc;
                    break;    
            }
        }

        $this->load->view('templates/back-end/header', $meta);
        $this->load->view('templates/back-end/sidebar');
        $this->load->view('templates/back-end/topbar');
        $this->load->view('admin_order/uncomplete', $data);
        $this->load->view('templates/back-end/footer');
    }
}