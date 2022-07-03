<?php
    session_start();

    include 'templates/function/functions.php';

    // mengambil id dari url
    $id = $_GET["id"];

    // query
    $data = query("SELECT * FROM produk WHERE ID_produk = $id")[0];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'templates/pages/style.php'; ?>

    <title>Petshopqu | Ubah Produk</title>
</head>
<body>
    <?php include 'templates/pages/navbar.php'; ?>

    </main>
        <div class="form-product column my-5 text-uppercase text-center">
            <div class="title-add mb-5">
                <h2>
                    Ubah Data
                </h2>
            </div>
            <form method="post" enctype="multipart/form-data" class="col-lg-6 col-md-6 col-sm-4 mx-auto w-20">
                <input type="hidden" name="id" value="<?= $data["ID_produk"] ?>">
                <input type="hidden" name="gambarLama" value="<?= $data["gambar"] ?>">
                <div class="form-group text-left">
                    <label>Nama Produk</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Produk" value="<?= $data["nama_produk"] ?>" required>
                </div>
                <div class="form-group text-left">
                    <label>Deskripsi Produk</label>
                    <textarea class="form-control" name="deskripsi" rows="3" placeholder="Deskripsi Produk" required><?= $data["deskripsi_produk"] ?></textarea>
                </div>
                <div class="form-group text-left">
                    <label>Harga Produk</label>
                    <input type="number" name="harga" class="form-control" placeholder="Harga Produk" value="<?= $data["harga_produk"] ?>" required>
                </div>
                <div class="form-group text-left">
                    <label for="exampleFormControlFile1">Foto Produk</label>
                    <input type="file" name="gambar" class="form-control-file">
                </div>
                <button type="submit" name="ubah" class="btn btn-dark">UBAH</button>
            </form>
        </div>
    <main>
    
    <?php include 'templates/pages/footer.php'; ?>

    <?php include 'templates/jquery/jquery.php'; ?>

    <?php
        // mengecek apakah data berhasil diubah
        if (isset($_POST["ubah"])) {
            if (ubah($_POST) >= 0) {
                echo "<script>alert('Data berhasil diubah!'); window.location.href='produk.php'</script>";
            } else {
                echo "<script>alert('Data gagal diubah!'); window.location.href='produk.php'</script>";
                exit;
            }
        }
    ?>
</body>
</html>
