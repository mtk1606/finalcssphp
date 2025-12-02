<?php 
require_once 'includes/config.php';
require_once 'includes/Database.php';
require_once 'includes/functions.php';

$title = "Register - Gaming Laptops";
$desc = "Create admin account";

$err = [];
$registered = false;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = clean($_POST['name']);
    $email = clean($_POST['email']);
    $pass = $_POST['password'];
    $pass2 = $_POST['passwordConfirm'];
    
    // validate name
    if(empty($name)) {
        $err['name'] = 'name required';
    }
    
    // validate email
    if(empty($email)) {
        $err['email'] = 'email required';
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err['email'] = 'not a valid email';
    } else {
        // check if email already exists
        $db = new Database();
        $conn = $db->connect();
        $stmt = $conn->prepare("SELECT id FROM admin_users WHERE email = ?");
        $stmt->execute([$email]);
        if($stmt->rowCount() > 0) {
            $err['email'] = 'email already registered';
        }
    }
    
    // check password length
    if(strlen($pass) < 8) {
        $err['password'] = 'password needs 8+ characters';
    }
    
    // passwords must match
    if($pass != $pass2) {
        $err['passwordConfirm'] = 'passwords dont match';
    }
    
    // if no errors save to db
    if(count($err) == 0) {
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
        
        $db = new Database();
        $conn = $db->connect();
        
        $stmt = $conn->prepare("INSERT INTO admin_users (name, email, password) VALUES (?, ?, ?)");
        
        if($stmt->execute([$name, $email, $hashedPass])) {
            $registered = true;
        } else {
            $err['general'] = 'registration failed, try again';
        }
    }
}

require_once 'templates/header.php';
?>

<section class="registerSection">
    <div class="container">
        <div class="formBox">
            <h1>Create Admin Account</h1>
            
            <?php if($registered): ?>
                <div class="successBox">Account created! <a href="login.php">Login now</a></div>
            <?php endif; ?>
            
            <?php if(isset($err['general'])): ?>
                <div class="errBox"><?php echo $err['general']; ?></div>
            <?php endif; ?>
            
            <form method="post">
                <div class="field">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                    <?php if(isset($err['name'])): ?>
                        <span class="errMsg"><?php echo $err['name']; ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    <?php if(isset($err['email'])): ?>
                        <span class="errMsg"><?php echo $err['email']; ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                    <?php if(isset($err['password'])): ?>
                        <span class="errMsg"><?php echo $err['password']; ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="field">
                    <label for="passwordConfirm">Confirm Password</label>
                    <input type="password" id="passwordConfirm" name="passwordConfirm">
                    <?php if(isset($err['passwordConfirm'])): ?>
                        <span class="errMsg"><?php echo $err['passwordConfirm']; ?></span>
                    <?php endif; ?>
                </div>
                
                <button type="submit" class="btnPrimary">Register</button>
            </form>
            
            <p class="altLink">Have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</section>

<?php require_once 'templates/footer.php'; ?>
