<?php 
require_once '../config/database.php'; 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../public/index.php");
    exit;
}

try { 
    query_delete("DELETE FROM menu WHERE id_menu = :id_menu", [":id_menu" => $_POST['id_menu']]);
    header("Location: ../public/index.php?status=deleted"); 
} catch (PDOException $e) { 
    echo "Gagal hapus data: " . $e->getMessage(); 
}
?>