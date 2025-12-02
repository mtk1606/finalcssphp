<?php 
require_once 'includes/config.php';
require_once 'includes/Database.php';
require_once 'includes/functions.php';

$title = "Admin Login - Gaming Laptops";
$desc = "Admin login portal";

$loginErr = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = clean($_POST['email']);
    $pass = $_POST['password'];
    
    if(empty($email) || empty($pass)) {
        $loginErr = 'both fields required';
    } else {
        // check db for user
        $db = new Database();
        $conn = $db->connect();
        
        $stmt = $conn->prepare("SELECT id, name, email, password FROM admin_users WHERE email = ?");
        $stmt->execute([$email]);
        
        if($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // verify password
            if(password_verify($pass, $user['password'])) {
                // login successful - create session
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_name'] = $user['name'];
                $_SESSION['admin_email'] = $user['email'];
                
                // redirect to admin dashboard
                header('Location: admin/dashboard.php');
                exit;
            } else {
                $loginErr = 'invalid email or password';
            }
        } else {
            $loginErr = 'invalid email or password';
        }
    }
}

require_once 'templates/header.php';
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
