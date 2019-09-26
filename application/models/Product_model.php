<?php 

class Product_model extends CI_Model{

    public function getAllProduct(){
        return $this->db->get('product_table')->result_array();
    }

    public function getProductById($id){
        return $this->db->get_where('product_table', ['id' => $id])->row_array();
    }

    public function costumQuery($query, $multiple = true){
        if($multiple){
            return $this->db->query($query)->result_array();
        } else{
            return $this->db->query($query)->row_array();
        }
    }
}