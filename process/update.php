<?php 
require_once '../config/database.php'; 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../public/index.php");
    exit;
}

try { 
    $data = $_POST;
    unset($data['id_menu']);
    query_update("UPDATE menu", $data, "WHERE id_menu = {$_POST['id_menu']}");
    header("Location: ../public/index.php?status=updated"); 
} catch (PDOException $e) { 
    echo "Gagal update data: " . $e->getMessage(); 
}
?>