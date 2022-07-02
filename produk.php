<?php
    session_start();

    include 'templates/function/functions.php';

    if ( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

    $produk = query("SELECT * FROM produk");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'templates/pages/style.php'; ?>

    <title>Petshopqu | Produk</title>
</head>
<body>
    <?php include 'templates/pages/navbar.php'; ?>

    <main>
        <div class="product-title text-center my-5">
            <h2 class="text-black">
                DAFTAR PRODUK
            </h2>
        </div>
        <table class="table w-75 mx-auto mt-3 mb-5">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Foto Produk</th>
                    <th scope="col">Deskripsi Produk</th>
                    <th scope="col">Harga Produk</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach($produk as $data) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th> 
                    <td><?= $data["nama_produk"] ?></td>
                    <td>piye iki toh</td>
                    <td><?= $data["deskripsi_produk"] ?></td>
                    <td>Rp<?= $data["harga_produk"] ?></td>
                    <td class="action-button text-uppercase text-bold">
                        <a href="#">edit</a> | 
                        <a href="hapus.php?id=<?= $data["ID_produk"] ?>" onclick="return confirm('Apakah anda yakin untuk menghapus data ini?');">delete</a>
                    </td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="button-add text-center mx-auto my-5">
            <a class="btn btn-dark text-white" href="tambah.php">Tambah Produk</a>
        </div>
    </main>
    
    <?php include 'templates/pages/footer.php'; ?>

    <?php include 'templates/jquery/jquery.php'; ?>
</body>
</html>
