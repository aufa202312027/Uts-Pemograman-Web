<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validasi input
    if (isset($_POST['nama'], $_POST['email'], $_POST['password'])) {
        $nama     = trim($_POST['nama']);
        $email    = trim($_POST['email']);
        $password = $_POST['password'];

        // Hash password untuk keamanan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Siapkan query dengan prepared statement
        $sql  = "INSERT INTO users (nama, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $nama, $email, $hashed_password);
            if (mysqli_stmt_execute($stmt)) {
                echo "Registrasi berhasil!";
            } else {
                echo "Gagal menyimpan data: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Gagal menyiapkan statement: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "Data tidak lengkap!";
    }
} else {
    echo "Akses tidak valid!";
}
?>
