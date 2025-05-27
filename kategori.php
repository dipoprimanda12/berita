<?php
include 'koneksi.php';

$slug = $_GET['nama'] ?? null; // Ambil slug dari URL

// Ambil semua artikel berdasarkan kategori dan urutkan dari yang terbaru
$artikel = $koneksi->query("SELECT * FROM artikel WHERE kategori='$slug' ORDER BY tanggal DESC")->fetch_all(MYSQLI_ASSOC);

// Cek apakah kategori ditemukan berdasarkan hasil artikel
$kategori = $artikel;

// Ambil 5 artikel terbaru dari kategori ini (jika ingin digunakan di bagian populer, dsb)
$populer = array_slice($artikel, 0, 5);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kategori: <?php echo htmlspecialchars($slug); ?></title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

<?php include 'header.php'; // Menampilkan header ?>

<div class="Berita">Berita <?php echo htmlspecialchars($slug); ?></div>

<div class="kategori">
  <?php 
  if (!$kategori) {
      echo "<p>Kategori tidak ditemukan: <strong>" . htmlspecialchars($slug) . "</strong></p>";
  } else {
      foreach ($artikel as $row) {
          echo "<div class='cart'>";
          echo "<a href='bacaan.php?id=" . $row['id'] . "'>";
          echo "<div class='img'><img src='" . $row['gambar'] . "' alt='Gambar artikel' /></div>";//
          echo "<div class='tanggal'><span>" . $row['tanggal'] . "</span></div>";
          echo "<div class='judul'>" . htmlspecialchars($row['judul']) . "</div>";
          echo "<div class='baca-berita'>Baca selengkapnya</div>";
          echo "</a>";
          echo "</div>";
      }
  }
  ?>
</div>

<div>
  <a href="index.php" class="btn-back">← Kembali</a>
</div>

</body>
</html>
