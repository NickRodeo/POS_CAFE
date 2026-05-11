<?php 
require_once '../config/database.php'; 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../public/index.php");
    exit;
}

//Jika Checkout
if(isset($_POST['cart'])){

    $cart = json_decode($_POST['cart'], true);

    //Validasi Jumlah Stok
    foreach($cart as $item){

        $menu = query_select(
            "SELECT * FROM menu WHERE nama_menu = :nama_menu",
            [
                ':nama_menu' => $item['nama']
            ]
        )[0];

        if($menu['jumlah_stok'] < $item['qty']){
            header(
                "Location: ../public/index.php?error=" . 
                urlencode("Stock {$item['nama']} tidak cukup!")
            );
            exit;
        }

    }

    //Ubah Stok
    foreach($cart as $item){

        $menu = query_select(
            "SELECT * FROM menu WHERE nama_menu = :nama_menu",
            [
                ':nama_menu' => $item['nama']
            ]
        )[0];

        $stockBaru = $menu['jumlah_stok'] - $item['qty'];

        query_update(
            "UPDATE menu",
            [
                'jumlah_stok' => $stockBaru
            ],
            "WHERE id_menu = {$menu['id_menu']}"
        );

    }

    header("Location: ../public/index.php?status=checkout");
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