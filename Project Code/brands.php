<?php
require 'db.php'; // Include your database connection file

// Fetch all distinct brands from the products table
$brandsQuery = "SELECT DISTINCT brand FROM products WHERE brand IS NOT NULL";
$brandsStmt = $pdo->query($brandsQuery);
$brands = $brandsStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch products by selected brand
$selectedBrand = isset($_GET['brand']) ? $_GET['brand'] : null;
$products = [];

if ($selectedBrand) {
    $productsQuery = "SELECT * FROM products WHERE brand = ?";
    $productsStmt = $pdo->prepare($productsQuery);
    $productsStmt->execute([$selectedBrand]);
    $products = $productsStmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Product by Brand</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Filter Product by Brand</h1>

    <!-- Display Brand Buttons -->
    <div class="d-flex justify-content-center mb-4">
        <?php foreach ($brands as $brand): ?>
            <a href="brands.php?brand=<?= urlencode($brand['brand']) ?>" 
               class="btn btn-outline-primary mx-2">
                <?= htmlspecialchars($brand['brand']) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Display Products -->
    <div class="row">
        <?php if ($selectedBrand && $products): ?>
            <h2 class="mb-3">Brand: <?= htmlspecialchars($selectedBrand) ?></h2>
            <?php foreach ($products as $product): ?>
                <div class="col-md-3 mb-4"> <!-- Changed from col-md-4 to col-md-3 for 4 cards per row -->
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
        <?php elseif ($selectedBrand): ?>
            <p class="text-center text-danger">No products found for this brand.</p>
        <?php else: ?>
            <div class="alert alert-info text-center">
                <strong>Select a brand to view products.</strong>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
