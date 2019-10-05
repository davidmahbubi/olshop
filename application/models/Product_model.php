<?php 

class Product_model extends CI_Model{

    public function getAllProduct($stockFilter = true){
        $this->db->order_by('date_created', 'DESC');
        if($stockFilter){
            return $this->db->get_where('product_table', ['stock > ' => 0])->result_array();
        } else{
            return $this->db->get('product_table')->result_array();
        }
    }

    public function getProductById($id, $stockFilter = true){
        if($stockFilter){
            return $this->db->get_where('product_table', ['id' => $id, 'stock > ' => 0])->row_array();
        } else{
            return $this->db->get_where('product_table', ['id' => $id])->row_array();
        }
    }

    public function costumQuery($query, $multiple = true){
        if($multiple){
            return $this->db->query($query)->result_array();
        } else{
            return $this->db->query($query)->row_array();
        }
    }

    public function getEmptyStockProduct(){
        return $this->db->get_where('product_table', ['stock' => 0])->result_array();
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

    public function getAllReview($productId){
        $query = "  SELECT `product_review_table`.*, `user_table`.`first_name`, `user_table`.`last_name`, `user_table`.`image` FROM `product_review_table`
                    JOIN `user_table` ON `user_id` = `user_table`.`id`
                    WHERE `product_id` = " . $productId . " ORDER BY `date_posted` DESC";
        return $this->db->query($query)->result_array();            
    }

    public function updateOrderStatus($orderId){
        $this->db->where('id', $orderId);
        $this->db->update('order_table', ['reviewed' => 1]);
    }

    public function getBuyedProduct($id){
        return $this->db->get_where('ordered_product_table', ['id_product' => $id])->row_array();
    }
}