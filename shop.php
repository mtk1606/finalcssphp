<?php 
$title = "Shop - Gaming Laptops";
$desc = "Browse all available gaming laptops in our store";
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
        <?php
        // placeholder til db connection works
        $laptops = [
            ['id' => 1, 'model' => 'Predator X15', 'price' => 1299, 'specs' => 'RTX 4060, i7-13700H', 'img' => 'laptop1.jpg'],
            ['id' => 2, 'model' => 'ROG Strix G17', 'price' => 1599, 'specs' => 'RTX 4070, Ryzen 9', 'img' => 'laptop2.jpg'],
            ['id' => 3, 'model' => 'Legion 5 Pro', 'price' => 1899, 'specs' => 'RTX 4080, i9-13900H', 'img' => 'laptop3.jpg'],
            ['id' => 4, 'model' => 'Razer Blade 15', 'price' => 2199, 'specs' => 'RTX 4090, i9-13900HX', 'img' => 'laptop4.jpg'],
            ['id' => 5, 'model' => 'MSI Stealth 16', 'price' => 1799, 'specs' => 'RTX 4070, i7-13700H', 'img' => 'laptop5.jpg'],
            ['id' => 6, 'model' => 'Alienware M17', 'price' => 2499, 'specs' => 'RTX 4090, i9-13980HX', 'img' => 'laptop6.jpg']
        ];
        ?>

        <div class="productGrid">
            <?php 
            foreach($laptops as $l) {
                ?>
                <div class="productCard">
                <img src="assets/<?php echo $l['img']; ?>" alt="<?php echo $l['model']; ?>">
                <div class="info">
                <h3><?php echo $l['model']; ?></h3>
                    <p class="specs"><?php echo $l['specs']; ?></p>
                    <p class="price">$<?php echo number_format($l['price']); ?></p>
                    <a href="product.php?id=<?php echo $l['id']; ?>" class="btnSecondary">View Details</a>
                </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>

<?php require_once 'templates/footer.php'; ?>