<?php 
$title = "Home - Gaming Laptops Store";
$desc = "Browse our collection of high-performance gaming laptops";
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
            // temp data - will connect to db later
            $items = [
                ['id' => 1, 'model' => 'Predator X15', 'price' => 1299, 'img' => 'laptop1.jpg'],
                ['id' => 2, 'model' => 'ROG Strix G17', 'price' => 1599, 'img' => 'laptop2.jpg'],
                ['id' => 3, 'model' => 'Legion 5 Pro', 'price' => 1899, 'img' => 'laptop3.jpg']
            ];

            foreach($items as $item): 
            ?>
                <div class="productCard">
                    <img src="assets/<?php echo $item['img']; ?>" alt="<?php echo $item['model']; ?>">
                    <h3><?php echo $item['model']; ?></h3>
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
    <div class="wrap">
        <h2>Need Help Choosing?</h2>
        <p>Our team can help you find the perfect gaming laptop</p>
        <a href="contact.php" class="btnPrimary">Contact Us</a>
    </div>
</section>

<?php require_once 'templates/footer.php'; ?>