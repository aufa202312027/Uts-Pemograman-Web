<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "registrasi");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Simpan data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["simpan"])) {
    $nama = trim($_POST["nama"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    if (!empty($nama) && !empty($email) && !empty($_POST["password"])) {
        $stmt = $conn->prepare("INSERT INTO users (nama, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $email, $password);
        $stmt->execute();
        $stmt->close();
    }
}

// Hapus data
if (isset($_GET["hapus"])) {
    $id = $_GET["hapus"];
    $conn->query("DELETE FROM users WHERE id=$id");
}

// Ambil semua data
$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Registrasi & Data</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #eef2f3;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
            color: #005f73;
        }
        form {
            background: #ffffff;
            width: 60%;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 12px;
        }
        form input {
            padding: 10px;
            width: 30%;
            margin: 8px 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        form button {
            background: #0a9396;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        form button:hover {
            background: #007f7f;
        }
        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
            background: #ffffff;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #0a9396;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            color: #005f73;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h2>Form Registrasi</h2>
<form method="POST" action="">
    <input type="text" name="nama" placeholder="Nama" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="simpan">Simpan</button>
</form>
    <?php
// Koneksi dan query data kamu di sini

// Fungsi sensorEmail diletakkan di sini, sebelum bagian HTML
function sensorEmail($email) {
    $parts = explode("@", $email);
    $username = $parts[0];
    $domain = $parts[1];

    // Sensor sebagian nama (misal tampilkan 3 karakter awal, sisanya diganti *)
    $visible = substr($username, 0, 3);
    $hidden = str_repeat("*", max(0, strlen($username) - 3));

    return $visible . $hidden . "@" . $domain;
}
?>

<h2>Data Pengguna</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= sensorEmail($row['email']) ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
            <a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>


</body>
</html>
