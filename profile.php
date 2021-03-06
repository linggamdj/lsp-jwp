<?php
    session_start();

    include 'templates/function/functions.php';

    if ( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

    $username_session = $_SESSION["username"];
    $user_detail = query("SELECT * FROM pelanggan WHERE username='$username_session'")[0];
    // var_dump($user_detail);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'templates/pages/style.php'; ?>

    <title>Petshopqu | Profile</title>
</head>
<body>
    <?php include 'templates/pages/navbar.php'; ?>

    </main>
        <section class="row justify-content-center text-center mt-4">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top img-thumbnail" src="http://localhost/petshopqu/templates/img/logo-cat.png" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $user_detail["name"] ?></h5>
                    <p class="card-text"><?= $user_detail["alamat"] ?></p>
                    <p class="card-text"><?= $user_detail["hp"] ?></p>
                    <a href="ubah_profile.php" class="btn btn-dark text-white px-4 ml-2">Edit</a>
                </div>
            </div>
        </section>
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
