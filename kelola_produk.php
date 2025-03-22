<?php
include 'db.php';

// Ambil data produk dari database
$query = "SELECT * FROM produk";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h2>Kelola Produk</h2>
<a href="#" onclick="loadPage('tambah_produk')" class="button button-primary">Tambah Produk</a>

<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama']; ?></td>
                <td>Rp<?= number_format($row['harga']); ?></td>
                <td><?= $row['deskripsi']; ?></td>
                <td><img src="uploads/<?= $row['gambar']; ?>" width="50" style="border-radius: 6px;"></td>
                <td>
                    <button class="button button-primary" onclick="editProduk(<?= $row['id']; ?>)">Edit</button>
                    <button class="button button-danger" onclick="hapusProduk(<?= $row['id']; ?>)">Hapus</button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    function editProduk(id) {
        $.ajax({
            url: "edit_produk.php",
            type: "GET",
            data: { id: id },
            success: function(response) {
                $("#content-area").html(response);
            }
        });
    }

    function hapusProduk(id) {
        if (confirm("Yakin ingin menghapus produk ini?")) {
            $.ajax({
                url: "hapus_produk.php",
                type: "GET",
                data: { id: id },
                success: function(response) {
                    alert("Produk berhasil dihapus!");
                    loadPage('kelola_produk');
                }
            });
        }
    }
</script>

</body>
</html>
