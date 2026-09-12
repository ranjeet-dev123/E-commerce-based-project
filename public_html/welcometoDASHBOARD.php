<?php
session_start();
if(!isset($_SESSION['email'])) {
    header("Location: Users_login.php");
    exit;
}

include 'Config.php';

// User info
$full_name = isset($_SESSION['full_name']) ? $_SESSION['full_name'] : '';
$email     = $_SESSION['email'];

// ✅ Pehle check karein users table mein columns hain ya nahi
$check_columns = $conn->query("SHOW COLUMNS FROM users LIKE 'address'");
$address_column_exists = ($check_columns->num_rows > 0);

// ✅ Agar columns nahi hain toh create karein
if(!$address_column_exists) {
    $conn->query("ALTER TABLE users ADD COLUMN address TEXT");
    $conn->query("ALTER TABLE users ADD COLUMN city VARCHAR(100)");
    $conn->query("ALTER TABLE users ADD COLUMN pincode VARCHAR(20)");
    $conn->query("ALTER TABLE users ADD COLUMN mobile VARCHAR(15)");
}


// ✅ ADD THIS FUNCTION AT THE TOP
function getProductImagePath($category, $product_image) {
    if (empty($product_image)) {
        return 'https://via.placeholder.com/80x80?text=No+Image';
    }
    
    // ✅ Folder mapping - Adjust according to your actual folder names
    $category_folders = [
        'fashion_flooring' => 'Fashion Flooring',
        'hand_tufted' => 'Handtufted',  // Your folder name
         'fine_indian_durrys' => 'Fine indian durrys', 
         'fine_indian_jute' => 'Fine indian jute',
         'fine_indian_knotted' => 'Fine indian knotted',
         'customize_own' => 'customize your own', 
        'handmade_painting' => 'Hand made painting', 
        'cushion_covers' => 'cushion covers',
        'brass_vessels' => 'brass vessels',
        'home_fashion' => 'Home fashion flooring',
       'hand_tufted_saggy' => 'Hand tufted& saggy',
        'big_hotel' => 'for big hotel',
       'pooja_durry' => 'pooja durrys',
       'knotted_carpets' => 'knotted carpets',
        'doormats' => 'doormats',
        'organic_yarns' => 'organic color dying wollen',
        'organic_carpets' => 'organic color dyning handmade',
         'kitchen_natural_wood' => 'Kitchen ware',
        'bamboo_bottels' => 'bamboo bottles'
    ];
    
    $folder = $category_folders[$category] ?? 'Fashion Flooring';
    $imgPath = 'uploads/' . $folder . '/' . $product_image;
    
    // Check if file exists
    if (file_exists($imgPath)) {
        return $imgPath;
    } else {
        // Try without category folder (direct in uploads)
        $directPath = 'uploads/' . $product_image;
        if (file_exists($directPath)) {
            return $directPath;
        }
        return 'https://via.placeholder.com/80x80?text=No+Image';
    }
}



// ✅ Fetch user data
$user_query = $conn->query("SELECT * FROM users WHERE email = '$email'");
$user_data = $user_query->fetch_assoc();

// ✅ Profile Update Functionality
if(isset($_POST['update_profile'])) {
    $new_name = $_POST['full_name'];
    $mobile = $_POST['mobile'] ?? '';
    $address = $_POST['address'] ?? '';
    $city = $_POST['city'] ?? '';
    $pincode = $_POST['pincode'] ?? '';
    
    // Session update
    $_SESSION['full_name'] = $new_name;
    
    // ✅ Safe database update
    $update_sql = "UPDATE users SET full_name = '$new_name'";
    
    if($address_column_exists) {
        $update_sql .= ", mobile = '$mobile', address = '$address', city = '$city', pincode = '$pincode'";
    }
    
    $update_sql .= " WHERE email = '$email'";
    
    if($conn->query($update_sql)) {
        $update_success = "Profile updated successfully!";
        $user_query = $conn->query("SELECT * FROM users WHERE email = '$email'");
        $user_data = $user_query->fetch_assoc();
    } else {
        $update_error = "Error updating profile: " . $conn->error;
    }
}

// ✅ Order Address Update Functionality
if(isset($_POST['update_order_address'])) {
    $order_id = $_POST['order_id'];
    $order_mobile = $_POST['order_mobile'];
    $order_address = $_POST['order_address'];
    $order_city = $_POST['order_city'];
    $order_pincode = $_POST['order_pincode'];
    
    $update_order_sql = "UPDATE orders SET mobile = '$order_mobile', address = '$order_address', 
                         city = '$order_city', pincode = '$order_pincode' 
                         WHERE id = '$order_id' AND user_email = '$email'";
    
    if($conn->query($update_order_sql)) {
        $order_update_success = "Order address updated successfully!";
    } else {
        $order_update_error = "Error updating order address: " . $conn->error;
    }
}

// ✅ Fetch user orders
$user_email = $_SESSION['email'];
$order_res = $conn->query("SELECT * FROM orders WHERE user_email='$user_email' ORDER BY order_date DESC");
$orders = [];
if($order_res){
    while($row = $order_res->fetch_assoc()){
        $orders[] = $row;
    }
}

// ✅ Delete order functionality
if(isset($_GET['delete_order'])) {
    $order_id = $_GET['delete_order'];
    $delete_sql = "DELETE FROM orders WHERE id='$order_id' AND user_email='$user_email'";
    if($conn->query($delete_sql)) {
        header("Location: welcometoDASHBOARD.php?delete_success=1");
        exit;
    } else {
        header("Location: welcometoDASHBOARD.php?delete_error=1");
        exit;
    }
}

// ✅ Calculate total money spent
$total_money = 0;
foreach($orders as $order) {
    $total_money += ($order['total_amount'] * $order['qty']);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Dashboard - Mirzapur Qaleen</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    body { 
        font-family: 'Segoe UI', Arial, sans-serif; 
        background: #f5e4ce;
        margin: 0; 
        min-height: 100vh;
    }
    
   .navbar {
    background: #e4ab60;
    padding: 15px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}

.logo {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #fff;
    font-size: 20px;
    font-weight: 700;
}

.logo img {
    height: 45px;
}

.nav-links {
    display: flex;
    gap: 25px;
}

.nav-links a {
    text-decoration: none;
    color: #fff;
    font-weight: 600;
    padding: 8px 16px;
    border-radius: 25px;
    transition: 0.3s ease;
}

.nav-links a:hover,
.nav-links a.active {
    background: rgba(255,255,255,0.2);
}

.logout-btn {
    background: #ff4d4d;
}

.logout-btn:hover {
    background: #e60000;
}

/* Responsive */
@media (max-width: 768px) {
    .navbar {
        flex-direction: column;
        gap: 15px;
        padding: 20px;
    }

    .nav-links {
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
    }
}

    
    .content { 
        padding: 40px; 
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .welcome-section {
        background: rgba(255, 255, 255, 0.95);
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin-bottom: 30px;
        text-align: center;
        backdrop-filter: blur(10px);
    }
    
    .welcome-section h1 {
        color: #333;
        margin-bottom: 10px;
        font-size: 2.5em;
    }
    
    .welcome-section p {
        color: #666;
        font-size: 1.2em;
    }
    
    .card-container { 
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 25px; 
        margin-bottom: 30px;
    }
    
    .card { 
        background: rgba(255, 255, 255, 0.95);
        padding: 25px; 
        border-radius: 20px; 
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }
    
    .card h3 {
        color: #333;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 15px;
        margin-bottom: 20px;
        font-size: 1.5em;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .card ul { 
        list-style: none; 
        padding-left: 0; 
    }
    
    .order-item { 
        display: flex; 
        align-items: flex-start; 
        gap: 15px; 
        margin-bottom: 20px; 
        padding: 20px; 
        border: 1px solid #e0e0e0; 
        border-radius: 15px; 
        background: #f8f9fa;
        transition: all 0.3s ease;
    }
    
    .order-item:hover {
        background: #ffffff;
        border-color: #007bff;
        box-shadow: 0 5px 15px rgba(0,123,255,0.1);
    }
    
    .order-info { 
        flex-grow: 1; 
    }
    
    .order-image {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .order-status { 
        padding: 8px 15px; 
        border-radius: 20px; 
        font-size: 12px; 
        font-weight: bold;
        margin-bottom: 10px;
        display: inline-block;
    }
    
    .status-pending { background: #fff3cd; color: #856404; }
    .status-ordered { background: #d4edda; color: #155724; }
    .status-cancelled { background: #f8d7da; color: #721c24; }
    .status-delivered { background: #d1ecf1; color: #0c5460; }
    
    .order-actions { 
        display: flex; 
        gap: 8px; 
        flex-direction: column; 
        min-width: 140px;
    }
    
    .btn { 
        padding: 10px 15px; 
        border: none; 
        border-radius: 8px; 
        cursor: pointer; 
        font-size: 12px; 
        margin-bottom: 5px; 
        text-decoration: none;
        text-align: center;
        transition: all 0.3s ease;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }
    
    .btn-danger { 
        background: linear-gradient(45deg, #ff6b6b, #ee5a52);
        color: white; 
    }
    
    .btn-success { 
        background: linear-gradient(45deg, #1dd1a1, #10ac84);
        color: white; 
    }
    
    .btn-info { 
        background: linear-gradient(45deg, #54a0ff, #2e86de);
        color: white; 
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    .total-money { 
        background:#ffffff;
        color: black; 
        padding: 25px; 
        border-radius: 20px; 
        text-align: center; 
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    
    .total-money h3 {
        font-size: 1.8em;
        margin-bottom: 10px;
    }
    
    .total-money p {
        font-size: 1.2em;
        opacity: 0.9;
    }
    
    .profile-form { 
        background: #f8f9fa; 
        padding: 20px; 
        border-radius: 15px; 
        margin-bottom: 20px; 
    }
    
    .form-group { 
        margin-bottom: 15px; 
    }
    
    .form-group label { 
        display: block; 
        margin-bottom: 8px; 
        font-weight: bold; 
        color: #333;
    }
    
    .form-group input, .form-group textarea { 
        width: 100%; 
        padding: 12px; 
        border: 2px solid #e0e0e0; 
        border-radius: 8px; 
        font-size: 14px;
        transition: border-color 0.3s ease;
    }
    
    .form-group input:focus, .form-group textarea:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
    }
    
    .saved-address { 
        background: linear-gradient(135deg, #e3f2fd, #f3e5f5);
        padding: 20px; 
        border-radius: 15px; 
        margin-bottom: 20px; 
        border-left: 5px solid #007bff;
    }
    
    .order-address-form { 
        background: #fff3cd; 
        padding: 15px; 
        border-radius: 10px; 
        margin-top: 15px; 
        display: none;
        border: 1px solid #ffeaa7;
    }
    
    .category-badge {
        background: #6c757d;
        color: white;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        margin-left: 10px;
    }
    
    .message {
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-weight: bold;
    }
    
    .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    
    @media (max-width: 768px) {
        .content { padding: 20px; }
        .card-container { grid-template-columns: 1fr; }
        .order-item { flex-direction: column; }
        .order-actions { flex-direction: row; flex-wrap: wrap; }
        .navbar { flex-direction: column; gap: 15px; text-align: center; }
    }

    .nav-buttons {
            display: flex;
            gap: 15px;
        }
        
        .nav-btn {
            padding: 10px 20px;
            border-radius: 25px;
            background: rgba(255,255,255,0.2);
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .nav-btn:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }
        
        
        
     
</style>
</head>
<body>
    
    <nav class="navbar">
    <div class="logo">
        <img src="images/clean_hd_logo-removebg-preview.png" alt="Logo">
   
    </div>

    <div class="nav-links">
        <a href="welcometoDASHBOARD.php" class="active">  <i class="fas fa-home"></i>Dashboard</a>
        <a href="profile.php"><i class="fas fa-user"></i>Profile</a>
        <a href="fashion_flooring.php"> <i class="fas fa-shopping-cart"></i>Shop</a>
        <a href="logout.php" class="logout-btn">  <i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
</nav>



<div class="content">
  <?php
$orderSuccess  = isset($_GET['order_success']) && $_GET['order_success'] == 1;
$deleteSuccess = isset($_GET['delete_success']) && $_GET['delete_success'] == 1;
$updateSuccess = isset($order_update_success);
?>

<script>
<?php if($updateSuccess): ?>
    alert("<?= $order_update_success ?>");
    window.history.replaceState({}, "", window.location.pathname);

<?php elseif($orderSuccess): ?>
    alert("Your order has been placed successfully!");
    window.history.replaceState({}, "", window.location.pathname);

<?php elseif($deleteSuccess): ?>
    alert("Order deleted successfully!");
    window.history.replaceState({}, "", window.location.pathname);

<?php endif; ?>
</script>




    <!-- Total Money Spent -->
    <div class="total-money">
        <h3>Total Money Spent: ₹<?php echo number_format($total_money, 2); ?></h3>
        <p>Total Orders: <?php echo count($orders); ?></p>
    </div>

    <div class="card-container">
        <!-- My Orders -->
        <div class="card" id="orders">
            <h3><i class="fas fa-shopping-bag"></i> My Orders (<?php echo count($orders); ?>)</h3>
            <?php if(count($orders) == 0): ?>
                <div style="text-align: center; padding: 40px; color: #666;">
                    <i class="fas fa-box-open" style="font-size: 48px; margin-bottom: 15px; color: #ddd;"></i>
                    <h3>No Orders Yet</h3>
                    <p>Start shopping to see your orders here!</p>
                    <a href="fashion_flooring.php" class="btn btn-info" style="display: inline-flex; margin-top: 15px;">
                        <i class="fas fa-shopping-cart"></i> Start Shopping
                    </a>
                </div>
            <?php else: ?>
                <ul>
                    <?php foreach($orders as $o): ?>
                    <li class="order-item">
                        <!-- Product Image -->
                        <!-- Product Image -->
<div>
    <?php
    $product_image = $o['product_image'] ?? '';
    $category = $o['category'] ?? 'fashion_flooring';
    $imgPath = getProductImagePath($category, $product_image);
    
    if (strpos($imgPath, 'placeholder.com') === false) {
        echo '<img src="' . $imgPath . '" class="order-image" alt="' . htmlspecialchars($o['name'] ?? 'Product') . '">';
    } else {
        echo '<div style="width: 80px; height: 80px; background: #e9ecef; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 12px; text-align: center; flex-direction: column;">';
        echo '<i class="fas fa-image"></i>';
        echo '<small style="font-size: 8px; margin-top: 5px;">No Image</small>';
        echo '</div>';
    }
    ?>
</div>
                        
                        <div class="order-info">
                            <strong style="font-size: 16px;">
                                <?php echo htmlspecialchars($o['name'] ?? 'Product'); ?>
                                <span class="category-badge"><?php echo ucfirst(str_replace('_', ' ', $o['category'] ?? 'general')); ?></span>
                            </strong>
                            <br>
                            
                            <div class="order-status status-<?php echo strtolower($o['status'] ?? 'pending'); ?>">
                                <i class="fas fa-info-circle"></i> <?php echo htmlspecialchars($o['status'] ?? 'Pending'); ?>
                            </div>
                            
                            <div style="margin: 10px 0;">
                                <strong style="color: #e74c3c; font-size: 18px;">₹<?php echo htmlspecialchars($o['total_amount'] ?? '0'); ?></strong> 
                                • Qty: <?php echo $o['qty'] ?? 1; ?>
                            </div>
                            
                            <?php if(isset($o['mobile']) || isset($o['address'])): ?>
                            <div style="background: #f8f9fa; padding: 10px; border-radius: 8px; margin: 10px 0;">
                                <?php if(isset($o['mobile'])): ?>
                                <div><i class="fas fa-phone"></i> <?php echo htmlspecialchars($o['mobile']); ?></div>
                                <?php endif; ?>
                                <?php if(isset($o['address'])): ?>
                                <div><i class="fas fa-map-marker-alt"></i> 
                                    <?php echo htmlspecialchars($o['address'] ?? ''); ?>, 
                                    <?php echo htmlspecialchars($o['city'] ?? ''); ?> - 
                                    <?php echo htmlspecialchars($o['pincode'] ?? ''); ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                            
                            <small style="color: #666;">
                                <i class="far fa-clock"></i> Ordered on: <?php echo date('d M Y, h:i A', strtotime($o['order_date'] ?? $o['created_at'])); ?>
                            </small>
                            
                            <!-- Order Address Update Form -->
                            <div class="order-address-form" id="addressForm<?php echo $o['id']; ?>">
                                <form method="POST">
                                    <input type="hidden" name="order_id" value="<?php echo $o['id']; ?>">
                                    <div class="form-group">
                                        <label><i class="fas fa-mobile-alt"></i> Mobile Number</label>
                                        <input type="tel" name="order_mobile" value="<?php echo htmlspecialchars($o['mobile'] ?? ''); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label><i class="fas fa-map-marked-alt"></i> Address</label>
                                        <textarea name="order_address" rows="2" required><?php echo htmlspecialchars($o['address'] ?? ''); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label><i class="fas fa-city"></i> City</label>
                                        <input type="text" name="order_city" value="<?php echo htmlspecialchars($o['city'] ?? ''); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label><i class="fas fa-mail-bulk"></i> Pincode</label>
                                        <input type="text" name="order_pincode" value="<?php echo htmlspecialchars($o['pincode'] ?? ''); ?>" required>
                                    </div>
                                    <div style="display: flex; gap: 10px;">
                                        <button type="submit" name="update_order_address" class="btn btn-success">
                                            <i class="fas fa-save"></i> Update Address
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="hideAddressForm(<?php echo $o['id']; ?>)">
                                            <i class="fas fa-times"></i> Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="order-actions">
                            <button class="btn btn-info" onclick="showAddressForm(<?php echo $o['id']; ?>)">
                                <i class="fas fa-edit"></i> Change Address
                            </button>
                            <a href="welcometoDASHBOARD.php?delete_order=<?php echo $o['id']; ?>" 
                               class="btn btn-danger" 
                               onclick="return confirm('Are you sure you want to cancel this order?')">
                               <i class="fas fa-trash"></i> Cancel Order
                            </a>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <!-- Support & Quick Actions -->
       
</div>

<script>
function showAddressForm(orderId) {
    document.getElementById('addressForm' + orderId).style.display = 'block';
}

function hideAddressForm(orderId) {
    document.getElementById('addressForm' + orderId).style.display = 'none';
}

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
</script>

</body>
</html>