<?php
include 'db.php';
$id = $_GET['id'];
$query = "SELECT * FROM pesanan WHERE id = $id";
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

    <h2 class="title">Edit Pesanan</h2>

    <form id="formEditPesanan" action="proses_edit_pesanan.php" method="POST" class="form-container">
        <input type="hidden" name="id" value="<?= $row['id']; ?>">

        <label class="form-label">Nama Pembeli:</label>
        <input type="text" name="nama_pembeli" value="<?= $row['nama_pembeli']; ?>" required class="form-input">

        <label class="form-label">Alamat:</label>
        <input type="text" name="alamat" value="<?= $row['alamat']; ?>" required class="form-input">

        <label class="form-label">No HP:</label>
        <input type="number" name="nomor_hp" value="<?= $row['nomor_hp']; ?>" required class="form-input">

        <label class="form-label">Catatan:</label>
        <textarea name="catatan" required class="form-textarea"><?= $row['catatan']; ?></textarea>

        <label class="form-label">Produk:</label>
        <input type="text" name="produk" value="<?= $row['produk']; ?>" required class="form-input">

        <label class="form-label">Jumlah:</label>
        <input type="number" name="jumlah" value="<?= $row['jumlah']; ?>" required class="form-input">

        <label class="form-label">Total Harga:</label>
        <input type="text" name="total" value="<?= $row['total']; ?>" required class="form-input">

        <button type="submit" class="btn-submit">Simpan</button>
    </form>

    <button type="button" onclick="loadPage('kelola_pesanan')" class="btn-back">Batal</button>

    <script>
        $("#formEditPesanan").submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "proses_edit_pesanan.php",
                type: "POST",
                data: formData,
                success: function(response) {
                    alert("Pesanan berhasil diperbarui!");
                    loadPage('kelola_pesanan');
                }
            });
        });
    </script>

</body>
</html>
