<?php
// 1. Hubungkan ke database MySQL
require_once 'koneksi.php';

// 2. Tangkap parameter filter kategori dari URL (Method GET)
$kategori_dipilih = isset($_GET['kategori']) ? trim($_GET['kategori']) : 'all';

// 3. Query produk: Jika ada kategori tertentu, gunakan WHERE kategori = ?
if (!empty($kategori_dipilih) && $kategori_dipilih !== 'all') {
    $stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE kategori = ? ORDER BY id DESC");
    mysqli_stmt_bind_param($stmt, "s", $kategori_dipilih);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    // Tampilkan semua produk jika filter bernilai 'all' atau belum dipilih
    $query  = "SELECT * FROM products ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tugas 8 - E-Commerce PHP & MySQL</title>

  <!-- Bootstrap 5.3 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Google Font: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-orange: #f86f03;
      --orange-hover: #e05e00;
    }
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      color: #212529;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .navbar-brand {
      font-weight: 700;
      font-size: 22px;
    }
    .navbar-brand span {
      color: var(--primary-orange);
    }
    .header-banner {
      background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
      color: #ffffff;
      padding: 45px 0 35px;
      margin-bottom: 30px;
    }
    .filter-btn {
      border: 1.5px solid #dee2e6;
      background-color: #ffffff;
      color: #495057;
      padding: 8px 22px;
      border-radius: 30px;
      font-size: 14px;
      font-weight: 500;
      text-decoration: none;
      display: inline-block;
      transition: all 0.2s ease;
    }
    .filter-btn:hover {
      border-color: var(--primary-orange);
      color: var(--primary-orange);
      transform: translateY(-2px);
    }
    .filter-btn.active {
      background-color: var(--primary-orange);
      border-color: var(--primary-orange);
      color: #ffffff;
      box-shadow: 0 4px 12px rgba(248, 111, 3, 0.3);
    }
    .product-card {
      border: 1px solid #e9ecef;
      border-radius: 12px;
      background: #ffffff;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      height: 100%;
      transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .product-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
    }
    .product-img-box {
      width: 100%;
      height: 200px;
      overflow: hidden;
      background-color: #f1f3f5;
      position: relative;
    }
    .product-img-box img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.35s ease;
    }
    .product-card:hover .product-img-box img {
      transform: scale(1.06);
    }
    .badge-category {
      position: absolute;
      top: 12px;
      left: 12px;
      background-color: rgba(30, 41, 59, 0.85);
      color: #ffffff;
      font-size: 11px;
      font-weight: 600;
      padding: 4px 10px;
      border-radius: 20px;
      text-transform: uppercase;
      backdrop-filter: blur(4px);
    }
    .product-body {
      padding: 18px 20px 20px;
      display: flex;
      flex-direction: column;
      flex-grow: 1;
    }
    .product-title {
      font-size: 16px;
      font-weight: 700;
      margin-bottom: 6px;
    }
    .product-desc {
      font-size: 13px;
      color: #6c757d;
      line-height: 1.6;
      margin-bottom: 14px;
      flex-grow: 1;
    }
    .product-price {
      font-size: 18px;
      font-weight: 700;
      color: var(--primary-orange);
      margin-bottom: 12px;
    }
    .btn-buy {
      background-color: var(--primary-orange);
      color: #ffffff;
      border: none;
      font-size: 13px;
      font-weight: 600;
      padding: 9px 16px;
      border-radius: 8px;
      width: 100%;
      transition: all 0.2s ease;
    }
    .btn-buy:hover {
      background-color: var(--orange-hover);
      color: #ffffff;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top py-3">
    <div class="container">
      <a class="navbar-brand" href="index.php">DHIMSON<span>PEDIA</span></a>
      <span class="badge bg-light text-dark border px-3 py-2">
        <i class="bi bi-database-check me-1 text-success"></i> Connected to MySQL
      </span>
    </div>
  </nav>

  <!-- Banner Header -->
  <header class="header-banner text-center">
    <div class="container">
      <h2 class="fw-bold mb-1">Product Catalog E-Commerce</h2>
      <p class="text-white-50 small mb-0">Data retrieved directly from the MySQL table using PHP looping & query filtering</p>
    </div>
  </header>

  <!-- Konten Utama -->
  <main class="container mb-5">

    <!-- Tombol Filter Kategori (Requirement 3) -->
    <div class="d-flex justify-content-center flex-wrap gap-2 mb-4">
      <a href="index.php?kategori=all" class="filter-btn <?= ($kategori_dipilih === 'all') ? 'active' : '' ?>">All</a>
      <a href="index.php?kategori=elektronik" class="filter-btn <?= ($kategori_dipilih === 'elektronik') ? 'active' : '' ?>">Electronics</a>
      <a href="index.php?kategori=fashion" class="filter-btn <?= ($kategori_dipilih === 'fashion') ? 'active' : '' ?>">Fashion</a>
      <a href="index.php?kategori=aksesoris" class="filter-btn <?= ($kategori_dipilih === 'aksesoris') ? 'active' : '' ?>">Accessories</a>
    </div>

    <!-- Grid Produk Menggunakan Looping PHP (Requirement 2) -->
    <div class="row g-4">
      <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <?php 
          // Looping data baris per baris dari hasil query database
          while ($row = mysqli_fetch_assoc($result)): 
            $gambar_url = !empty($row['gambar']) ? $row['gambar'] : 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&auto=format&fit=crop&q=80';
        ?>
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-card">
              <div class="product-img-box">
                <span class="badge-category"><?= htmlspecialchars($row['kategori']) ?></span>
                <img src="<?= htmlspecialchars($gambar_url) ?>" alt="<?= htmlspecialchars($row['nama_produk']) ?>">
              </div>
              <div class="product-body">
                <h3 class="product-title"><?= htmlspecialchars($row['nama_produk']) ?></h3>
                <p class="product-desc"><?= htmlspecialchars($row['deskripsi']) ?></p>
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span class="product-price mb-0">Rp <?= number_format($row['harga'], 0, ',', '.') ?></span>
                  <span class="badge bg-light text-secondary border">Stok: <?= (int)$row['stok'] ?></span>
                </div>
                <button class="btn btn-buy mt-auto" onclick="alert('Order <?= addslashes(htmlspecialchars($row['nama_produk'])) ?> added successfully!')">
                  <i class="bi bi-cart-plus me-1"></i> Buy Now
                </button>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="col-12 text-center py-5">
          <i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
          <h5 class="fw-bold text-muted">No products found</h5>
          <p class="text-secondary small">There are no items in the database for this category</p>
        </div>
      <?php endif; ?>
    </div>

  </main>

  <!-- Footer -->
  <footer class="mt-auto py-3 bg-white border-top text-center text-muted small">
    &copy; 2026 DHIMSONPEDIA.
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>