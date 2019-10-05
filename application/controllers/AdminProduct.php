<?php 

defined('BASEPATH') or exit();

class AdminProduct extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if(!isAdmin()){
            redirect('404');
        }

        $this->load->model('Product_model');
    }

    public function index(){

        $meta['title'] = "Product List";

        $data['allProduct'] = $this->Product_model->getAllProduct(false);
        $data['outOfStock'] = [];

        foreach($data['allProduct'] as $ap){
            if($ap['stock'] == 0){
                $data['outOfStock'][] = $ap;
            }
        }

        $this->load->view('templates/back-end/header', $meta);
        $this->load->view('templates/back-end/sidebar');
        $this->load->view('templates/back-end/topbar');
        $this->load->view('admin_product/index', $data);
        $this->load->view('templates/back-end/footer');
    }

    public function details($id = NULL){
        if(is_null($id)){
            redirect('404');
        } else{

            $meta['title'] = 'Product Details';
            $data['product'] = $this->Product_model->getProductById($id, false);
            $data['buyTimes'] = count($this->Product_model->getBuyedProduct($id));
            $data['categoryResult'] = $this->Product_model->getAllCategories();
            $data['category'] = [];

            // Replace original default numeric index from result of db query, so the category id will be index of categoriy array

            foreach($data['categoryResult'] as $c){
                $data['category'][$c['id']] = $c;
            }
            unset($data['categoryResult']);

            $this->load->view('templates/back-end/header', $meta);
            $this->load->view('templates/back-end/sidebar');
            $this->load->view('templates/back-end/topbar');
            $this->load->view('admin_product/details', $data);
            $this->load->view('templates/back-end/footer');
        }
    }

    public function search(){
        if(!$this->input->post('query')){
            redirect('404');
        } else{
            $this->db->like('name', $this->input->post('query'));
            $this->db->order_by('date_created', 'DESC');
            $result = $this->db->get('product_table')->result_array();
            echo json_encode($result);
        }
    }

    public function order(){
        if(!$this->input->post()){
            redirect('404');
        } else{

            $this->db->order_by($this->input->post('order_by'), 'ASC');
            $result = $this->db->get('product_table')->result_array();

            foreach($result as $i=>$r){
                $result[$i]['price'] = formatPrice($r['price'], 'Rp');
                $result[$i]['date_created'] = date('d F Y', $r['date_created']);
            }
            echo json_encode($result);
        }
    }
}