<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h2>Laporan Penjualan</h2>

<!-- Dropdown Filter -->
<label for="filter">Tampilkan berdasarkan:</label>
<select id="filter" class="form-input">
    <option value="semua">Semua</option>
    <option value="hari">Hari Ini</option>
    <option value="minggu">Minggu Ini</option>
    <option value="bulan">Bulan Ini</option>
    <option value="tahun">Tahun Ini</option>
</select>

<!-- Div untuk laporan tabel -->
<div id="laporan">
    <?php include 'laporan_data.php'; ?>  <!-- Load tabel awal -->
</div>

<!-- Tombol Cetak -->
<button onclick="cetakLaporan()" class="button button-primary">Cetak Laporan</button>

<!-- Tombol Kembali ke Dashboard -->
<a href="#" onclick="loadPage('dashboard')">
    <button type="button" class="button button-primary">Kembali ke Dashboard</button>
</a>

<!-- CSS untuk cetak -->
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #laporan, #laporan * {
            visibility: visible;
        }
        #laporan {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }
    }
</style>

<script>
    // AJAX untuk mengganti tabel tanpa reload
    $(document).ready(function() {
        $("#filter").change(function() {
            var filter = $(this).val();
            $.ajax({
                url: "laporan_data.php",
                type: "GET",
                data: { filter: filter },
                success: function(response) {
                    $("#laporan").html(response);  // Hanya perbarui tabel
                }
            });
        });
    });

    function cetakLaporan() {
        window.print();
    }
</script>

</body>
</html>
