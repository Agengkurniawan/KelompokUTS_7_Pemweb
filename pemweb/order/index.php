<?php 
    include '../header.php';
    include '../config/koneksi.php';
    include '../classes/Order.php';

    $or = new Order();

    if (isset($_GET['del'])) {
        $id = base64_decode($_GET['del']);
        $delOrder = $or->deleteOrd($id);

        echo '
            <script>
                alert("Data berhasil dihapus");
                window.location.href="../order/";
            </script>
        ';
    }
?>

<div class="container">
    <h2 class="my-3">Master Order</h2>
    <a href="tambah.php" class="btn btn-outline-dark">Add Data</a><br>
    <table class="table table-hover mt-5">
    <thead class="table-dark">
            <tr>
            <th scope="col">No</th>
            <th scope="col">ID Order</th>
            <th scope="col">Nama Kurir</th>
            <th scope="col">Ongkir</th>
            <th scope="col">Tanggal Order</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $allOrd = $or->allOrd();
            if ($allOrd) {
                $no = 1;
                while ($row = mysqli_fetch_assoc($allOrd)) {

                    if ($row['order_batal'] == 0) {
                        $status = '<p class="text-warning">Draft</p>';
                        $edit = "edit.php?id='". base64_encode($row['order_kode']) ."'";
                    }elseif ($row['order_batal'] == 1) {
                        $status = '<p class="text-success">Ordered</p>';
                        $edit = "edit.php?id='". base64_encode($row['order_kode']) ."'&status='". base64_encode($row['order_batal']) ."'";
                    }elseif ($row['order_batal'] == 2) {
                        $status = '<p class="text-danger">Canceled</p>';
                        $edit = "edit.php?id='". base64_encode($row['order_kode']) ."'&status='". base64_encode($row['order_batal']) ."'";
                    }

            ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $row['order_kode'] ?></td>
                        <td><?= $row['order_kurir'] ?></td>
                        <td>Rp. <?= number_format($row['order_ongkir']) ?></td>
                        <td><?= $row['order_tgl'] ?></td>
                        <td><?= $status ?></td>
                        <td>
                            <a href="<?= $edit ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="?del=<?= base64_encode($row['order_kode']) ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="btn btn-danger btn-sm">Delete</a>
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