<?php
session_start();
if(!isset($_SESSION['email'])) {
    header("Location: Users_login.php");
    exit;
}

include 'Config.php';

// User info
$email = $_SESSION['email'];
$full_name = isset($_SESSION['full_name']) ? $_SESSION['full_name'] : '';

// Fetch complete user data
$user_query = $conn->query("SELECT * FROM users WHERE email = '$email'");
$user_data = $user_query->fetch_assoc();

// Fetch user orders
$order_res = $conn->query("SELECT * FROM orders WHERE user_email='$email' ORDER BY order_date DESC");
$orders = [];
$total_orders = 0;
$total_spent = 0;

if($order_res){
    while($row = $order_res->fetch_assoc()){
        $orders[] = $row;
        $total_orders++;
        $total_spent += ($row['total_amount'] * $row['qty']);
    }
}

// Profile update functionality
if(isset($_POST['update_profile'])) {
    $new_name = $_POST['full_name'];
    $mobile = $_POST['mobile'] ?? '';
    $address = $_POST['address'] ?? '';
    $city = $_POST['city'] ?? '';
    $pincode = $_POST['pincode'] ?? '';
    
    // Update session
    $_SESSION['full_name'] = $new_name;
    
    // Update database
    $update_sql = "UPDATE users SET 
                  full_name = '$new_name',
                  mobile = '$mobile',
                  address = '$address',
                  city = '$city',
                  pincode = '$pincode'
                  WHERE email = '$email'";
    
    if($conn->query($update_sql)) {
        $update_success = "Profile updated successfully!";
        // Refresh user data
        $user_query = $conn->query("SELECT * FROM users WHERE email = '$email'");
        $user_data = $user_query->fetch_assoc();
    } else {
        $update_error = "Error updating profile: " . $conn->error;
    }
}

// Function to get product image path
function getProductImagePath($category, $product_image) {
    if (empty($product_image)) {
        return 'https://via.placeholder.com/80x80?text=No+Image';
    }
    
    $category_folders = [
        'fashion_flooring' => 'Fashion Flooring',
        'hand_tufted' => 'Handtufted',
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
    
    if (file_exists($imgPath)) {
        return $imgPath;
    } else {
        $directPath = 'uploads/' . $product_image;
        if (file_exists($directPath)) {
            return $directPath;
        }
        return 'https://via.placeholder.com/80x80?text=No+Image';
    }
}



if(isset($_POST['change_password'])){

    $user_id = $_SESSION['id'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Get current password
    $stmt = $conn->prepare("SELECT password FROM register WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if($row){

        if(password_verify($old_password, $row['password'])){

            $new_hashed = password_hash($new_password, PASSWORD_DEFAULT);

            $update_stmt = $conn->prepare("UPDATE register SET password = ? WHERE id = ?");
            $update_stmt->bind_param("si", $new_hashed, $user_id);

            if($update_stmt->execute()){
                echo "<script>alert('Password Changed Successfully');</script>";
            } else {
                echo "<script>alert('Error Updating Password');</script>";
            }

        } else {
            echo "<script>alert('Old Password Incorrect');</script>";
        }

    } else {
        echo "<script>alert('User Not Found');</script>";
    }

    if($_POST['new_password'] !== $_POST['confirm_password']){
    echo "<script>alert('New Password and Confirm Password do not match');</script>";
    exit;
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Mirzapur Qaleen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #8B4513;
            --primary-dark: #654321;
            --secondary: #D2691E;
            --accent: #CD853F;
            --light: #FAEBD7;
            --dark: #2C1810;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --info: #17a2b8;
            --gray: #6c757d;
            --light-gray: #f8f9fa;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', 'Inter', Arial, sans-serif;
            background:#f5e4ce;
            min-height: 100vh;
            color: #333;
            line-height: 1.6;
        }
        
        .navbar {
             background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
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
        
        .profile-header {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            margin-bottom: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 48px;
            color: white;
            border: 5px solid white;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .profile-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            border-left: 4px solid var(--primary);
        }
        
        .stat-number {
            font-size: 2.5em;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
        }
        
        .stat-label {
            color: var(--gray);
            font-weight: 600;
        }
        
        .card-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }
        
        @media (max-width: 768px) {
            .card-container {
                grid-template-columns: 1fr;
            }
        }
        
        .card {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.07);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .card h3 {
            color: var(--dark);
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
            margin-bottom: 20px;
            font-size: 1.4em;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
            font-size: 14px;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            font-family: inherit;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(139, 69, 19, 0.1);
        }
        
        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-primary {
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(139, 69, 19, 0.3);
        }
        
        .order-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #e8e8e8;
            border-radius: 12px;
            background: var(--light-gray);
            transition: all 0.3s ease;
        }
        
        .order-item:hover {
            background: #ffffff;
            border-color: var(--accent);
            box-shadow: 0 4px 12px rgba(205, 133, 63, 0.1);
        }
        
        .order-image {
            width: 70px;
            height: 70px;
            border-radius: 10px;
            object-fit: cover;
            border: 3px solid #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .order-info {
            flex-grow: 1;
        }
        
        .order-status {
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 8px;
        }
        
        .status-pending { background: #fff3cd; color: #856404; }
        .status-delivered { background: #d4edda; color: #155724; }
        .status-cancelled { background: #f8d7da; color: #721c24; }
        
        .message {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        
        .empty-state {
            text-align: center;
            padding: 40px;
            color: var(--gray);
        }
        
        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #ddd;
        }

        .password-wrapper {
    position: relative;
}

.password-form {
    background: #ffffff;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.06);
    border: 1px solid rgba(0,0,0,0.05);
    
    max-width: 420px;   /* 👈 width control */
    margin: 0 auto;     /* 👈 center align */
}

.password-form:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(0,0,0,0.08);
}

.password-group {
    margin-bottom: 22px;
}

.password-group label {
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 8px;
    display: block;
    color: var(--dark);
}

.password-wrapper {
    position: relative;
}

.password-wrapper input {
    width: 100%;
    padding: 14px 45px 14px 15px;
    border: 2px solid #e5e5e5;
    border-radius: 10px;
    font-size: 14px;
    transition: 0.3s ease;
    background: #fafafa;
}

.password-wrapper input:focus {
    border-color: var(--primary);
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(139, 69, 19, 0.08);
    outline: none;
}

.toggle-password {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #999;
    font-size: 14px;
    transition: 0.3s;
}

.toggle-password:hover {
    color: var(--primary);
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
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-avatar">
            <i class="fas fa-user"></i>
        </div>
        
        
        <div class="profile-stats">
            <div class="stat-card">
                <div class="stat-number"><?php echo $total_orders; ?></div>
                <div class="stat-label">Total Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">₹<?php echo number_format($total_spent, 2); ?></div>
                <div class="stat-label">Total Spent</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo date('M Y', strtotime($user_data['created_at'] ?? 'now')); ?></div>
                <div class="stat-label">Member Since</div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    <?php if(isset($update_success)): ?>
    <div class="message success">
        <i class="fas fa-check-circle"></i> <?php echo $update_success; ?>
    </div>
    <?php endif; ?>
    
    <?php if(isset($update_error)): ?>
    <div class="message error">
        <i class="fas fa-exclamation-circle"></i> <?php echo $update_error; ?>
    </div>
    <?php endif; ?>

    <div class="card-container">
        <!-- Personal Information -->
        <div class="card">
            <h3><i class="fas fa-user-edit"></i> Personal Information</h3>
            <form method="POST">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" class="form-control" 
                           value="<?php echo htmlspecialchars($user_data['full_name'] ?? ''); ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" class="form-control" 
                           value="<?php echo htmlspecialchars($user_data['email'] ?? ''); ?>" readonly>
                    <small style="color: var(--gray);">Email cannot be changed</small>
                </div>
                
                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="tel" name="mobile" class="form-control" 
                           value="<?php echo htmlspecialchars($user_data['mobile'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" class="form-control" rows="3"><?php echo htmlspecialchars($user_data['address'] ?? ''); ?></textarea>
                </div>
                
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" class="form-control" 
                           value="<?php echo htmlspecialchars($user_data['city'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label>Pincode</label>
                    <input type="text" name="pincode" class="form-control" 
                           value="<?php echo htmlspecialchars($user_data['pincode'] ?? ''); ?>">
                </div>
                
                <button type="submit" name="update_profile" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Profile
                </button>
            </form>
        </div>

   

        <!-- Recent Orders -->
        <div class="card">
            <h3><i class="fas fa-shopping-bag"></i> Recent Orders</h3>
            <?php if($total_orders == 0): ?>
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <h3>No Orders Yet</h3>
                    <p>You haven't placed any orders yet.</p>
                    <a href="fashion_flooring.php" class="btn btn-primary" style="margin-top: 15px;">
                        <i class="fas fa-shopping-cart"></i> Start Shopping
                    </a>
                </div>
            <?php else: ?>
                <?php 
                $recent_orders = array_slice($orders, 0, 5); // Show only 5 recent orders
                foreach($recent_orders as $order): 
                ?>
                <div class="order-item">
                    <div>
                        <?php
                        $product_image = $order['product_image'] ?? '';
                        $category = $order['category'] ?? 'fashion_flooring';
                        $imgPath = getProductImagePath($category, $product_image);
                        
                        if (strpos($imgPath, 'placeholder.com') === false) {
                            echo '<img src="' . $imgPath . '" class="order-image" alt="Product">';
                        } else {
                            echo '<div style="width: 70px; height: 70px; background: #e9ecef; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 12px; text-align: center; flex-direction: column;">';
                            echo '<i class="fas fa-image"></i>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                    
                    <div class="order-info">
                        <strong><?php echo htmlspecialchars($order['name'] ?? 'Product'); ?></strong>
                        <div class="order-status status-<?php echo strtolower($order['status'] ?? 'pending'); ?>">
                            <?php echo htmlspecialchars($order['status'] ?? 'Pending'); ?>
                        </div>
                        <div style="margin: 8px 0;">
                            <strong style="color: var(--primary);">₹<?php echo htmlspecialchars($order['total_amount'] ?? '0'); ?></strong> 
                            • Qty: <?php echo $order['qty'] ?? 1; ?>
                        </div>
                        <small style="color: var(--gray);">
                            <i class="far fa-clock"></i> <?php echo date('d M Y', strtotime($order['order_date'] ?? $order['created_at'])); ?>
                        </small>
                    </div>
                </div>
                <?php endforeach; ?>
                
                <?php if($total_orders > 5): ?>
                <div style="text-align: center; margin-top: 20px;">
                    <a href="welcometoDASHBOARD.php" class="btn btn-primary">
                        <i class="fas fa-list"></i> View All Orders (<?php echo $total_orders; ?>)
                    </a>
                </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="card">
    <h3><i class="fas fa-lock"></i> Change Password</h3>

    <form method="POST" class="password-form">

        <div class="form-group password-group">
            <label>Old Password</label>
            <div class="password-wrapper">
                <input type="password" name="old_password" class="form-control" required>
                <i class="fas fa-eye toggle-password"></i>
            </div>
        </div>

        <div class="form-group password-group">
            <label>New Password</label>
            <div class="password-wrapper">
                <input type="password" name="new_password" class="form-control" required>
                <i class="fas fa-eye toggle-password"></i>
            </div>
        </div>

        <div class="form-group password-group">
            <label>Confirm Password</label>
            <div class="password-wrapper">
                <input type="password" name="confirm_password" class="form-control" required>
                <i class="fas fa-eye toggle-password"></i>
            </div>
        </div>

        <button type="submit" name="change_password" class="btn btn-primary">
            <i class="fas fa-key"></i> Update Password
        </button>

    </form>
</div>

<script>
document.querySelectorAll('.toggle-password').forEach(icon => {
    icon.addEventListener('click', function () {
        const input = this.previousElementSibling;
        if (input.type === "password") {
            input.type = "text";
            this.classList.replace("fa-eye", "fa-eye-slash");
        } else {
            input.type = "password";
            this.classList.replace("fa-eye-slash", "fa-eye");
        }
    });
});
</script>


<script>
// Simple animation for profile elements
document.addEventListener('DOMContentLoaded', function() {
    const elements = document.querySelectorAll('.stat-card, .card');
    elements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        
        setTimeout(() => {
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 200);
    });
});
</script>

</body>
</html>