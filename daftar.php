<?php
include 'koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM users");

echo "<table border='1'>";
echo "<tr><th>ID</th><th>Nama</th><th>Email</th><th>Aksi</th></tr>";

while ($row = mysqli_fetch_assoc($query)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['nama'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td><a href='edit.php?id=" . $row['id'] . "'>Edit</a></td>";
    echo "</tr>";
}

echo "</table>";
?>
