<?php
require 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; 

// Get the order ID from the query string
$orderId = $_GET['order_id'] ?? null;

// Ensure the order ID is valid and belongs to the logged-in user
$customerId = $_SESSION['customer_id'];
$sql = "SELECT * FROM orders WHERE id = ? AND customer_id = ? LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([$orderId, $customerId]);
$order = $stmt->fetch();

if (!$order) {
    header("Location: my_orders.php");
    exit;
}

// Fetch the items in the order
$itemSQL = "SELECT * FROM order_items WHERE order_id = ?";
$itemStmt = $pdo->prepare($itemSQL);
$itemStmt->execute([$orderId]);
$orderItems = $itemStmt->fetchAll();
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Order Details</h1>

    <div class="order-details">
        <div class="mb-4">
            <p><strong>Order ID:</strong> <?= htmlspecialchars($order['id']) ?></p>
            <p><strong>Order Date:</strong> <?= htmlspecialchars($order['created_at']) ?></p>
            <p><strong>Total Amount:</strong> $<?= htmlspecialchars(number_format($order['total'], 2)) ?></p>
            <p><strong>Shipping Address:</strong> <?= htmlspecialchars($order['address']) ?></p>
        </div>

        <h3>Products in this Order</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderItems as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['product_name']) ?></td>
                            <td><?= htmlspecialchars($item['quantity']) ?></td>
                            <td>$<?= htmlspecialchars(number_format($item['price'], 2)) ?></td>
                            <td>$<?= htmlspecialchars(number_format($item['quantity'] * $item['price'], 2)) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <a href="my_orders.php" class="btn btn-secondary mt-3">Back to My Orders</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
