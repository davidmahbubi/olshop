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
}