<?php 
require_once '../config/database.php'; 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../public/index.php");
    exit;
}

$menu = query_select(
    "SELECT * FROM menu WHERE id_menu = :id",
    [
        ':id' => $_POST['id_menu']
    ]
);

if(count($menu) === 0){
    redirect_with_message(
        "../public/index.php",
        "error",
        "Menu tidak ditemukan!"
    );
}

try { 
    query_delete("DELETE FROM menu WHERE id_menu = :id_menu", [":id_menu" => $_POST['id_menu']]);
    redirect_with_message(
        "../public/index.php",
        "success",
        "Menu berhasil dihapus!"
    );
} catch (PDOException $e) { 
    echo "Gagal hapus data: " . $e->getMessage(); 
}
?>