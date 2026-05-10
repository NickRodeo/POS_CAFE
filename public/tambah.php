<?php 


?>

<style>
.btn{
    padding: 10px;
    margin-top: 10px;
    display: inline-block;
    width: auto;
    text-align: center;
    border: 2px solid black;
    border-radius: 10px;
}
a{
    text-decoration: none;
    color: black;
}
input, select{
    border-radius: 10px;
    padding: 10px 5px 10px 5px;
}
</style>

<?php 
require_once "../config/database.php";
$kategori = query_select("SELECT * FROM kategori", []) ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah</title>
</head>
<body>
    <h1 style="text-align: center;">Tambah Menu</h1>
    <form action="../process/insert.php" method="POST" style="display: flex; flex-direction: column; gap: 10px;">
        <input type="text" name="nama_menu" placeholder="Masukkan Nama Menu...">
        <input type="number" name="harga" placeholder="Masukkan Harga">
        <input type="number" name="jumlah_stok" placeholder="Masukkan Jumlah Stok">
        <select name="id_kategori" id="kategori">
            <?php foreach($kategori as $k): ?>
                <option value=<?= $k['id_kategori'] ?>><?= $k['nama_kategori'] ?></option>
            <?php endforeach; ?>
        </select>
        <div style="display: flex; justify-content:space-between;">
            <a href="index.php" class="btn">BALIK</a>
            <button type="submit" class="btn">TAMBAH</button>
        </div>
    </form>
    
</body>
</html>