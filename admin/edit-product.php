<?php 
require_once '../includes/config.php';
require_once '../includes/Database.php';
require_once '../includes/functions.php';

requireLogin();

$title = "Edit Product - Admin";
$desc = "Edit gaming laptop details";

// get product id
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($id == 0) {
    header('Location: dashboard.php');
    exit;
}

$db = new Database();
$conn = $db->connect();

// get existing product data
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);

if($stmt->rowCount() == 0) {
    header('Location: dashboard.php');
    exit;
}

$product = $stmt->fetch(PDO::FETCH_ASSOC);

$err = [];
$success = false;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model = clean($_POST['model']);
    $price = clean($_POST['price']);
    $specs = clean($_POST['specs']);
    $description = clean($_POST['description']);
    $stock = (int)$_POST['stock'];
    
    // validate
    if(empty($model)) {
        $err['model'] = 'model name required';
    }
    
    if(empty($price) || !is_numeric($price)) {
        $err['price'] = 'valid price required';
    }
    
    if(empty($specs)) {
        $err['specs'] = 'specs required';
    }
    
    if(empty($description)) {
        $err['description'] = 'description required';
    }
    
    // handle new image upload
    $imgFilename = $product['image']; // keep old image by default
    if(isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $upload = uploadImage($_FILES['image']);
        if($upload['success']) {
            // delete old image if exists
            if(!empty($product['image'])) {
                deleteImage($product['image']);
            }
            $imgFilename = $upload['filename'];
        } else {
            $err['image'] = implode(', ', $upload['errors']);
        }
    }
    
    // update db
    if(count($err) == 0) {
        $stmt = $conn->prepare("UPDATE products SET model = ?, price = ?, specs = ?, description = ?, image = ?, stock = ? WHERE id = ?");
        
        if($stmt->execute([$model, $price, $specs, $description, $imgFilename, $stock, $id])) {
            $success = true;
            // refresh product data
            $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$id]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $err['general'] = 'failed to update product';
        }
    }
}

require_once '../templates/header.php';

$imgPath = !empty($product['image']) ? UPLOAD_URL . $product['image'] : '../assets/placeholder.jpg';
?>

<section class="adminForm">
    <div class="container">
        <h1>Edit Product</h1>
        
        <?php if($success): ?>
            <div class="successBox">Product updated! <a href="dashboard.php">Back to dashboard</a></div>
        <?php endif; ?>
        
        <?php if(isset($err['general'])): ?>
            <div class="errBox"><?php echo $err['general']; ?></div>
        <?php endif; ?>
        
        <form method="post" enctype="multipart/form-data">
            <div class="field">
                <label for="model">Model Name</label>
                <input type="text" id="model" name="model" value="<?php echo htmlspecialchars($product['model']); ?>">
                <?php if(isset($err['model'])): ?>
                    <span class="errMsg"><?php echo $err['model']; ?></span>
                <?php endif; ?>
            </div>
            
            <div class="field">
                <label for="price">Price</label>
                <input type="number" step="0.01" id="price" name="price" value="<?php echo $product['price']; ?>">
                <?php if(isset($err['price'])): ?>
                    <span class="errMsg"><?php echo $err['price']; ?></span>
                <?php endif; ?>
            </div>
            
            <div class="field">
                <label for="specs">Specifications</label>
                <input type="text" id="specs" name="specs" value="<?php echo htmlspecialchars($product['specs']); ?>">
                <?php if(isset($err['specs'])): ?>
                    <span class="errMsg"><?php echo $err['specs']; ?></span>
                <?php endif; ?>
            </div>
            
            <div class="field">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4"><?php echo htmlspecialchars($product['description']); ?></textarea>
                <?php if(isset($err['description'])): ?>
                    <span class="errMsg"><?php echo $err['description']; ?></span>
                <?php endif; ?>
            </div>
            
            <div class="field">
                <label for="stock">Stock Quantity</label>
                <input type="number" id="stock" name="stock" value="<?php echo $product['stock']; ?>">
            </div>
            
            <div class="field">
                <label>Current Image</label>
                <img src="<?php echo $imgPath; ?>" alt="current" class="currentImg">
            </div>
            
            <div class="field">
                <label for="image">Upload New Image (optional)</label>
                <input type="file" id="image" name="image" accept="image/*">
                <?php if(isset($err['image'])): ?>
                    <span class="errMsg"><?php echo $err['image']; ?></span>
                <?php endif; ?>
            </div>
            
            <div class="formActions">
                <button type="submit" class="btnPrimary">Update Product</button>
                <a href="dashboard.php" class="btnSecondary">Cancel</a>
            </div>
        </form>
    </div>
</section>

<?php require_once '../templates/footer.php'; ?>