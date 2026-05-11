<?php 
require_once "../config/database.php";

$query = "SELECT * FROM menu WHERE 1=1";
$params = [];

// FILTER KATEGORI
if(isset($_GET['id_kategori']) && $_GET['id_kategori'] != ''){
    $query .= " AND id_kategori = :id_kategori";
    $params[':id_kategori'] = $_GET['id_kategori'];
}

// SEARCH MENU
if(isset($_GET['search']) && $_GET['search'] != ''){
    $query .= " AND nama_menu LIKE :search";
    $params[':search'] = "%" . $_GET['search'] . "%";
}

$menus = query_select($query, $params);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Modern Cafe POS</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <style>

    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body{
      background: #e7e7e7;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 25px;
    }

    /* CONTAINER */

    .container{
      width: 1450px;
      background: white;
      border-radius: 30px;
      overflow: hidden;
      display: grid;
      grid-template-columns: 2.3fr 1fr;
      box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    }

    /* LEFT PANEL */

    .left-panel{
      padding: 25px;
      border-right: 1px solid #ececec;
    }

    /* TOPBAR */

    .topbar{
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }

    .topbar h2{
      font-size: 30px;
      color: #111;
    }

    .topbar p{
      color: #777;
      font-size: 14px;
    }

    .top-actions{
      display: flex;
      gap: 12px;
    }

    .top-actions button{
      border: none;
      background: #f3f4f6;
      padding: 12px 18px;
      border-radius: 14px;
      cursor: pointer;
    }

    .profile{
      background: #111 !important;
      color: white;

      display: flex;
      align-items: center;
      gap: 10px;
    }

    .profile img{
      width: 34px;
      height: 34px;
      border-radius: 50%;
      object-fit: cover;
    }

    /* CATEGORY */

    .categories{
      display: flex;
      gap: 12px;
      margin-bottom: 25px;
      flex-wrap: wrap;
    }

    .categories a{
      padding: 12px 18px;
      border-radius: 14px;
      background: #f3f4f6;
      cursor: pointer;
      font-weight: 500;

      text-decoration: none;
      color: #111827;

      transition: 0.2s;
    }

    .categories a:hover{
      background: #e5e7eb;
      transform: translateY(-2px);
    }

    .categories .active,
    .categories .active:hover{
      background: #facc15;
      color: #111;
    }
    /* TOOLS */

    .menu-tools{
      margin-bottom: 20px;
    }

    .add-menu-btn{
        border: none;
        background: #111827;
        color: white;
        padding: 14px 20px;
        border-radius: 16px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;

        text-decoration: none;
        display: inline-block;
    }

    /* MENU GRID */

    .menu-grid{
      display: grid;
      grid-template-columns: repeat(3,1fr);
      gap: 18px;
    }

    /* CARD */

    .card{
      background: #fafafa;
      border-radius: 24px;
      padding: 18px;
      position: relative;
      border: 1px solid #ececec;
      transition: 0.3s;
    }

    .card:hover{
      transform: translateY(-5px);
      box-shadow: 0 12px 25px rgba(0,0,0,0.08);
    }

    .card img{
      width: 100%;
      height: 170px;
      object-fit: contain;
      margin-bottom: 15px;
    }

    .card h4{
      font-size: 18px;
      margin-bottom: 6px;
      color: #111827;
    }

    .card p{
      color: #666;
      font-size: 15px;
    }

    /* DISABLED CARD */
    .disabled-card{
      opacity: 0.5;
      filter: grayscale(1);

      cursor: not-allowed !important;

      position: relative;

      overflow: hidden;
    }

    .disabled-card:hover{
      transform: none;
      box-shadow: none;
    }

    .disabled-card::after{
      content: 'OUT OF STOCK';

      position: absolute;

      top: 18px;
      right: -35px;

      background: #dc2626;
      color: white;

      padding: 8px 40px;

      font-size: 11px;
      font-weight: 700;

      transform: rotate(45deg);

      letter-spacing: 1px;

      box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    /* STOCK */

    .stock{
      margin-top: 12px;
      display: inline-block;
      padding: 6px 12px;
      border-radius: 12px;
      background: #dcfce7;
      color: #15803d;
      font-size: 13px;
      font-weight: 600;
    }

    .stock-empty{
      background: #fee2e2;
      color: #dc2626;
    }

    /* ACTION */

    .action-btn{
      display: flex;
      gap: 10px;
      margin-top: 16px;
    }

    .edit-btn,
    .delete-btn{
        flex: 1;
        border: none;
        padding: 10px;
        border-radius: 12px;
        cursor: pointer;

        text-decoration: none;
        color: black;

        display: flex;
        justify-content: center;
        align-items: center;
    }

    .edit-btn{
      background: #dbeafe;
    }

    .delete-btn{
      background: #fee2e2;
    }

    /* RIGHT PANEL */

    .right-panel{
      padding: 25px;
      background: #fcfcfc;
    }

    /* ORDER HEADER */

    .order-header{
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }

    .order-header h3{
      font-size: 24px;
    }

    .reset{
      border: none;
      background: #ffe4e6;
      color: #e11d48;
      padding: 10px 16px;
      border-radius: 12px;
      cursor: pointer;
    }

    /* ORDER ITEM */

    .order-item{
      display: flex;
      gap: 14px;
      margin-bottom: 22px;
      padding-bottom: 18px;
      border-bottom: 1px solid #ececec;
    }

    .order-item img{
      width: 70px;
      height: 70px;
      object-fit: contain;
      background: #f5f5f5;
      border-radius: 16px;
      padding: 8px;
    }

    .item-info{
      flex: 1;
    }

    .item-info h4{
      font-size: 16px;
      margin-bottom: 5px;
    }

    .item-info span{
      font-size: 13px;
      color: #777;
    }

    .item-info p{
      margin-top: 5px;
      font-weight: 600;
    }

    /* QTY */

    .qty-box{
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .qty-box button{
      width: 30px;
      height: 30px;
      border: none;
      border-radius: 10px;
      background: #f3f4f6;
      cursor: pointer;
    }

    /* LOGO */
    .logo{
      font-size: 32px;
      font-weight: 700;
      color: #111827;
      letter-spacing: 1px;
    }

    .logo span{

      animation: rainbowGlow 3s infinite linear;

      text-shadow:
        0 0 24px rgba(255,255,255,0.8),
        0 0 48px rgba(255,255,255,0.5);

    }

    @keyframes rainbowGlow{

      0%{
        color:#ff0080;
        text-shadow:
          0 0 16px #ff0080,
          0 0 24px #ff0080,
          0 0 48px #ff0080;
      }

      20%{
        color:#7c3aed;
        text-shadow:
          0 0 16px #7c3aed,
          0 0 24px #7c3aed,
          0 0 48px #7c3aed;
      }

      40%{
        color:#2563eb;
        text-shadow:
          0 0 16px #2563eb,
          0 0 24px #2563eb,
          0 0 48px #2563eb;
      }

      60%{
        color:#06b6d4;
        text-shadow:
          0 0 16px #06b6d4,
          0 0 24px #06b6d4,
          0 0 48px #06b6d4;
      }

      80%{
        color:#22c55e;
        text-shadow:
          0 0 16px #22c55e,
          0 0 24px #22c55e,
          0 0 48px #22c55e;
      }

      100%{
        color:#ff0080;
        text-shadow:
          0 0 16px #ff0080,
          0 0 24px #ff0080,
          0 0 48px #ff0080;
      }

    }
    /* SUMMARY */

    .summary{
      margin-top: 30px;
    }

    .summary div{
      display: flex;
      justify-content: space-between;
      margin-bottom: 16px;
      color: #555;
    }

    .grand-total{
      font-size: 22px;
      font-weight: 700;
      color: #111 !important;
    }

    /* PAYMENT */

    .payment-method{
      margin-top: 35px;
    }

    .payment-method h4{
      margin-bottom: 15px;
      font-size: 18px;
    }

    .payment-options{
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .payment-options label{
      background: #f3f4f6;
      padding: 14px;
      border-radius: 14px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 500;
    }

    /* PAY BUTTON */

    .pay-btn{
      width: 100%;
      margin-top: 30px;
      padding: 18px;
      border: none;
      border-radius: 18px;
      background: #facc15;
      color: #111;
      font-size: 18px;
      font-weight: 600;
      cursor: pointer;
    }

    /* ICON */
    .icon-btn,
    .edit-btn,
    .delete-btn,
    .refresh-btn{
      transition: 0.25s;
    }

    .icon-btn:hover,
    .edit-btn:hover,
    .delete-btn:hover,
    .refresh-btn:hover{
      transform: translateY(-2px) scale(1.05);
    }

    .edit-btn svg,
    .delete-btn svg,
    .icon-btn svg{
      transition: 0.25s;
    }

    /* ERROR ALERT */
    .error-alert{
      position: fixed;
      top: 25px;
      right: 25px;

      background: #fee2e2;
      color: #dc2626;

      padding: 16px 22px;
      border-radius: 18px;

      font-weight: 600;

      box-shadow: 0 10px 25px rgba(220,38,38,0.15);

      z-index: 999;

      animation:
        slideIn 0.3s ease,
        fadeOut 0.5s ease 5s forwards;
    }

    @keyframes slideIn{
      from{
        opacity: 0;
        transform: translateY(-10px);
      }

      to{
        opacity: 1;
        transform: translateY(0);
      }

      }

      @keyframes fadeOut{

      to{
        opacity: 0;
        transform: translateY(-10px);
        visibility: hidden;
      }

    }

    /* SEARCH */

.search-box{
  display: flex;
  gap: 12px;
  margin-bottom: 20px;
}

.search-box input{
  flex: 1;
  border: 1px solid #d1d5db;
  padding: 14px 18px;
  border-radius: 16px;
  outline: none;
  font-size: 15px;
}

.search-box button{
  border: none;
  background: #111827;
  color: white;
  padding: 0 22px;
  border-radius: 16px;
  cursor: pointer;
  font-weight: 600;
}

    /* RESPONSIVE */

    @media(max-width:1200px){

      .container{
        grid-template-columns: 1fr;
      }

      .menu-grid{
        grid-template-columns: repeat(2,1fr);
      }

    }

    @media(max-width:700px){

      .menu-grid{
        grid-template-columns: 1fr;
      }

      .topbar{
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
      }

    }

  </style>
</head>

<body>
  <?php if(isset($_GET['error'])): ?>

  <div class="error-alert">
    <?= $_GET['error'] ?>
  </div>

  <?php endif; ?>
  <div class="container">

    <!-- LEFT PANEL -->

    <div class="left-panel">

      <div class="topbar">

        <div>
          <h2 class="logo">
            CAFE <span>ASELOLE</span>
          </h2>
          <p>Dashboard Cafe POS</p>
        </div>

        <div class="top-actions">

          <button class="refresh-btn" onclick="refreshPage()">Refresh</button>

          <button class="icon-btn">
            <svg xmlns="http://www.w3.org/2000/svg" 
                width="22" 
                height="22" 
                viewBox="0 0 24 24" 
                fill="none" 
                stroke="currentColor" 
                stroke-width="2" 
                stroke-linecap="round" 
                stroke-linejoin="round">

              <path d="M15 17h5l-1.4-1.4A2 2 0 0 1 18 14.2V11a6 6 0 1 0-12 0v3.2a2 2 0 0 1-.6 1.4L4 17h5"/>
              <path d="M9 17a3 3 0 0 0 6 0"/>

            </svg>
          </button>

          <button class="profile">

            <img src="https://i.pravatar.cc/100" alt="Profile">

            <span>admin_budi</span>

          </button>

        </div>

      </div>

      <!-- CATEGORY -->

      <div class="categories">
        <a href="./index.php"  class="<?= !isset($_GET['id_kategori']) ? 'active' : '' ?>">All</a>
        <?php foreach(query_select("SELECT * FROM kategori", []) as $kategori): ?>
          <a 
      href="<?= "./index.php?id_kategori=" . $kategori['id_kategori'] ?>"
      class="<?= (isset($_GET['id_kategori']) && $_GET['id_kategori'] == $kategori['id_kategori']) ? 'active' : '' ?>"
    >
      <?= $kategori['nama_kategori'] ?>
    </a>

        <?php endforeach; ?>

      </div>

      <form method="GET" class="search-box">

  <?php if(isset($_GET['id_kategori'])): ?>
    <input 
      type="hidden" 
      name="id_kategori" 
      value="<?= $_GET['id_kategori'] ?>"
    >
  <?php endif; ?>

  <input 
    type="text" 
    name="search"
    placeholder="Cari menu..."
    value="<?= $_GET['search'] ?? '' ?>"
  >

  <button type="submit">
    Search
  </button>

</form>

      <!-- TOOLS -->

      <div class="menu-tools">

        <a href="tambah.php" class="add-menu-btn">
          + Tambah Menu
        </a>

      </div>

      <!-- MENU GRID -->

      <div class="menu-grid">
            <?php foreach($menus as $menu): ?>
                <div  class="card <?= $menu['jumlah_stok'] <= 0 ? 'disabled-card' : '' ?>"
                <?= $menu['jumlah_stok'] > 0 
                ? "onclick=\"addToCart('{$menu['nama_menu']}', {$menu['harga']})\" style='cursor:pointer;'" : ""?>>

                <img src="https://cdn-icons-png.flaticon.com/512/924/924514.png">

                <h4><?= $menu['nama_menu'] ?></h4>

                <p>Rp <?= number_format($menu['harga']) ?></p>

                <div class="stock <?= $menu['jumlah_stok'] <= 0 ? 'stock-empty' : '' ?>">
                  <?= $menu['jumlah_stok'] <= 0 
                      ? 'Out Of Stock' 
                      : 'Stock : ' . $menu['jumlah_stok'] ?>
                </div>

                <div class="action-btn">
                      
                <a href="<?= "edit.php?id_menu=" . $menu['id_menu'] ?>" class="edit-btn">

                  <svg xmlns="http://www.w3.org/2000/svg"
                      width="20"
                      height="20"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round">

                    <path d="M12 20h9"/>
                    <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>

                  </svg>

                  </a>

                  <a href="<?= "hapus.php?id_menu=" . $menu['id_menu'] ?>" class="delete-btn">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round">

                      <path d="M3 6h18"/>
                      <path d="M8 6V4h8v2"/>
                      <path d="M19 6l-1 14H6L5 6"/>
                      <path d="M10 11v6"/>
                      <path d="M14 11v6"/>

                    </svg>

                  </a>
                </div>

                </div>
              <?php endforeach; ?>
      </div>

    </div>

    <!-- RIGHT PANEL -->
<div class="right-panel">
    <div class="order-header">
        <h3>Order Details</h3>
        <button class="reset" onclick="resetCart()">Reset</button>
    </div>

    <!-- Container tempat menu yang dipilih muncul -->
    <div id="cart-items">
        <p style="text-align:center; color:#999; margin-top:20px;">Belum ada pesanan</p>
    </div>

    <!-- SUMMARY -->
    <div class="summary">
        <div>
            <span>Subtotal</span>
            <strong id="subtotal">Rp 0</strong>
        </div>
        <div>
            <span>Tax (10%)</span>
            <strong id="tax">Rp 0</strong>
        </div>
        <div class="grand-total">
            <span>Total</span>
            <strong id="total">Rp 0</strong>
        </div>
    </div>

    <!-- ... sisanya (payment method & pay button) tetap sama ... -->
    <button class="pay-btn" onclick="checkout()">Pay Now</button>
</div>

  </div>

  <script>
    let cart = JSON.parse(localStorage.getItem('cafe_cart')) || [];
    document.addEventListener('DOMContentLoaded', renderCart);

    function addToCart(nama, harga) {
        const existingItem = cart.find(item => item.nama === nama);
        if (existingItem) {
            existingItem.qty += 1;
        } else {
            cart.push({ nama, harga, qty: 1 });
        }
        saveAndRender();
    }

    function changeQty(nama, delta) {
        const item = cart.find(item => item.nama === nama);
        if (item) {
            item.qty += delta;
            if (item.qty <= 0) {
                cart = cart.filter(i => i.nama !== nama);
            }
        }
        saveAndRender();
    }

    function resetCart() {
      cart = [];
      saveAndRender();
    }

    // 2. Fungsi tambahan untuk simpan ke localStorage
    function saveAndRender() {
        localStorage.setItem('cafe_cart', JSON.stringify(cart));
        renderCart();
    }

    function renderCart() {
        const container = document.getElementById('cart-items');
        const subtotalEl = document.getElementById('subtotal');
        const taxEl = document.getElementById('tax');
        const totalEl = document.getElementById('total');

        if (!container) return; // Guard clause jika elemen belum dimuat

        if (cart.length === 0) {
            container.innerHTML = '<p style="text-align:center; color:#999; margin-top:20px;">Belum ada pesanan</p>';
            subtotalEl.innerText = 'Rp 0';
            taxEl.innerText = 'Rp 0';
            totalEl.innerText = 'Rp 0';
            return;
        }

        let html = '';
        let subtotal = 0;

        cart.forEach(item => {
            subtotal += (item.harga * item.qty);
            html += `
                <div class="order-item">
                    <img src="https://cdn-icons-png.flaticon.com/512/924/924514.png">
                    <div class="item-info">
                        <h4>${item.nama}</h4>
                        <p>Rp ${item.harga.toLocaleString()}</p>
                    </div>
                    <div class="qty-box">
                        <button onclick="changeQty('${item.nama}', -1)">-</button>
                        <span>${item.qty}</span>
                        <button onclick="changeQty('${item.nama}', 1)">+</button>
                    </div>
                </div>
            `;
        });

        const tax = subtotal * 0.1;
        const total = subtotal + tax;

        container.innerHTML = html;
        subtotalEl.innerText = `Rp ${subtotal.toLocaleString()}`;
        taxEl.innerText = `Rp ${tax.toLocaleString()}`;
        totalEl.innerText = `Rp ${total.toLocaleString()}`;
    }

    
    function checkout(){
      if(cart.length === 0) return;
    
      const form = document.createElement("form");
      form.method = "POST";
      form.action = "../process/update.php";

      const input = document.createElement("input");
      input.type = "hidden";
      input.name = "cart";
      input.value = JSON.stringify(cart);

      form.appendChild(input);

      cart = [];
      localStorage.removeItem('cafe_cart');
      
      document.body.appendChild(form);
      form.submit();
      

    }
    
    function refreshPage(){
      window.location.reload();
    }
</script>
</body>
</html>