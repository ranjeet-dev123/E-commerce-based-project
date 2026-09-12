<?php
session_start();
if(!isset($_SESSION['email']) || $_SESSION['loggedin'] !== true) {
    header("location: Admin_login.php");
    exit;
}

include 'Config.php';

// ✅ ADD THIS SAME FUNCTION IN ADMIN.PHP TOO
function getProductImagePath($category, $product_image) {
    if (empty($product_image)) {
        return 'https://via.placeholder.com/80x80?text=No+Image';
    }
    
    // ✅ Same folder mapping as in welcometoDASHBOARD.php
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

// ✅ Fetch all orders from database
$order_res = $conn->query("SELECT * FROM orders ORDER BY order_date DESC");
$orders = [];
if($order_res){
    while($row = $order_res->fetch_assoc()){
        $orders[] = $row;
    }
}

// ✅ Delete order functionality
if(isset($_GET['delete_order'])) {
    $order_id = $_GET['delete_order'];
    $delete_sql = "DELETE FROM orders WHERE id='$order_id'";
    if($conn->query($delete_sql)) {
        header("Location: admin.php?delete_success=1");
        exit;
    } else {
        header("Location: admin.php?delete_error=1");
        exit;
    }
}

// ✅ Update order status
if(isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];
    
    $update_sql = "UPDATE orders SET status = '$new_status' WHERE id = '$order_id'";
    if($conn->query($update_sql)) {
        header("Location: admin.php?update_success=1");
        exit;
    } else {
        header("Location: admin.php?update_error=1");
        exit;
    }
}

// ✅ Calculate statistics
$total_orders = count($orders);
$pending_orders = 0;
$completed_orders = 0;
$total_revenue = 0;

foreach($orders as $order) {
    $total_revenue += ($order['total_amount'] * $order['qty']);
    if($order['status'] == 'pending') $pending_orders++;
    if($order['status'] == 'delivered') $completed_orders++;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard - All Orders</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
/* ---------- NAVBAR STYLES ---------- */
body{margin:0;font-family:Arial,sans-serif;background:#f7f7f7}
.navbar{display:flex;justify-content:space-between;align-items:center;padding:12px 20px;background:#1a1a1a;color:#fff;position:sticky;top:0;z-index:1000}
.navbar .logo{font-size:20px;font-weight:bold;color:#fff}
.navbar .nav-links{list-style:none;display:flex;margin:0;padding:0;align-items:center}
.navbar .nav-links li{position:relative;margin-left:20px}
.navbar .nav-links li a{color:#fff;text-decoration:none;padding:8px 12px;display:block}
.navbar .nav-links li a:hover{background:#333;border-radius:5px}
.navbar .nav-links li .dropdown-menu{display:none;position:absolute;top:100%;left:0;background:#222;min-width:220px;border-radius:5px;overflow:hidden;box-shadow:0 4px 10px rgba(0,0,0,0.2)}
.navbar .nav-links li .dropdown-menu li{margin:0}
.navbar .nav-links li .dropdown-menu li a{padding:10px 15px}
.navbar .nav-links li:hover .dropdown-menu{display:block}
.navbar .right-section{display:flex;align-items:center}
.navbar .right-section span{margin-right:20px;font-size:14px}
.navbar .logout-btn{background:#ff4d4d;color:#fff;padding:6px 12px;border:none;border-radius:5px;cursor:pointer}
.navbar .logout-btn:hover{background:#e60000}

/* ---------- CONTENT STYLES ---------- */
.content {padding: 20px; max-width: 1400px; margin: 0 auto;}

/* Statistics Cards */
.stats-container {display: flex; gap: 20px; margin-bottom: 30px; flex-wrap: wrap;}
.stat-card {background: white; padding: 25px; border-radius: 10px; flex: 1; min-width: 200px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-left: 4px solid #007bff;}
.stat-card h3 {margin: 0 0 10px 0; font-size: 14px; color: #666;}
.stat-card .number {font-size: 32px; font-weight: bold; color: #333;}
.stat-card.revenue {border-left-color: #28a745;}
.stat-card.pending {border-left-color: #ffc107;}
.stat-card.completed {border-left-color: #17a2b8;}

/* Orders Section */
.orders-section {background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);}
.orders-section h2 {margin-top: 0; color: #333; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px;}

/* Order Item Styles */
.order-item {display: flex; align-items: flex-start; gap: 15px; margin-bottom: 20px; padding: 20px; border: 1px solid #eee; border-radius: 8px; background: #fafafa;}
.order-image {width: 80px; height: 80px; border-radius: 8px; object-fit: cover; border: 2px solid #ddd;}
.order-info {flex-grow: 1;}
.order-info h4 {margin: 0 0 8px 0; color: #333; font-size: 18px;}
.order-details {display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px; margin: 10px 0;}
.detail-item {font-size: 14px;}
.detail-item strong {color: #555;}
.order-actions {display: flex; gap: 8px; flex-direction: column; min-width: 150px;}

/* Category Badge */
.category-badge {background: #6c757d; color: white; padding: 4px 8px; border-radius: 12px; font-size: 11px; margin-left: 8px;}

/* Status Styles */
.order-status {padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; display: inline-block; margin-bottom: 10px;}
.status-pending {background: #fff3cd; color: #856404;}
.status-ordered {background: #d4edda; color: #155724;}
.status-shipped {background: #cce7ff; color: #004085;}
.status-delivered {background: #d1ecf1; color: #0c5460;}
.status-cancelled {background: #f8d7da; color: #721c24;}

/* Button Styles */
.btn {padding: 8px 12px; border: none; border-radius: 5px; cursor: pointer; font-size: 12px; text-decoration: none; text-align: center; display: inline-block;}
.btn-danger {background: #dc3545; color: white;}
.btn-success {background: #28a745; color: white;}
.btn-info {background: #17a2b8; color: white;}
.btn-warning {background: #ffc107; color: #212529;}

/* Status Form */
.status-form {display: flex; gap: 8px; align-items: center; margin-top: 10px;}
.status-form select {padding: 6px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px;}
.status-form button {padding: 6px 12px;}

/* Messages */
.message {padding: 15px; border-radius: 5px; margin-bottom: 20px;}
.success {background: #d4edda; color: #155724; border: 1px solid #c3e6cb;}
.error {background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;}

/* No Orders */
.no-orders {text-align: center; padding: 40px; color: #666;}
.no-orders i {font-size: 48px; margin-bottom: 15px; color: #ddd;}

/* Responsive */
@media (max-width: 768px) {
    .order-item {flex-direction: column;}
    .order-actions {flex-direction: row; flex-wrap: wrap;}
    .stats-container {flex-direction: column;}
    .order-details {grid-template-columns: 1fr;}
}
</style>
</head>
<body>

<nav class="navbar">
  <div class="logo">Admin Dashboard</div>
  
  <ul class="nav-links">
      <li><a href="#"><i class="fa-solid fa-house"></i> Home</a></li>
      
      <li class="dropdown">
        <a href="#"><i class="fa-solid fa-crown"></i> Luxury Fashion & Customized Oversease Taste</a>
        <ul class="dropdown-menu">
          <li><a href="FashionFlooring.php">Fashion Flooring</a></li>
          <li><a href="handtufted.php">Hand Tufted Carpets</a></li>
          <li><a href="fineindiandurrys.php">Fine Indian Durrys & Kilims</a></li>
          <li><a href="fineindianjute.php">Fine Indian Jute & Threads</a></li>
          <li><a href="fineindianknotted.php">Fine Indian Knotted Carpets</a></li>
          <li><a href="customizeyourown.php">Customize Your Own</a></li>
          <li><a href="handmadepainting.php">Handmade Painting</a></li>
          <li><a href="cushioncovers.php">Cushion Covers & Pouffes</a></li>
          <li><a href="Brassvessels.php">Brass Vessels & Utensils</a></li>
        </ul>
      </li>
      
      <li class="dropdown">
        <a href="#"><i class="fa-solid fa-house-chimney"></i> Luxury Home Fashion Flooring</a>
        <ul class="dropdown-menu">
          <li><a href="homefashion.php">Home Fashion Flooring</a></li>
          <li><a href="handtuftedsaggy.php">Hand Tufted & Saggy Durries</a></li>
          <li><a href="forbighotel.php">For Big Hotels & Banquets</a></li>
          <li><a href="poojadurryaasan.php">Pooja Durry Assan & Yoga Durry</a></li>
          <li><a href="knottedcarpets.php">Knotted Carpets & Doormats</a></li>
          <li><a href="door.php">Doormats</a></li>
        </ul>
      </li>
      
      <li class="dropdown">
        <a href="#"><i class="fa-solid fa-leaf"></i> Organic Treasury</a>
        <ul class="dropdown-menu">
          <li><a href="organicyarns.php">Organic Woollen Yarns</a></li>
          <li><a href="organiccarpets.php">Organic Handmade Carpets</a></li>
          <li><a href="kitchennatural_wood.php">Kitchen Ware Natural Wood</a></li>
          <li><a href="bamboobottels.php">Bamboo Bottles & Products</a></li>
        </ul>
      </li>
  </ul>
  
  <div class="right-section">
    <span>Welcome, <strong>Vijay Gupta </strong>!</span>
    <span id="current-time"></span>
    <form action="logout.php" method="post" style="margin:0;">
        <button type="submit" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
    </form>
  </div>
</nav>
<div class="content">
  
    
    <?php if(isset($_GET['delete_error']) && $_GET['delete_error'] == 1): ?>
    <div class="message error">
        ❌<strong>Error!</strong> Failed to delete order.
    </div>
    <?php endif; ?>

    <!-- Statistics Cards -->
    <div class="stats-container">
        <div class="stat-card">
            <h3>TOTAL ORDERS</h3>
            <div class="number"><?php echo $total_orders; ?></div>
        </div>
        <div class="stat-card pending">
            <h3>PENDING ORDERS</h3>
            <div class="number"><?php echo $pending_orders; ?></div>
        </div>
        <div class="stat-card completed">
            <h3>COMPLETED ORDERS</h3>
            <div class="number"><?php echo $completed_orders; ?></div>
        </div>
        <div class="stat-card revenue">
            <h3>TOTAL REVENUE</h3>
            <div class="number">₹<?php echo number_format($total_revenue, 2); ?></div>
        </div>
    </div>

    <!-- Orders Section -->
    <div class="orders-section">
        <h2><i class="fas fa-shopping-cart"></i> All Customer Orders (<?php echo $total_orders; ?>)</h2>
        
        <?php if(count($orders) == 0): ?>
            <div class="no-orders">
                <i class="fas fa-box-open"></i>
                <h3>No Orders Yet</h3>
                <p>No customers have placed any orders yet.</p>
            </div>
        <?php else: ?>
            <?php foreach($orders as $order): ?>
            <div class="order-item">
                <!-- ✅ CORRECTED Product Image Code -->
                <div>
                    <?php
                    $product_image = $order['product_image'] ?? ''; // ✅ Changed $o to $order
                    $category = $order['category'] ?? 'fashion_flooring'; // ✅ Changed $o to $order
                    $imgPath = getProductImagePath($category, $product_image);
                    
                    if (strpos($imgPath, 'placeholder.com') === false) {
                        echo '<img src="' . $imgPath . '" class="order-image" alt="' . htmlspecialchars($order['name'] ?? 'Product') . '">';
                    } else {
                        echo '<div style="width: 80px; height: 80px; background: #e9ecef; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 12px; text-align: center; flex-direction: column;">';
                        echo '<i class="fas fa-image"></i>';
                        echo '<small style="font-size: 8px; margin-top: 5px;">No Image</small>';
                        echo '</div>';
                    }
                    ?>
                </div>
                
                <!-- Order Information -->
                <div class="order-info">
                    <h4>
                        <?php echo htmlspecialchars($order['name'] ?? 'Product Name Not Available'); ?>
                        <span class="category-badge"><?php echo ucfirst(str_replace('_', ' ', $order['category'] ?? 'general')); ?></span>
                    </h4>
                    
                    <div class="order-status status-<?php echo strtolower($order['status'] ?? 'pending'); ?>">
                        <?php echo htmlspecialchars($order['status'] ?? 'Pending'); ?>
                    </div>
                    
                    <div class="order-details">
                        <div class="detail-item">
                            <strong>Order ID:</strong> #<?php echo $order['id']; ?>
                        </div>
                      <div class="detail-item">
                       <strong>Email:</strong> 
                             <?php echo htmlspecialchars($order['user_email']); ?>
                                             </div>

                        <div class="detail-item">
                            <strong>Price:</strong> ₹<?php echo htmlspecialchars($order['total_amount'] ?? '0'); ?>
                        </div>
                        <div class="detail-item">
                            <strong>Quantity:</strong> <?php echo $order['qty'] ?? 1; ?>
                        </div>
                        <div class="detail-item">
                            <strong>Order Date:</strong> <?php echo date('d M Y, h:i A', strtotime($order['order_date'] ?? $order['created_at'])); ?>
                        </div>
                        <?php if(isset($order['mobile'])): ?>
                        <div class="detail-item">
                            <strong>Phone:</strong> <?php echo htmlspecialchars($order['mobile']); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Address Information -->
                    <?php if(isset($order['address'])): ?>
                    <div class="detail-item">
                        <strong>Delivery Address:</strong><br>
                        <?php echo htmlspecialchars($order['address'] ?? ''); ?>, 
                        <?php echo htmlspecialchars($order['city'] ?? ''); ?> - 
                        <?php echo htmlspecialchars($order['pincode'] ?? ''); ?>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Status Update Form -->
                    <form method="POST" class="status-form">
                        <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                        <select name="status" required>
                            <option value="pending" <?php echo ($order['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                            <option value="ordered" <?php echo ($order['status'] == 'ordered') ? 'selected' : ''; ?>>Ordered</option>
                            <option value="shipped" <?php echo ($order['status'] == 'shipped') ? 'selected' : ''; ?>>Shipped</option>
                            <option value="delivered" <?php echo ($order['status'] == 'delivered') ? 'selected' : ''; ?>>Delivered</option>
                            <option value="cancelled" <?php echo ($order['status'] == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                        </select>
                        <button type="submit" name="update_status" class="btn btn-success">Update</button>
                    </form>
                </div>
                
                <!-- Order Actions -->
                <div class="order-actions">
                    <a href="admin.php?delete_order=<?php echo $order['id']; ?>" 
                       class="btn btn-danger" 
                       onclick="return confirm('Are you sure you want to delete this order?')">
                       <i class="fas fa-trash"></i> Delete
                    </a>
                    <button class="btn btn-info" onclick="viewOrderDetails(<?php echo $order['id']; ?>)">
                        <i class="fas fa-eye"></i> View Details
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
function updateTime(){
    const now = new Date();
    const options = {weekday:'long', year:'numeric', month:'long', day:'numeric', hour:'2-digit', minute:'2-digit', second:'2-digit'};
    document.getElementById('current-time').innerText = now.toLocaleString('en-US', options);
}
setInterval(updateTime,1000);
updateTime();

function viewOrderDetails(orderId) {
    alert('Order Details for Order ID: ' . orderId + '\nFull details view functionality can be added here.');
}
</script>

</body>
</html>