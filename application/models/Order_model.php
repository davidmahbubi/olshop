<?php 

class Order_model extends CI_Model{

    public function getAllOrder(){
        return $this->db->get('order_table')->result_array();
    }

    public function getPendingOrder(){
        $this->db->join('order_identity_table', 'order_id = order_table.id');
        $this->db->order_by('order_date', 'ASC'); // Order `pending order` as date_order ascending, mean past first
        return $this->db->get_where('order_table', ['order_status' => 1])->result_array();
    }

    public function getMonthlyOrder($time){
        return $this->db->get_where('order_table',['order_date >' => ($time - (60*60*24*30)) ])->result_array();
    }

    public function getEarningsData($time){

        // Get monthly earnings data;
        $this->db->where('order_status', 6); // Using where order status 6 to pick success transaction only
        $orderData = $this->getMonthlyOrder($time);
        $bufferArray = [];

        foreach($orderData as $od) {
            $query = "SELECT * FROM `ordered_product_table` WHERE `order_id`  = '" . $od['id'] . "'";
            $data = $this->costumQuery($query);
            foreach($data as $d){
                $bufferArray[] = $d['sub_total'];
            }
        }
        return $bufferArray;
    }

    public function costumQuery($query, $multiple = true){
        if($multiple){
            return $this->db->query($query)->result_array();
        } else{
            return $this->db->query($query)->row_array();
        }
    }
}