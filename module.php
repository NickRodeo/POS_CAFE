<?php 
require_once 'config/database.php';

function query_select($q){
    global $conn;
    $stmt = $conn->prepare($q);
    $stmt->execute();

    $data = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $data;
}

function query_select_param($q, $param){
    global $conn;
    $q = $q . " WHERE ";
    $temp = [];
    foreach($param as $key => $value){
        $q = $q . $key . " = :" . $key .  " AND ";
        $temp[":" . $key] = $value;
    };
    
    $q = $q . "1 = 1";
    $stmt = $conn->prepare($q);
    $stmt->execute($temp);

    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data;
}
//INSERT INTO menu (menu..., nama...) VALUES (:menu..., nama...)
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
    var_dump($q);
    $stmt = $conn->prepare($q);
    $stmt->execute($temp);

    $data = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $data;
}

function query_update(){

}

function query_delete(){
    
}


?>