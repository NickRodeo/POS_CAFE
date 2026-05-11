<?php 
require_once '../config/database.php'; 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../public/index.php");
    exit;
}

if(
    empty($_POST['nama_menu']) ||
    empty($_POST['harga']) ||
    empty($_POST['jumlah_stok']) ||
    empty($_POST['id_kategori'])
){
    redirect_with_message(
        "../public/index.php",
        "error",
        "Semua field wajib diisi!"
    );
}

if($_POST['harga'] < 0){
    redirect_with_message(
        "../public/index.php",
        "error",
        "Harga tidak valid!"
    );
}

if($_POST['jumlah_stok'] < 0){
    redirect_with_message(
        "../public/index.php",
        "error",
        "Stock tidak valid!"
    );
}

try { 
    query_insert("INSERT INTO menu", ["nama_menu" => $_POST["nama_menu"], "harga" => $_POST["harga"], "jumlah_stok" => $_POST['jumlah_stok'], "id_kategori" => $_POST["id_kategori"]]);
    redirect_with_message(
        "../public/index.php",
        "success",
        "Menu berhasil ditambahkan!"
    );
} catch (PDOException $e) { 
    redirect_with_message(
        "../public/index.php",
        "error",
        "Gagal menambah menu!"
    );
} 
?>