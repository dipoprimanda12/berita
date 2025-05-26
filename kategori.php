<?php
include 'koneksi.php';
$slug = $_GET['nama'] ?? null; // Ambil slug dari URL
$kategori = $koneksi->query("SELECT * FROM artikel WHERE kategori='$slug'")->fetch_all(MYSQLI_ASSOC);// Ambil data kategori berdasarkan slug
$artikel = $koneksi->query("SELECT * FROM artikel WHERE kategori='$slug'")->fetch_all(MYSQLI_ASSOC);// Ambil semua data artikel berdasarkan kategori
$populer = $koneksi->query("SELECT * FROM artikel WHERE kategori='$slug' ORDER BY tanggal DESC LIMIT 5")->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kategori</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  
   
<?php
include 'header.php'; // Menampilkan header.php

?>
  <div class="Berita">Berita <?php echo($slug);?></div>
  <div class="kategori">
    <?php 
    if (!$kategori) {
        echo "kategori tidak ada ".$slug;
    }
    foreach ($artikel as $row) {
        echo "<div class='cart'>";
        echo "<a href='bacaan.php?id=" . $row['id'] . "'>";
        echo "<div class='img'><img src=".$row['gambar']." alt='' /></div>";// Menampilkan gambar artikel
        echo "<div class='tanggal'><span>" . $row['tanggal'] . "</span></div>";
        echo "<div class='judul'>" . $row['judul'] . "</div>";
        echo "<div class='baca-berita'>baca selengkapnya</div>";
        echo "</a>";
        echo "</div>";
    }
    ?>
    
  </div>
  <div>
    <a href="index.php" class="btn-back">← Kembali</a>
  </div>
  <body></body>
</html>
