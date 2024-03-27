<?php
include '../lib/Database.php';

class Kategori{
    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function allKat(){
        $query = "SELECT * FROM tb_kategori ORDER BY kat_id ASC";
        $result = $this->db->read($query);
        return $result;
    }

    public function GetIdKat($id){
        $query = "SELECT * FROM tb_kategori WHERE kat_id = '$id' ORDER BY kat_id ASC";
        $result = $this->db->read($query);
        return $result;
    }

    public function addKat($data){
        $kat_nama = $data['kat_nama'];
        $kat_keterangan = $data['kat_keterangan'];

        $query = "INSERT INTO tb_kategori
                    (
                    kat_nama, 
                    kat_keterangan
                    ) VALUES (
                    '$kat_nama',
                    '$kat_keterangan'
                    )";
        
        $result = $this->db->insert($query);
    }

    public function editKat($data, $id){
        $kat_nama = $data['kat_nama'];
        $kat_keterangan = $data['kat_keterangan'];

        $query = "UPDATE tb_kategori SET
            kat_nama='$kat_nama',
            kat_keterangan='$kat_keterangan',
            update_at='". date("Y-m-d H:i:s") ."' WHERE kat_id = '$id'";
        
        $result = $this->db->update($query);
    }

    public function deleteKat($id){
        $query = "DELETE FROM tb_kategori WHERE kat_id = '$id'";

        $result = $this->db->delete($query);
    }

    
}

?>