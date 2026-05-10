<?php 
require_once "../config/database.php";
$x = 6;
// query_update("UPDATE menu", ["nama_menu" => "kentang", "jumlah_stok" => 100], "WHERE id_menu = {$x}");
var_dump(query_select("SELECT * FROM menu", []));
echo "<br><br>";
var_dump(query_select("SELECT * FROM menu WHERE harga >= :harga", [":harga" => "15000"]));
?>
<h1>helo</h1>