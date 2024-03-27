<?php 
    include '../header.php';
    include '../classes/User.php';

    $us = new User();
    
    if (isset($_GET['id'])) {
        $id = base64_decode($_GET['id']);
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $addUser = $us->editUser($_POST, $id);

        echo '
            <script>
                alert("Data berhasil diedit");
                window.location.href="../user/";
            </script>
        ';
    }

?>

<div class="container mt-5"> 
    <h2 class="my-3 text-center">Update User</h2>
    <div class="row justify-content-center">
        <div class="col-md-6 border rounded p-4">
            <?php
                $getId = $us->GetIdUser($id);
                if ($getId) {
                    while ($row = mysqli_fetch_assoc($getId)) {
            ?>
            <form method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Nama</label>
                    <input type="text" name="user_nama" class="form-control" value="<?= $row['user_nama'] ?>" aria-describedby="emailHelp" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label">Email</label>
                    <input type="email" name="user_email" class="form-control" value="<?= $row['user_email'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="user_password" class="form-control" value="<?= $row['user_password'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label">Alamat</label>
                    <textarea class="form-control" name="user_alamat"><?= $row['user_alamat'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label">No.Hp</label>
                    <input type="text" name="user_hp" class="form-control" value="<?= $row['user_hp'] ?>">
                </div><br>
                <div class="d-grid gap-2">
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                    <a href="../user" name="save" class="btn btn-danger">Back</a>
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
