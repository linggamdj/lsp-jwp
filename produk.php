<?php
    session_start();

    if ( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
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
        <div class="product-title text-center mt-5">
            <h2 class="text-black">
                DAFTAR PRODUK
            </h2>
        </div>
        <table class="table w-75 mx-auto my-5">
            <thead class="thead-dark">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Deskripsi Produk</th>
                <th scope="col">Harga Produk</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <a href="http://"></a>
                    <td class="action-button text-uppercase text-bold"><a href="http://">edit</a> | <a href="http://">delete</a></td>
                </tr>
                </tr>
            </tbody>
        </table>
    </main>
    
    <?php include 'templates/pages/footer.php'; ?>

    <?php include 'templates/jquery/jquery.php'; ?>
</body>
</html>
