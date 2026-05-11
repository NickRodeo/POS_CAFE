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
        if(
            !isset($item['nama']) ||
            !isset($item['qty']) ||
            $item['qty'] <= 0
        ){
            redirect_with_message(
                "../public/index.php",
                "error",
                "Data cart tidak valid!"
            );
        }

        $menu = query_select(
            "SELECT * FROM menu WHERE nama_menu = :nama_menu",
            [
                ':nama_menu' => $item['nama']
            ]
        );

        if(count($menu) === 0){

            redirect_with_message(
                "../public/index.php",
                "error",
                "Menu {$item['nama']} tidak ditemukan!"
            );

        }

        $menu = $menu[0];

        if($menu['jumlah_stok'] < $item['qty']){
            redirect_with_message(
                "../public/index.php",
                "error",
                "Stock {$item['nama']} tidak cukup!"
            );
            exit;
        }

    }

    //Ubah Stok
    try{

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

        redirect_with_message(
            "../public/index.php",
            "success",
            "Checkout berhasil!"
        );

    }catch(PDOException $e){

        redirect_with_message(
            "../public/index.php",
            "error",
            "Checkout gagal!"
        );

    }
}

$menuLama = query_select(
    "SELECT * FROM menu WHERE id_menu = :id",
    [
        ':id' => $_POST['id_menu']
    ]
);

if(count($menuLama) === 0){
    redirect_with_message(
        "../public/index.php",
        "error",
        "Menu tidak ditemukan!"
    );
}

if($_POST['jumlah_stok'] < 0){
    redirect_with_message(
        "../public/index.php",
        "error",
        "Stock tidak valid!"
    );
}

try { 
    $data = $_POST;
    unset($data['id_menu']);
    query_update("UPDATE menu", $data, "WHERE id_menu = {$_POST['id_menu']}");
    redirect_with_message(
        "../public/index.php",
        "success",
        "Menu berhasil diupdate!"
    );
} catch (PDOException $e) { 
    echo "Gagal update data: " . $e->getMessage(); 
}
?>