<?php 
require_once 'includes/config.php';
require_once 'includes/Database.php';

// get product id from url
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($id == 0) {
    header('Location: shop.php');
    exit;
}

// get product from db
$db = new Database();
$conn = $db->connect();
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);

if($stmt->rowCount() == 0) {
    header('Location: shop.php');
    exit;
}

$product = $stmt->fetch(PDO::FETCH_ASSOC);

$title = $product['model'] . " - Gaming Laptops";
$desc = $product['description'];

require_once 'templates/header.php';

$imgPath = !empty($product['image']) ? UPLOAD_URL . $product['image'] : 'assets/placeholder.jpg';
?>

<section class="productDetail">
    <div class="container">
        <div class="productWrap">
            <div class="productImg">
                <img src="<?php echo $imgPath; ?>" alt="<?php echo htmlspecialchars($product['model']); ?>">
            </div>
            <div class="productContent">
                <h1><?php echo htmlspecialchars($product['model']); ?></h1>
                <p class="productPrice">$<?php echo number_format($product['price']); ?></p>
                
                <div class="productSpecs">
                    <h3>Specifications</h3>
                    <p><?php echo htmlspecialchars($product['specs']); ?></p>
                </div>
                
                <div class="productDesc">
                    <h3>Description</h3>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                </div>
                
                <div class="productStock">
                    <?php if($product['stock'] > 0): ?>
                        <p class="inStock">In Stock (<?php echo $product['stock']; ?> available)</p>
                    <?php else: ?>
                        <p class="outStock">Out of Stock</p>
                    <?php endif; ?>
                </div>
                
                <a href="shop.php" class="btnSecondary">Back to Shop</a>
            </div>
        </div>
    </div>
</section>

<?php require_once 'templates/footer.php'; ?>