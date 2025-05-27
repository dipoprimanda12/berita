<?php 
include 'koneksi.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($q === '') {
  die("Masukkan kata kunci pencarian.");
}

// Gunakan LIKE dan LOWER agar pencarian tidak case sensitive
$sql = "SELECT * FROM artikel 
        WHERE LOWER(judul) LIKE LOWER(?) 
        OR LOWER(konten) LIKE LOWER(?) 
        OR LOWER(kategori) LIKE LOWER(?) 
        OR LOWER(tanggal) LIKE LOWER(?)
        ORDER BY tanggal DESC";
$stmt = $koneksi->prepare($sql);
$param = '%' . $q . '%';
$stmt->bind_param("ssss", $param, $param, $param, $param);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Hasil Pencarian: <?= htmlspecialchars($q) ?></title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

<header class="navbar">
  <div class="logo"><a href="index.php">BeritaKita</a></div>
  <form action="search.php" method="GET" class="search-form">
    <input type="text" name="q" value="<?= htmlspecialchars($q) ?>" placeholder="Cari berita atau kategori..." required />
    <button type="submit">Cari</button>
  </form>
</header>

<main class="content">
  <h2>Hasil Pencarian untuk: "<em><?= htmlspecialchars($q) ?></em>"</h2>

  <?php if ($result->num_rows > 0): ?>
    <div class="berita-grid">
      <?php while ($row = $result->fetch_assoc()): ?>
        <article class="berita-item">
          <a href="bacaan.php?id=<?= $row['id'] ?>">
            <?php if (!empty($row['gambar'])): ?>
              <img src="<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['judul']) ?>" />
            <?php endif; ?>
            <div class="judul"><?= htmlspecialchars($row['judul']) ?></div>
            <div class="tanggal"><?= $row['tanggal'] ?></div>
            <p><?= substr(strip_tags($row['konten']), 0, 100) ?>...</p>
          </a>
        </article>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <p>Tidak ada hasil untuk kata kunci "<strong><?= htmlspecialchars($q) ?></strong>".</p>
  <?php endif; ?>
</main>

<div>
  <a href="index.php" class="btn-back">← Kembali</a>
</div>

<footer class="footer">
  <p>&copy; 2025 BeritaKita</p>
</footer>

</body>
</html>
