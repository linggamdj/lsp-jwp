<?php
    include 'templates/config/db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="templates/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Petshopqu | Login</title>
</head>
<body>
    <?php include 'templates/pages/navbar.php'; ?>

    </main>
        <div class="column mt-5 mb-2">
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
                    <input type="text" class="form-control text-center" name="password" placeholder="Password">
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
            $query = "SELECT * FROM pelanggan WHERE username='$username' AND password='$password'";

            // result
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);

                if ($row["role"] == "ADMIN") {
                    echo "<script>alert('Login telah berhasil sebagai Admin'); window.location.href='index.php'</script>";
                    exit;
                } else if ($row["role"] == "PELANGGAN") {
                    echo "<script>alert('Login telah berhasil sebagai Pelanggan'); window.location.href='pelanggan.php'</script>";
                } else {
                    echo "<script>alert('Gagal login, silakan ulangi');</script>";
                }
            }
        }
    ?>
</body>
</html>