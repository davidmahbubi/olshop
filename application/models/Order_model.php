<?php 

class Order_model extends CI_Model{

    public function getAllOrder($sortDate = "DESC", $limit = false, $limitTotal = 0, $offset = 0){
        if($limit){
            $this->db->limit($limitTotal, $offset);
        }
        $this->db->order_by('order_date', $sortDate);
        return $this->db->get('order_table')->result_array();
    }

    public function getPendingOrder($withCourier = false, $orderBy = 'order_date', $orderValue = 'ASC'){
        $this->db->order_by($orderBy, $orderValue); // Order `pending order` as date_order ascending, mean past first
        $this->db->join('order_identity_table', 'order_id = order_table.id');
        if($withCourier){
            $this->db->join('courier_table', 'courier_id = courier_table.id');
        }
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

    public function getWholeOrder($sortDate = 'DESC', $limit = false, $limitTotal = 0, $offset = 0){
        $this->db->join('order_identity_table', 'order_id = `order_table`.`id`');
        $this->db->join('order_status_table', 'order_status = `order_status_table`.`id`');
        $this->db->order_by('order_date', $sortDate);
        return $this->getAllOrder($sortDate, $limit, $limitTotal, $offset);
    }

    public function getWholeOrderById($id){
        $this->db->join('order_identity_table', 'order_id = order_table.id');
        $this->db->join('courier_table', 'courier_id = courier_table.id');
        $this->db->join('order_status_table', 'order_status = order_status_table.id');
        $this->db->where('order_id', $id);
        $this->db->order_by('order_date', 'DESC');
        return $this->db->get('order_table')->row_array();
    }

    public function getAllStatus(){
        return $this->db->get('order_status_table')->result_array();
    }

    public function updateStatus($orderId, $orderStatus){
        $this->db->where('id', $orderId);
        $this->db->update('order_table', ['order_status' => $orderStatus]);
    }

    public function addAirwayBill($orderId, $airwayBill){
        $this->db->where('order_id', $orderId);
        $this->db->update('order_identity_table', ['airway_bill' => $airwayBill]);
    }

    public function getUncompleteOrder(){
        $this->db->where('order_status !=' , 6);
        return $this->getWholeOrder();
    }
}