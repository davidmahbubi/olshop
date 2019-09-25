<?php 

class User_model extends CI_Model{

    public function addUser($data){
        $data = [
            'first_name' => htmlspecialchars($data['first_name']),
            'last_name' => htmlspecialchars($data['last_name']),
            'email' => htmlspecialchars($data['email']),
            'password' => password_hash($data['password1'], PASSWORD_DEFAULT),
            'address' => '',
            'block' => 0,
            'image' => 'default.png',
            'date_created' => time(),
            'is_active' => 1,
            'role_id' => 2
        ];
        $this->db->insert('user_table', $data);
    }

    public function getUserByEmail($email){
        return $this->db->get_where('user_table', ['email' => $email])->row_array();
    }

    public function getUserById($id){
        return $this->db->get_where('user_table', ['id' => $id])->row_array();
    }
}