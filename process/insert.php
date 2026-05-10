<?php 
require_once '../config/database.php'; 
require_once '../module.php';
try { 
    query_insert("INSERT INTO menu", ["nama_menu" => $_POST["nama_menu"], "harga" => $_POST["harga"], "jumlah_stok" => $_POST['jumlah_stok'], "id_kategori" => $_POST["id_kategori"]]);
    header("Location: ../public/index.php?status=sukses"); 
} catch (PDOException $e) { 
    echo "Gagal menambah data: " . $e->getMessage(); 
} 
?>