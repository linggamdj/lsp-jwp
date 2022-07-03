<?php
    session_start();

    include 'templates/function/functions.php';

    if ( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

    $produk = query("SELECT * FROM produk");

    if ( isset($_POST["cari"]) ) {
        $produk = cari($_POST["keyword"]);
    }
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
        <table class="table table-bordered bg-white w-75 mx-auto mt-3 mb-5">
            <form action="" method="post">
                <div class="input-group rounded w-50 mx-auto">
                    <input type="search" name="keyword" class="form-control rounded" placeholder="contoh: ori, tuna, harga" aria-label="Search" aria-describedby="search-addon" />
                    <button class="btn btn-dark text-white px-4 ml-2" name="cari" type="submit" href="#">Cari</button>
                    <a class="btn btn-dark text-white ml-2" href="tambah.php">Tambah Produk</a>
                </div>
            </form>
            
            <thead class="thead-dark text-center">
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
                    <td class="font-weight-bold"scope="row"><?= $i; ?></td> 
                    <td><?= $data["nama_produk"] ?></td>
                    <td> <img src="templates/uploads/<?= $data["gambar"] ?>" width="50" alt="image"></td>
                    <td><?= $data["deskripsi_produk"] ?></td>
                    <td>Rp<?= number_format($data["harga_produk"], 2) ;?></td>
                    <td class="action-button text-uppercase text-bold">
                        <a href="ubah.php?id=<?= $data["ID_produk"] ?>">edit</a> | 
                        <a href="hapus.php?id=<?= $data["ID_produk"] ?>" onclick="return confirm('Apakah anda yakin untuk menghapus data ini?');">delete</a>
                    </td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    
    <?php include 'templates/pages/footer.php'; ?>

    <?php include 'templates/jquery/jquery.php'; ?>
</body>
</html>
