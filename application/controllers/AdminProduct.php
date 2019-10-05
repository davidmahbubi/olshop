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

    public function addProduct(){

        $meta['title'] = "Add Product";
        $data['category'] = $this->Product_model->getAllCategories();

        $this->form_validation->set_rules('name', 'product name' , 'required|trim');
        $this->form_validation->set_rules('price', 'price' , 'required|numeric|trim');
        $this->form_validation->set_rules('stock', 'stock' , 'required|numeric|trim');
        $this->form_validation->set_rules('weight', 'wight' , 'required|numeric|trim');
        $this->form_validation->set_rules('description', 'description' , 'required|trim');

        if(!$this->form_validation->run()){

            $this->load->view('templates/back-end/header', $meta);
            $this->load->view('templates/back-end/sidebar');
            $this->load->view('templates/back-end/topbar');
            $this->load->view('admin_product/add', $data);
            $this->load->view('templates/back-end/footer');

        } else{

            // Upload image first, then after image success uploaded, product identity will be processed
            $uploadImage = $this->uploadProductImage();

            if($uploadImage['stats']){

                $data = $this->input->post();
                
                // Merging new image file name to array data
                $data['img'] = $uploadImage['data']['file_name'];

                $this->Product_model->addProduct($data);

                $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                New Product Posted !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');

                redirect('AdminProduct/addproduct');
            } else{

                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                '. $uploadImage['data'] .'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                
                redirect('AdminProduct/addproduct');
            }
        }
    }

    public function productCategory(){

        $meta['title'] = "Product Categories";
        $data['categories'] = $this->Product_model->getAllCategories();

        $this->load->view('templates/back-end/header', $meta);
        $this->load->view('templates/back-end/sidebar');
        $this->load->view('templates/back-end/topbar');
        $this->load->view('admin_product/categories', $data);
        $this->load->view('templates/back-end/footer');

    }

    public function details($id = NULL){

        if(is_null($id)){

            redirect('404');

        } else{

            $this->form_validation->set_rules('name', 'product name' , 'required|trim');
            $this->form_validation->set_rules('price', 'price' , 'required|numeric|trim');
            $this->form_validation->set_rules('stock', 'stock' , 'required|numeric|trim');
            $this->form_validation->set_rules('weight', 'weight' , 'required|numeric|trim');
            $this->form_validation->set_rules('description', 'description' , 'required|trim');

            if(!$this->form_validation->run()){

                $meta['title'] = 'Product Details';
                $data['product'] = $this->Product_model->getProductById($id, false);
                $data['buyTimes'] = $this->Product_model->getBuyedProduct($id);
                if(is_null($data['buyTimes'])){
                    $data['buyTimes'] = 0;
                } else{
                    $data['buyTimes'] = count($data['buyTimes']);
                }
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

            } else{

                $this->Product_model->updateProduct($id, $this->input->post());

                if($_FILES['img']['error'] != 4){

                    $uploadImage = $this->uploadProductImage();

                    if($uploadImage['stats']){

                        $oldFileName = $this->Product_model->getProductById($id, false)['img'];
                        $newFileName = $uploadImage['data']['file_name'];

                        $this->Product_model->updateProductImg($id, $oldFileName, $newFileName);
                        $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Product Details Updated
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');
                        redirect('AdminProduct/details/' . $id);
                        
                    } else{

                        $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        '. $uploadImage['data'] .'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');

                        redirect('AdminProduct/details/' . $id);

                    }
                }
                $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Product Details Updated
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('AdminProduct/details/' . $id);
            }
        }
    }

    public function categoryAjax(){
        if(!$this->input->post('category_id')){
            redirect('404');
        } else{
            $category = $this->Product_model->getCategoryById($this->input->post('category_id'));
            echo json_encode($category);
        }
    }

    public function editCategory(){
        if(!$this->input->post()){
            redirect('404');
        } else{
            $edit = $this->Product_model->editCategory($this->input->post('id'), $this->input->post('name'));
            if($edit){
                echo json_encode(['stats' => true, 'name' => $this->input->post('name')]);
            } else{
                echo json_encode(['stats' => false]);
            }
        }
    }

    public function addCategory(){
        if(!$this->input->post()){
            redirect('404');
        } else{
            if($this->Product_model->addCategory($this->input->post('name'))){
                echo json_encode(['stats' => true]);
            } else{
                echo json_encode(['stats' => false]);
            }
        }
    }

    public function deleteCategory(){
        if(!$this->input->post()){
            redirect('404');
        } else{
            if($this->Product_model->deleteCategory($this->input->post('id'))){
                echo json_encode(['stats' => true]);
            } else{
                echo json_encode(['stats' => false]);
            }
        }
    }

    public function deleteProduct($id = NULL){
        if(is_null($id)){
            redirect('404');
        } else{
            $this->Product_model->deleteProduct($id);
            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Product Deleted
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('AdminProduct');
        }
    }

    private function uploadProductImage(){

        $config['upload_path'] = './assets/img/product/';
        $config['allowed_types'] = 'jpeg|png|jpg|bmp';
        $config['max_size'] = 1024;
        $config['file_ext_tolower'] = true;

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('img')){
            return ['stats' => false, 'data' => $this->upload->display_errors()];
        } else{
            return ['stats' => true, 'data' => $this->upload->data()];
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