<?php 
$title = "Contact Us - Gaming Laptops";
$desc = "Get in touch with our team for questions or support";
require_once 'templates/header.php';

$sent = false;
$err = [];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $msg = trim($_POST['message']);
    
    // validate inputs
    if(empty($name)) {
        $err['name'] = 'Name is required';
    }
    
    if(empty($email)) {
        $err['email'] = 'Email required';
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err['email'] = 'Email not valid';
    }
    
    if(empty($msg)) {
        $err['message'] = 'Message cant be empty';
    }
    
    // if no errors save it
    if(count($err) == 0) {
        // TODO save to database in phase 2
        $sent = true;
    }
}
?>

<section class="pageHeader">
    <div class="container">
        <h1>Contact Us</h1>
        <p>Have questions? We're here to help</p>
    </div>
</section>

<section class="contactSection">
    <div class="container">
        <?php if($sent): ?>
            <div class="successMsg">Thanks for your message. We'll reply soon.</div>
        <?php endif; ?>
        
        <form method="post" action="contact.php">
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
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5"><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                <?php if(isset($err['message'])): ?>
                    <span class="errMsg"><?php echo $err['message']; ?></span>
                <?php endif; ?>
            </div>
            
            <button type="submit" class="btnPrimary">Send Message</button>
        </form>
    </div>
</section>

<?php require_once 'templates/footer.php'; ?>