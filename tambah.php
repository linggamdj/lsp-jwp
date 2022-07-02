<?php
    session_start();

    include 'templates/function/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'templates/pages/style.php'; ?>

    <title>Petshopqu | Tambah Produk</title>
</head>
<body>
    <?php include 'templates/pages/navbar.php'; ?>

    </main>
        <div class="form-product column my-5 text-uppercase text-center">
            <div class="title-add mb-5">
                <h1>
                    TAMBAH DATA
                </h1>
            </div>
            <form method="post" class="col-lg-6 col-md-6 col-sm-4 mx-auto w-20">
                <div class="form-group text-left">
                    <label>Nama Produk</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Produk" required>
                </div>
                <div class="form-group text-left">
                    <label>Deskripsi Produk</label>
                    <textarea class="form-control" name="deskripsi" rows="3" placeholder="Deskripsi Produk" required></textarea>
                </div>
                <div class="form-group text-left">
                    <label>Harga Produk</label>
                    <input type="number" name="harga" class="form-control" id="exampleFormControlInput1" placeholder="Nama Produk" required>
                </div>
                <div class="form-group text-left">
                    <label for="exampleFormControlFile1">Foto Produk</label>
                    <input type="file" name="foto" class="form-control-file">
                </div>
                <button type="submit" name="tambah" class="btn btn-dark">TAMBAH</button>
            </form>
        </div>
    <main>
    
    <?php include 'templates/pages/footer.php'; ?>

    <?php include 'templates/jquery/jquery.php'; ?>

    <?php 
        if (isset($_POST["tambah"])) {
            if (tambah($_POST)) {
                echo "<script>alert('Tambah produk berhasil!'); window.location.href='produk.php'</script>";
            } else {
                echo "<script>alert('gagal tambah produk!');</script>";
            }
        }
    ?>
</body>
</html>
