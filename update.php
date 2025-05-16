<?php
include 'koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$email = $_POST['email'];

mysqli_query($conn, "UPDATE users SET nama='$nama', email='$email' WHERE id=$id");
header("Location: tampil.php");
?>
