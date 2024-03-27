<?php
include '../lib/Database.php';

class User{
    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function allUser(){
        $query = "SELECT * FROM tb_users ORDER BY user_id ASC";
        $result = $this->db->read($query);
        return $result;
    }

    public function GetIdUser($id){
        $query = "SELECT * FROM tb_users WHERE user_id = '$id' ORDER BY user_id ASC";
        $result = $this->db->read($query);
        return $result;
    }

    public function addUser($data){
        $user_nama = $data['user_nama'];
        $user_email = $data['user_email'];
        $user_password = $data['user_password'];
        $user_alamat = $data['user_alamat'];
        $user_hp = $data['user_hp'];

        $query = "INSERT INTO tb_users
                    (
                    user_email, 
                    user_password, 
                    user_nama, 
                    user_alamat, 
                    user_hp
                    ) VALUES (
                    '$user_email',
                    '$user_password',
                    '$user_nama',
                    '$user_alamat',
                    '$user_hp'
                    )";
        
        $result = $this->db->insert($query);
    }

    public function editUser($data, $id){
        $user_nama = $data['user_nama'];
        $user_email = $data['user_email'];
        $user_password = $data['user_password'];
        $user_alamat = $data['user_alamat'];
        $user_hp = $data['user_hp'];

        $query = "UPDATE tb_users SET
            user_nama='$user_nama',
            user_email='$user_email',
            user_password='$user_password',
            user_alamat='$user_alamat',
            user_hp='$user_hp',
            update_at='". date("Y-m-d H:i:s") ."' WHERE user_id = '$id'";
        
        $result = $this->db->update($query);
    }

    public function deleteUser($id){
        $query = "DELETE FROM tb_users WHERE user_id = '$id'";

        $result = $this->db->delete($query);
    }

    
}

?>