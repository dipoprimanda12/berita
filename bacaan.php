<?php
include 'koneksi.php';
include 'header.php';

// Ambil ID dari URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Ambil data artikel berdasarkan ID
$query = $koneksi->query("SELECT * FROM artikel WHERE id = $id");
$data = $query->fetch_assoc();

// Jika tidak ditemukan, tampilkan pesan
if (!$data) {
    die("Artikel tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?php echo $data['judul']; ?> - BeritaKita</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

<main class="artikel">
  <h2><?php echo $data['judul']; ?></h2>
  <p class="meta">Kategori: <strong><?php echo $data['kategori']; ?></strong> | Tanggal: <?php echo $data['tanggal']; ?></p>

  <?php if (!empty($data['gambar'])) : ?>
    <img src="<?php echo $data['gambar']; ?>" alt="Gambar Artikel" class="gambar-utama" />
  <?php endif; ?>

  <p><?php echo nl2br($data['konten']); ?></p>

 <a href="javascript:history.back()" class="btn-back">← Kembali</a>

</main>

<footer class="footer">
  <p>&copy; 2025 BeritaKita</p>
</footer>

</body>
</html>
