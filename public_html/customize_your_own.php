


<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name    = trim($_POST['Name']);
    $Mobile  = trim($_POST['Mobile']);
    $Email   = trim($_POST['Email']);
    $Message = trim($_POST['Message']);

    $error = "";

    // Validation
    if (empty($Name) || empty($Mobile) || empty($Email) || empty($Message)) {
        $error = "All fields are required!";
    } elseif (!preg_match("/^[0-9]{10}$/", $Mobile)) {
        $error = "Enter a valid 10-digit Mobile Number!";
    } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $error = "Enter a valid Email address!";
    } else {
        // Insert data
        $sql = "INSERT INTO contactme (Name, Mobile, Email, Message) 
                VALUES ('$Name', '$Mobile', '$Email', '$Message')";

        if (mysqli_query($conn, $sql)) {
            //  Show JS alert and redirect to same page (no duplicate on refresh)
            echo "<script>
                    alert('Message Sent Successfully!');
                    window.location.href = '".$_SERVER['PHP_SELF']."';
                  </script>";
            exit;
        } else {
            $error = 'Database Error! Please try again.';
        }
    }

    // Show error if validation failed
    if (!empty($error)) {
        echo "<script>
                alert(' $error');
                window.location.href = '".$_SERVER['PHP_SELF']."';
              </script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MY WEBSITE</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
 <link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
/>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html,
    body {
      width: 100%;
      overflow-x: hidden;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background-color: #f5e4ce;
    }

    /* Top bar nav1 */
    .nav1 {
      background: #131617;
      color: #fff;
      padding: 10px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 999;
    }

    .nav1 p {
      font-size: 16px;
      text-align: center;
      flex: 1;
    }

    .nav1 .highlight {
      color: #f4b400;
      font-weight: bold;
    }

    .social-icons {
      display: flex;
      gap: 10px;
      margin-left: auto;
    }

    .social-icons a {
      background: #fff;
      width: 24px;
      height: 24px;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #131617;
      border-radius: 50%;
      text-decoration: none;
      transition: transform 0.3s;
    }

    .social-icons a:hover {
      transform: scale(1.3);
      background-color: #d98209;
      text-decoration: none;
    }

    @media (max-width: 768px) {
      .nav1 {
        flex-direction: column;
        gap: 5px;
        text-align: center;
      }

      .social-icons {
        justify-content: center;
        margin-left: 0;
      }

      .nav1 p {
        font-size: 14px;
      }
    }

    /* Main navbar */
    .navbar {
      background-color: #e4ab60;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      position: fixed;

      width: 100%;
      z-index: 998;
    }

    .logo img {
      height: 60px;
      width: auto;
    }

    .hamburger {
      display: none;
      font-size: 26px;
      cursor: pointer;
      color: #7d3719;
    }

    .nav-links {
      display: flex;
      list-style: none;
      gap: 20px;
      align-items: center;
    }

    .nav-links li a {
      text-decoration: none;
      color: #7d3719;
      font-size: 16px;
      transition: 0.3s;
    }

    .nav-links li a:hover {
      color: white;
    }

    .dropdown {
      position: relative;
    }

    .dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      width: 250px;
      background: #e4ab60;
      list-style: none;
      padding: 10px 0;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }

    .dropdown-menu li {
      padding: 8px 20px;
    }

    .dropdown-menu li a {
      font-size: 15px;
      color: #7d3719;
    }

    .dropdown:hover .dropdown-menu {
      display: block;
    }

    @media (max-width: 768px) {
      .hamburger {
        display: block;
        margin-left: auto;
      }

      .nav-links {
        display: none;
        flex-direction: column;
        width: 100%;
        background: #e4ab60;
        margin-top: 10px;
      }

      .nav-links.active {
        display: flex;
      }

      .dropdown:hover .dropdown-menu {
        display: none;
      }

      .dropdown-menu {
        position: static;
        box-shadow: none;
      }

      .dropdown.active .dropdown-menu {
        display: block;
      }
    }




   



    .footer {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
      padding: 40px 20px;
      background-color: #000;
    }

    .footer-col {
      flex: 1;
      min-width: 220px;
      margin: 10px;
      font-size: 20px;
    }

    .footer-col img.logo {
      width: 120px;
      display: block;

      margin-bottom: 10px;
    }

    .footer-col h3 {
      font-size: 20px;
      margin-bottom: 15px;
      font-family: Arial, Helvetica, sans-serif;
      font-weight: 100;
      color: rgb(255, 254, 254);
    }

    .footer-col a {
      display: block;
      color: #8a8686;
      text-decoration: none;
      margin-bottom: 8px;
      font-size: 17px;
      font-weight: 100;
      font-family: Arial, Helvetica, sans-serif;
    }

    .footer-col a:hover {
      color: rgb(223, 217, 183);
    }
   .footer-col p,
    .footer-col span {
      font-size: 16px;
      line-height: 1.6;
      color: white;
    }



    .visitors {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
    }

    @media(max-width: 768px) {
      .footer {
        flex-direction: column;
        align-items: center;
      }

      .footer-col {
        max-width: 400px;
      }
    }


    /* whatsapp box */
    .whatsapp-container {
      position: fixed;
      bottom: 20px;
      left: 10px;
      z-index: 100;
    }

    .whatsapp-link {
      display: flex;
      align-items: center;
      background-color: #25D366;
      color: white;
      text-decoration: none;
      border-radius: 50px;
      overflow: hidden;
      width: 40px;
      height: 40px;
      transition: width 0.4s ease;
      box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
    }

    .whatsapp-icon {
      font-size: 34px;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 60px;
      height: 60px;
      margin-left: 15%;
    }

    .whatsapp-text {
      white-space: nowrap;
      margin-left: 10px;
      font-size: 12px;
      opacity: 0;
      transition: opacity 0.4s ease;
      font-weight: bold;
    }

    .whatsapp-link:hover {
      width: 190px;
      text-decoration: none;
    }

    .whatsapp-link:hover .whatsapp-icon {
      margin-left: 15px;
    }

    .whatsapp-link:hover .whatsapp-text {
      opacity: 1;
    }

    /* responsive tweaks */
    @media (max-width: 600px) {
      .whatsapp-link {
        width: auto;
        height: 50px;
        padding: 0 12px;
      }

      .whatsapp-icon {
        font-size: 28px;
        width: 40px;
        height: 40px;
        margin-left: 0;
      }

      .whatsapp-text {
        opacity: 1;
        font-size: 12px;
        margin-left: 8px;
      }
    }

    /* chat box*/
    .chat-container {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 1000;
    }

    .chat-box {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: rgba(197, 157, 95, 0.85);
      backdrop-filter: blur(8px);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      cursor: pointer;
      transition: all 0.4s ease;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      border: 3px solid transparent;
      background-clip: padding-box;
      animation: gradientBorder 5s linear infinite;
      position: relative;

    }



    .chat-box.open {
      width: 340px;
      height: auto;
      border-radius: 20px;
      padding: 20px;
      animation: scaleFade 0.4s forwards;
    }

    @keyframes scaleFade {
      from {
        transform: scale(0.9);
        opacity: 0.8;
      }

      to {
        transform: scale(1);
        opacity: 1;
      }
    }

    .chat-icon {
      font-size: 28px;
      animation: pulse 2s infinite;
      transition: all 0.4s;

    }

    .chat-box.open .chat-icon {
      position: absolute;
      top: 15px;
      left: 140px;
      font-size: 24px;
      animation: none;
    }

    @keyframes pulse {

      0%,
      100% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.2);
      }
    }

    .chat-content {
      display: flex;
      flex-direction: column;
      opacity: 0;
      max-height: 0;
      transition: opacity 0.6s ease, max-height 0.6s ease;
      overflow: hidden;
      margin-top: 10px;
    }

    .chat-box.open .chat-content {
      opacity: 1;
      max-height: 1000px;
    }

    .chat-content h4,
    .chat-content p,
    .chat-form input,
    .chat-form textarea,
    .chat-form button {
      transform: translateY(20px);
      opacity: 0;
    }

    .chat-box.open .chat-content h4 {
      animation: slideIn 0.4s forwards;
    }

    .chat-box.open .chat-content p {
      animation: slideIn 0.4s forwards 0.1s;
    }

    .chat-box.open .chat-form input:nth-of-type(1) {
      animation: slideIn 0.4s forwards 0.2s;
    }

    .chat-box.open .chat-form input:nth-of-type(2) {
      animation: slideIn 0.4s forwards 0.3s;
    }

    .chat-box.open .chat-form input:nth-of-type(3) {
      animation: slideIn 0.4s forwards 0.4s;
    }

    .chat-box.open .chat-form textarea {
      animation: slideIn 0.4s forwards 0.5s;
    }

    .chat-box.open .chat-form button {
      animation: slideIn 0.4s forwards 0.6s;
    }

    @keyframes slideIn {
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .chat-content h4 {
      text-align: center;
      font-size: 16px;
      font-weight: bold;
      margin: 5px 0;
      padding-top: 10px;
    }

    .chat-content p {
      font-size: 14px;
      text-align: center;
      margin: 5px 0 10px 0;
    }

    .chat-form input,
    .chat-form textarea {
      width: 100%;
      padding: 8px;
      margin: 6px 0;
      border: none;
      border-radius: 8px;
      outline: none;
    }

    .chat-form button {
      width: 100%;
      padding: 8px;
      background: white;
      color: #c59d5f;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s;
      margin-top: 5px;
    }

    .chat-form button:hover {
      background: #eee;
      transform: scale(1.05);
    }

    .thank-you {
      text-align: center;
      font-size: 16px;
      font-weight: bold;
      opacity: 0;
      transition: opacity 0.6s;
    }

    .thank-you.show {
      opacity: 1;
    }

    @media (max-width: 420px) {
      .chat-box.open {
        width: 90vw;
      }
    }

    /* end*/

    /* comapny name */
    .copyright {
      text-align: center;
      padding: 15px;
      font-size: 15px;
      background: #000;
      color: #fff;
    }

    .copyright .developer {
      color: transparent;


    }

    .copyright .developer:hover {
      color: #b0a792;
      text-shadow: 0 0 5px #ffdd57;
    }

    /*   end   */
 .product-container {
    margin-top: 20vh;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 3rem;
    padding: 2rem;
    justify-items: center;
    background-color: #f5f5f5;
  }

  .product-card {
    width: 400px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    text-align: center;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  }

  .product-card img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .product-card img:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
  }

  .product-card h3 {
    font-size: 1.2rem;
    margin: 0.5rem 0;
  }

  .product-card .price {
    font-size: 1.2rem;
    font-weight: bold;
    color: #333;
  }

  .buttons {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin: 0.75rem 0;
    flex-wrap: wrap;
  }

  .product-card button,
  .wishlist-btn {
    padding: 8px 14px;
    font-size: 1rem;
    border: none;
    cursor: pointer;
    border-radius: 5px;
  }

  .product-card button {
    background: #c59d5f;
    color: white;
  }

  .product-card button:hover {
    background: #a7793c;
  }

  .wishlist-btn {
    background: #eee;
    color: #c0392b;
  }

  .wishlist-btn.active {
    color: #e74c3c;
    background: #ffeaea;
  }

  .big-wishlist {
    position: fixed;
    bottom: 180px;
    left: 20px;
    background: #fff;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: #c0392b;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    cursor: pointer;
  }

  .big-wishlist span {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #e74c3c;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 0.75rem;
  }

  .wishlist-popup {
    position: fixed;
    bottom: 250px;
    left: 20px;
    width: 250px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    padding: 1rem;
    display: none;
    flex-direction: column;
  }

  .wishlist-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem;
    background: #f9f9f9;
    border-radius: 6px;
    margin-bottom: 0.5rem;
  }

  .wishlist-item button {
    background: none;
    border: none;
    color: #e74c3c;
    cursor: pointer;
  }

 @media (max-width: 1200px) {
  .product-container {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .product-container {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 480px) {
  .product-card {
    margin: 0 auto;
    width: 90%;
  }

  .product-card img {
    height: 200px;
  }

  .buttons {
    flex-direction: column;
    gap: 0.5rem;
  }
}
    
  </style>
</head>

<body>
  <!-- Top contact bar -->
  <div class="nav1">
    <p>
      For best prices and early deliveries,
      <span class="highlight">Contact Us :</span>
      <span class="highlight">+91 94152 05761</span> or
      <i class="fa-brands fa-whatsapp"></i>
      <span class="highlight">+91 94152 05761</span>
    </p>
    <div class="social-icons">
      <a href="https://www.facebook.com/mirzapurkaleen.rugs?mibextid=ZbWKwL"><i class="fa-brands fa-facebook"></i></a>
      <a href="https://www.instagram.com/mirzapurkaleenrugs?igsh=Z2JsdjRnZGZuOXVk"><i class="fab fa-instagram"></i></a>
      <a href="https://youtube.com/@mirzapurkaleenrugs?si=qmRs1i0sdg3hXMOf"><i class="fas fa-play"></i></a>
      <a href="https://x.com/kaleen1731371?t=nGRLDTD_SbPgPfgm6wnSrw&s=09"><i class="fab fa-twitter"></i></a>
<a href="https://x.com/kaleen1731371?t=nGRLDTD_SbPgPfgm6wnSrw&s=09"><i class="fa-brands fa-x-twitter"></i></a>
   
    </div>
  </div>

  <!-- Main navbar -->
  <nav class="navbar">
    <div class="logo">
      <img src="images/clean_hd_logo-removebg-preview.png">
    </div>
    <div class="hamburger" onclick="toggleMenu()">
      <i class="fas fa-bars"></i>
    </div>
    <ul class="nav-links">
      <li><a href="home.php">Home</a></li>
      <li class="dropdown">
        <a href="#">Luxury Fashion & customized <br>
          <p style="text-align: center;">oversease taste</p>
        </a>
        <ul class="dropdown-menu">
          <li><a href="fashion_flooring.php">Fashion Flooring</a></li>
          <li><a href="hand_tufted.php">Hand Tufted carpets</a></li>
          <li><a href="fine_indian_durrys.php">Fine Indian Durrys & Kilims</a></li>
          <li><a href="fine_indian_jute.php">Fine Indian jute, Hamp,so many villagers threads</a></li>
          <li><a href="fine_indian_knotted.php">Fine Indian Knotted carpets</a></li>
          <li><a href="customize_your_own.php">Customize Your Own Carpets</a></li>
          <li><a href="hand_made_painting.php">Hand made painting</a></li>
          <li><a href="cushion_covers.php">Cushion covers, pouffes</a></li>
          <li><a href="Brass_vessels.php">Brass vessels & utensils</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#">Luxury home fashion flooring</a>
        <ul class="dropdown-menu">
          <li><a href="home_fashion.php">Home Fashion Floring</a></li>
          <li><a href="hand_tufted_saggy.php">Hand Tufted & saggy,Durries</a></li>
          <li><a href="for_big_hotel.php">For big Hotel, Banquets, Big Size carpets etc</a></li>
          <li><a href="pooja_durry_aasan.php">Pooja Durry Assan & Yoga Durry Assan</a></li>
          <li><a href="knotted_carpets.php">Knotted carpets & Doormats</a></li>
          <li><a href="doormats.php">Doormats</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#">Organic treasury</a>
        <ul class="dropdown-menu">
          <li><a href="organic_yarns.php">Organic color dying woollen yarns</a></li>
          <li><a href="organic_carpets.php">Organic color dying handmade tufted carpets</a></li>
          <li><a href="kitchen_natural_wood.php">Kitchen ware made from natural wood</a></li>
          <li><a href="bamboo_bottels.php">Bamboo Bottles & products</a></li>
        </ul>
      </li>
      <li><a href="Drycleaning_Exchange_Offer.php">Drycleaning & Exchange Offer</a></li>
      <li><a href="Social_Weavers_Welfare.php">Social & Weavers Welfare</a></li>

      <li><a href="Contact_Us.php">ContactUs & Warranty</a></li>
    </ul>
  </nav>
  <script>
    function toggleMenu() {
      document.querySelector('.nav-links').classList.toggle('active');
    }
    document.querySelectorAll('.nav-links .dropdown > a').forEach(link => {
      link.addEventListener('click', function (e) {
        if (window.innerWidth <= 768) {
          e.preventDefault();
          this.parentElement.classList.toggle('active');
        }
      });
    });
    function adjustNavbarOffset() {
      const nav1 = document.querySelector('.nav1');
      const navbar = document.querySelector('.navbar');
      const nav1Height = nav1.offsetHeight;
      navbar.style.top = nav1Height + 'px';
    }
    window.addEventListener('load', adjustNavbarOffset);
    window.addEventListener('resize', adjustNavbarOffset);
  </script>
 <?php
session_start();


// Fetch products from `customizeyourown` table
$res = $conn->query("SELECT * FROM customizeyourown ORDER BY id DESC");
$products = [];
if ($res) while ($r = $res->fetch_assoc()) $products[] = $r;
?>

<div class="product-container">
  <?php if (count($products) === 0): ?>
    <p>No products available.</p>
  <?php else: foreach ($products as $p): ?>
    <div class="product-card" data-name="<?php echo htmlspecialchars($p['name']); ?>">
      <?php
      // Image folder ka path "uploads/customize your own/"
      $imgPath = 'uploads/customize your own/' . $p['image'];
      if (!file_exists($imgPath) || empty($p['image'])) {
          $imgPath = 'https://via.placeholder.com/400x250?text=No+Image';
      }
      ?>
      <img src="<?php echo $imgPath; ?>" alt="<?php echo htmlspecialchars($p['name']); ?>">
      <h3><?php echo htmlspecialchars($p['name']); ?></h3>
      <p class="price">₹<?php echo htmlspecialchars($p['price']); ?></p>

      <div class="buttons">
        <form method="POST" action="create_order.php" style="display: inline;">
            <input type="hidden" name="product_id" value="<?php echo $p['id']; ?>">
            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($p['name']); ?>">
            <input type="hidden" name="price" value="<?php echo $p['price']; ?>">
            <input type="hidden" name="image" value="<?php echo htmlspecialchars($p['image']); ?>">
            <input type="hidden" name="category" value="customize_own">
            <button type="submit" class="buy-now-btn">Buy Now</button>
        </form>
        <button class="wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
    </div>
  <?php endforeach; endif; ?>
</div>

<script>
  // Check login status from PHP session
  const isLoggedIn = <?php echo isset($_SESSION['email']) ? 'true' : 'false'; ?>;

  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.shop-btn, .cart-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const pid = this.getAttribute('data-id');

        if (!isLoggedIn) {
          const alreadyRegistered = localStorage.getItem("alreadyRegistered");

          if (alreadyRegistered === "true") {
            // Registered before → go to Login
            window.location.href = "Resister.php";
          } else {
            // Not registered → go to Register first
            localStorage.setItem("alreadyRegistered", "true");
            window.location.href = "Users_login.php";
          }
        } else {
          // Logged in → normal flow
          if (this.classList.contains('shop-btn')) {
            window.location.href = "product_details.php?id=" + pid;
          } else if (this.classList.contains('cart-btn')) {
            window.location.href = "userdashboard.php?action=cart&id=" + pid;
          }
        }
      });
    });
  });
</script>



<div class="big-wishlist">
  <i class="fa-solid fa-heart"></i>
  <span id="wishlist-count">0</span>
</div>

<div class="wishlist-popup" id="wishlist-popup"></div>

<script>
  const wishlistBtns = document.querySelectorAll('.wishlist-btn');
  const wishlistCount = document.getElementById('wishlist-count');
  const wishlistPopup = document.getElementById('wishlist-popup');
  const bigWishlist = document.querySelector('.big-wishlist');

  let wishlist = [];

  wishlistBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const card = btn.closest('.product-card');
      const name = card.getAttribute('data-name');
      if (!btn.classList.contains('active')) {
        btn.classList.add('active');
        btn.innerHTML = '<i class="fa-solid fa-heart"></i>';
        addToWishlist(name);
      } else {
        btn.classList.remove('active');
        btn.innerHTML = '<i class="fa-regular fa-heart"></i>';
        removeFromWishlist(name);
      }
    });
  });

  function addToWishlist(name) {
    if (!wishlist.includes(name)) {
      wishlist.push(name);
      updateCount();
      updatePopup();
    }
  }

  function removeFromWishlist(name) {
    wishlist = wishlist.filter(item => item !== name);
    updateCount();
    updatePopup();
    updateHearts(name);
  }

  function updateCount() {
    wishlistCount.textContent = wishlist.length;
  }

  function updatePopup() {
    wishlistPopup.innerHTML = '';
    if (wishlist.length === 0) {
      wishlistPopup.innerHTML = '<p>No items in wishlist.</p>';
    } else {
      wishlist.forEach(item => {
        const div = document.createElement('div');
        div.className = 'wishlist-item';
        div.innerHTML = `<span>${item}</span><button onclick="removeItem('${item}')"><i class="fa-solid fa-xmark"></i></button>`;
        wishlistPopup.appendChild(div);
      });
    }
  }

  function updateHearts(name) {
    wishlistBtns.forEach(btn => {
      const card = btn.closest('.product-card');
      if (card.getAttribute('data-name') === name) {
        btn.classList.remove('active');
        btn.innerHTML = '<i class="fa-regular fa-heart"></i>';
      }
    });
  }

  function removeItem(name) { removeFromWishlist(name); }

  bigWishlist.addEventListener('click', () => {
    wishlistPopup.style.display = wishlistPopup.style.display === 'flex' ? 'none' : 'flex';
  });
</script>
  <!-- whatsapp start-->
  <div class="whatsapp-container">
    <a href="https://wa.me/9415205761?text=Hello%20I%20want%20to%20know%20more" class="whatsapp-link" target="_blank">
      <i class="fab fa-whatsapp whatsapp-icon"></i>
      <span class="whatsapp-text">WHATSAPP US</span>
    </a>
  </div>
  <!--end-->
<!-- chatbox start-->

  <div class="chat-container">
    <div class="chat-box" id="chatBox">
      <div class="chat-icon">
        <i class="fas fa-user" style="margin-left: 16px;"></i>
      </div>
      <div class="chat-content">
        <h4>GET HELP</h4>
        <p>Call +91 9415205761<br>or WhatsApp +91 9123456789</p>

        <!-- Chat Form -->
        <form class="chat-form" id="chatForm" method="POST" action="">
          <input type="text" name="Name" placeholder="* Name" required>
          <input type="text" name="Mobile" placeholder="* Mobile Number" required>
          <input type="text" name="Email" placeholder="* Email" required>
          <textarea rows="3" name="Message" placeholder="* Message" required></textarea>
          <button type="submit" name="submit">Submit</button>
        </form>

      </div>
    </div>
  </div>

  <script>
    const chatBox = document.getElementById('chatBox');
    chatBox.addEventListener('click', e => {
      if (e.target === chatBox || e.target.closest('.chat-icon')) {
        chatBox.classList.toggle('open');
      }
    });
  </script>
  <!-- end-->
  <div class="footer">
    <div class="footer-col">
      <img src="clean_hd_logo-removebg-preview.png" alt="Mirzapur Qaleen" class="logo" />
      <p style="font-family: cursive; font-size:25px ;">handcrafted with love</p>
    </div>
    <div class="footer-col">
      <h3>Shop With Us</h3>
      <a href="Product_Style.php">Product Style</a>
      <a href="Product_Size.php">Product Size</a>
      <a href="Custom_Design.php">Custom Design</a>
      <a href="My_Account.php">My Account</a>
      <a href="My_Cart.php">My Cart</a>
      <br>
      <br>
      <p> Total Visitors <i class="fas fa-users">:</i> <strong>000000</strong> </p>

    </div>
    <div class="footer-col">
      <h3>Guides & Policies</h3>
      <a href="materials.php">Materials</a>
      <a href="Carpet_Maintenance.php">Carpet Maintenance</a>
      <a href="Privacy_Policy.php">Privacy Policy</a>
      <a href="Shipping_Policy.php">Shipping Policy</a>
      <a href="Return.php">Return & Exchange Policy</a>
      <h3 style="margin-top:20px;">Locate Us : <i class="fa-solid fa-location-dot"></i></h3>
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10413.840102017733!2d82.54038283930292!3d25.148007144428398!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x398feb46a07ab895%3A0x4c36292fb3b8d964!2sNatwa%20Tiraha!5e0!3m2!1sen!2sin!4v1752044763815!5m2!1sen!2sin"
        width="310" height="150" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">

      </iframe>
    </div>
    <div class="footer-col">
      <h3>Contact us </h3>
      <p>Mr. VIJAY GUPTA <br>Phone: <i class="fa-solid fa-phone"></i> +91 94152 05761 </p>
      <p>Mr. VIJAY GUPTA <br>Whatsapp Number: <i class="fa-brands fa-whatsapp"></i>+91 94152 05761</p>
      <p>E-mail: <i class="fa-solid fa-envelope"></i> <a href="#">mirzapurkalenrugs@gmail.com</a></p>
      <h3>Our store : <i class="fas fa-store"></i></h3>
      <p>Mahant ka Shiwala,Mirzapur<br> Pin Code  – 231001</p>
    </div>
  </div>
  <div class="copyright">
    © 2025 - Maa VindhyaVashini Carpet Powered by
    <span class="developer"> <a href="#" style="text-decoration: none; color: white;  ">INDRADHANUSH
        INFOTECH</a></span>
  </div>
</body>

</html>