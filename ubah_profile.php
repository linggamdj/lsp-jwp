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

    <title>Petshopqu | Edit Profile</title>
</head>
<body>
    <?php include 'templates/pages/navbar.php'; ?>

    <?php if ( isset($_SESSION["username"]) ) { ?>
        </main>
        <div class="column my-5">
            <div class="login-logo text-center mb-4">
                <img src="http://localhost/petshopqu/templates/img/logo-cat.png" alt="logo" height="100">
            </div>
            <form method="post" class="text-center col-lg-2 col-md-4 col-sm-8 mx-auto w-20">
                <input type="hidden" name="id" value="<?= $user_detail["ID_pelanggan"] ?>">
                <div class="form-group">
                    <label for="nama">NAMA LENGKAP</label>
                    <input type="text" value="<?= $user_detail["name"] ?>" class="form-control text-center" name="nama" placeholder="Nama Lengkap" required>
                </div>
                <div class="form-group">
                    <label for="hp">NO. HP</label>
                    <input type="text" value="<?= $user_detail["hp"] ?>" class="form-control text-center" name="hp" placeholder="Nomor HP" required>
                </div>
                <div class="form-group">
                    <label for="hp">ALAMAT</label>
                    <input type="text" value="<?= $user_detail["alamat"] ?>" class="form-control text-center" name="alamat" placeholder="Alamat" required>
                </div>
                <input type="submit" class="btn btn-dark" name="update" value="UPDATE">
            </form>
        </div>
    <main>
    <?php } else { ?>
        <script>window.location.href='index.php'</script>";
    <?php } ?>
    
    <?php include 'templates/pages/footer.php'; ?>

    <?php include 'templates/jquery/jquery.php'; ?>
    <?php
        // mengecek apakah data berhasil diubah
        if (isset($_POST["update"])) {
            if (ubahPengguna($_POST) >= 0) {
                echo "<script>alert('Data berhasil diubah!'); window.location.href='profile.php'</script>";
            } else {
                echo "<script>alert('Data gagal diubah!'); window.location.href='profile.php'</script>";
                exit;
            }
        }
    ?>
</body>
</html>
