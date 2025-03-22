<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="checkout-page">

    <div class="checkout-container">
        <h2>Form Pemesanan</h2>
        <form action="proses_pemesanan.php" method="POST" class="order-form">
            
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama_pembeli" class="form-input" placeholder="Masukkan nama Anda" required>
            </div>

            <div class="form-group">
                <label>Alamat:</label>
                <input type="text" name="alamat" class="form-input" placeholder="Masukkan alamat lengkap" required>
            </div>

            <div class="form-group">
                <label>No HP:</label>
                <input type="text" name="nomor_hp" class="form-input" placeholder="Masukkan nomor HP" required>
            </div>

            <div class="form-group">
                <label>Catatan:</label>
                <textarea name="catatan" class="form-textarea" placeholder="Tambahkan catatan untuk pesanan Anda"></textarea>
            </div>

            <h3>Produk yang Dipesan</h3>
            <table class="order-table" id="order-table">
                <tr>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                </tr>
            </table>

            <input type="hidden" name="pesanan" id="pesanan">
            
            <!-- Pilihan Jenis Pembayaran -->
            <div class="form-group">
                <label>Pilih Jenis Pembayaran:</label>
                <select name="jenis_pembayaran" class="form-input" id="jenis_pembayaran">
                    <option value="Full">💰 Full</option>
                    <option value="DP">💳 DP (50%)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Metode Pembayaran:</label>
                <select name="metode_pembayaran" class="form-input" id="metode_pembayaran" onchange="tampilkanRekening()">
                    <option value="Langsung">💵 Bayar Langsung</option>
                    <option value="Transfer">🏦 Transfer Bank</option>
                </select>
            </div>

            <div id="rekening-container" class="form-group" style="display: none;">
                <label>Rekening Tujuan:</label>
                <select name="nomor_rekening" class="form-input">
                    <option value="BCA - 1234567890">BCA - 1234567890 - A/N PT Banten</option>
                    <option value="Mandiri - 0987654321">Mandiri - 0987654321 - A/N PT Banten</option>
                    <option value="BRI - 5678901234">BRI - 5678901234 - A/N PT Banten</option>
                </select>
            </div>

            <!-- Menampilkan total harga -->
            <div class="form-group">
                <label>Total Harga yang Dibayar:</label>
                <strong id="total-harga">Rp 0</strong>
                <input type="hidden" name="total" id="total_bayar">
            </div>

            <div class="btn-container">
                <button type="submit" class="button button-primary">Kirim Pesanan</button>
                <button type="button" class="button button-secondary" onclick="window.location.href='index.php'">Kembali</button>
            </div>
        </form>
    </div>

    <script>
        let keranjang = JSON.parse(localStorage.getItem("keranjang")) || [];
        let table = document.getElementById("order-table");
        let pesananInput = document.getElementById("pesanan");
        let jenisPembayaran = document.getElementById("jenis_pembayaran");
        let totalHargaElement = document.getElementById("total-harga");
        let totalBayarInput = document.getElementById("total_bayar");

        // Hitung total harga awal
        let totalHarga = keranjang.reduce((total, item) => total + (item.harga * item.jumlah), 0);
        totalHargaElement.innerText = `Rp ${totalHarga.toLocaleString()}`;
        totalBayarInput.value = totalHarga; // Default full payment

        keranjang.forEach(item => {
            let row = table.insertRow();
            row.innerHTML = `
                <td>${item.nama}</td>
                <td>${item.jumlah}</td>
                <td>Rp ${(item.harga * item.jumlah).toLocaleString()}</td>
            `;
        });

        pesananInput.value = JSON.stringify(keranjang);

        // Ubah total harga saat memilih DP atau Full
        jenisPembayaran.addEventListener("change", function () {
            let hargaBayar = (this.value === "DP") ? totalHarga * 0.5 : totalHarga;
            totalHargaElement.innerText = `Rp ${hargaBayar.toLocaleString()}`;
            totalBayarInput.value = hargaBayar;
        });

        function tampilkanRekening() {
            let metode = document.getElementById("metode_pembayaran").value;
            let rekeningContainer = document.getElementById("rekening-container");

            rekeningContainer.style.display = metode === "Transfer" ? "block" : "none";
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let jenisPembayaran = document.getElementById("jenis_pembayaran");
            let totalHargaEl = document.getElementById("total-harga");
            let totalBayarInput = document.getElementById("total_bayar");

            function hitungTotal() {
                let keranjang = JSON.parse(localStorage.getItem("keranjang")) || [];
                let total = keranjang.reduce((acc, item) => acc + (item.harga * item.jumlah), 0);

                // Jika DP, hanya bayar 50%
                if (jenisPembayaran.value === "DP") {
                    total *= 0.5;
                }

                totalHargaEl.textContent = `Rp ${total.toLocaleString()}`;
                totalBayarInput.value = total; // Pastikan nilai yang dikirim ke database benar
            }

            // Panggil fungsi pertama kali
            hitungTotal();

            // Event Listener untuk dropdown jenis pembayaran
            jenisPembayaran.addEventListener("change", hitungTotal);
        });
    </script>
</body>
</html>
