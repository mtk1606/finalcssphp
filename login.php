<?php 
$title = "Admin Login - Gaming Laptops";
$desc = "Admin login portal";
require_once 'templates/header.php';

$loginErr = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $pass = $_POST['password'];
    
    // temp - will check db later
    if(empty($email) || empty($pass)) {
        $loginErr = 'Both fields required';
    }
    // if login works redirect to admin panel (phase 2)
}
?>

<section class="loginSection">
    <div class="container">
        <div class="formBox">
            <h1>Admin Login</h1>
            
            <?php if($loginErr != ''): ?>
                <div class="errBox"><?php echo $loginErr; ?></div>
            <?php endif; ?>
            
            <form method="post">
                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btnPrimary">Login</button>
            </form>
            
            <p class="altLink">Need an account? <a href="register.php">Register</a></p>
        </div>
    </div>
</section>

<?php require_once 'templates/footer.php'; ?>