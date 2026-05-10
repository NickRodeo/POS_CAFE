<style>
.btn{
    padding: 80px 80px 80px 80px;
  
}
.yesno{
    padding:20px;
    margin-top: 20px;
    display: flex;
    justify-content: space-between;

}
</style>

<?php 
require_once '../module.php';
$data = query_select_param("SELECT * FROM menu", ["id_menu" => $_GET['id_menu']]);

echo "<h2 style='text-align:center;'>APA ANDA YAKIN INGIN MENGHAPUS MENU \"" . $data['nama_menu'] . "\"";

?>
<div class="yesno"><a href=<?= "../process/delete.php?id_menu=" . $_GET['id_menu'] ?>><button class="btn">YES</button></a>
<a href="../public"><button class="btn">NO</button></a></div>
