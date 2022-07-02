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

    <title>Petshopqu | Register</title>
</head>
<body>
    <?php include 'templates/pages/navbar.php'; ?>

    </main>
        <div class="column my-5">
            <div class="login-logo text-center mb-4">
                <img src="http://localhost/petshopqu/templates/img/logo-cat.png" alt="logo" height="100">
            </div>
            <form method="post" class="text-center col-lg-2 col-md-4 col-sm-8 mx-auto w-20">
                <div class="form-group">
                    <label for="nama">NAMA LENGKAP</label>
                    <input type="text" class="form-control text-center" name="nama" placeholder="Nama Lengkap" required>
                </div>
                <div class="form-group">
                    <label for="username">USERNAME</label>
                    <input type="text" class="form-control text-center" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="hp">NO. HP</label>
                    <input type="text" class="form-control text-center" name="hp" placeholder="Nomor HP" required>
                </div>
                <div class="form-group">
                    <label for="hp">ALAMAT</label>
                    <input type="text" class="form-control text-center" name="alamat" placeholder="Alamat" required>
                </div>
                <div class="form-group">
                    <label for="password">PASSWORD</label>
                    <input type="password" class="form-control text-center" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="repassword">RE-PASSWORD</label>
                    <input type="password" class="form-control text-center" name="repassword" placeholder="Re-password" required>
                </div>
                <input type="submit" class="btn btn-dark" name="register" value="REGISTER">
            </form>
        </div>
    <main>

    <?php include 'templates/pages/footer.php'; ?>

    <?php include 'templates/jquery/jquery.php'; ?>

    <?php
        if (isset($_POST['register'])) {
            if (registrasi($_POST) > 0) {
                echo "<script>alert('Registrasi berhasil! Silahkan login kembali.'); window.location.href='login.php'</script>";
                exit;
            } else {
                echo mysqli_error($conn);
            }
        }
    ?>
</body>
</html>