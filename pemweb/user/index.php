<?php 
    include '../header.php';
    include '../classes/User.php';

    $us = new User();

    if (isset($_GET['del'])) {
        $id = base64_decode($_GET['del']);
        $delUser = $us->deleteUser($id);

        echo '
            <script>
                alert("Data berhasil dihapus");
                window.location.href="../user/";
            </script>
        ';
    }
?>

<div class="container">
    <h2 class="my-3">Master User</h2>
    <a href="tambah.php" class="btn btn-outline-dark">Add Data</a><br>
    <table class="table table-hover mt-5">
    <thead class="table-dark">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Alamat</th>
            <th scope="col">No.Hp</th>
            <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $allUser = $us->allUser();
            if ($allUser) {
                $no = 1;
                while ($row = mysqli_fetch_assoc($allUser)) {
            ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $row['user_nama'] ?></td>
                        <td><?= $row['user_email'] ?></td>
                        <td><?= $row['user_alamat'] ?></td>
                        <td><?= $row['user_hp'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= base64_encode($row['user_id']) ?>" class="btn btn-warning btn-sm">Update</a>
                            <a href="?del=<?= base64_encode($row['user_id']) ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="btn btn-danger btn-sm">Delete</a>
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