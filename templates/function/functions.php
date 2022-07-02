<?php
    $conn = mysqli_connect("localhost", "root", "", "petshopqu");

    // fungsi untuk melakukan query
    function query($data) {
        global $conn;
        
        // result
        $result = mysqli_query($conn, $data);

        return $result;
    }

    // fungsi untuk registrasi
    function registrasi($data) {
        global $conn;

        // mengambil nilai inputan user
        $name = strtolower(stripslashes($data["nama"]));
        $username = strtolower(stripslashes($data["username"]));
        $hp = strtolower(stripslashes($data["hp"]));
        $alamat = strtolower(stripslashes($data["alamat"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $repassword = mysqli_real_escape_string($conn, $data["repassword"]);

        // cek username
        $queryUsername = "SELECT username FROM pelanggan WHERE username='$username'";
        $result = mysqli_query($conn, $queryUsername);

        if (mysqli_fetch_assoc($result)) {
            echo "<script>alert('Username sudah terdaftar! Silakan gunakan username lain.');</script>";
            return false;
        }

        // cek confirm password
        if ($password !== $repassword) {
            echo "<script>alert('Konfirm password tidak cocok!');</script>";
            return false;
        }

        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // query
        $query = "INSERT INTO pelanggan VALUES('', '$name', '$username', '$password', '$alamat', '$hp', 'PELANGGAN')";

        // result
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    // fungsi untuk tambah produk
    function tambah($data) {
        global $conn;

        // mengambil nilai inputan user
        $name = htmlspecialchars($data["nama"]);
        $desc = htmlspecialchars($data["deskripsi"]);
        $price = htmlspecialchars($data["harga"]);
        $pic = htmlspecialchars($data["foto"]);

        // query
        $query = "INSERT INTO produk VALUES ('', '$name', '$desc', '$price')";

        // result
        query($query);

        return mysqli_affected_rows($conn);
    }
?>