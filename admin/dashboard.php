<?php 
require_once '../includes/config.php';
require_once '../includes/Database.php';
require_once '../includes/functions.php';

// must be logged in to access
requireLogin();

$title = "Admin Dashboard - Manage Products";
$desc = "Admin panel for product management";

// get all products
$db = new Database();
$conn = $db->connect();
$stmt = $conn->prepare("SELECT * FROM products ORDER BY created_at DESC");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// check for delete success message
$deleteMsg = isset($_GET['deleted']) ? 'Product deleted successfully' : '';

require_once '../templates/header.php';
?>

<section class="adminDashboard">
    <div class="container">
        <div class="dashHeader">
            <h1>Product Management</h1>
            <div class="dashActions">
                <span>Welcome, <?php echo $_SESSION['admin_name']; ?></span>
                <a href="add-product.php" class="btnPrimary">Add New Product</a>
                <a href="../logout.php" class="btnSecondary">Logout</a>
            </div>
        </div>
        
        <?php if($deleteMsg): ?>
            <div class="successBox"><?php echo $deleteMsg; ?></div>
        <?php endif; ?>
        
        <?php if(count($products) > 0): ?>
        <div class="tableWrap">
            <table class="adminTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Model</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($products as $p): 
                        $imgPath = !empty($p['image']) ? UPLOAD_URL . $p['image'] : '../assets/placeholder.jpg';
                    ?>
                    <tr>
                        <td><?php echo $p['id']; ?></td>
                        <td><img src="<?php echo $imgPath; ?>" alt="<?php echo htmlspecialchars($p['model']); ?>" class="tableThumbnail"></td>
                        <td><?php echo htmlspecialchars($p['model']); ?></td>
                        <td>$<?php echo number_format($p['price']); ?></td>
                        <td><?php echo $p['stock']; ?></td>
                        <td class="actionBtns">
                            <a href="edit-product.php?id=<?php echo $p['id']; ?>" class="btnEdit">Edit</a>
                            <a href="delete-product.php?id=<?php echo $p['id']; ?>" class="btnDelete" onclick="return confirm('Delete this product?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
            <p>No products yet. <a href="add-product.php">Add your first product</a></p>
        <?php endif; ?>
    </div>
</section>

<?php require_once '../templates/footer.php'; ?>