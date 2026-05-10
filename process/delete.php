<?php 
require_once '../config/database.php'; 
try { 
$stmt = $conn->prepare( 
"DELETE FROM menu WHERE id_menu = :id_menu" 
); 
$stmt->execute([ 
':id_menu' => $_GET['id_menu'] 
]); 
header("Location: ../public/index.php?status=deleted"); 
} catch (PDOException $e) { 
echo "Gagal hapus data: " . $e->getMessage(); 
}
?>