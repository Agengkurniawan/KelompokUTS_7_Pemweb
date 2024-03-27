<?php 
    include '../header.php';
    include '../config/koneksi.php';
    include '../classes/Order.php';

    $or = new Order();
    
    if (isset($_GET['id'])) {
        $id = base64_decode($_GET['id']);
    }

    if (isset($_POST['addDetail'])) {
        $editProDtl = $or->editOrdDtl($_POST, $id);
        echo '
            <script>
                window.location.href="../order/edit.php?id='. base64_encode($id) .'";
            </script>
        ';
    }

    if (isset($_GET['del'])) {
        $id_delete = base64_decode($_GET['del']);
        $delOrder = $or->deleteOrdDtl($id_delete);

        echo '
            <script>
                window.location.href="../order/edit.php?id='. base64_encode($id) .'";
            </script>
        ';
    }

    if (isset($_POST['save'])) {
        $editPro = $or->editOrd($_POST, $id);
        echo '
            <script>
                alert("Data berhasil diedit");
                window.location.href="../order/";
            </script>
        ';
    }

    $readonly = "";
    if (isset($_GET['status']) ) {
        $readonly = "readonly";
    }
?>

<div class="container mt-5"> 
    <form method="post">
    <h2 class="my-3 text-center">Update Order</h2>
    <div class="row justify-content-center">
        <div class="col-md-6 border rounded p-4">
                <?php
                    $getId = $or->GetIdOrd($id);
                    if ($getId) {
                        while ($row = mysqli_fetch_assoc($getId)) {
                ?>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Tanggal Order</label>
                    <input type="datetime" name="order_tgl" class="form-control" value="<?= date("Y-m-d H:i:s") ?>" aria-describedby="emailHelp" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Nama Kurir</label>
                    <input type="text" name="order_kurir" class="form-control" value="<?= $row['order_kurir'] ?>" aria-describedby="emailHelp" <?= $readonly ?>>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Ongkir</label>
                    <input type="number" name="order_ongkir" class="form-control" value="<?= $row['order_ongkir'] ?>" aria-describedby="emailHelp" <?= $readonly ?>>
                </div>

                <hr class="my-5">
                <?php if(!isset($_GET['status'])) { ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                        <select name="produk_kode" class="form-select">
                            <option value="">-- Pilih Produk --</option>
                            <?php
                            $query = mysqli_query($conn, "SELECT * FROM tb_produk");
                            while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                            <option value="<?= $row['produk_kode'] ?>"><?= $row['produk_nama'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label">Harga</label>
                        <input type="number" name="detail_harga" class="form-control" aria-describedby="emailHelp">
                    </div>
                    <label for="exampleInputEmail1" class="form-label">Qty</label>
                    <div class="input-group mb-5">
                        <input type="number" name="detail_jml" class="form-control" aria-describedby="emailHelp">
                        <button type="submit" name="addDetail" class="btn btn-success"><i class="bi bi-plus-lg"></i></button>
                    </div>
                
                <?php
                        }
                        }
                    }
                ?>
                
            </div>
            <?php
            if (isset($_GET['id'])) {
            ?>
            <div class="col-md-12">
                <div class="container px-0">
                    <table class="table table-hover mt-5">
                        <thead class="table-dark">
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID Produk</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $allOrd = $or->allOrdDtl(base64_decode($_GET['id']));
                            if ($allOrd) {
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($allOrd)) {
                                    $queryProduk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT produk_nama FROM tb_produk WHERE produk_kode = '". $row['produk_kode'] ."'"));
                            ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $row['produk_kode'] ?></td>
                                        <td><?= $queryProduk['produk_nama'] ?></td>
                                        <td>Rp.<?= number_format($row['detail_harga']) ?></td>
                                        <td><?= $row['detail_jml'] ?></td>
                                        <td>Rp.<?= number_format($row['detail_harga'] * $row['detail_jml']) ?></td>
                                        <td>
                                            <?php if(!isset($_GET['status'])) {?>
                                            <a href="?id=<?= $_GET['id'] ?>&del=<?= base64_encode($row['order_detail_id']) ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php 
            if(!isset($_GET['status'])) {
                echo'
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                ';
            }elseif(base64_decode($_GET['status']) == 1) {
                echo'
                    <button type="submit" name="save" class="btn btn-danger">Batal</button>
                ';
            }else {
                echo'';
            }
        ?>
        <a href="../order" class="btn btn-danger">Back</a>
    </form>
</div>

<?php include '../footer.php' ?>