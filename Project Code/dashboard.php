<?php
require 'db.php';
$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .product-image {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>
    <!-- Navbar End -->

    <!-- Product List -->
    <div class="container mt-4">
        <h2>Product List</h2>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-3">
                    <div class="card mb-4">
                        <img src="uploads/<?= $product['image'] ?>" class="card-img-top product-image" alt="<?= $product['name'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['name'] ?></h5>
                            <p class="card-text"><?= $product['description'] ?></p>
                            <p class="card-text fw-bold">Price: $<?= $product['price'] ?></p>
                            <form action="cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <input type="hidden" name="product_name" value="<?= $product['name'] ?>">
                                <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                                <input type="hidden" name="product_image" value="<?= $product['image'] ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
