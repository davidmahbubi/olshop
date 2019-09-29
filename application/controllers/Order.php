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
        $this->load->model('Product_model');
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

    public function review($orderId = NULL){

        if(is_null($orderId)){
            redirect('404');
        } else{

            if($this->input->post('submit_bt')){

                $reviewData = $this->input->post();
                $reviewDatum= [];
                $arrayBuff = [];
                $loop = 1;
                $date_posted = time();
                $user_id = $this->session->userdata('user')['id'];
                
                foreach($reviewData as $index=>$rd){
                    echo $index . " = " . $rd;
                    echo"<br>";
                    $arrayBuff[explode('-',$index)[0]] = $rd;

                    if($loop == 3){
                        $arrayBuff['userId'] = $user_id;
                        $arrayBuff['datePosted'] = $date_posted;
                        $reviewDatum[] = $arrayBuff;
                        $arrayBuff = [];
                        $loop = 0;
                    }
                    $loop++;

                }

                foreach($reviewDatum as $rdtum){
                    if(!empty($rdtum['rating'])){
                        $this->Product_model->addReview($rdtum);
                    }
                }

                $this->session->set_flashdata('msg', '
                <div class="alert alert-success" role="alert">
                Thanks for reviewing !
                </div>');
                redirect('checkout/status/' . urlencode($orderId));
            }

            $meta['title'] = 'My Order';
            $req['user'] = isLoggedIn() ? $this->User_model->getUserById($this->session->userdata('user')['id']) : NULL;

            $query = "  SELECT * FROM `order_table` JOIN `order_identity_table`
            ON `order_table`.`id` = `order_identity_table`.`order_id`
            WHERE `order_table`.`id` = '" . $orderId . "'
            AND `order_identity_table`.`user_id` = " . $this->session->userdata('user')['id'];

            $orderData = $this->Payment_model->costumQuery($query, false);

            if($orderData){

                $meta['title'] = "Order Review";
                $req['user'] = isLoggedIn() ? $this->User_model->getUserById($this->session->userdata('user')['id']) : NULL;

                $data['orderData'] = $orderData;

                // Query for join ordered product and product details
                $query = "  SELECT * FROM `ordered_product_table`
                            JOIN `product_table` ON `ordered_product_table`.`id_product` = `product_table`.`id`
                            WHERE `ordered_product_table`.`order_id` = '" . $orderId . "'";

                $data['orderProduct'] = $this->Payment_model->costumQuery($query);
                $data['orderStatus'] = $this->Payment_model->getOrderStatusById($orderData['order_status']);

                if($data['orderStatus']['id'] != 6){
                    redirect('404');
                }

                $this->load->view('templates/front-end/header', $meta);
                $this->load->view('templates/front-end/navbar', $req);
                $this->load->view('order/review', $data);
                $this->load->view('templates/front-end/footer');

            } else{
                redirect('404');
            }
        }
    }
}
