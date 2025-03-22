<?php
// Hubungkan ke database
include 'db.php';

// Hitung jumlah produk
$queryProduk = mysqli_query($conn, "SELECT COUNT(*) AS total_produk FROM produk");
$dataProduk = mysqli_fetch_assoc($queryProduk);
$totalProduk = $dataProduk['total_produk'];

// Hitung jumlah pesanan masuk
$queryPesanan = mysqli_query($conn, "SELECT COUNT(*) AS total_pesanan FROM pesanan");
$dataPesanan = mysqli_fetch_assoc($queryPesanan);
$totalPesanan = $dataPesanan['total_pesanan'];
?>

<div class="dashboard-info">
    <div class="info-box">
        <h3>Jumlah Produk</h3>
        <p><?php echo $totalProduk; ?></p>
    </div>
    <div class="info-box">
        <h3>Pesanan Masuk</h3>
        <p><?php echo $totalPesanan; ?></p>
    </div>
</div>

<style>
.dashboard-info {
    display: flex;
    gap: 20px;
    margin: 20px 0;
}
.info-box {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    width: 200px;
    text-align: center;
}
h3 {
    margin-bottom: 10px;
    color: #333;
}
p {
    font-size: 24px;
    font-weight: bold;
    color: #007bff;
}
</style>
