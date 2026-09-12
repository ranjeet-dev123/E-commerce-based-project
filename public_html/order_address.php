<?php
session_start();
include 'Config.php';

if(!isset($_SESSION['email'])) {
    header("Location: Users_login.php");
    exit;
}

// Product details from GET parameters
$product_id = $_GET['product_id'] ?? '';
$product_category = $_GET['category'] ?? 'fashion_flooring'; // ✅ NEW: Category

if(empty($product_id)) {
    header("Location: home.php");
    exit;
}

// ✅ Dynamic table selection based on category
$table_name = '';
$image_folder = '';

switch($product_category) {
    case 'fashion_flooring':
        $table_name = 'fashionflooring';
        $image_folder = 'Fashion Flooring';
        break;
    case 'hand_tufted':
        $table_name = 'handtufted';
        $image_folder = 'Handtufted';
        break;
    case 'fine_indian_durrys':  // ✅ ADD THIS
        $table_name = 'fineindiarugs';
        $image_folder = 'Fine indian durrys';
        
        break;
    case 'fine_indian_jute':  // ✅ ADD THIS
        $table_name = 'fineindianjute';
        $image_folder = 'Fine indian jute';
        break;
    case 'fine_indian_knotted':  // ✅ ADD THIS
        $table_name = 'fineindianknotted';
        $image_folder = 'Fine indian knotted';
        break;
     case 'customize_own':  // ✅ ADD THIS
        $table_name = 'customizeyourown';
        $image_folder = 'customize your own';
        break;
     case 'handmade_painting':  // ✅ ADD THIS
        $table_name = 'handmadepainting';
        $image_folder = 'Hand made painting';
        break;

    case 'cushion_covers':
         $table_name = 'cushioncovers'; 
         $image_folder = 'cushion covers'; 
         break;
   case 'brass_vessels': 
    $table_name = 'Brassvessels'; 
    $image_folder = 'brass vessels'; 
    break;
   case 'home_fashion':
    $table_name = 'homefashion';
    $image_folder = 'Home fashion flooring';
    break;
  case 'hand_tufted_saggy':
    $table_name = 'handtuftedsaggy';
    $image_folder = 'Hand tufted& saggy'; 
    break;
   case 'big_hotel': 
    $table_name = 'forbighotel'; 
    $image_folder = 'for big hotel'; 
    break;
    case 'pooja_durry':
        $table_name = 'poojadurryaasan'; 
        $image_folder = 'pooja durrys'; 
        break;
   case 'knotted_carpets': 
    $table_name = 'knottedcarpets'; 
    $image_folder = 'knotted carpets'; 
    break;
    case 'doormats':
        $table_name   = 'door';
        $image_folder = 'doormats';
        break;
    case 'organic_yarns': 
        $table_name = 'organicyarns'; 
        $image_folder = 'organic color dying wollen'; 
        break;

     case 'organic_carpets': 
        $table_name = 'organiccarpets'; 
        $image_folder = 'organic color dying handmade'; 
        break;

    case 'kitchen_natural_wood' :
        $table_name = 'kitchennatural_wood';
        $image_folder = 'Kitchen ware';
        break;
    case 'bamboo_bottels':
        $table_name = 'bamboobottels';
        $image_folder = 'bamboo bottles';
        break;
    default:
        $table_name = 'fashionflooring';
        $image_folder = 'Fashion Flooring';
}

// Fetch product details from the correct table
$product_query = $conn->query("SELECT * FROM $table_name WHERE id = '$product_id'");
if($product_query && $product_query->num_rows > 0) {
    $product = $product_query->fetch_assoc();
} else {
    header("Location: home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Address - Mirzapur Qaleen</title>
    <style>
        body { font-family: 'Segoe UI'; background-color: #f5f5f5; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .product-info { display: flex; gap: 15px; margin-bottom: 20px; padding: 15px; background: #f9f9f9; border-radius: 5px; }
        .product-info img { width: 80px; height: 80px; object-fit: cover; border-radius: 5px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; }
        .btn { background: #007bff; color: white; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; }
        .btn:hover { background: #0056b3; }
        .error { color: red; margin-bottom: 15px; }
        .category-badge { background: #007bff; color: white; padding: 4px 8px; border-radius: 3px; font-size: 12px; margin-left: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>📦 Delivery Address</h2>
        
        <!-- Product Information -->
        <div class="product-info">
            <?php
            // ✅ Dynamic image path based on category
            $imgPath = 'uploads/' . $image_folder . '/' . $product['image'];
            if (!file_exists($imgPath) || empty($product['image'])) {
                $imgPath = 'https://via.placeholder.com/80x80?text=No+Image';
            }
            ?>
            <img src="<?php echo $imgPath; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            <div>
                <h3><?php echo htmlspecialchars($product['name']); ?>
                    <span class="category-badge"><?php echo ucfirst(str_replace('_', ' ', $product_category)); ?></span>
                </h3>
                <p><strong>Price: ₹<?php echo htmlspecialchars($product['price']); ?></strong></p>
            </div>
        </div>

        <?php if(isset($_GET['error']) && $_GET['error'] == 1): ?>
            <div class="error">❌ Please fill all the address details!</div>
        <?php endif; ?>

        <!-- Address Form -->
        <form method="POST" action="create_order.php">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
            <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
            <input type="hidden" name="image" value="<?php echo htmlspecialchars($product['image']); ?>">
            <input type="hidden" name="category" value="<?php echo $product_category; ?>">
            
            <div class="form-group">
                <label for="name">Full Name *</label>
                <input type="text" id="name" name="name" required placeholder="Enter your full name" value="<?php echo htmlspecialchars($_SESSION['full_name'] ?? ''); ?>">
            </div>
            
            <div class="form-group">
                <label for="mobile">Mobile Number *</label>
                <input type="tel" id="mobile" name="mobile" required placeholder="Enter your 10-digit mobile number">
            </div>
            
            <div class="form-group">
                <label for="address">Delivery Address *</label>
                <textarea id="address" name="address" rows="3" required placeholder="Enter your complete address"></textarea>
            </div>
            
            <div class="form-group">
                <label for="city">City *</label>
                <input type="text" id="city" name="city" required placeholder="Enter your city">
            </div>
            
            <div class="form-group">
                <label for="pincode">Pincode *</label>
                <input type="text" id="pincode" name="pincode" required placeholder="Enter 6-digit pincode">
            </div>
            
            <button type="submit" class="btn">✅ Place Order</button>
            <a href="home.php" style="margin-left: 15px; color: #007bff; text-decoration: none;">Cancel</a>
        </form>
    </div>
</body>
</html>