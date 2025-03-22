<?php
include 'db.php';
session_start();

// Ambil data produk dari database
$query = "SELECT * FROM produk";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BantenNiniMangku</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style1.css">
</head>
<body>

<!-- Navbar -->
<div id="home" class="navbar">
    <h1>BantenNiniMangku</h1>
    <div class="nav-right">
        <div class="nav-links">
            <button onclick="location.href='#home'">Home</button>
            <button onclick="location.href='#about'">About Us</button>
            <button onclick="location.href='#contact'">Contact Us</button>
        </div>
        <div class="cart-container">
            <div class="cart-icon" onclick="toggleKeranjang()">🛒</div>
            <span id="cart-count">0</span>
        </div>
    </div>
</div>


<!-- Hero Section -->
<!-- Hero Section dengan Gambar -->
<div class="hero">
    <img src="uploads/banten.jpg" alt="Banner Utama" class="hero-image">
    <a href="#produks" class="shop-now-btn">SHOP NOW</a>
</div>

<!-- About Us -->
<div id="about" class="about-section">
    <div class="about-text">
        <h2 >About BantenNiniMangku</h2>
        <p>BantenNiniMangku adalah penyedia perlengkapan banten berkualitas dengan harga terjangkau.</p>
        <p>Kami menyediakan berbagai kategori perlengkapan banten, termasuk:</p>
        <p>Kami berharap dapat menjadi bagian dari perjalanan spiritual Anda.</p>
        <p><strong>Website ini melayani pembelian eceran dan grosir.</strong></p>
    </div>
    <div class="about-image">
        <img src="uploads/banten.jpg" alt="Tentang Kami">
    </div>
</div>

<!-- Produk -->
<h2 style="text-align: center;">Produk</h2>
<div id="produks" class="produk-container">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="produk">
            <div class="produk-gambar">
                <img src="uploads/<?= $row['gambar']; ?>" alt="<?= $row['nama']; ?>">
            </div>
            <div class="produk-detail">
                <h3><?= $row['nama']; ?></h3>
                <p class="deskripsi"><?= $row['deskripsi']; ?></p>
                <p class="harga">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
                <button onclick="tambahKeKeranjang(<?= $row['id']; ?>, '<?= $row['nama']; ?>', <?= $row['harga']; ?>)">Tambah ke Keranjang</button>
            </div>
        </div>
    <?php } ?>
</div>

<!-- Sidebar Keranjang -->
<div class="cart-sidebar" id="cart-sidebar">
    <span class="close-btn" onclick="toggleKeranjang()">✖</span>
    <h2>Keranjang Belanja</h2>
    <table id="cart-table">
        <tr>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </table>
    <button onclick="checkout()">Pesan Sekarang</button>
</div>

<script>
    let keranjang = [];

    function tambahKeKeranjang(id, nama, harga) {
        let produk = keranjang.find(item => item.id === id);
        if (produk) {
            produk.jumlah++;
        } else {
            keranjang.push({ id, nama, harga, jumlah: 1 });
        }
        updateKeranjang();
    }

    function hapusDariKeranjang(index) {
        keranjang.splice(index, 1);
        updateKeranjang();
    }

    function updateKeranjang() {
    let table = document.getElementById("cart-table");
    table.innerHTML = `
        <tr>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    `;

    keranjang.forEach((item, index) => {
        table.innerHTML += `
            <tr>
                <td>${item.nama}</td>
                <td>${item.jumlah}</td>
                <td>Rp ${item.harga.toLocaleString()}</td>
                <td>Rp ${(item.harga * item.jumlah).toLocaleString()}</td>
                <td><button onclick="hapusDariKeranjang(${index})">Hapus</button></td>
            </tr>
        `;
    });

    // Update notifikasi jumlah barang di ikon keranjang
    let cartCount = document.getElementById("cart-count");
    let totalItems = keranjang.reduce((total, item) => total + item.jumlah, 0);
    cartCount.textContent = totalItems;
    cartCount.style.visibility = totalItems > 0 ? "visible" : "hidden";
    }


    function checkout() {
        if (keranjang.length === 0) {
            alert("Keranjang belanja kosong!");
            return;
        }
        let dataKeranjang = JSON.stringify(keranjang);
        localStorage.setItem("keranjang", dataKeranjang);
        window.location.href = "checkout.php";
    }

    function toggleKeranjang() {
    let sidebar = document.getElementById("cart-sidebar");
    
    if (sidebar.style.display === "none" || sidebar.style.display === "") {
        sidebar.style.display = "block"; // Tampilkan sidebar
        setTimeout(() => {
            sidebar.classList.add("active"); // Geser sidebar masuk
        }, 10);
    } else {
        sidebar.classList.remove("active"); // Geser sidebar keluar
        setTimeout(() => {
            sidebar.style.display = "none"; // Sembunyikan sidebar setelah animasi
        }, 300);
    }
}

</script>



<!-- Contact Us -->
<div id="contact" class="contact-section">
    <h2>Contact Us</h2>
    <div class="contact-box">
        <p>Email: <a href="mailto:support@bantenninimangku.com">support@bantenninimangku.com</a></p>
        <p>Telepon: 082147075005</p>
        <p>Alamat: Br. Tengkulak Tengah, Kemenuh</p>
    </div>
</div>

<button id="scrollToTopBtn" class="scroll-to-top" onclick="scrollToTop()">⬆</button>

<script>
    // Tampilkan tombol saat scroll ke bawah
    window.onscroll = function() {
        let btn = document.getElementById("scrollToTopBtn");
        if (document.documentElement.scrollTop > 200) {
            btn.style.display = "block";
        } else {
            btn.style.display = "none";
        }
    };

    // Fungsi untuk scroll ke atas
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: "smooth" });
    }
</script>
</body>
</html>
