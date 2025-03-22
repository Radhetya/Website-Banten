<?php
include 'db.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$harga = $_POST['harga'];
$stok = $_POST['deskripsi'];

$query = "UPDATE produk SET nama='$nama', harga='$harga', stok='$stok' WHERE id=$id";
mysqli_query($conn, $query);
?>
