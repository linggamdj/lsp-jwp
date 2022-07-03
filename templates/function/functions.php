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

    // fungsi untuk login
    function login($data) {
        global $conn;

        // mengambil nilai inputan user
        $username = $data['username'];
        $password = $data['password'];

        // query pengecekan username ada atau tidak
        $query = "SELECT * FROM pelanggan WHERE username='$username'";

        // result
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            // verifikasi password
            $verify = password_verify($password, $row["password"]);

            if ($verify) {
                // set session
                $_SESSION["login"] = true;
                $_SESSION["username"] = $username;

                if ($row["role"] == "ADMIN") {
                    echo "<script>alert('Login telah berhasil sebagai Admin'); window.location.href='http://localhost/petshopqu'</script>";
                    exit;
                } else if ($row["role"] == "PELANGGAN") {
                    echo "<script>alert('Login telah berhasil sebagai Pelanggan'); window.location.href='http://localhost/petshopqu'</script>";
                    exit;
                } else {
                    echo "<script>alert('Gagal login, silakan ulangi');</script>";
                    exit;
                }
            } else {
                echo "<script>alert('Username atau password salah!');</script>";
                exit;
            }
        } else {
            echo "<script>alert('Username belum terdaftar!');</script>";
            exit;
        }
    }

    // fungsi untuk tambah data
    function tambah($data) {
        global $conn;

        // mengambil nilai inputan user
        $name = htmlspecialchars($data["nama"]);
        $desc = htmlspecialchars($data["deskripsi"]);
        $price = htmlspecialchars($data["harga"]);

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
        $oldPic = htmlspecialchars($data["gambarLama"]);

        // mengecek apakah user mengupload gambar baru
        if ($_FILES['gambar']['error'] === 4) {
            $pic = $oldPic;
        } else {
            $pic = upload();
        }
        

        // query
        $query = "UPDATE produk SET
                nama_produk = '$name',
                deskripsi_produk = '$desc',
                harga_produk = $price,
                gambar = '$pic'
                WHERE ID_produk = $id
                ";

        // result
        query($query);

        return mysqli_affected_rows($conn);
    }

    // fungsi untuk menghapus data
    function hapus($data) {
        global $conn;

        $file = mysqli_fetch_assoc(mysqli_query($conn, "SELECT gambar FROM produk WHERE ID_produk = $data"));
        
        unlink("C:/xampp/htdocs/petshopqu/templates/uploads/", $file);

        mysqli_query($conn, "DELETE FROM produk WHERE ID_produk = $data");

        return mysqli_affected_rows($conn);
    }

    // fungsi untuk search
    function cari($data) {
        $query = "SELECT * FROM produk
                    WHERE nama_produk LIKE '%$data%' OR
                    deskripsi_produk LIKE '%$data%' OR
                    harga_produk LIKE '%$data%'
                    ORDER BY ID_produk ASC
                ";

        return query($query);
    }
?>