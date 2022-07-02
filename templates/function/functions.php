<?php
    $conn = mysqli_connect("localhost", "root", "", "petshopqu");

    // fungsi untuk melakukan query
    function query($data) {
        global $conn;
        
        // result
        $result = mysqli_query($conn, $data);

        $rows = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
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

    // fungsi untuk tambah data
    function tambah($data) {
        global $conn;

        // mengambil nilai inputan user
        $name = htmlspecialchars($data["nama"]);
        $desc = htmlspecialchars($data["deskripsi"]);
        $price = htmlspecialchars($data["harga"]);
        $pic = htmlspecialchars($data["gambar"]);


        // mengupload gambar
        $pic = upload();

        if (!$pic) {
            return false;
        }

        // query
        $query = "INSERT INTO produk VALUES ('', '$name', '$desc', '$price', '$pic')";

        // result
        query($query);

        return mysqli_affected_rows($conn);
    }

    // fungsi untuk upload
    function upload() {
        // mengambil nilai-nilai file
        $fileName = $_FILES['gambar']['name'];
        $fileSize = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmp = $_FILES['gambar']['tmp_name'];

        // mengecek apakah file sudah terupload (4 = no file was uploaded)
        if ($error === 4) {
            echo "<script>alert('Pilih gambar dahulu!');</script>";
            return false;
        }

        // ekstensi gambar yang diterima
        $picExtension = ['jpg', 'jpeg', 'png', 'gif'];

        // mengecek ekstensi file yang telah diupload
        $uploadedExtension = explode('.', $fileName);
        $uploadedExtension = strtolower(end($uploadedExtension));

        if (!in_array($uploadedExtension, $picExtension)) {
            echo "<script>alert('Yang diupload bukan file gambar!');</script>";
            return false;
        }

        // membatasi ukuran file (byte)
        if ($fileSize > 2000000) {
            echo "<script>alert('File gambar terlalu besar! Max 2MB');</script>";
            return false;
        }

        // generate nama file baru
        $newName = uniqid();
        $newName .= '.';
        $newName .= $uploadedExtension;


        // mengupload file
        move_uploaded_file($tmp, "C:/xampp/htdocs/petshopqu/templates/uploads/" . $newName);

        return $newName;
    }

    //fungsi untuk mengubah data
    function ubah($data) {
        global $conn;

        // mengambil nilai inputan user
        $id = $data["id"];
        $name = htmlspecialchars($data["nama"]);
        $desc = htmlspecialchars($data["deskripsi"]);
        $price = htmlspecialchars($data["harga"]);
        $pic = htmlspecialchars($data["foto"]);

        // query
        $query = "UPDATE produk SET
                nama_produk = '$name',
                deskripsi_produk = '$desc',
                harga_produk = $price
                WHERE ID_produk = $id
                ";

        // result
        query($query);

        return mysqli_affected_rows($conn);
    }

    // fungsi untuk menghapus data
    function hapus($data) {
        global $conn;

        mysqli_query($conn, "DELETE FROM produk WHERE ID_produk = $data");

        return mysqli_affected_rows($conn);
    }
?>