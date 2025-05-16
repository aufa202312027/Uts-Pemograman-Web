<?php
// Koneksi database
$conn = new mysqli("localhost", "root", "", "registrasi");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data berdasarkan ID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data dari database
    $result = $conn->query("SELECT * FROM users WHERE id = $id");
    $data = $result->fetch_assoc();

    if (!$data) {
        echo "Data tidak ditemukan!";
        exit;
    }
} else {
    echo "ID tidak ditemukan!";
    exit;
}

// Update data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users SET nama = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nama, $email, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php"); // Redirect kembali
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f7f7f7;
            padding: 20px;
        }
        form {
            background: #ffffff;
            padding: 25px;
            margin: auto;
            width: 50%;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 12px;
        }
        h2 {
            text-align: center;
            color: #005f73;
        }
        input[type="text"], input[type="email"] {
            width: 95%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            background: #0a9396;
            color: #fff;
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #007f7f;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #005f73;
        }
    </style>
</head>
<body>

<h2>Edit Data Pengguna</h2>
<form method="POST" action="">
    <label>Nama</label><br>
    <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required><br>

    <label>Email</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required><br>

    <button type="submit">Simpan Perubahan</button>
    <br><a href="index.php">← Kembali</a>
</form>

</body>
</html>