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

.container{
    margin:auto;
    padding: 10px;
    display: flex;
    flex-direction: column;
}

.card{

    border: 2px solid black;
    border-radius: 30px;
    margin: 5px; 
    padding: 5px 15px 15px 15px;
}

.card-container{
    display: flex;
    justify-content: space-evenly;
}
</style>

<?php 
require_once '../config/database.php'; 
$data = query_select("SELECT * FROM menu", []);
$keranjang = [];
?> 
<h1 style="text-align: center;">SISTEM POS CAFE</h1>
<div class="container">
    <div class="card-container">
        <?php foreach($data as $row): ?>
            <div class="card">
                <h2 style="text-align:center;background-color: white;"><?= $row['nama_menu'] ?></h2>
                <img src="./kucgg.jfif" alt="">
                <div style="display: flex; justify-content: space-between; margin: 7px 0px 10px 0px;">
                    <span style="background-color:green; padding: 5px 15px 5px 15px; border-radius: 15px; color:white;"><?= query_select("SELECT * FROM kategori WHERE id_kategori = :id_kategori", [":id_kategori" => $row['id_kategori']])[0]['nama_kategori'] ?></span>
                    <span style="background-color:green; padding: 5px 10px 5px 10px; border-radius: 100px; color:white;"><?= $row['jumlah_stok'] ?></span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span>Rp <?= $row['harga'] ?></span>
                    <div style="">
                        <a href="edit.php?id_menu=<?= $row['id_menu']; ?>">Edit</a> | 
                        <a href="hapus.php?id_menu=<?= $row['id_menu']; ?>">Hapus</a> 
                    </div>
                </div> 
            </div>
        <?php endforeach; ?>
    </div>
<?php if(sizeof($keranjang) != 0) echo sizeof($keranjang) ?>
<a  class="btn" href='tambah.php'>Tambah Menu</a>
</div>



