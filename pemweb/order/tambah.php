<?php 
    include '../header.php';
    include '../config/koneksi.php';
    include '../classes/Order.php';

    $or = new Order();

    if (isset($_POST['addDetail'])) {
        $addOrd = $or->addOrd($_POST);
        
        echo '
            <script>
                window.location.href="../order/edit.php?id='. base64_encode($addOrd) .'";
            </script>
        ';
    }
?>

<div class="container mt-5">
<h2 class="my-3 text-center">Add Order</h2>
    <div class="row justify-content-center">
        <div class="col-md-6 border rounded p-4">
            <form method="post">
                <!-- <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tanggal Order*</label>
                    <input type="datetime" name="order_tgl" class="form-control" value="<?= date("Y-m-d H:i:s") ?>" aria-describedby="emailHelp" readonly>
                </div> -->
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Nama Kurir</label>
                    <input type="text" name="order_kurir" class="form-control" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Ongkir</label>
                    <input type="number" name="order_ongkir" class="form-control" aria-describedby="emailHelp">
                </div>

                <hr class="my-5">
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
                <div class="input-group mb-3">
                    <input type="number" name="detail_jml" class="form-control" aria-describedby="emailHelp">
                    <button type="submit" name="addDetail" class="btn btn-success"><i class="bi bi-plus-lg"></i></button>
                </div><br>
                <div class="d-grid gap-2">
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                    <a href="../order" name="save" class="btn btn-danger">Back</a>
                </div>
            </form>
        </div>
</div>

<?php include '../footer.php' ?>