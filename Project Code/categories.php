<?php
require 'db.php'; // Include your database connection

// Fetch all distinct categories from the products table
$categoriesQuery = "SELECT DISTINCT category FROM products WHERE category IS NOT NULL";
$categoriesStmt = $pdo->query($categoriesQuery);
$categories = $categoriesStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch products by selected category
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : null;
$products = [];

if ($selectedCategory) {
    $productsQuery = "SELECT * FROM products WHERE category = ?";
    $productsStmt = $pdo->prepare($productsQuery);
    $productsStmt->execute([$selectedCategory]);
    $products = $productsStmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List by Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Product List by Categories</h1>

    <!-- Display Category Buttons -->
    <div class="d-flex justify-content-center mb-4">
        <?php foreach ($categories as $category): ?>
            <a href="categories.php?category=<?= urlencode($category['category']) ?>" 
               class="btn btn-outline-primary mx-2">
                <?= htmlspecialchars($category['category']) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Display Products -->
    <div class="row">
        <?php if ($selectedCategory && $products): ?>
            <h2 class="mb-3">Category: <?= htmlspecialchars($selectedCategory) ?></h2>
            <?php foreach ($products as $product): ?>
                <div class="col-md-3 mb-4"> <!-- Change from col-md-4 to col-md-3 for 4 cards per row -->
                    <div class="card">
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
        <?php elseif ($selectedCategory): ?>
            <div class="alert alert-warning text-center">
                <strong>No products found in this category.</strong>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">
                <strong>Select a category to view products.</strong>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
