<?php
include 'db.php';
$id = $_GET['id'];
$query = "SELECT * FROM produk WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan</title>
    <link rel="stylesheet" href="style.css"> <!-- Hubungkan dengan file CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="halaman-edit">
    <h2>Edit Produk</h2>
    <form id="formEditProduk" class="form-container">
        <input type="hidden" name="id" value="<?= $row['id']; ?>">
        <input type="text" name="nama" value="<?= $row['nama']; ?>" required class="form-input">
        <input type="number" name="harga" value="<?= $row['harga']; ?>" required class="form-input">
        <input type="text" name="deskripsi" value="<?= $row['deskripsi']; ?>" required class="form-input">
        <button type="submit" onclick="loadPage('kelola_produk')" class="btn-back">Simpan</button>
    </form>

    <script>
        $("#formEditProduk").submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "proses_edit_produk.php",
                type: "POST",
                data: formData,
                success: function(response) {
                    alert("Produk berhasil diperbarui!");
                    loadPage('kelola_produk');
                }
            });
        });
    </script>
</body>
</html>