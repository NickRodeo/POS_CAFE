<?php 
$host = "localhost";
$dbname = "pos_cafe";
$username = "root";
$password = "";

try { 
    $conn = new PDO( 
        "mysql:host=$host;dbname=$dbname;charset=utf8", 
        $username, 
        $password 
    ); 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (PDOException $e) { 
    die("Koneksi database gagal: " . $e->getMessage()); 
}

session_start();
//Cara pakai : 
//query_select("SELECT * FROM menu");
//query_select("SELECT * FROM menu WHERE harga >= 15000")
function query_select($q, $param){
    global $conn;
    $stmt = $conn->prepare($q);
    $stmt->execute($param);

    $data = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $data;
}

//Cara pakai : 
// query_insert("INSERT INTO menu", ["nama_menu" => $_POST["nama_menu"], "harga" => $_POST["harga"], "jumlah_stok" => $_POST['jumlah_stok'], "id_kategori" => $_POST["id_kategori"]]);
function query_insert($q, $param){
    global $conn;
    $keys = "(";
    $values = "(";
    $temp = [];
    foreach($param as $key => $value){
        $keys = $keys . $key . ", ";
        $values = $values . ":" . $key . ", ";
        $temp[":" . $key] = $value;
    }
    $keys = substr($keys, 0, -2);
    $values = substr($values, 0, -2);
    $keys = $keys . ")";
    $values = $values . ")";

    $q = $q . " " . $keys . " VALUES " . $values;
    $stmt = $conn->prepare($q);
    $stmt->execute($temp);

    $data = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $data;
}

//Cara pakai : 
// query_update("UPDATE menu", ["nama_menu" => "kentang", "jumlah_stok" => 100], "WHERE id_menu = {$id}");
function query_update($q, $set, $where){
    global $conn;
    $q .= " SET ";
    $param = "";
    $temp = [];
    foreach($set as $key => $value){
        $param .= $key . " = :" . $key . ", ";
        $temp[':' . $key] = $value;
    }
    $param = substr($param, 0, -2);
    $q .= $param . " " . $where;
    
    $stmt = $conn->prepare($q);
    $stmt->execute($temp);
}

//Cara pakai : 
//query_delete("DELETE FROM menu WHERE id_menu = :id_menu", [":id_menu" => $_GET['id_menu']]);
function query_delete($q, $param){
    global $conn;
   
    $stmt = $conn->prepare($q);
    $stmt->execute($param);
}

function redirect_with_message($location, $type, $message){
    $_SESSION[$type] = $message;

    header("Location: $location");
    exit;
}

?>