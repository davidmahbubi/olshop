<?php 

class Payment_model extends CI_Model{

    public function getAllCourier(){
        return $this->db->get('courier_table')->result_array();
    }

    public function uploadReceipt(){
        
        $config['upload_path'] = './assets/img/receipt/';
        $config['allowed_types'] = 'jpg|jpeg|png|bmp';
        $config['max_size'] = '2048';

        $this->load->library('upload', $config);

        if($this->upload->do_upload('receiptImg')){
            return ['stats' => true, 'data' => $this->upload->data()];
        } else{
            return ['stats' => false, 'data' => $this->upload->display_errors()];
        }
    }

    public function addProductIdentity($data){

        $data = [
            'order_id' => $data['orderId'],
            'receiver_name' => htmlspecialchars($data['name']),
            'complete_address' => htmlspecialchars($data['address']),
            'postal' => htmlspecialchars($data['postal']),
            'courier_id' => $data['courier'],
            'phone_number' => htmlspecialchars($data['phoneNumber']),
            'transfer_proof_img' => $data['receiptImg'],
            'user_id' => $data['userId']
        ];

        $this->db->insert('order_identity_table', $data);
    }

    public function makeOrder($id){
        $data = [
            'id' => $id,
            'order_date' => time(),
            'order_status' => 1
        ];
        $this->db->insert('order_table', $data);
    }

    public function addOrderedProduct($data, $orderId){
        $data = [
            'order_id' => $orderId,
            'id_product' => $data['id'],
            'total' => $data['qty'],
            'sub_total' => $data['subtotal']
        ];
        $this->db->insert('ordered_product_table', $data);
    }

    public function getOrder($orderId){
        return $this->db->get_where('order_table', ['id' => $orderId])->row_array();
    }

    public function costumQuery($query, $resultSet = true){
        if($resultSet){
            return $this->db->query($query)->result_array();
        } else{
            return $this->db->query($query)->row_array();
        }
    }

    public function getOrderedProductByOid($orderId){
        return $this->db->get_where('ordered_product_table', ['order_id' => $orderId])->result_array();
    }

    public function getOrderStatusById($id){
        return $this->db->get_where('order_status_table', ['id' => $id])->row_array();
    }

    public function getCourierById($id){
        return $this->db->get_where('courier_table', ['id' => $id])->row_array();
    }
}