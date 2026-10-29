-- ==============================================================
-- TUGAS DATABASE & QUERY E-COMMERCE
-- ==============================================================

-- ==============================================================
-- 1. PEMBUATAN DATABASE & TABEL (DDL)
-- ==============================================================

-- Buat Database
CREATE DATABASE IF NOT EXISTS ecommerce_db;
USE ecommerce_db;

-- a. Tabel users (Dibuat terlebih dahulu sebagai acuan foreign key)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- b. Tabel products
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(150) NOT NULL,
    harga INT NOT NULL,
    deskripsi TEXT,
    stok INT NOT NULL DEFAULT 0
);

-- c. Tabel orders (Relasi transaksi user dan produk)
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    total INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);


-- ==============================================================
-- 2. QUERY CRUD DATA PRODUK (DML)
-- ==============================================================

-- A. CREATE (Menambahkan Data Produk Baru)
INSERT INTO products (nama_produk, harga, deskripsi, stok) 
VALUES ('Wireless Noise-Canceling Headphone', 1450000, 'Headphone over-ear nirkabel dengan baterai 30 jam.', 15);

INSERT INTO products (nama_produk, harga, deskripsi, stok) VALUES
('Smartwatch AMOLED Pro', 2199000, 'Jam tangan pintar dengan sensor detak jantung dan GPS.', 20),
('Tas Ransel Laptop 20L', 375000, 'Backpack ergonomis tahan air dengan slot laptop 15.6 inci.', 35),
('Keyboard Mekanikal 75%', 890000, 'Keyboard switch tactile dengan RGB backlight dan Bluetooth.', 10);


-- B. READ (Membaca / Menampilkan Data Produk)
-- 1. Menampilkan seluruh data produk
SELECT * FROM products;

-- 2. Menampilkan produk spesifik berdasarkan ID
SELECT * FROM products 
WHERE id = 1;

-- 3. Menampilkan produk yang stoknya menipis (di bawah 15 item)
SELECT nama_produk, stok 
FROM products 
WHERE stok < 15;


-- C. UPDATE (Mengubah Data Produk)
-- Mengubah harga dan stok produk ID = 1
UPDATE products 
SET harga = 1399000, 
    stok = 25 
WHERE id = 1;

-- Mengubah deskripsi produk ID = 2
UPDATE products 
SET deskripsi = 'Smartwatch AMOLED Pro Gen 2 dengan ketahanan baterai hingga 14 hari.' 
WHERE id = 2;


-- D. DELETE (Menghapus Data Produk)
-- Menghapus produk dengan ID tertentu (misal: ID = 4)
DELETE FROM products 
WHERE id = 4;