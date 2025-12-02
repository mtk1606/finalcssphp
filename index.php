<?php 
require_once 'includes/config.php';
require_once 'includes/Database.php';

$title = "Home - Gaming Laptops Store";
$desc = "Browse our collection of high-performance gaming laptops";

// get featured products (limit 3)
$db = new Database();
$conn = $db->connect();
$stmt = $conn->prepare("SELECT * FROM products ORDER BY created_at DESC LIMIT 3");
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once 'templates/header.php';
?>

<section class="hero">
    <div class="heroWrap">
        <h1>High Performance Gaming</h1>
        <p>Professional grade laptops for serious gamers</p>
        <a href="shop.php" class="btnPrimary">Browse Collection</a>
    </div>
</section>

<section class="featured">
    <div class="container">
        <h2>Featured Models</h2>
        <div class="productGrid">
            <?php
            foreach($items as $item): 
                $imgPath = !empty($item['image']) ? UPLOAD_URL . $item['image'] : 'assets/placeholder.jpg';
            ?>
                <div class="productCard">
                    <img src="<?php echo $imgPath; ?>" alt="<?php echo htmlspecialchars($item['model']); ?>">
                    <h3><?php echo htmlspecialchars($item['model']); ?></h3>
                    <p class="price">$<?php echo number_format($item['price']); ?></p>
                    <a href="product.php?id=<?php echo $item['id']; ?>" class="btnSecondary">View Details</a>
                </div>
            <?php 
            endforeach; 
            ?>
        </div>
    </div>
</section>

<section class="callout">
    <div class="container">
        <h2>Need Help Choosing?</h2>
        <p>Our team can help you find the perfect gaming laptop</p>
        <a href="contact.php" class="btnPrimary">Contact Us</a>
    </div>
</section>

<?php require_once 'templates/footer.php'; ?>
