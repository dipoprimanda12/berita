<?php 
include 'koneksi.php';

// Ambil semua kategori
$kategori = $koneksi->query("SELECT * FROM kategori")->fetch_all(MYSQLI_ASSOC);

// Ambil 1 artikel terakhir sebagai berita utama
$beritaUtamaResult = $koneksi->query("SELECT * FROM artikel ORDER BY id DESC LIMIT 1");
$berita_utama = $beritaUtamaResult->fetch_assoc();

// Ambil 5 artikel terbaru untuk sidebar populer
$populer = $koneksi->query("SELECT * FROM artikel ORDER BY tanggal DESC LIMIT 5")->fetch_all(MYSQLI_ASSOC);

// Ambil 4 artikel dari kategori tertentu (misalnya: nasional)
$kategori_tertentu = 'nasional';
$berita_lainnya = $koneksi->query("SELECT * FROM artikel WHERE kategori = '$kategori_tertentu' ORDER BY tanggal DESC LIMIT 4")->fetch_all(MYSQLI_ASSOC);

// Cek jika tidak ada berita utama
if (!$berita_utama) {
  die("Berita utama tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Berita Terkini</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <header class="navbar">
    <strong><div class="logo">Berita <span> Kita</span></div></strong>
    <nav>
      <ul class="nav-links">
        <!-- Tombol Home: arahkan ke file index.php -->
        <li><a href="index.php" class="active">Home</a></li>

        <!-- Menu dinamis kategori -->
        <?php foreach ($kategori as $row): ?>
          <li><a href="kategori.php?nama=<?= urlencode($row['slug']) ?>"><?= htmlspecialchars($row['nama']) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>
    
    <form action="search.php" method="GET" class="search-form">
      <input type="text" name="q" placeholder="Cari berita..." required />
      <button type="submit">Cari</button>
    </form>
  </header>

  <main class="content">
    <!-- Berita Utama -->
    <section class="main-news">
      <h2>Berita Utama</h2>
      <article class="post">
        <?php if (!empty($berita_utama['gambar'])): ?>
          <img class="img-depan" src="<?= htmlspecialchars($berita_utama['gambar']) ?>" alt="Gambar Berita Utama" />
        <?php endif; ?>
        <div class="sumber-img">
          <span><?= htmlspecialchars($berita_utama['sumber'] ?? 'Sumber tidak diketahui') ?></span>
        </div>
        <h3>
          <a href="bacaan.php?id=<?= $berita_utama['id'] ?>">
            <?= htmlspecialchars($berita_utama['judul']) ?>
          </a>
        </h3>
        <p><?= nl2br(htmlspecialchars(substr($berita_utama['konten'], 0, 200))) ?>...</p>
        <a href="bacaan.php?id=<?= $berita_utama['id'] ?>" class="btn-detail">Baca Selengkapnya</a>
      </article>
    </section>

    <!-- Berita Kategori Tertentu -->
    <section class="kategori-news">
      <h2>Berita <?= ucfirst(htmlspecialchars($kategori_tertentu)) ?> Terbaru</h2>
      <div class="berita-grid">
        <?php foreach ($berita_lainnya as $berita): ?>
          <article class="berita-item">
            <?php if (!empty($berita['gambar'])): ?>
              <img src="<?= htmlspecialchars($berita['gambar']) ?>" alt="Gambar <?= htmlspecialchars($berita['judul']) ?>" />
            <?php endif; ?>
            <h4>
              <a href="bacaan.php?id=<?= $berita['id'] ?>">
                <?= htmlspecialchars($berita['judul']) ?>
              </a>
            </h4>
            <p><?= htmlspecialchars(substr(strip_tags($berita['konten']), 0, 100)) ?>...</p>
          </article>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Sidebar Populer -->
    <aside class="sidebar">
      <h3>Populer</h3>
      <ul>
        <?php foreach ($populer as $item): ?>
          <li>
            <a href="bacaan.php?id=<?= $item['id'] ?>">
              <?= htmlspecialchars($item['judul']) ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </aside>
  </main>

  <footer class="footer">
    <p>&copy; 2025 BeritaKita. All rights reserved.</p>
  </footer>

  <script src="script.js"></script>
</body>
</html>
