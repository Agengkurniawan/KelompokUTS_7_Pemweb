<?php 
    include '../header.php';
    include '../classes/User.php';

    $us = new User();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $addUser = $us->addUser($_POST);

        echo '
            <script>
                alert("Data berhasil ditambahkan");
                window.location.href="../user/";
            </script>
        ';
    }
?>

<div class="container mt-5">
<h2 class="my-3 text-center">Add User</h2>
    <div class="row justify-content-center">
        <div class="col-md-6 border rounded p-4">
            <form method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Nama</label>
                    <input type="text" name="user_nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label">Email</label>
                    <input type="email" name="user_email" class="form-control" id="exampleInputPassword1" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="user_password" class="form-control" id="exampleInputPassword1" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label">Alamat</label>
                    <textarea class="form-control" name="user_alamat" id="exampleInputPassword1"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label">No.Hp</label>
                    <input type="text" name="user_hp" class="form-control" id="exampleInputPassword1">
                </div><br>
                <div class="d-grid gap-2">
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                    <a href="../user" name="save" class="btn btn-danger">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../footer.php' ?>