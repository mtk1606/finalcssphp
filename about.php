<?php 
$title = "About Us - Gaming Laptops";
$desc = "Learn about our mission to provide quality gaming laptops";
require_once 'templates/header.php';
?>

<section class="pageHeader">
    <div class="container">
        <h1>About Apex Gaming</h1>
        <p>Your trusted source for gaming laptops</p>
    </div>
</section>

<section class="story">
    <div class="container">
        <h2>Our Story</h2>
        <p>Founded by gamers, for gamers. We started Apex Gaming because we believe everyone deserves access to quality gaming hardware without the hassle.</p>
        <p>With years of experience in the gaming industry, we handpick every laptop in our collection to ensure peak performance and reliability.</p>
    </div>
</section>

<section class="whyUs">
    <div class="container">
        <h2>What We Stand For</h2>
        <!-- tried grid first but flexbox easier for 3 columns -->
        <div class="valueBoxes">
            <div class="box">
                <h3>Quality First</h3>
                <p>Every laptop meets our strict performance standards</p>
            </div>
            <div class="box">
                <h3>Fair Pricing</h3>
                <p>Competitive prices without hidden fees</p>
            </div>
            <div class="box">
                <h3>Customer Support</h3>
                <p>Expert help when you need it</p>
            </div>
        </div>
    </div>
</section>

<?php require_once 'templates/footer.php'; ?>