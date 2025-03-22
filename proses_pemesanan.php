<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pembeli = mysqli_real_escape_string($conn, $_POST['nama_pembeli']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $nomor_hp = mysqli_real_escape_string($conn, $_POST['nomor_hp']);
    $catatan = mysqli_real_escape_string($conn, $_POST['catatan']);
    $jenis_pembayaran = mysqli_real_escape_string($conn, $_POST['jenis_pembayaran']);
    $metode_pembayaran = mysqli_real_escape_string($conn, $_POST['metode_pembayaran']);
    
    // Cek apakah nomor rekening dikirim atau tidak (untuk pembayaran langsung)
    $nomor_rekening = isset($_POST['nomor_rekening']) ? mysqli_real_escape_string($conn, $_POST['nomor_rekening']) : NULL;
    
    // Ambil data pesanan dari JSON
    $pesanan = json_decode($_POST['pesanan'], true);

    // Cek apakah pesanan tidak kosong
    if (!empty($pesanan)) {
        foreach ($pesanan as $item) {
            $produk = mysqli_real_escape_string($conn, $item['nama']);
            $jumlah = (int) $item['jumlah'];
            $harga = (int) $item['harga'];
            $total = $harga * $jumlah;

            // Jika memilih DP, maka hanya membayar 50%
            if ($jenis_pembayaran === "DP") {
                $total = $total / 2;
            }

            // ✅ Simpan data ke dalam database
            $query = "INSERT INTO pesanan (nama_pembeli, alamat, nomor_hp, catatan, jenis_pembayaran, metode_pembayaran, nomor_rekening, produk, jumlah, total) 
                      VALUES ('$nama_pembeli', '$alamat', '$nomor_hp', '$catatan', '$jenis_pembayaran', '$metode_pembayaran', " . ($nomor_rekening ? "'$nomor_rekening'" : "NULL") . ", '$produk', '$jumlah', '$total')";

            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Terjadi kesalahan saat menyimpan pesanan: " . mysqli_error($conn));
            }
        }

        // ✅ Jika semua berhasil, hapus keranjang & redirect
        echo "<script>
            alert('Pesanan berhasil dikirim!');
            localStorage.removeItem('keranjang'); // Hapus keranjang belanja
            window.location.href = 'index.php'; // Kembali ke halaman utama
        </script>";
    } else {
        echo "<script>alert('Pesanan kosong, silakan pilih produk!'); window.history.back();</script>";
    }
}
?>
