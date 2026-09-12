<?php
session_start();
include 'config.php'; // Make sure $conn is your mysqli connection

// Upload directory
$uploadDir = __DIR__ . '/uploads/customize your own/';
if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

// Flash message helper
function flash($msg){
    $_SESSION['flash'] = $msg;
}

// ---------------- ADD PRODUCT ----------------
if(isset($_POST['add_product'])){
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);

    if($name === '' || $price === ''){
        flash('Please provide name and price.');
        header('Location: customizeyourown.php'); exit;
    }

    if(!is_numeric($price)){
        flash('Price must be numeric.');
        header('Location: customizeyourown.php'); exit;
    }

    if(!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK){
        flash('Please upload an image.');
        header('Location: customizeyourown.php'); exit;
    }

    $allowedExt = ['jpg','jpeg','png','webp'];
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    if(!in_array($ext, $allowedExt)){
        flash('Only JPG/PNG/WEBP allowed.');
        header('Location: customizeyourown.php'); exit;
    }

    $newName = time().'_'.bin2hex(random_bytes(6)).'.'.$ext;
    $dest = $uploadDir.$newName;
    if(!move_uploaded_file($_FILES['image']['tmp_name'],$dest)){
        flash('Failed to upload image.');
        header('Location: customizeyourown.php'); exit;
    }

    $stmt = $conn->prepare("INSERT INTO customizeyourown (name, price, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $name, $price, $newName);
    if($stmt->execute()){
        flash('Product added successfully.');
    } else {
        @unlink($dest);
        flash('DB error: '.$stmt->error);
    }
    $stmt->close();
    header('Location: customizeyourown.php'); exit;
}

// ---------------- DELETE PRODUCT ----------------
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("SELECT image FROM customizeyourown WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    if($row){
        $imgName = $row['image'];
        $del = $conn->prepare("DELETE FROM customizeyourown WHERE id=?");
        $del->bind_param("i", $id);
        if($del->execute()){
            if(file_exists($uploadDir.$imgName)) @unlink($uploadDir.$imgName);
            flash('Product deleted.');
        } else flash('Delete failed: '.$del->error);
        $del->close();
    } else flash('Product not found.');
    header('Location: customizeyourown.php'); exit;
}

// ---------------- EDIT PRODUCT ----------------
$editMode = false;
$editData = null;
if(isset($_GET['edit'])){
    $editId = intval($_GET['edit']);
    $stmt = $conn->prepare("SELECT id,name,price,image FROM customizeyourown WHERE id=?");
    $stmt->bind_param("i",$editId);
    $stmt->execute();
    $res = $stmt->get_result();
    $editData = $res->fetch_assoc();
    $stmt->close();
    if($editData) $editMode = true;
}

// ---------------- UPDATE PRODUCT ----------------
if(isset($_POST['update_product'])){
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);

    if($name === '' || $price === ''){
        flash('Please provide name and price.');
        header('Location: customizeyourown.php'); exit;
    }

    if(!is_numeric($price)){
        flash('Price must be numeric.');
        header('Location: customizeyourown.php'); exit;
    }

    $newImage = null;
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if(!in_array($ext,['jpg','jpeg','png','webp'])){
            flash('Only JPG/PNG/WEBP allowed.');
            header('Location: customizeyourown.php'); exit;
        }
        $newImage = time().'_'.bin2hex(random_bytes(6)).'.'.$ext;
        $dest = $uploadDir.$newImage;
        if(!move_uploaded_file($_FILES['image']['tmp_name'],$dest)){
            flash('Failed to upload new image.');
            header('Location: customizeyourown.php'); exit;
        }
    }

    if($newImage){
        $stmt = $conn->prepare("SELECT image FROM customizeyourown WHERE id=?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->bind_result($oldImg);
        $stmt->fetch();
        $stmt->close();

        $upd = $conn->prepare("UPDATE customizeyourown SET name=?, price=?, image=? WHERE id=?");
        $upd->bind_param("sdsi", $name, $price, $newImage, $id);
        if($upd->execute()){
            if(file_exists($uploadDir.$oldImg)) @unlink($uploadDir.$oldImg);
            flash('Product updated (image changed).');
        } else {
            @unlink($dest);
            flash('Update failed: '.$upd->error);
        }
        $upd->close();
    } else {
        $upd = $conn->prepare("UPDATE customizeyourown SET name=?, price=? WHERE id=?");
        $upd->bind_param("sdi", $name, $price, $id);
        if($upd->execute()) flash('Product updated.');
        else flash('Update failed: '.$upd->error);
        $upd->close();
    }

    header('Location: customizeyourown.php'); exit;
}

// ---------------- FETCH ALL PRODUCTS ----------------
$products = [];
$res = $conn->query("SELECT * FROM customizeyourown ORDER BY id DESC");
if($res) while($r=$res->fetch_assoc()) $products[] = $r;

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin - Customize Your Own</title>
<style>
body{font-family:Arial,sans-serif;padding:20px;background:#f7f7f7}
.wrap{max-width:1100px;margin:0 auto;background:#fff;padding:20px;border-radius:8px;box-shadow:0 6px 20px rgba(0,0,0,0.05)}
h1,h2{margin-bottom:10px}
form input,form button{padding:8px;margin:6px 0;display:block;width:100%}
table{width:100%;border-collapse:collapse;margin-top:20px}
table th,table td{padding:8px;border:1px solid #ddd;text-align:left}
img.thumb{width:80px;height:60px;object-fit:cover;border-radius:6px}
.actions a{margin-right:8px}
.flash{background:#e2ffe2;border:1px solid #b2f5b2;padding:8px;margin-bottom:10px;border-radius:6px;color:#1a7a1a}
</style>
</head>
<body>
<div class="wrap">
<a href="admin.php">
  <button type="button" style="background:#6c757d;color:#fff;padding:8px 15px;border:none;border-radius:5px;cursor:pointer;">
    ← Back to Admin Dashboard
  </button>
</a>
<h1>Customize Your Own Products</h1>

<?php if(!empty($_SESSION['flash'])): ?>
<div class="flash"><?php echo htmlspecialchars($_SESSION['flash']); unset($_SESSION['flash']); ?></div>
<?php endif; ?>

<?php if($editMode && $editData): ?>
<h2>Edit Product (ID <?php echo $editData['id']; ?>)</h2>
<form method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $editData['id']; ?>">
<label>Product Name</label>
<input type="text" name="name" value="<?php echo htmlspecialchars($editData['name']); ?>" required>
<label>Price</label>
<input type="text" name="price" value="<?php echo htmlspecialchars($editData['price']); ?>" required>
<label>Change Image (leave blank to keep current)</label>
<input type="file" name="image" accept="image/*">
<p>Current image:</p>
<img src="uploads/customize your own/<?php echo htmlspecialchars($editData['image']); ?>" class="thumb" alt="">
<button type="submit" name="update_product">Update Product</button>
<a href="customizeyourown.php"><button type="button">Cancel</button></a>
</form>
<?php else: ?>
<h2>Add New Product</h2>
<form method="post" enctype="multipart/form-data">
<input type="text" name="name" placeholder="Product Name" required>
<input type="text" name="price" placeholder="Product Price" required>
<input type="file" name="image" accept="image/*" required>
<button type="submit" name="add_product">Add Product</button>
</form>
<?php endif; ?>

<h2>All Products</h2>
<table>
<thead>
<tr><th>ID</th><th>Image</th><th>Name</th><th>Price</th><th>Actions</th></tr>
</thead>
<tbody>
<?php if(count($products)===0): ?>
<tr><td colspan="5">No products yet.</td></tr>
<?php else: foreach($products as $p): ?>
<tr>
<td><?php echo $p['id']; ?></td>
<td><img src="uploads/customize your own/<?php echo htmlspecialchars($p['image']); ?>" class="thumb" alt=""></td>
<td><?php echo htmlspecialchars($p['name']); ?></td>
<td>₹<?php echo htmlspecialchars($p['price']); ?></td>
<td class="actions">
<a href="customizeyourown.php?edit=<?php echo $p['id']; ?>">Edit</a>
<a href="customizeyourown.php?delete=<?php echo $p['id']; ?>" onclick="return confirm('Delete this product?')">Delete</a>
</td>
</tr>
<?php endforeach; endif; ?>
</tbody>
</table>
</div>
</body>
</html>
