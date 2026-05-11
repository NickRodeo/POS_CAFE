Modern Cafe POS
=> Aplikasi Point Of Sales (POS) sederhana untuk cafe berbasis PHP Native dan MySQL dengan tampilan modern serta fitur cart realtime.

Fiturnya terdiri dari :
1. CRUD Menu
2. Filter Kategori
3. Search Menu
4. Cart Realtime
5. Checkout
6. Update Stock Otomatis
7. Validasi Stock
8. Responsive Layout
9. Tampilan Modern

Untuk bagian tampilan, terdiri dari :

1. Dashboard
=> Menampilkan daftar menu, kategori, search, dan cart.

2. Tambah Menu
=> Menambahkan menu baru ke database.

3. Edit Menu
=> Mengubah data menu yang sudah ada.

4. Hapus Menu
=> Konfirmasi sebelum menghapus menu.

Bahasa Pemrograman yang dipakai :
1. PHP
2. HTML
3. CSS
4. JavaScript

Database :
1. MySQL

Tools :
1. PDO
2. LocalStorage
3. XAMPP

Struktur Folder Aplikasi:

POS_CAFE/
│
├── config/
│   └── database.php
│
├── process/
│   ├── insert.php
│   ├── update.php
│   └── delete.php
│
├── public/
│   ├── index.php
│   ├── tambah.php
│   ├── edit.php
│   └── hapus.php
│
└── README.md

Untuk Cara Menjalankannya
1. Clone Repository
git clone https://github.com/USERNAME/POS_CAFE.git

2. Pindahkan ke htdocs
Jika menggunakan XAMPP:
C:/xampp/htdocs/

3. Buat Database
CREATE DATABASE pos_cafe;

4. Buat Tabel
Table kategori

CREATE TABLE kategori (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100)
);

Table menu

CREATE TABLE menu (
    id_menu INT AUTO_INCREMENT PRIMARY KEY,
    nama_menu VARCHAR(100),
    harga INT,
    jumlah_stok INT,
    id_kategori INT,
    FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
);

5. Atur Koneksi Database
Buka file:
config/database.php

Lalu sesuaikan:
$host = "localhost";
$dbname = "pos_cafe";
$username = "root";
$password = "";

6. Jalankan Project
http://localhost/POS_CAFE/public

Cara Kerja :
Cart menggunakan LocalStorage sehingga data pesanan tetap tersimpan walaupun halaman di refresh.

Saat checkout:
1. stock akan dicek terlebih dahulu
2. stock otomatis berkurang
3. cart otomatis dikosongkan

Author :
1. Raihan Fadhillah (D1041241029)
2. Charles Oktavianus (D1041241040)
3. Rifky Alfarizky (D1041241009)