<?php
require 'db.php'; // Include database connection

// Get the search keyword from the query string
$searchQuery = isset($_GET['query']) ? trim($_GET['query']) : '';

// Initialize an empty array for products
$products = [];

if (!empty($searchQuery)) {
    // SQL query to search for products by name or description
    $searchSQL = "SELECT * FROM products 
                  WHERE name LIKE ? OR description LIKE ?";
    $searchStmt = $pdo->prepare($searchSQL);
    $searchStmt->execute(["%$searchQuery%", "%$searchQuery%"]);
    $products = $searchStmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Search Results for: "<?= htmlspecialchars($searchQuery) ?>"</h1>
    
    <div class="row">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="uploads/<?= htmlspecialchars($product['image']) ?>" 
                             class="card-img-top product-image" 
                             alt="<?= htmlspecialchars($product['name']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                            <p class="card-text">Price: $<?= htmlspecialchars($product['price']) ?></p>
                            <form action="cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <input type="hidden" name="product_name" value="<?= $product['name'] ?>">
                                <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                                <input type="hidden" name="product_image" value="<?= $product['image'] ?>">
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-danger">No products found matching your search query.</p>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
