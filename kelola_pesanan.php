<?php
include 'db.php';
$query = "SELECT * FROM pesanan ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h2>Kelola Pesanan</h2>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Nama Pembeli</th>
        <th>Alamat</th>
        <th>Nomor HP</th>
        <th>Catatan</th>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Total Harga</th>
        <th>Jenis Pembayaran</th>
        <th>Metode Pembayaran</th>
        <th>Rekening Tujuan</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?= $row['id']; ?></td>
        <td><?= $row['nama_pembeli']; ?></td>
        <td><?= $row['alamat']; ?></td>
        <td><?= $row['nomor_hp']; ?></td>
        <td><?= $row['catatan']; ?></td>
        <td><?= $row['produk']; ?></td>
        <td><?= $row['jumlah']; ?></td>
        <td><?= $row['total']; ?></td>
        <td><?= $row['jenis_pembayaran']; ?></td>
        <td><?= $row['metode_pembayaran']; ?></td>
        <td><?= $row['nomor_rekening']; ?></td>
        <td>
            <button class="button button-primary" onclick="editPesanan(<?= $row['id']; ?>)">Edit</button>
            <button class="button button-danger" onclick="hapusPesanan(<?= $row['id']; ?>)">Hapus</button>
        </td>
    </tr>
    <?php } ?>
</table>

<!-- Tombol kembali ke Dashboard -->
<a href="dashboard.php" class="button button-primary" margin-top="40px">Kembali ke Dashboard</a>

<script>
    function editPesanan(id) {
        $.ajax({
            url: "edit_pesanan.php",
            type: "GET",
            data: { id: id },
            success: function(response) {
                $("#content-area").html(response);
            }
        });
    }

    function hapusPesanan(id) {
        if (confirm("Yakin ingin menghapus pesanan ini?")) {
            $.ajax({
                url: "hapus_pesanan.php",
                type: "GET",
                data: { id: id },
                success: function(response) {
                    alert("Pesanan berhasil dihapus!");
                    loadPage('kelola_pesanan');
                }
            });
        }
    }
</script>

</body>
</html>
