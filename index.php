<?php
    session_start();

    include 'templates/function/functions.php';

    $produk = query("SELECT * FROM produk");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'templates/pages/style.php'; ?>

    <title>Selamat Datang di Petshopqu</title>
</head>
<body>
    <?php include 'templates/pages/navbar.php'; ?>

    <header class="navbar-home text-center mx-auto">
        <h1>SELAMAT DATANG DI<br>PETSHOPQU</h1>
    </header>

    </main>
    <div class="product-title">
        <h2 class="py-5">
            Daftar Produk
        </h2>
    </div class="col-sm-6 col-md-4 col-lg-3">
        <div class="product-card d-flex  justify-content-center  mb-5">
            <?php foreach($produk as $data) : ?>
                <div class="card-item card border mx-3" style="width: 18rem;">
                    <img class="card-img-top border p-5" src="templates/uploads/<?= $data["gambar"] ?>" width="10" alt="Card image cap">
                    <div class="card-body">
                        <p class="font-weight-bold"><?= $data["nama_produk"] ?></p>
                        <p class="card-price font-weight-normal"><?= $data["harga_produk"] ?></p>
                        <p class="card-text"><?= $data["deskripsi_produk"] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <main>
    
    <?php include 'templates/pages/footer.php'; ?>

    <?php include 'templates/jquery/jquery.php'; ?>
</body>
</html>
