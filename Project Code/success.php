<?php

if (!isset($_GET['order_id'])) {
    header("Location: index.php");
    exit;
}

$orderId = htmlspecialchars($_GET['order_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .success-container {
            max-width: 600px;
            margin: 0 auto;
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .success-container h2 {
            color: #28a745;
        }
        .order-id {
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container">
    <div class="success-container text-center">
        <h2>Order Placed Successfully!</h2>
        <p class="mt-3">Thank you for shopping with us. Your order has been placed successfully.</p>
        <p>Your Order ID: <span class="order-id"><?= $orderId ?></span></p>
        <div class="mt-4">
            <a href="dashboard.php" class="btn btn-primary btn-lg">Continue Shopping</a>
            <a href="my_orders.php" class="btn btn-outline-success btn-lg">View Order History</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
