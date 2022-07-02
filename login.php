<?php
    include 'templates/config/db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'templates/pages/style.php'; ?>

    <title>Petshopqu | Login</title>
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
                    <label for="username">USERNAME</label>
                    <input type="text" class="form-control text-center" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="password">PASSWORD</label>
                    <input type="password" class="form-control text-center" name="password" placeholder="Password">
                </div>
                <input type="submit" class="btn btn-dark" name="login" value="LOGIN">
            </form>
        </div>
    <main>

    <?php include 'templates/pages/footer.php'; ?>

    <?php include 'templates/jquery/jquery.php'; ?>

    <?php
        if (isset($_POST['login'])) {
            // mengambil nilai inputan user
            $username = $_POST['username'];
            $password = $_POST['password'];

            // query
            $query = "SELECT * FROM pelanggan WHERE username='$username'";

            // result
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);

                // verifikasi password
                $verify = password_verify($password, $row["password"]);

                if ($verify) {
                    if ($row["role"] == "ADMIN") {
                        echo "<script>alert('Login telah berhasil sebagai Admin'); window.location.href='index.php'</script>";
                        exit;
                    } else if ($row["role"] == "PELANGGAN") {
                        echo "<script>alert('Login telah berhasil sebagai Pelanggan'); window.location.href='pelanggan.php'</script>";
                        exit;
                    } else {
                        echo "<script>alert('Gagal login, silakan ulangi');</script>";
                        exit;
                    }
                }
            } else {
                echo "<script>alert('Username atau password salah!');</script>";
                exit;
            }
        }
    ?>
</body>
</html>