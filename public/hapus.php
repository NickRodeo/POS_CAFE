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
require_once "../config/database.php";
$data = query_select("SELECT * FROM menu WHERE id_menu = :id_menu", [":id_menu" => $_GET['id_menu']])[0];

echo "<h2 style='text-align:center;'>APA ANDA YAKIN INGIN MENGHAPUS MENU \"" . $data['nama_menu'] . "\"";

?>
<div class="yesno">
    <form action="../process/delete.php" method="POST">
        <input type="hidden" name="id_menu" value=<?= $_GET['id_menu'] ?>>
        <button class="btn" type="submit">YES</button>
    </form>
    <a href="../public">
        <button class="btn">NO</button>
    </a>
</div>
