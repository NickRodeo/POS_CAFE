<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Hapus Menu</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>

    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
      font-family:'Poppins',sans-serif;
    }

    body{
      background:#fef2f2;
      min-height:100vh;
      display:flex;
      justify-content:center;
      align-items:center;
      padding:30px;
    }

    .modal{
      width:550px;
      background:white;
      border-radius:35px;
      padding:40px;
      text-align:center;
      box-shadow:0 20px 40px rgba(0,0,0,0.08);
    }

    .icon{
      width:110px;
      height:110px;
      background:#fee2e2;
      color:#dc2626;
      margin:auto;
      border-radius:50%;
      display:flex;
      justify-content:center;
      align-items:center;
      font-size:55px;
      margin-bottom:25px;
    }

    .icon svg{
        width:52px;
        height:52px;
    }

    h1{
      font-size:34px;
      margin-bottom:15px;
      color:#111827;
    }

    p{
      color:#777;
      line-height:1.7;
      margin-bottom:30px;
    }

    .menu-box{
      background:#f9fafb;
      border-radius:20px;
      padding:18px;
      margin-bottom:30px;
    }

    .menu-box h3{
      font-size:22px;
      margin-bottom:5px;
    }

    .menu-box span{
      color:#777;
      font-size:14px;
    }

    .btn-group{
      display:flex;
      gap:15px;
    }

    .delete-btn,
    .cancel-btn{
      flex:1;
      border:none;
      padding:18px;
      border-radius:18px;
      font-size:16px;
      font-weight:600;
      cursor:pointer;
    }

    .delete-btn{
      background:#dc2626;
      color:white;
    }

    .cancel-btn{
      background:#e5e7eb;
      color:#111;
    }

  </style>
</head>
<?php 
    require_once '../config/database.php';
    $menu = query_select("SELECT * FROM menu WHERE id_menu = :id_menu", [':id_menu' => $_GET["id_menu"]])[0];
?>
<body>

  <div class="modal">

  <div class="icon">

    <svg xmlns="http://www.w3.org/2000/svg"
        width="52"
        height="52"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2.2"
        stroke-linecap="round"
        stroke-linejoin="round">

    <path d="M3 6h18"/>
    <path d="M8 6V4h8v2"/>
    <path d="M19 6l-1 14H6L5 6"/>
    <path d="M10 11v6"/>
    <path d="M14 11v6"/>

    </svg>

    </div>

    <h1>Hapus Menu?</h1>

    <p>
      Apakah kamu yakin ingin menghapus menu ini?
      Data yang dihapus tidak dapat dikembalikan lagi.
    </p>

    <div class="menu-box">

      <h3><?= $menu['nama_menu'] ?></h3>

      <span>Harga : <?= number_format($menu['harga']) ?> dan Stock : <?= $menu['jumlah_stok'] ?></span>

    </div>

    <form class="btn-group" method="POST" action="../process/delete.php">
      <input type="hidden" value="<?= $_GET['id_menu'] ?>" name="id_menu">
      <button type="submit" class="delete-btn">
        Ya, Hapus
      </button>

      <button type="button" onclick="backToHome()" class="cancel-btn">
        Batal
      </button>

    </form>

  </div>

</body>
<script>
    function backToHome(){
        window.location.href = "./index.php";
    }
</script>
</html>