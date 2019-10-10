<?php 

defined('BASEPATH') or exit();

class Cart extends CI_Controller{

    public function __construct(){

        parent::__construct();
        
        // User must be logged in to access this controller

        if(!isLoggedIn()){

            $this->session->set_flashdata('msg', '
                <div class="alert mt-2 mb-2 alert-danger alert-dismissible fade show" role="alert">
                Please log in to use cart
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('auth');

            die;
        }

        $this->load->model('User_model');

    }

    public function index(){

        $meta['title'] = "My Cart";

        // Give empty array to variable data, to prevent variable error when cart is empty

        $data = [];
        $req['user'] = isLoggedIn() ? $this->User_model->getUserById($this->session->userdata('user')['id']) : NULL;
        $data['cart'] = $this->cart->contents();

        $this->load->view('templates/front-end/header', $meta);
        $this->load->view('templates/front-end/navbar', $req);
        $this->load->view('cart/index', $data);
        $this->load->view('templates/front-end/footer');
    }

    public function addToCart(){

        if(!$this->input->post()){

            echo json_encode(['stats' => false, 'msg' => 'Product identity needed !']);

        } else{

            $data = [
                'id' => $this->input->post('id'),
                'qty' => $this->input->post('total'),
                'price' => $this->input->post('price'),
                'name' => $this->input->post('name'),
                'image' => $this->input->post('image')
            ];

            $this->cart->insert($data);

            echo json_encode(['stats' => true, 'data' => $this->cart->contents()]);

        }
    }

    public function edittotal(){

        if(!$this->input->post()){

            echo json_encode(['stats' => false, 'msg' => 'no post data found !']);
            
        } else{

            $total = $this->input->post('total');

            if($total <= 0){
                $total = 1;
            }

            $data = [
                'rowid' => $this->input->post('rowid'),
                'qty' => $total
            ];

            $this->cart->update($data);

            $data['curItem'] = $this->cart->get_item($this->input->post('rowid'));
            $data['curItem']['subtotal'] = formatPrice($data['curItem']['subtotal']);
            $data['totalPrice'] = formatPrice($this->cart->total());
            
            echo json_encode(['stats' => true, 'data' => $data]);
        }
    }

    public function removeCartItem($rowid){
        $this->cart->remove($rowid);
        redirect('cart');
    }
}