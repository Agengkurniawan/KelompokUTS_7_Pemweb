<?php 
    include '../header.php';
    include '../classes/Kategori.php';

    $ka = new Kategori();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $addKat = $ka->addKat($_POST);

        echo '
            <script>
                alert("Data berhasil ditambahkan");
                window.location.href="../kategori/";
            </script>
        ';
    }
?>

<div class="container mt-5"> 
    <h2 class="my-3 text-center">Add Kategori</h2>
    <div class="row justify-content-center">
        <div class="col-md-6 border rounded p-4">
            <form method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Nama*</label>
                    <input type="text" name="kat_nama" class="form-control" aria-describedby="emailHelp" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label">Keterangan*</label>
                    <textarea class="form-control" name="kat_keterangan"></textarea>
                </div><br>
                <div class="d-grid gap-2">
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                    <a href="../kategori" name="save" class="btn btn-danger">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../footer.php' ?>