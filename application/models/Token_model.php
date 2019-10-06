<?php 

class Token_model extends CI_Model{

    public function insertToken($userId, $token, $tokenType){
        $data = [
            'token' => $token,
            'user_email' => $userId,
            'token_type_id' => $tokenType,
            'date_created' => time()
        ];
        $this->db->insert('token_table', $data);
    }

    public function verifyToken($userEmail, $token, $tokenType, bool $limit = false, int $limitDay = 0){

        $criteria = [
            'token' => $token,
            'user_email' => $userEmail,
            'token_type_id' => $tokenType,
        ];

        $token = $this->db->get_where('token_table', $criteria)->row_array();

        if($token){
            if($limit){
                $token['date_created'] = (int)$token['date_created'];
                if((int)$token['date_created'] <= ($token['date_created'] + (60*60*24*$limitDay))){
                    return ['stats' => true, 'msg' => ''];
                } else{
                    $this->deleteToken($userEmail, $token);

                    // If user token is register token, delete user after token expired

                    if($tokenType == 2){
                        $this->db->where('email', $user_email);
                        $this->db->delete('user_table');
                    }
                    
                    return ['stats' => false, 'msg' => 'Token expired'];
                }
            } else{
                return ['stats' => true, 'msg' => ''];
            }
        } else{
            return ['stats' => false, 'msg' => 'Invalid token !'];
        }
    }

    public function deleteToken($userEmail, $token){
        $this->db->where('user_email', $userEmail);
        $this->db->where('token', $token);
        $this->db->delete('token_table');
    }
}