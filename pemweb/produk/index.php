<?php 
    include '../header.php';
    include '../config/koneksi.php';
    include '../classes/Produk.php';

    $pr = new Produk();

    if (isset($_GET['del'])) {
        $id = base64_decode($_GET['del']);
        $delProduk = $pr->deletePro($id);

        echo '
            <script>
                alert("Data berhasil dihapus");
                window.location.href="../produk/";
            </script>
        ';
    }
?>

<div class="container">
    <h2 class="my-3">Master Produk</h2>
    <a href="tambah.php" class="btn btn-outline-dark">Add Data</a><br>
    <table class="table table-hover mt-5">
        <thead class="table-dark">
            <tr>
            <th scope="col">No</th>
            <th scope="col">ID Produk</th>
            <th scope="col">Nama</th>
            <th scope="col">Harga</th>
            <th scope="col">Qty</th>
            <th scope="col">Kategori</th>
            <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $allPro = $pr->allPro();
            if ($allPro) {
                $no = 1;
                while ($row = mysqli_fetch_assoc($allPro)) {
                    $queryKat = mysqli_fetch_assoc(mysqli_query($conn, "SELECT kat_nama FROM tb_kategori WHERE kat_id = '". $row['kat_id'] ."'"));
            ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $row['produk_kode'] ?></td>
                        <td><?= $row['produk_nama'] ?></td>
                        <td>Rp. <?= number_format($row['produk_hrg']) ?></td>
                        <td><?= number_format($row['produk_stock']) ?> Pcs</td>
                        <td><?= $queryKat['kat_nama'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= base64_encode($row['produk_id']) ?>" class="btn btn-warning btn-sm">Update</a>
                            <a href="?del=<?= base64_encode($row['produk_id']) ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php include '../footer.php' ?>