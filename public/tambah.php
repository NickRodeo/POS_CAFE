<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Tambah Menu</title>

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
      background:#f3f4f6;
      min-height:100vh;
      display:flex;
      justify-content:center;
      align-items:center;
      padding:30px;
    }

    .container{
      width:700px;
      background:white;
      border-radius:30px;
      padding:35px;
      box-shadow:0 20px 40px rgba(0,0,0,0.08);
    }

    .title{
      margin-bottom:30px;
    }

    .title h1{
      font-size:34px;
      color:#111827;
    }

    .title p{
      color:#777;
      margin-top:5px;
    }

    .form-group{
      margin-bottom:22px;
    }

    .form-group label{
      display:block;
      margin-bottom:10px;
      font-weight:600;
      color:#374151;
    }

    .form-group input,
    .form-group select,
    .form-group textarea{
      width:100%;
      padding:16px;
      border-radius:16px;
      border:1px solid #d1d5db;
      outline:none;
      font-size:15px;
    }

    textarea{
      resize:none;
      height:120px;
    }

    .upload-box{
      border:2px dashed #d1d5db;
      padding:40px;
      text-align:center;
      border-radius:20px;
      color:#777;
      background:#fafafa;
      cursor:pointer;
    }

    .btn-group{
      display:flex;
      gap:15px;
      margin-top:30px;
    }

    .save-btn,
    .cancel-btn{
      flex:1;
      border:none;
      padding:18px;
      border-radius:18px;
      font-size:16px;
      font-weight:600;
      cursor:pointer;
    }

    .save-btn{
      background:#facc15;
      color:#111;
    }

    .cancel-btn{
      background:#e5e7eb;
      color:#111;
    }

  </style>
</head>

<?php

require_once "../config/database.php";

$kategori = query_select("SELECT * FROM kategori", []);

?>

<body>

  <div class="container">

    <div class="title">
      <h1>Tambah Menu</h1>
      <p>Tambahkan menu baru ke sistem cafe</p>
    </div>

    <form action="../process/insert.php" method="POST">

      <div class="form-group">
        <label>Nama Menu</label>

        <input
          name="nama_menu"
          type="text"
          placeholder="Masukkkan nama menu..."
          required
        >
      </div>

      <div class="form-group">
        <label>Kategori</label>

        <select name="id_kategori" required>

          <?php foreach($kategori as $k): ?>

            <option value="<?= $k['id_kategori'] ?>">
              <?= $k['nama_kategori'] ?>
            </option>

          <?php endforeach; ?>

        </select>
      </div>

      <div class="form-group">
        <label>Harga</label>

        <input
          name="harga"
          type="number"
          placeholder="Masukkkan harga..."
          required
        >
      </div>

      <div class="form-group">
        <label>Stok</label>

        <input
          name="jumlah_stok"
          type="number"
          placeholder="Masukkkan jumlah stok..."
          required
        >
      </div>

      <div class="btn-group">

        <button type="submit" class="save-btn">
          Simpan Menu
        </button>

        <button type="button" onclick="backToHome()" class="cancel-btn">
          Batal
        </button>

      </div>

    </form>

  </div>

</body>
<script>
    function backToHome(){
        window.location.href = "./index.php";
    }
</script>
</html>