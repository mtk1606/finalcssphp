<?php 
require_once '../includes/config.php';
require_once '../includes/Database.php';
require_once '../includes/functions.php';

requireLogin();

// get product id
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($id == 0) {
    header('Location: dashboard.php');
    exit;
}

$db = new Database();
$conn = $db->connect();

// get product to delete image
$stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
$stmt->execute([$id]);

if($stmt->rowCount() > 0) {
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // delete from db
    $deleteStmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    
    if($deleteStmt->execute([$id])) {
        // delete image file if exists
        if(!empty($product['image'])) {
            deleteImage($product['image']);
        }
        
        header('Location: dashboard.php?deleted=1');
        exit;
    }
}

// if something went wrong just redirect back
header('Location: dashboard.php');
exit;
?>