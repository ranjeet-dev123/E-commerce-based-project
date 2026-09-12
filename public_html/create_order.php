<?php
session_start();
include 'Config.php';

if(!isset($_SESSION['email'])) {
    header("Location: Users_login.php");
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Product details
    $product_id = $_POST['product_id'] ?? '';
    $product_name = $_POST['product_name'] ?? '';
    $price = $_POST['price'] ?? '';
    $product_image = $_POST['image'] ?? '';
    $product_category = $_POST['category'] ?? 'fashion_flooring'; // ✅ NEW: Category
    $user_email = $_SESSION['email'];
    
    // ✅ Address details from form
    $name = $_POST['name'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $address = $_POST['address'] ?? '';
    $city = $_POST['city'] ?? '';
    $pincode = $_POST['pincode'] ?? '';
    
    // Validation
    if(empty($name) || empty($mobile) || empty($address) || empty($city) || empty($pincode)) {
        header("Location: order_address.php?product_id=$product_id&category=$product_category&error=1");
        exit;
    }
    
    // ✅ Foreign keys temporarily disable karein
    $conn->query("SET FOREIGN_KEY_CHECKS=0");
    
    // ✅ Complete order insert with address details AND category
    $sql = "INSERT INTO orders (user_email, product_id, name, total_amount, qty, status, order_date, mobile, address, city, pincode, product_image, category) 
            VALUES ('$user_email', '$product_id', '$product_name', '$price', 1, 'ordered', NOW(), '$mobile', '$address', '$city', '$pincode', '$product_image', '$product_category')";
    
    if($conn->query($sql)) {
        $conn->query("SET FOREIGN_KEY_CHECKS=1");
        header("Location: welcometoDASHBOARD.php?order_success=1");
        exit;
    } else {
        $conn->query("SET FOREIGN_KEY_CHECKS=1");
        header("Location: welcometoDASHBOARD.php?order_error=1");
        exit;
    }
} else {
    header("Location: home.php");
    exit;
}
?>