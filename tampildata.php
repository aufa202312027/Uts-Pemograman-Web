<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef3f6;
            padding: 20px;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: teal;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f3f3f3;
        }
        h2 {
            text-align: center;
            color: #004d4d;
        }
        .aksi a {
            text-decoration: none;
            color: teal;
            margin: 0 5px;
        }
        .aksi a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h2>Data Pengguna</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Aksi</th>
    </tr>

    <?php
    $query = "SELECT * FROM users"; // Ganti 'users' dengan nama tabel kamu
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0):
        while ($row = mysqli_fetch_assoc($result)):
    ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td class="aksi">
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
            </td>
        </tr>
    <?php
        endwhile;
    else:
    ?>
        <tr>
            <td colspan="4" style="text-align:center;">Tidak ada data</td>
        </tr>
    <?php endif; ?>

</table>

</body>
</html>
