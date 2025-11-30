<?php 
require_once '../includes/config.php';
require_once '../includes/Database.php';
require_once '../includes/functions.php';

requireLogin();

$title = "Add Product - Admin";
$desc = "Add new gaming laptop";

$err = [];
$success = false;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model = clean($_POST['model']);
    $price = clean($_POST['price']);
    $specs = clean($_POST['specs']);
    $desc = clean($_POST['description']);
    $stock = (int)$_POST['stock'];
    
    // validate inputs
    if(empty($model)) {
        $err['model'] = 'model name required';
    }
    
    if(empty($price) || !is_numeric($price)) {
        $err['price'] = 'valid price required';
    }
    
    if(empty($specs)) {
        $err['specs'] = 'specs required';
    }
    
    if(empty($desc)) {
        $err['description'] = 'description required';
    }
    
    // handle image upload
    $imgFilename = '';
    if(isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $upload = uploadImage($_FILES['image']);
        if($upload['success']) {
            $imgFilename = $upload['filename'];
        } else {
            $err['image'] = implode(', ', $upload['errors']);
        }
    }
    
    // if no errors insert into db
    if(count($err) == 0) {
        $db = new Database();
        $conn = $db->connect();
        
        $stmt = $conn->prepare("INSERT INTO products (model, price, specs, description, image, stock) VALUES (?, ?, ?, ?, ?, ?)");
        
        if($stmt->execute([$model, $price, $specs, $desc, $imgFilename, $stock])) {
            $success = true;
        } else {
            $err['general'] = 'failed to add product';
        }
    }
}

require_once '../templates/header.php';
?>

<section class="adminForm">
    <div class="container">
        <h1>Add New Product</h1>
        
        <?php if($success): ?>
            <div class="successBox">Product added! <a href="dashboard.php">Back to dashboard</a></div>
        <?php endif; ?>
        
        <?php if(isset($err['general'])): ?>
            <div class="errBox"><?php echo $err['general']; ?></div>
        <?php endif; ?>
        
        <form method="post" enctype="multipart/form-data">
            <div class="field">
                <label for="model">Model Name</label>
                <input type="text" id="model" name="model" value="<?php echo isset($_POST['model']) ? htmlspecialchars($_POST['model']) : ''; ?>">
                <?php if(isset($err['model'])): ?>
                    <span class="errMsg"><?php echo $err['model']; ?></span>
                <?php endif; ?>
            </div>
            
            <div class="field">
                <label for="price">Price</label>
                <input type="number" step="0.01" id="price" name="price" value="<?php echo isset($_POST['price']) ? htmlspecialchars($_POST['price']) : ''; ?>">
                <?php if(isset($err['price'])): ?>
                    <span class="errMsg"><?php echo $err['price']; ?></span>
                <?php endif; ?>
            </div>
            
            <div class="field">
                <label for="specs">Specifications</label>
                <input type="text" id="specs" name="specs" value="<?php echo isset($_POST['specs']) ? htmlspecialchars($_POST['specs']) : ''; ?>">
                <?php if(isset($err['specs'])): ?>
                    <span class="errMsg"><?php echo $err['specs']; ?></span>
                <?php endif; ?>
            </div>
            
            <div class="field">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4"><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                <?php if(isset($err['description'])): ?>
                    <span class="errMsg"><?php echo $err['description']; ?></span>
                <?php endif; ?>
            </div>
            
            <div class="field">
                <label for="stock">Stock Quantity</label>
                <input type="number" id="stock" name="stock" value="<?php echo isset($_POST['stock']) ? (int)$_POST['stock'] : '0'; ?>">
            </div>
            
            <div class="field">
                <label for="image">Product Image</label>
                <input type="file" id="image" name="image" accept="image/*">
                <?php if(isset($err['image'])): ?>
                    <span class="errMsg"><?php echo $err['image']; ?></span>
                <?php endif; ?>
            </div>
            
            <div class="formActions">
                <button type="submit" class="btnPrimary">Add Product</button>
                <a href="dashboard.php" class="btnSecondary">Cancel</a>
            </div>
        </form>
    </div>
</section>

<?php require_once '../templates/footer.php'; ?>