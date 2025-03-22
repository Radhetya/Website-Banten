<?php
include 'db.php';

$id = $_POST['id'];
$nama_pembeli = $_POST['nama_pembeli'];
$alamat = $_POST['alamat'];
$nomor_hp = $_POST['nomor_hp'];
$catatan = $_POST['catatan'];
$produk = $_POST['produk'];
$jumlah = $_POST['jumlah'];
$total = $_POST['total'];

$query = "UPDATE pesanan SET 
            nama_pembeli='$nama_pembeli', 
            alamat='$alamat',
            nomor_hp='$nomor_hp',
            catatan='$catatan',
            produk='$produk', 
            jumlah='$jumlah',
            total='$total' 
          WHERE id=$id";
mysqli_query($conn, $query);
?>
