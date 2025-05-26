<!-- menampilkan bagian header disetiap halaman -->
<?php
include 'koneksi.php';
$list_kategori = $koneksi->query("SELECT * FROM kategori")->fetch_all(MYSQLI_ASSOC); // Ambil semua data kategori
?>
<header class="navbar">
      <div class="logo">BeritaKita</div>
      <nav>
        <ul class="nav-links">
          <li><a href="#">Home</a></li>
          <?php foreach ($list_kategori as $row) {
            echo "<li><a href='kategori.php?nama=" . $row['slug'] . "'>" . $row['nama'] . "</a></li>";// Menampilkan kategori
          }
             ?>
        </ul>
      </nav>
      <input type="text" id="searchInput" placeholder="Cari berita..." />
    </header>