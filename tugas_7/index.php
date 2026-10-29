<?php
// ==============================================================
// 1. TUGAS DASAR PHP & 3. VALIDASI FORM
// ==============================================================

// Inisialisasi variabel untuk menampung pesan dan nilai input
$pesan_sukses = "";
$pesan_error  = [];
$nama_produk  = "";
$harga        = "";
$deskripsi    = "";

// Cek apakah form dikirimkan menggunakan method POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 1.a Deklarasi Variabel & Pembersihan Input
    $nama_produk = htmlspecialchars(trim($_POST["nama_produk"]));
    $harga       = trim($_POST["harga"]);
    $deskripsi   = htmlspecialchars(trim($_POST["deskripsi"]));

    // 3. Validasi: Memastikan data yang diinputkan tidak kosong
    // Menggunakan operator logika (empty, ||, <=) dan struktur if-else

    // Validasi Nama Produk
    if (empty($nama_produk)) {
        $pesan_error[] = "Nama produk wajib diisi dan tidak boleh kosong.";
    }

    // Validasi Harga
    if (empty($harga)) {
        $pesan_error[] = "Harga produk wajib diisi.";
    } elseif (!is_numeric($harga) || (int)$harga <= 0) { // Operator logika & perbandingan
        $pesan_error[] = "Harga harus berupa angka valid dan lebih dari 0.";
    }

    // Validasi Deskripsi
    if (empty($deskripsi)) {
        $pesan_error[] = "Deskripsi produk wajib diisi.";
    }

    // Keputusan akhir dengan if-else
    if (empty($pesan_error)) {
        // Jika lolos validasi (data lengkap & benar)
        $harga_format = number_format((int)$harga, 0, ',', '.');
        $pesan_sukses = "Data produk <strong>{$nama_produk}</strong> (Rp {$harga_format}) berhasil divalidasi dan siap disimpan ke database!";
        
        // Reset nilai form setelah berhasil
        $nama_produk = $harga = $deskripsi = "";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tugas 7 - Form Input & Validasi PHP</title>
  <!-- Bootstrap 5.3 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Google Font: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f6f9;
      color: #333;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .card-form {
      border: none;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
      background-color: #ffffff;
    }
    .card-header-custom {
      background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
      color: #ffffff;
      padding: 24px;
      border-top-left-radius: 12px !important;
      border-top-right-radius: 12px !important;
    }
    .btn-submit {
      background-color: #f86f03;
      color: #ffffff;
      font-weight: 600;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      transition: all 0.25s ease;
    }
    .btn-submit:hover {
      background-color: #e05e00;
      color: #ffffff;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(248, 111, 3, 0.35);
    }
  </style>
</head>
<body>

  <!-- Navbar Sederhana -->
  <nav class="navbar navbar-dark bg-dark py-3 mb-4">
    <div class="container">
      <span class="navbar-brand mb-0 h1">
        <i class="bi bi-box-seam me-2 text-warning"></i>Backend PHP Product Input Form 
      </span>
    </div>
  </nav>

  <div class="container my-auto py-4">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">

        <!-- ==============================================================
             NOTIFIKASI VALIDASI (SUKSES ATAU ERROR)
             ============================================================== -->
        <?php if (!empty($pesan_sukses)): ?>
          <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
            <?= $pesan_sukses ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <?php if (!empty($pesan_error)): ?>
          <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <div class="d-flex align-items-center mb-1">
              <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
              <strong>Input Error:</strong>
            </div>
            <ul class="mb-0 ps-4">
              <?php foreach ($pesan_error as $error): ?>
                <li><?= $error ?></li>
              <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <!-- ==============================================================
             2. TUGAS FORM INPUT PRODUK
             ============================================================== -->
        <div class="card card-form">
          <div class="card-header-custom text-center">
            <h4 class="fw-bold mb-1">Add New Product</h4>
            <p class="small text-white-50 mb-0">Input complete product data to be processed by the PHP server</p>
          </div>

          <div class="card-body p-4">
            <form action="" method="POST">
              <!-- Input Nama Produk -->
              <div class="mb-3">
                <label for="nama_produk" class="form-label fw-semibold">Product Name <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text bg-light"><i class="bi bi-tag"></i></span>
                  <input type="text" class="form-control" id="nama_produk" name="nama_produk" 
                         value="<?= htmlspecialchars($nama_produk) ?>" placeholder="Example: Wireless Headphone Pro">
                </div>
              </div>

              <!-- Input Harga Produk -->
              <div class="mb-3">
                <label for="harga" class="form-label fw-semibold">Price (IDR) <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text bg-light">Rp</span>
                  <input type="number" class="form-control" id="harga" name="harga" 
                         value="<?= htmlspecialchars($harga) ?>" placeholder="Contoh: 1500000">
                </div>
              </div>

              <!-- Input Deskripsi Produk -->
              <div class="mb-4">
                <label for="deskripsi" class="form-label fw-semibold">Product Description <span class="text-danger">*</span></label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" 
                          placeholder="Tuliskan spesifikasi atau keterangan produk..."><?= htmlspecialchars($deskripsi) ?></textarea>
              </div>

              <!-- Tombol Simpan -->
              <div class="d-grid">
                <button type="submit" class="btn btn-submit">
                  <i class="bi bi-save2 me-1"></i> Save Product
                </button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>

  <footer class="text-center py-3 text-muted small mt-auto border-top bg-white">
    &copy; 2026 DHIMSONPEDIA.
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>