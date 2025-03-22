<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
</head>
<body>

    <div class="sidebar">
        <a href="#" onclick="loadPage('home')">Dashboard</a>
        <a href="#" onclick="loadPage('kelola_produk')">Kelola Produk</a>
        <a href="#" onclick="loadPage('kelola_pesanan')">Pesanan Masuk</a>
        <a href="#" onclick="loadPage('laporan_penjualan')">Laporan Penjualan</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <div class="header">
            <img src="uploads/images.png" alt="Admin Profile">
            <span>Hello, Admin!</span>
        </div>

        <div id="content-area">
            <h2>Selamat Datang di Dashboard</h2>
            <p>Pilih menu di sidebar untuk mengelola data.</p>
        </div>
    </div>

    <script>
    function loadPage(page) {
        $.ajax({
            url: page + ".php",
            type: "GET",
            success: function(response) {
                $("#content-area").html(response);
            }
        });
    }
    </script>

</body>
</html>
