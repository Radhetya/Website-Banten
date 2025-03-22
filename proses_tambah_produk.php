<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

$nama = $_POST['nama'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];
$gambar = $_FILES['gambar']['name'];
$target = "uploads/" . basename($gambar);

if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
    $query = "INSERT INTO produk (nama, harga, deskripsi, gambar) VALUES ('$nama', '$harga', '$deskripsi', '$gambar')";
    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Produk berhasil ditambahkan!');
                window.location.href = 'dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . mysqli_error($conn) . "');
                window.history.back();
              </script>";
    }
} else {
    echo "<script>
            alert('Gagal mengupload gambar.');
            window.history.back();
          </script>";
}
?>

