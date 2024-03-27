<?php 
    include '../header.php';
    include '../classes/Kategori.php';

    $ka = new Kategori();

    if (isset($_GET['del'])) {
        $id = base64_decode($_GET['del']);
        $delKategori = $ka->deleteKat($id);

        echo '
            <script>
                alert("Data berhasil dihapus");
                window.location.href="../kategori/";
            </script>
        ';
    }
?>

<div class="container">
    <h2 class="my-3">Master Kategori</h2>
    <a href="tambah.php" class="btn btn-outline-dark">Add Data</a><br>
    <table class="table table-hover mt-5">
    <thead class="table-dark">
            <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $allKat = $ka->allKat();
            if ($allKat) {
                $no = 1;
                while ($row = mysqli_fetch_assoc($allKat)) {
            ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $row['kat_nama'] ?></td>
                        <td><?= $row['kat_keterangan'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= base64_encode($row['kat_id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="?del=<?= base64_encode($row['kat_id']) ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="btn btn-danger btn-sm">Delete</a>
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