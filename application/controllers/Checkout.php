<?php 

defined('BASEPATH') or exit();

class Checkout extends CI_Controller{

    public function __construct(){

        parent::__construct();
        
        if(!isLoggedIn()){
            redirect('404');
        }
        
        $this->load->model('User_model');
        $this->load->model('Payment_model');

    }

    public function index(){

        $meta['title'] = "Checkout";
        $req['user'] = isLoggedIn() ? $this->User_model->getUserById($this->session->userdata('user')['id']) : NULL;
        $data['courier'] = $this->Payment_model->getAllCourier();
        $data['curAdd'] = $this->session->userdata('shipAddress');

        $this->form_validation->set_rules('name', 'name', 'required|trim');
        $this->form_validation->set_rules('phone_number', 'phone number', 'required|numeric|trim');
        $this->form_validation->set_rules('address', 'complete address', 'required|trim');
        $this->form_validation->set_rules('postal', 'postal code', 'required|numeric|trim|min_length[5]');

        if(!$this->form_validation->run()){

            $this->load->view('templates/front-end/header', $meta);
            $this->load->view('templates/front-end/navbar', $req);
            $this->load->view('checkout/index', $data);
            $this->load->view('templates/front-end/footer');

        } else{

            $data = [
                'name' => $this->input->post('name'),
                'phoneNumber' => $this->input->post('phone_number'),
                'address' => $this->input->post('address'),
                'postal' => $this->input->post('postal'),
                'courier' => $this->input->post('courier')
            ];
            $this->session->set_userdata(['shipAddress' => $data]);
            redirect('checkout/payment');
        }
    }

    public function payment(){

        $meta['title'] = "Payment";
        $req['user'] = isLoggedIn() ? $this->User_model->getUserById($this->session->userdata('user')['id']) : NULL;
        $data['cart'] = $this->cart->contents();

        if(isset($_FILES['receiptImg'])){

            $uploadImg = $this->Payment_model->uploadReceipt();

            if($uploadImg['stats']){

                $receiptImgName = $uploadImg['data']['file_name'];
                $orderedProduct = $data['cart'];
                $orderId = uniqid('mhb-ord-',);

                // Prepare order identity
                $orderIdentity = $this->session->userdata('shipAddress');
                $orderIdentity['orderId'] = $orderId;
                $orderIdentity['receiptImg'] = $receiptImgName;
                $orderIdentity['userId'] = $req['user']['id'];

                // Make an order
                $this->Payment_model->makeOrder($orderId);

                // Make order identity
                $this->Payment_model->addProductIdentity($orderIdentity);

                // Register ordered product
                foreach($orderedProduct as $op){
                    $this->Payment_model->addOrderedProduct($op, $orderId);
                }

                $this->cart->destroy();

                redirect('checkout/status/' . urlencode($orderId));

            } else{
                $this->session->set_flashdata('msg', '
                <div class="alert alert-danger" role="alert">
                ' . $uploadImg['data'] .'
                </div>');
                redirect('checkout/payment');
            }
        } else{
            $this->load->view('templates/front-end/header', $meta);
            $this->load->view('templates/front-end/navbar', $req);
            $this->load->view('checkout/payment', $data);
            $this->load->view('templates/front-end/footer');
        }
    }

    public function status($orderId = NULL){

        if(is_null($orderId)){
            redirect('404');
        } else{

            $query = "  SELECT * FROM `order_table` JOIN `order_identity_table`
                        ON `order_table`.`id` = `order_identity_table`.`order_id`
                        WHERE `order_table`.`id` = '" . $orderId . "'
                        AND `order_identity_table`.`user_id` = " . $this->session->userdata('user')['id'];
            $orderData = $this->Payment_model->costumQuery($query, false);
            
            if($orderData){

                $meta['title'] = "Order Status";
                $req['user'] = isLoggedIn() ? $this->User_model->getUserById($this->session->userdata('user')['id']) : NULL;

                $data['orderData'] = $orderData;

                // Query for join ordered product and product details
                $query = "  SELECT * FROM `ordered_product_table`
                            JOIN `product_table` ON `ordered_product_table`.`id_product` = `product_table`.`id`
                            WHERE `ordered_product_table`.`order_id` = '" . $orderId . "'";
                $data['orderProduct'] = $this->Payment_model->costumQuery($query);
                $data['orderStatus'] = $this->Payment_model->getOrderStatusById($orderData['order_status']);
                $data['courierData'] = $this->Payment_model->getCourierById($orderData['courier_id']);

                $this->load->view('templates/front-end/header', $meta);
                $this->load->view('templates/front-end/navbar', $req);
                $this->load->view('checkout/status', $data);
                $this->load->view('templates/front-end/footer');

            } else{
                redirect('404');
            }

        }
    }
}