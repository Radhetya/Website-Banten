<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="style.css"> <!-- Hubungkan dengan file CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="halaman-tambah">

    <h2 class="title">Tambah Produk</h2>

    <form id="formTambahProduk" action="proses_tambah_produk.php" method="POST" enctype="multipart/form-data" class="form-container">
        
        <label class="form-label">Nama Produk:</label>
        <input type="text" name="nama" required class="form-input">

        <label class="form-label">Harga:</label>
        <input type="number" name="harga" required class="form-input">

        <label class="form-label">Deskripsi Produk:</label>
        <textarea name="deskripsi" required class="form-textarea"></textarea>

        <label class="form-label">Upload Gambar:</label>
        <input type="file" name="gambar" accept="image/*" required class="form-input">

        <button type="submit" class="btn-submit">Tambah Produk</button>
    </form>

    <button type="button" onclick="kembaliKeDashboard()" class="btn-back">Kembali ke Dashboard</button>

    <script>
        $("#formTambahProduk").submit(function(e) {
            e.preventDefault(); 
            var formData = new FormData(this);
            $.ajax({
                url: "proses_tambah_produk.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert(response);  // Menampilkan respon dari PHP
                    loadPage('kelola_produk'); // Reload halaman kelola produk
                }
            });
        });

        function kembaliKeDashboard() {
            loadPage('dashboard');
        }
    </script>

</body>
</html>
