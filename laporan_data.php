<?php
include 'db.php';

// Ambil filter dari AJAX
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'semua';

// Query default (semua data)
$query = "SELECT * FROM pesanan ORDER BY id DESC";

// Filter berdasarkan pilihan
if ($filter == 'hari') {
    $query = "SELECT * FROM pesanan WHERE DATE(tanggal) = CURDATE() ORDER BY id DESC";
} elseif ($filter == 'minggu') {
    $query = "SELECT * FROM pesanan WHERE YEARWEEK(tanggal, 1) = YEARWEEK(CURDATE(), 1) ORDER BY id DESC";
} elseif ($filter == 'bulan') {
    $query = "SELECT * FROM pesanan WHERE MONTH(tanggal) = MONTH(CURDATE()) AND YEAR(tanggal) = YEAR(CURDATE()) ORDER BY id DESC";
} elseif ($filter == 'tahun') {
    $query = "SELECT * FROM pesanan WHERE YEAR(tanggal) = YEAR(CURDATE()) ORDER BY id DESC";
}

$result = mysqli_query($conn, $query);

// Hitung total pendapatan
$total_pendapatan = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $total_pendapatan += $row['total'];
}

// Kembalikan pointer ke awal hasil query agar data bisa ditampilkan
mysqli_data_seek($result, 0);
?>

<table border="1" cellspacing="0" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nama Pembeli</th>
        <th>Alamat</th>
        <th>Nomor HP</th>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Total Harga</th>
        <th>Tanggal</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?= $row['id']; ?></td>
        <td><?= $row['nama_pembeli']; ?></td>
        <td><?= $row['alamat']; ?></td>
        <td><?= $row['nomor_hp']; ?></td>
        <td><?= $row['produk']; ?></td>
        <td><?= $row['jumlah']; ?></td>
        <td>Rp <?= number_format($row['total'], 0, ',', '.'); ?></td>
        <td><?= $row['tanggal']; ?></td>
    </tr>
    <?php } ?>
    <!-- Baris total pendapatan -->
    <tr>
        <td colspan="6" align="right"><strong>Total Pendapatan:</strong></td>
        <td colspan="2"><strong>Rp <?= number_format($total_pendapatan, 0, ',', '.'); ?></strong></td>
    </tr>
</table>
