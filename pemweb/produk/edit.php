<?php 
    include '../header.php';
    include '../config/koneksi.php';
    include '../classes/Produk.php';

    $pr = new Produk();
    
    if (isset($_GET['id'])) {
        $id = base64_decode($_GET['id']);
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $editPro = $pr->editPro($_POST, $id);

        echo '
            <script>
                alert("Data berhasil diedit");
                window.location.href="../produk/";
            </script>
        ';
    }

?>

<div class="container mt-5"> 
    <h2 class="my-3 text-center">Update Produk</h2>
    <div class="row justify-content-center">
        <div class="col-md-6 border rounded p-4">
            <?php
                $getId = $pr->GetIdPro($id);
                if ($getId) {
                    while ($row = mysqli_fetch_assoc($getId)) {
            ?>
            <form method="post">
            <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Nama</label>
                    <input type="text" name="produk_nama" class="form-control" value="<?= $row['produk_nama'] ?>" aria-describedby="emailHelp" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Harga</label>
                    <input type="number" name="produk_hrg" class="form-control" value="<?= $row['produk_hrg'] ?>" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Qty</label>
                    <input type="number" name="produk_stock" class="form-control" value="<?= $row['produk_stock'] ?>" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Qty</label>
                    <select name="kat_id" class="form-select">
                        <option value="">-- Pilih Kategori --</option>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM tb_kategori");
                        while ($rowKat = mysqli_fetch_assoc($query)) {
                        ?>
                        <option value="<?= $rowKat['kat_id'] ?>" <?php if($row['kat_id'] == $rowKat['kat_id']){ echo "selected"; } ?>><?= $rowKat['kat_nama'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label">Keterangan</label>
                    <textarea class="form-control" name="produk_keterangan"><?= $row['produk_keterangan'] ?></textarea>
                    </div><br>
                <div class="d-grid gap-2">
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                    <a href="../produk" name="save" class="btn btn-danger">Back</a>
                </div>
            </form>
            <?php
                    }
                }
            ?>
            
        </div>
    </div>
</div>

<?php include '../footer.php' ?>