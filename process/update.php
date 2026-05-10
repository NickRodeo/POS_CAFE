<?php 
require_once '../config/database.php'; 
try { 
$stmt = $conn->prepare( 
"UPDATE buku 
SET buku_judul = :judul, buku_harga = :harga 
WHERE buku_isbn = :isbn" 
); 
$stmt->execute([ 
':judul' => $_POST['judul'], 
':harga' => $_POST['harga'], 
':isbn'  => $_POST['isbn'] 
]); 
header("Location: ../public/index.php?status=updated"); 
} catch (PDOException $e) { 
echo "Gagal update data: " . $e->getMessage(); 
}
?>