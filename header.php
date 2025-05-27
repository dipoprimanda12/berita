<!-- menampilkan bagian header disetiap halaman -->
<?php
include 'koneksi.php';
$list_kategori = $koneksi->query("SELECT * FROM kategori")->fetch_all(MYSQLI_ASSOC); // Ambil semua data kategori
?>
<header class="navbar">
      <div class="logo">BeritaKita</div>
      <nav>
        <ul class="nav-links">
          <li><a href="index.php">Home</a></li>
          <?php foreach ($list_kategori as $row) {
            echo "<li><a href='kategori.php?nama=" . $row['slug'] . "'>" . $row['nama'] . "</a></li>";// Menampilkan kategori
          }
             ?>
        </ul>
      </nav>
      <form action="search.php" method="GET" class="search-form">
      <input type="text" name="q" placeholder="Cari berita..." required />
      <button type="submit">Cari</button>
    </form>
    </header>