<?php 

defined('BASEPATH') or exit();

class Product extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Product_model');
    }

    public function index(){

        $meta['title'] = 'Product';
        $req['user'] = isLoggedIn() ? $this->User_model->getUserById($this->session->userdata('user')['id']) : NULL;
        $data['product'] = $this->Product_model->getAllProduct();
        $data['categories'] = $this->Product_model->getAllCategories();

        $this->load->view('templates/front-end/header', $meta);
        $this->load->view('templates/front-end/navbar', $req);
        $this->load->view('product/index', $data);
        $this->load->view('templates/front-end/footer');

    }

    public function details($id){

        $meta['title'] = 'Product Details';
        $req['user'] = isLoggedIn() ? $this->User_model->getUserById($this->session->userdata('user')['id']) : NULL;
        // Get and join
        $query = "
            SELECT `product_table`.*, `product_categories_table`.`name` AS 'category_name'
            FROM `product_table` JOIN `product_categories_table`
            ON `category_id` = `product_categories_table`.`id`
            WHERE `product_table`.`id` = 
        " . $id;
        
        $data['product'] = $this->Product_model->costumQuery($query, false);
        $data['review'] = $this->Product_model->getAllReview($id);

        $this->load->view('templates/front-end/header', $meta);
        $this->load->view('templates/front-end/navbar', $req);
        $this->load->view('product/details', $data);
        $this->load->view('templates/front-end/footer');
    }

    public function ajaxFilter(){
        
        if(!$this->input->post()){
            echo json_encode(['stats' => false]);
        } else{

            $filterData = $this->input->post('data');

            foreach($filterData as $index=>$fd){
                if($index === 0){
                    $this->db->where('category_id', $fd);
                } else{
                    $this->db->or_where('category_id', $fd);
                }
            }

            $res = $this->db->get('product_table')->result_array();

            foreach($res as $i=>$r){
                $res[$i]['price'] = formatPrice($res[$i]['price'], 'Rp');
            }
            
            echo json_encode(['stats' => true, 'data' => $res]);
        }
    }

    public function ajaxsearch(){
        if(!$this->input->post()){
            echo json_encode($this->db->get('product_table')->result_array());
        } else{
            $query = $this->input->post('query');
            $query = "SELECT * FROM `product_table` WHERE `name` LIKE '%" . $query ."%'";
            $result = $this->Product_model->costumQuery($query);

            foreach($result as $i=>$r){
                $result[$i]['price'] = formatPrice($result[$i]['price'], 'Rp');
            }
            if($result){
                echo json_encode(['stats' => true, 'data' => $result]);
            } else{
                echo json_encode(['stats' => false]);
            }
        }
    }

    public function buy($id = NULL){

        if(!isLoggedIn()){
            $this->session->set_flashdata('msg', '<div class="alert mt-2 mb-2 alert-danger alert-dismissible fade show" role="alert">
            Log in to buy this product
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('auth'); 
        }

        if(is_null($id)){
            redirect('404');
        } else{

            $product = $this->Product_model->getProductById($id);

            if($this->input->post('qty')){
                $qty = $this->input->post('qty');
            } else{
                $qty = 1;
            }
            $this->cart->destroy();
            $this->cart->insert([
                'id' => $id,
                'qty' => $qty,
                'price' => $product['price'],
                'name' => $product['name'],
                'image' => $product['img']
            ]);
            redirect('checkout');
        }
    }
}