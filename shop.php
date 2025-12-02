?php 
require_once 'includes/config.php';
require_once 'includes/Database.php';

$title = "Shop - Gaming Laptops";
$desc = "Browse all available gaming laptops in our store";

// get all products from db
$db = new Database();
$conn = $db->connect();
$stmt = $conn->prepare("SELECT * FROM products ORDER BY created_at DESC");
$stmt->execute();
$laptops = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once 'templates/header.php';
?>

<section class="pageHeader">
    <div class="container">
        <h1>Gaming Laptop Collection</h1>
        <p>Find your perfect machine</p>
    </div>
</section>

<section class="allProducts">
    <div class="container">
        <?php if(count($laptops) > 0): ?>
        <div class="productGrid">
            <?php 
            foreach($laptops as $l) {
                $imgPath = !empty($l['image']) ? UPLOAD_URL . $l['image'] : 'assets/placeholder.jpg';
                ?>
                <div class="productCard">
                <img src="<?php echo $imgPath; ?>" alt="<?php echo htmlspecialchars($l['model']); ?>">
                <div class="info">
                <h3><?php echo htmlspecialchars($l['model']); ?></h3>
                    <p class="specs"><?php echo htmlspecialchars($l['specs']); ?></p>
                    <p class="price">$<?php echo number_format($l['price']); ?></p>
                    <a href="product.php?id=<?php echo $l['id']; ?>" class="btnSecondary">View Details</a>
                </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php else: ?>
            <p style="text-align: center;">No products available yet.</p>
        <?php endif; ?>
    </div>
</section>

<?php require_once 'templates/footer.php'; ?>
