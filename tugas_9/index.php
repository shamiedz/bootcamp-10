<?php
session_start();
require_once 'koneksi.php';

// Inisialisasi session keranjang jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$pesan = "";
$tipe_pesan = "";

// Buat folder uploads jika belum tersedia
if (!is_dir('uploads')) {
    mkdir('uploads', 0777, true);
}

// ==============================================================
// 1. CREATE: Tambah Produk Baru (Dengan Upload Gambar)
// ==============================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_produk'])) {
    $nama_produk = htmlspecialchars(trim($_POST['nama_produk']));
    $deskripsi   = htmlspecialchars(trim($_POST['deskripsi']));
    $harga       = (int) $_POST['harga'];
    $gambar      = "https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&auto=format&fit=crop&q=80"; // Default

    // Proses upload file gambar
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $file_tmp  = $_FILES['gambar']['tmp_name'];
        $file_name = time() . '_' . preg_replace("/[^a-zA-Z0-9._-]/", "", $_FILES['gambar']['name']);
        $tujuan    = 'uploads/' . $file_name;

        if (move_uploaded_file($file_tmp, $tujuan)) {
            $gambar = $tujuan;
        }
    }

    if (!empty($nama_produk) && $harga > 0) {
        $stmt = mysqli_prepare($conn, "INSERT INTO products (nama_produk, deskripsi, harga, stok, gambar) VALUES (?, ?, ?, 10, ?)");
        mysqli_stmt_bind_param($stmt, "ssis", $nama_produk, $deskripsi, $harga, $gambar);
        
        if (mysqli_stmt_execute($stmt)) {
            $pesan = "Product successfully added!";
            $tipe_pesan = "success";
        } else {
            $pesan = "Failed to add product: " . mysqli_error($conn);
            $tipe_pesan = "danger";
        }
    } else {
        $pesan = "Product name and price are required.";
        $tipe_pesan = "warning";
    }
}

// ==============================================================
// 2. UPDATE: Perbarui Data Produk
// ==============================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_produk'])) {
    $id          = (int) $_POST['id'];
    $nama_produk = htmlspecialchars(trim($_POST['nama_produk']));
    $deskripsi   = htmlspecialchars(trim($_POST['deskripsi']));
    $harga       = (int) $_POST['harga'];

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $file_tmp  = $_FILES['gambar']['tmp_name'];
        $file_name = time() . '_' . preg_replace("/[^a-zA-Z0-9._-]/", "", $_FILES['gambar']['name']);
        $tujuan    = 'uploads/' . $file_name;

        if (move_uploaded_file($file_tmp, $tujuan)) {
            $stmt = mysqli_prepare($conn, "UPDATE products SET nama_produk = ?, deskripsi = ?, harga = ?, gambar = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "ssisi", $nama_produk, $deskripsi, $harga, $tujuan, $id);
        }
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE products SET nama_produk = ?, deskripsi = ?, harga = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "ssii", $nama_produk, $deskripsi, $harga, $id);
    }

    if (mysqli_stmt_execute($stmt)) {
        $pesan = "Data produk berhasil diperbarui!";
        $tipe_pesan = "success";
    }
}

// ==============================================================
// 3. DELETE: Hapus Produk dari Database
// ==============================================================
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    $stmt = mysqli_prepare($conn, "DELETE FROM products WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if (mysqli_stmt_execute($stmt)) {
        $pesan = "Produk berhasil dihapus dari database.";
        $tipe_pesan = "info";
    }
}

// ==============================================================
// 4. CART: Tambah / Hapus Item di Keranjang Belanja
// ==============================================================
if (isset($_GET['add_cart'])) {
    $id = (int) $_GET['add_cart'];
    $query = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
    $item  = mysqli_fetch_assoc($query);

    if ($item) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['qty'] += 1;
        } else {
            $_SESSION['cart'][$id] = [
                'nama'   => $item['nama_produk'],
                'harga'  => $item['harga'],
                'gambar' => $item['gambar'],
                'qty'    => 1
            ];
        }
        $pesan = "Produk <strong>" . htmlspecialchars($item['nama_produk']) . "</strong> berhasil masuk keranjang!";
        $tipe_pesan = "success";
    }
}

if (isset($_GET['remove_cart'])) {
    $id = (int) $_GET['remove_cart'];
    unset($_SESSION['cart'][$id]);
    $pesan = "Produk dihapus dari keranjang belanja.";
    $tipe_pesan = "warning";
}

if (isset($_GET['clear_cart'])) {
    $_SESSION['cart'] = [];
    $pesan = "Keranjang belanja telah dikosongkan.";
    $tipe_pesan = "secondary";
}

// ==============================================================
// 5. READ: Mengambil Seluruh Daftar Produk
// ==============================================================
$result_products = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
$total_cart_items = 0;
foreach ($_SESSION['cart'] as $c) {
    $total_cart_items += $c['qty'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tugas 9 - CRUD E-Commerce & Keranjang Belanja</title>

  <!-- Bootstrap 5.3 CSS & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f6fa;
      color: #333;
    }
    /* Style Kartu Form Tambah Produk Sesuai Referensi Desain */
    .form-card {
      background: #ffffff;
      border-radius: 20px;
      padding: 35px 30px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      border: none;
    }
    .form-card h4 {
      font-weight: 700;
      color: #212529;
      text-align: center;
      margin-bottom: 25px;
    }
    .form-label-custom {
      font-size: 13px;
      font-weight: 500;
      color: #495057;
      margin-bottom: 6px;
    }
    .form-control-custom {
      border: 1px solid #ced4da;
      border-radius: 6px;
      padding: 8px 12px;
      font-size: 14px;
    }
    .btn-green {
      background-color: #28a745;
      color: #ffffff;
      font-weight: 600;
      border: none;
      padding: 10px;
      border-radius: 6px;
      width: 100%;
      margin-top: 15px;
      transition: all 0.2s ease;
    }
    .btn-green:hover {
      background-color: #218838;
      color: #ffffff;
      box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    }
    /* Style Produk Read */
    .product-box {
      background: #ffffff;
      border-radius: 12px;
      overflow: hidden;
      border: 1px solid #e9ecef;
      display: flex;
      flex-direction: column;
      height: 100%;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .product-box:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 18px rgba(0,0,0,0.06);
    }
    .product-img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      background-color: #f8f9fa;
    }
    .product-price {
      color: #f86f03;
      font-weight: 700;
      font-size: 16px;
    }
  </style>
</head>
<body>

  <!-- 1. NAVBAR DENGAN ICON CART -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top py-3">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.php">
        <i class="bi bi-shop text-warning me-2"></i>DHIMSON E-STORE
      </a>
      <div class="d-flex align-items-center">
        <!-- Tombol Buka Keranjang -->
        <button class="btn btn-warning position-relative fw-semibold px-3" data-bs-toggle="modal" data-bs-target="#cartModal">
          <i class="bi bi-cart3 me-1"></i> Cart
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <?= $total_cart_items ?>
          </span>
        </button>
      </div>
    </div>
  </nav>

  <div class="container py-4">

    <!-- Notifikasi Feedback -->
    <?php if (!empty($pesan)): ?>
      <div class="alert alert-<?= $tipe_pesan ?> alert-dismissible fade show shadow-sm" role="alert">
        <?= $pesan ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <div class="row g-4">
      
      <!-- ==============================================================
           KIRI: FORM TAMBAH PRODUK (CREATE)
           ============================================================== -->
      <div class="col-lg-4 col-md-5">
        <div class="form-card">
          <h4>Add Product</h4>
          <form action="index.php" method="POST" enctype="multipart/form-data">
            
            <div class="mb-3">
              <label class="form-label-custom">Product Name:</label>
              <input type="text" name="nama_produk" class="form-control form-control-custom" required>
            </div>

            <div class="mb-3">
              <label class="form-label-custom">Product Description:</label>
              <textarea name="deskripsi" rows="3" class="form-control form-control-custom" required></textarea>
            </div>

            <div class="mb-3">
              <label class="form-label-custom">Product Price:</label>
              <input type="number" name="harga" class="form-control form-control-custom" placeholder="Contoh: 150000" required>
            </div>

            <div class="mb-3">
              <label class="form-label-custom">Upload Picture:</label>
              <input type="file" name="gambar" class="form-control form-control-custom" accept="image/*">
            </div>

            <button type="submit" name="tambah_produk" class="btn btn-green">
              Add Product
            </button>
          </form>
        </div>
      </div>

      <!-- ==============================================================
           KANAN: DAFTAR PRODUK DATABASE (READ, UPDATE, DELETE, CART)
           ============================================================== -->
      <div class="col-lg-8 col-md-7">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="fw-bold mb-0">List of Products in the Database</h5>
          <span class="badge bg-secondary"><?= mysqli_num_rows($result_products) ?> Item</span>
        </div>

        <div class="row g-3">
          <?php if (mysqli_num_rows($result_products) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result_products)): ?>
              <div class="col-md-6">
                <div class="product-box">
                  <img src="<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama_produk']) ?>" class="product-img">
                  <div class="p-3 d-flex flex-column flex-grow-1">
                    <h6 class="fw-bold mb-1"><?= htmlspecialchars($row['nama_produk']) ?></h6>
                    <p class="text-muted small mb-2 text-truncate"><?= htmlspecialchars($row['deskripsi']) ?></p>
                    <div class="product-price mb-3">Rp <?= number_format($row['harga'], 0, ',', '.') ?></div>

                    <!-- Tombol Aksi: Keranjang, Edit, Hapus -->
                    <div class="mt-auto d-flex gap-2">
                      <a href="index.php?add_cart=<?= $row['id'] ?>" class="btn btn-primary btn-sm flex-grow-1">
                        <i class="bi bi-cart-plus me-1"></i> + Cart
                      </a>
                      
                      <!-- Tombol Edit (Memicu Modal Update) -->
                      <button type="button" class="btn btn-outline-secondary btn-sm" 
                              onclick="openEditModal(<?= $row['id'] ?>, '<?= addslashes(htmlspecialchars($row['nama_produk'])) ?>', '<?= addslashes(htmlspecialchars($row['deskripsi'])) ?>', <?= $row['harga'] ?>)">
                        <i class="bi bi-pencil"></i>
                      </button>

                      <!-- Tombol Hapus (Delete) -->
                      <a href="index.php?hapus=<?= $row['id'] ?>" class="btn btn-outline-danger btn-sm" 
                         onclick="return confirm('Are you sure you want to delete this product from the database?')">
                        <i class="bi bi-trash"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
          <?php else: ?>
            <div class="col-12 text-center py-5 bg-white rounded-3 border">
              <i class="bi bi-inbox fs-1 text-muted d-block"></i>
              <p class="text-muted mb-0">No products available in the database. Please fill out the form on the left.</p>
            </div>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>

  <!-- ==============================================================
       MODAL: UPDATE / EDIT PRODUK
       ============================================================== -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header">
          <h5 class="modal-title fw-bold">Edit Product Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="index.php" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="id" id="edit_id">

            <div class="mb-3">
              <label class="form-label small fw-semibold">Product Name:</label>
              <input type="text" name="nama_produk" id="edit_nama" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-semibold">Product Description:</label>
              <textarea name="deskripsi" id="edit_deskripsi" rows="3" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-semibold">Product Price:</label>
              <input type="number" name="harga" id="edit_harga" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-semibold">Change Picture (Optional):</label>
              <input type="file" name="gambar" class="form-control" accept="image/*">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelled</button>
            <button type="submit" name="update_produk" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- ==============================================================
       MODAL: KERANJANG BELANJA (CART)
       ============================================================== -->
  <div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title fw-bold"><i class="bi bi-cart3 me-2 text-warning"></i>Your Shopping Cart</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <?php if (!empty($_SESSION['cart'])): ?>
            <div class="table-responsive">
              <table class="table align-middle">
                <thead>
                  <tr class="table-light">
                    <th>Product</th>
                    <th>Unit Price</th>
                    <th class="text-center">Amount</th>
                    <th>Subtotal</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $grand_total = 0;
                    foreach ($_SESSION['cart'] as $id => $item): 
                      $subtotal = $item['harga'] * $item['qty'];
                      $grand_total += $subtotal;
                  ?>
                    <tr>
                      <td>
                        <div class="d-flex align-items-center gap-2">
                          <img src="<?= htmlspecialchars($item['gambar']) ?>" width="45" height="45" class="rounded object-fit-cover" alt="">
                          <span class="fw-semibold small"><?= htmlspecialchars($item['nama']) ?></span>
                        </div>
                      </td>
                      <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                      <td class="text-center"><span class="badge bg-light text-dark border px-2 py-1"><?= $item['qty'] ?></span></td>
                      <td class="fw-bold">Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                      <td class="text-center">
                        <a href="index.php?remove_cart=<?= $id ?>" class="btn btn-outline-danger btn-sm">
                          <i class="bi bi-trash"></i>
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  <tr class="table-light fw-bold fs-6">
                    <td colspan="3" class="text-end">Total Payment:</td>
                    <td colspan="2" class="text-success">Rp <?= number_format($grand_total, 0, ',', '.') ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="d-flex justify-content-between mt-3">
              <a href="index.php?clear_cart=1" class="btn btn-outline-secondary btn-sm" onclick="return confirm('Clear all items from the cart?')">
                <i class="bi bi-x-circle me-1"></i> Clear Cart
              </a>
              <button class="btn btn-success" onclick="alert('The checkout feature has been successfully simulated!')">
                <i class="bi bi-credit-card me-1"></i> Checkout Now
              </button>
            </div>
          <?php else: ?>
            <div class="text-center py-5">
              <i class="bi bi-cart-x fs-1 text-muted d-block mb-2"></i>
              <h6 class="text-muted">Your shopping cart is still empty.</h6>
              <p class="small text-secondary">Click the "+ Cart" button on products to start shopping.</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS & Script Helper Modal Edit -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function openEditModal(id, nama, deskripsi, harga) {
      document.getElementById('edit_id').value = id;
      document.getElementById('edit_nama').value = nama;
      document.getElementById('edit_deskripsi').value = deskripsi;
      document.getElementById('edit_harga').value = harga;
      
      const editModal = new bootstrap.Modal(document.getElementById('editModal'));
      editModal.show();
    }
  </script>
</body>
</html>