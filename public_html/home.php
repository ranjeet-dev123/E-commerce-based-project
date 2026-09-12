




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
   *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }
    html,
    body {
      width: 100%;
      overflow-x: hidden;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background-color: #f5e4ce;
      padding-top: 140px;
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




    /* container */

    .main-container {
           margin-top: 120px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }

        .content-left,
        .content-container {
            width: 48%;
            max-width: 700px;
            background: transparent;
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            border-radius: 20px;
            overflow: hidden;
        }

        .content-left img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .section,
        .mini-section {
            position: relative;
            overflow: hidden;
            padding: 25px;
            margin-bottom: 20px;
            background: rgba(255, 250, 240, 0.85);
            border: 3px solid #ffb74d;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
            transition: transform 0.4s, box-shadow 0.4s;
        }

        .section h1,
        .section h2,
        .section h3,
        .section h4,
        .mini-section h1,
        .mini-section h2,
        .mini-section h3,
        .mini-section h4 {
            background: linear-gradient(90deg, #ff9800, #f57c00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-top: 0;
        }

        .section:hover,
        .mini-section:hover {
            transform: translateY(-6px) scale(1.015);
            box-shadow: 0 22px 55px rgba(0, 0, 0, 0.2);
        }

        .section::before,
        .mini-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(from 0deg, #ffa500, #ffcc80, #ffa500, transparent, #ffa500);
            animation: rotateBorder 6s linear infinite;
            z-index: 0;
        }

        .section::after,
        .mini-section::after {
            content: '';
            position: absolute;
            top: 6px;
            left: 6px;
            right: 6px;
            bottom: 6px;
            background: rgba(255, 245, 235, 0.9);
            border-radius: 16px;
            z-index: 1;
        }

        .section>*,
        .mini-section>* {
            position: relative;
            z-index: 2;
        }

        p,
        ul {
            line-height: 1.7;
        }

        ul {
            padding-left: 20px;
        }

        .emoji {
            display: inline-block;
            animation: floatEmoji 2.5s ease-in-out infinite;
        }

        .cta {
            display: inline-block;
            background: #e67e22;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1.1rem;
            margin-top: 15px;
            transition: background 0.3s;
        }

        .cta:hover {
            background: #d35400;
        }

        @keyframes rotateBorder {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes floatEmoji {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-6px);
            }
        }

        @media(max-width: 900px) {

            .content-left,
            .content-container {
                width: 100%;
            }
        }

    



    .footer {

      margin-top: 8vh;
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

    .container {
      display: flex;

      width: 100%;

      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      line-height: 1.6;
      color: #333;
    }

    .image-side {
      flex: 1 1 50%;
    }

    .image-side img {
      width: 100%;

      object-fit: cover;
      margin-top: 80px;

    }

    .content-side {
      flex: 1 1 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 3rem;
      text-align: center;
      margin-top: 80px;
    }

    .content {
      max-width: 100%;
    }

    .small-text {
      font-size: 1.1rem;
      color: #666;
      margin-bottom: 1rem;
    }

    .main-heading {
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 1.5rem;
    }

    .desc {
      font-size: 1.2rem;
      margin-bottom: 1.5rem;
    }

    .links {
      font-size: 1.1rem;
      color: #555;
      margin-bottom: 2rem;
    }

    .links span {
      margin: 0 0.4rem;
    }

    .btn {
      display: inline-block;
      padding: 0.8rem 2rem;
      font-size: 1.1rem;
      border: 2px solid #000;
      text-decoration: none;
      color: #000;
      transition: 0.3s;
    }

    .btn:hover {
      background: #000;
      color: #fff;
      text-decoration: none;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }

      .image-side,
      .content-side {
        flex: 1 1 100%;
      }
    }

    /* end */






     .container12 {
      background-color: rgb(204, 168, 168);
      color: #333;
      padding: 2rem 1rem;
      animation: slideFromLeft 1s ease-out;
    }

    @keyframes slideFromLeft {
      0% {
        transform: translateX(-100%);
        opacity: 0;
      }
      100% {
        transform: translateX(0);
        opacity: 1;
      }
    } 

    .features {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 2rem;
      max-width: 1200px;
      margin: auto;
    }

    .feature {
      flex: 1 1 300px;
      max-width: 350px;
      text-align: center;
      padding: 1rem;
    }

    .feature i {
      font-size: 3rem;
      color: #9b7d44;
      margin-bottom: 1rem;
    }

    .feature h3 {
      font-size: 1.25rem;
      margin-bottom: 1rem;
    }

    .feature p {
      font-size: 1rem;
      color: #444;
      line-height: 1.5;
    }

    .product-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 5rem;
      padding: 2rem 1rem;
      
    }

    .product-card {
      flex: 1 1 calc(100% / 2 - 1rem);
      max-width: 220px;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 10px;
      text-align: center;
      overflow: hidden;
    }

    .product-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card img:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .product-card h3 {
      font-size: 1rem;
      margin: 0.5rem 0;
    }

    

    .product-card .price {
      font-size: 1.1rem;
      font-weight: bold;
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
      padding: 6px 10px;
      font-size: 0.9rem;
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
      bottom:180px;
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

    @media (max-width: 768px) {
      .product-card {
        flex: 1 1 calc(50% - 1rem);
      }
    }

    @media (max-width: 480px) {
      .product-card {
        flex: 1 1 100%;
        max-width: 100%;
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

  <script>
function togglePassword(inputId, icon) {
  let input = document.getElementById(inputId);
  if (input.type === "password") {
    input.type = "text";
    icon.classList.remove("fa-eye");
    icon.classList.add("fa-eye-slash");
  } else {
    input.type = "password";
    icon.classList.remove("fa-eye-slash");
    icon.classList.add("fa-eye");
  }
}
</script>

  <!-- body start-->

  <div class="main-container">
        <!-- LEFT IMAGE BOX -->
       

        <!-- RIGHT CONTENT -->
        <div class="content-container">

            <div class="section">
                <h2>Why Choose Us?</h2>
                <p> <strong>Maa Vindhywasani Carpets, Rugs & More</strong><br>
                     Mirzapur – 231001, Uttar Pradesh, INDIA</p>
                <h3> Timeless Artistry</h3>
                <p> Made from the finest materials, each piece is a masterpiece that lasts, adding a touch of luxury to
                    your space.</p>
            </div>

            <div class="section">
                <h3> Trusted by Homes Worldwide</h3>
                <p> Our carpets are adored for their elegance, durability, and unmatched quality – beautifying homes
                    across continents.</p>
            </div>

            <div class="section">
                <h2> Experience Tradition & Trust</h2>
                <p> Don’t just buy a carpet — <strong>own a piece of history!</strong></p>
                
            </div>

            <div class="mini-section">
                <h3><span class="emoji"></span> भारत में कालीन का इतिहास</h3>
                <p>भारत में कालीन का इतिहास बहुत समृद्ध और विविध है, जो देश की सांस्कृतिक धरोहर और शिल्प कौशल को दर्शाता
                    है।</p>
            </div>

            <div class="mini-section">
                <h4><span class="emoji"></span> प्राचीन उत्पत्ति</h4>
                <p>सिंधु घाटी सभ्यता, जो लगभग 3300 ईसा पूर्व की है, में कपड़ा उत्पादन के प्रमाण मिलते हैं, जिसमें कालीन
                    भी शामिल हैं।</p>
                <h4><span class="emoji"></span> मध्यकालीन काल</h4>
                <p>मध्यकालीन काल में, भारत में विभिन्न राजवंशों और राज्य ने कालीन बुनाई के विकास में योगदान दिया।</p>
            </div>

            <div class="mini-section">
                <h4><span class="emoji"></span> क्षेत्रीय शैलियाँ</h4>
                <ul>
                    <li> <strong>मिर्जापुर (उत्तर प्रदेश):</strong> उच्च गुणवत्ता वाले ऊन के कालीनों के लिए प्रसिद्ध।
                    </li>
                    <li> <strong>अमृतसर (पंजाब):</strong> कालीन निर्माण का प्राचीन केंद्र।</li>
                    <li> <strong>भदोही (उत्तर प्रदेश):</strong> हाथ से बुने कालीनों के लिए प्रसिद्ध।</li>
                </ul>
            </div>

            <div class="mini-section">
                <h4><span class="emoji"></span> शिल्प कौशल और तकनीक</h4>
                <p>भारतीय कालीन बुनाई अपनी जटिल डिज़ाइनों और उच्च गुणवत्ता वाले शिल्प कौशल के लिए जानी जाती है।</p>
                <h4><span class="emoji"></span> सांस्कृतिक महत्व</h4>
                <p>कालीनों का भारतीय संस्कृति में सजावटी और कार्यात्मक रूप में महत्वपूर्ण स्थान है।</p>
            </div>


            <div class="mini-section">
                <h3><span class="emoji"></span> History of Carpets in India</h3>
                <p>The history of carpets in India is very rich and diverse, reflecting the country’s cultural heritage
                    and
                    craftsmanship. Here are some key points about the history of carpets in India:</p>
                <h4><span class="emoji"></span> Ancient Origins</h4>
                <p>The Indus Valley Civilization, dating back to around 3300 BCE, shows evidence of textile production,
                    including
                    carpets. The art of carpet weaving has been passed down through generations, influenced by various
                    dynasties and
                    cultural exchanges.</p>
            </div>
            <div class="mini-section">
                <h4><span class="emoji"></span> Medieval Period</h4>
                <p>During the medieval period, various dynasties and states in India contributed to the development of
                    carpet
                    weaving. The Delhi Sultanate and other regional states patronized artisans and encouraged the
                    production of
                    high-quality carpets.</p>
            </div>
            <div class="mini-section">
                <h4><span class="emoji"></span> Regional Styles</h4>
                <ul>
                    <li> <strong>Mirzapur (Uttar Pradesh):</strong> A prominent and well-known carpet production
                        center. Known for
                        its high-quality wool carpets with intricate designs, complex patterns, and vibrant colors.</li>
                    <li> <strong>Amritsar (Punjab):</strong> Also has a mention of carpet making since ancient times.
                    </li>
                    <li> <strong>Bhadohi (Uttar Pradesh):</strong> Famous for its hand-woven carpets.</li>
                </ul>
            </div>
            <div class="mini-section">
                <h4><span class="emoji"></span> Craftsmanship & Techniques</h4>
                <p>Indian carpet weaving is renowned for its intricate designs, vibrant colors, and high-quality
                    craftsmanship.
                    Artisans use traditional techniques like hand-knotting and hand-tufting to create these beautiful
                    works of art.

                <h4><span class="emoji"></span> Cultural Significance</h4>
                <p>Carpets have played an important role in Indian culture, serving as both decorative and functional
                    items. They
                    are often used in homes, temples, and other sacred spaces, and are also given as gifts on special
                    occasions.</p>
                </p>
            </div>

        </div>
    </div>

  <!--body end-->

  <hr style="background-color:black ; width: 100%; height: 5px; ">


  <div class="container12">
    <div class="features">
      <div class="feature">
        <i class="fas fa-thumbs-up"></i>
        <h3>Exquisite Quality</h3>
        <p>Mirzapur’s handwoven carpets masterfully blend lasting strength with intricate design. Each one is made to
          endure, adding warmth, character, and a timeless elegance to any room. More than mere decor, these pieces
          are crafted to truly inspire.

        </p>
      </div>
      <div class="feature">
        <i class="fas fa-truck"></i>
        <h3>Effortless Delivery</h3>
        <p>Find the perfect carpet for your space and enjoy a seamless delivery experience. Quick, reliable, and
          brought straight to your doorstep, we make it easy to welcome effortless style and comfort into your home.
        </p>
      </div>
      <div class="feature">
        <i class="fas fa-shield-alt"></i>
        <h3>Trusted Warranty</h3>
        <p>Shop with total confidence, knowing every purchase is backed by a robust warranty that safeguards its
          lasting beauty. We’re dedicated to your satisfaction, offering complete peace of mind long after your carpet
          arrives.</p>
      </div>
    </div>
  </div>










  <!-- end the product-->

  <!-- MA VINDHYAVASHANI PROJECTS-->
  <div class="container" style="background-color: transparent;">
    <div class="image-side">
      <img src="images/image.png" alt="Interior Room" style="height: 80vh; width: 100%;">
    </div>
    <div class="content-side">
      <div class="content">
        <div class="small-text">True Bespoke Experience</div>
        <div class="main-heading">Maa VindhyaVashini Carpet Rugs and more</div>
        <div class="desc">
          Crafting bespoke luxury rugs for the world's most discerning clientele,
          transforming visions into exclusive handcrafted masterpieces.
        </div>
        <div class="links">
          Private Residences <span>|</span>
          Hotels & Hospitality <span>|</span>
          Royal Palaces <span>|</span>
          Boutique Stores <span>|</span>
          Yachts <span>|</span>
          Private Jets
        </div>
        <a href="#" class="btn">EXPLORE</a>
      </div>
    </div>
  </div>
  <!-- END-->
  
  

  
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
      <img src="images/clean_hd_logo-removebg-preview.png" alt="Mirzapur Qaleen" class="logo" />
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
      <p >Mr. VIJAY GUPTA <br>WHATSAPP NUMBER : <i class="fa-brands fa-whatsapp"></i>+91 94152 05761</p>
      <p>Email: <i class="fa-solid fa-envelope"></i> <a href="#">mirzapurkalenrugs@gmail.com</a></p>
      <h3>Our store : <i class="fas fa-store"></i></h3>
      <p>Mahant ka Shiwala,Mirzapur<br> pin code  – 231001</p>
    </div>
  </div>
  <div class="copyright">
    © 2025 - Maa VindhyaVashini Carpet Powered by
    <span class="developer"> <a href="#" style="text-decoration: none; color: white;  ">INDRADHANUSH
        INFOTECH</a></span>
  </div>
</body>

</html>