<?php
include '../lib/Database.php';
include '../lib/Appcode.php';

class Produk{
    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function allPro(){
        $query = "SELECT * FROM tb_produk ORDER BY produk_id ASC";
        $result = $this->db->read($query);
        return $result;
    }

    public function GetIdPro($id){
        $query = "SELECT * FROM tb_produk WHERE produk_id = '$id' ORDER BY produk_id ASC";
        $result = $this->db->read($query);
        return $result;
    }

    public function addPro($data){
        $kat_id = $data['kat_id'];
        $produk_kode = generate_produk();
        $produk_nama = $data['produk_nama'];
        $produk_hrg = $data['produk_hrg'];
        $produk_stock = $data['produk_stock'];
        $produk_keterangan = $data['produk_keterangan'];

        $query = "INSERT INTO tb_produk
                    (
                    kat_id, 
                    produk_kode,
                    produk_nama,
                    produk_hrg,
                    produk_stock,
                    produk_keterangan
                    ) VALUES (
                    '$kat_id',
                    '$produk_kode',
                    '$produk_nama',
                    '$produk_hrg',
                    '$produk_stock',
                    '$produk_keterangan'
                    )";
        
        $result = $this->db->insert($query);
    }

    public function editPro($data, $id){
        $kat_id = $data['kat_id'];
        $produk_nama = $data['produk_nama'];
        $produk_hrg = $data['produk_hrg'];
        $produk_stock = $data['produk_stock'];
        $produk_keterangan = $data['produk_keterangan'];

        $query = "UPDATE tb_produk SET
            kat_id='$kat_id',
            produk_nama='$produk_nama',
            produk_hrg='$produk_hrg',
            produk_stock='$produk_stock',
            produk_keterangan='$produk_keterangan',
            update_at='". date("Y-m-d H:i:s") ."' WHERE produk_id = '$id'";
        
        $result = $this->db->update($query);
    }

    public function deletePro($id){
        $query = "DELETE FROM tb_produk WHERE produk_id = '$id'";

        $result = $this->db->delete($query);
    }

    
}

?>