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

    public function editUser($data){
        $id = $data['id'];
        $data = [
            'first_name' => htmlspecialchars($data['first_name']),
            'last_name' => htmlspecialchars($data['last_name']),
            'email' => htmlspecialchars($data['email']),
            'address' => htmlspecialchars($data['address'])
        ];
        $this->db->where('id', $id);
        $this->db->update('user_table', $data);
    }

    public function updateImg(){

        $config['upload_path'] = './assets/img/profile/';
        $config['allowed_types'] = 'jpeg|jpg|png|bmp|gif';
        $config['max_size'] = 1024;
        $config['max_filename'] = 128;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('img')){
            return ['stats' => true, 'data' => $this->upload->data()];
        } else{
            return ['stats' => false, 'data' => $this->upload->display_errors()];
        }
    }

    public function updateImageName($id, $image){
        $this->db->where('id', $id);
        $this->db->update('user_table', ['image' => $image]);
    }

    public function updatePassword($id, $password){
        $this->db->where('id', $id);
        $this->db->update('user_table', ['password' => password_hash($password, PASSWORD_DEFAULT)]);
    }

    public function getOwnerByUname($uname){
        return $this->db->get_where('owner_table', ['username' => $uname])->row_array();
    }
}