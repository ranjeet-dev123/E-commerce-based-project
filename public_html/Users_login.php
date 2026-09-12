<?php
// this script will handle login
session_start();

// Add security headers
session_regenerate_id(true);
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);

//check if the user is already logged in as USER only
if(isset($_SESSION['email']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] == "user")
{
  header("location: welcometoDASHBOARD.php");
  exit;
}
// If admin is logged in, show message and don't auto-redirect
if(isset($_SESSION['email']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] == "admin")
{
    $err = "Admin session detected. Please logout first to access user login.";
}

require_once "config.php";
$email = $password = "";
$err = "";

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

//if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
  // Verify CSRF token
  if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
      $err = "Invalid request!";
  }
  elseif(empty(trim($_POST['email'])) || empty(trim($_POST['password'])))
  {
    $err = "Please enter email and password";
  }
  else{
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
  }

if(empty($err))
{
  $sql = "SELECT id, email, password FROM register WHERE email = ?";
  $stmt = mysqli_prepare($conn, $sql);
  if($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $param_email);
    $param_email = $email;
    
    //try to execute this statement
    if(mysqli_stmt_execute($stmt))
    { 
      mysqli_stmt_store_result($stmt);
      if(mysqli_stmt_num_rows($stmt) == 1)
      {
        mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
        if(mysqli_stmt_fetch($stmt))
        {
          if(password_verify($password, $hashed_password))
          {
            // Clear any existing session first
            $_SESSION = array();
            session_destroy();
            session_start();
            
            $_SESSION["email"] = $email;
            $_SESSION["id"] = $id;
            $_SESSION["loggedin"] = true;
            $_SESSION["user_type"] = "user";
            
            // Regenerate session ID for security
            session_regenerate_id(true);
            
            // Show alert before redirect
            echo "<script>
                    alert('Login Successful!');
                    window.location.href = 'welcometoDASHBOARD.php';
                  </script>";
            exit;
          } else {
            $err = "Invalid email or password!";
          }
        }
      } else {
        $err = "Invalid email or password!";
      }
    }
    mysqli_stmt_close($stmt);
  } else {
    $err = "Database error!";
  }
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login Page</title>
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
        
        .main {   
            padding: 50px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-section {
            margin-top: 20vh;
            min-width: 320px;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            animation: slideInUp 1.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideInUp {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            font-size: 26px;
            margin-bottom: 20px;
            color: #3a2d21;
            position: relative;
            text-align: center;
        }

        h2::before, h2::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 60px;
            height: 2px;
            background: #a77c4e;
        }

        h2::before {
            left: 0;
            transform: translateX(-110%);
        }

        h2::after {
            right: 0;
            transform: translateX(110%);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
            animation: fadeIn 2s ease-in-out;
        }

        input:not([type="checkbox"]) {
            padding: 16px 14px;
            border: none;
            border-bottom: 2px solid #b89e82;
            background: transparent;
            font-size: 17px;
            outline: none;
            transition: border-color 0.3s;
            width: 100%;
        }

        input:focus {
            border-color: #8b6543;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper i {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #a07c57;
            cursor: pointer;
            font-size: 16px;
        }
        
        button {
            padding: 12px;
            background: #a07c57;
            color: white;
            font-size: 15px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #8b6543;
        }

        .Raj a {
            color: #a07c57;
            text-decoration: none;
            font-size: 14px;
            text-align: center;
            display: block;
            margin-top: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        input[type="checkbox"] {
            width: auto;
            transform: scale(1.1);
            accent-color: #a07c57;
            margin: 0;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }
        
        @media (max-width: 768px) {
            h2::before, h2::after {
                display: none;
            }
            .form-section {
                margin-top: 25vh;
            }
        }

        .error-message {
            color: #d9534f;
            text-align: center;
            padding: 10px;
            background: #f8d7da;
            border-radius: 5px;
            margin-bottom: 15px;
            border: 1px solid #f5c6cb;
        }
        
        .footer {
            margin-top: 30vh;
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
        
        .copyright {
            background: #131617;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 14px;
        }
        
        .register-link {
            text-align: center;
            margin-top: 15px;
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


    <div class="main">
        <!-- Login Form -->
        <div class="form-section">
            <h2>User Login</h2>
            
           
            
            <form method="POST" action="">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <input type="email" name="email" placeholder="Email address *" required 
                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                
                <div class="password-wrapper">
                    <input type="password" name="password" id="loginPassword" 
                           placeholder="Enter Password" required>
                    <i class="fas fa-eye" onclick="togglePassword('loginPassword', this)" 
                       style="cursor:pointer;"></i>
                </div>
                
                <label class="remember-me">
                    <input type="checkbox"> <span>Remember me</span>
                </label>
                
                <button type="submit">Log in</button>
                
                <div class="Raj">
                    <a href="Resister.php">New User? Register here</a>
                    <a href="#" style="margin-top: 5px;">Forgot Password?</a>
                </div>
            </form>

            <div class="register-link">
                <p>Don't have an account? <a href="Resister.php" style="color: #a07c57; font-weight: bold;">Register Now</a></p>
            </div>
        </div>
    </div>
    
    <!-- Footer Section -->
    <div class="footer">
        <div class="footer-col">
            <img src="clean_hd_logo-removebg-preview.png" alt="Mirzapur Qaleen" class="logo" />
            <p style="font-family: cursive; font-size:25px;">handcrafted with love</p>
        </div>
        <div class="footer-col">
            <h3>Shop With Us</h3>
            <a href="Product_Style.php">Product Style</a>
            <a href="Product_Size.php">Product Size</a>
            <a href="Custom_Design.php">Custom Design</a>
            <a href="My_Account.php">My Account</a>
            <a href="My_Cart.php">My Cart</a>
            <br><br>
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
            <h3>Contact us</h3>
            <p>Mr. VIJAY GUPTA <br>Phone: <i class="fa-solid fa-phone"></i> +91 94152 05761 </p>
            <p>Mr. VIJAY GUPTA <br>Whatsapp: <i class="fa-brands fa-whatsapp"></i> +91 94152 05761</p>
            <p>E-mail: <i class="fa-solid fa-envelope"></i> <a href="mailto:mirzapurkalenrugs@gmail.com">mirzapurkalenrugs@gmail.com</a></p>
            <h3>Our store : <i class="fas fa-store"></i></h3>
            <p>Mahant ka Shiwala, Mirzapur<br> Pin Code – 231001</p>
        </div>
    </div>
    
    <div class="copyright">
        © 2025 - Maa VindhyaVashini Carpet Powered by
        <span class="developer">
            <a href="#" style="text-decoration: none; color: white;">INDRADHANUSH INFOTECH</a>
        </span>
    </div>
</body>
</html>