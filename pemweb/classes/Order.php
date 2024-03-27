<?php
include '../lib/Database.php';
include '../lib/Appcode.php';

class Order{
    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    //Model Order
    public function allOrd(){
        $query = "SELECT * FROM tb_order ORDER BY order_id ASC";
        $result = $this->db->read($query);
        return $result;
    }

    public function GetIdOrd($id){
        $query = "SELECT * FROM tb_order WHERE order_kode = '$id' ORDER BY order_kode ASC";
        $result = $this->db->read($query);
        return $result;
    }

    public function addOrd($data){
        $order_kurir = $data['order_kurir'];
        $order_ongkir = $data['order_ongkir'];
        $order_kode = generate_order();

        $produk_kode = $data['produk_kode'];
        $detail_harga = $data['detail_harga'];
        $detail_jml = $data['detail_jml'];

        $query = "INSERT INTO tb_order
                    (
                    order_kode,
                    order_kurir,
                    order_ongkir
                    ) VALUES (
                    '$order_kode',
                    '$order_kurir',
                    '$order_ongkir'
                    )";
        
        $result = $this->db->insert($query);

        $query2 = "INSERT INTO tb_order_detail
                    (
                    order_kode,
                    produk_kode,
                    detail_harga,
                    detail_jml
                    ) VALUES (
                    '$order_kode',
                    '$produk_kode',
                    '$detail_harga',
                    '$detail_jml'
                    )";

        $result2 = $this->db->insert($query2);

        return $order_kode;
    }

    public function editOrd($data, $id){
        $order_tgl = $data['order_tgl'];
        $order_kurir = $data['order_kurir'];
        $order_ongkir = $data['order_ongkir'];

        $query = "UPDATE tb_order SET
            order_kurir='$order_kurir',
            order_ongkir='$order_ongkir',
            order_batal='1',
            update_at='". date("Y-m-d H:i:s") ."' WHERE order_kode = '$id'";
        
        $result = $this->db->update($query);
    }

    public function deleteOrd($id){
        $query = "DELETE FROM tb_order WHERE order_kode = '$id'";

        $result = $this->db->delete($query);

        $query2 = "DELETE FROM tb_order_detail WHERE order_kode = '$id'";

        $result2 = $this->db->delete($query2);
    }

    //Model Order Detail
    public function allOrdDtl($id){
        $query = "SELECT * FROM tb_order_detail WHERE order_kode = '$id' ORDER BY produk_kode ASC";
        $result = $this->db->read($query);
        return $result;
    }

    public function deleteOrdDtl($id){
        $query = "DELETE FROM tb_order_detail WHERE order_detail_id = '$id'";

        $result = $this->db->delete($query);
    }

    public function editOrdDtl($data, $id){
        $order_kurir = $data['order_kurir'];
        $order_ongkir = $data['order_ongkir'];

        $produk_kode = $data['produk_kode'];
        $detail_harga = $data['detail_harga'];
        $detail_jml = $data['detail_jml'];

        $query = "UPDATE tb_order SET
            order_kurir='$order_kurir',
            order_ongkir='$order_ongkir' WHERE order_kode = '$id'";
        
        $result = $this->db->update($query);

        $queryOrdDet = "SELECT * FROM tb_order_detail WHERE produk_kode = '$produk_kode'";
        $countOrdDet = mysqli_num_rows($this->db->insert($queryOrdDet));

        if ($countOrdDet > 0) {
            $query2 = "UPDATE tb_order_detail SET
                detail_harga='$detail_harga',
                detail_jml='$detail_jml' WHERE produk_kode = '$produk_kode'";
        }else {
            $query2 = "INSERT INTO tb_order_detail
                        (
                        order_kode,
                        produk_kode,
                        detail_harga,
                        detail_jml
                        ) VALUES (
                        '$id',
                        '$produk_kode',
                        '$detail_harga',
                        '$detail_jml'
                        )";
        }

        $result2 = $this->db->insert($query2);
    }
}

?>