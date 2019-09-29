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

    public function getAllCategories(){
        return $this->db->get('product_categories_table')->result_array();
    }

    public function addReview($data){
        $data = [
            'user_id' => $data['userId'],
            'rating' => $data['rating'],
            'review' => $data['review'],
            'product_id' => $data['productId'],
            'date_posted' => $data['datePosted']
        ];
        $this->db->insert('product_review_table', $data);
    }
}