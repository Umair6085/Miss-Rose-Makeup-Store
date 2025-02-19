<?php
require 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .order-table th, .order-table td {
            text-align: center;
        }
        .order-table td {
            vertical-align: middle;
        }
        .order-actions a {
            margin-right: 10px;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; 
$customerId = $_SESSION['customer_id'];

// Fetch the user's orders
$sql = "SELECT * FROM orders WHERE customer_id = ? ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([$customerId]);
$orders = $stmt->fetchAll();

// Helper function to check if an order is cancelable within 24 hours
function isCancelable($orderDate) {
    $orderTime = strtotime($orderDate);
    $currentTime = time();
    return ($currentTime - $orderTime) <= 24 * 60 * 60; // 24 hours in seconds
}
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">My Orders</h1>

    <!-- Display success or error messages -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- Orders Table -->
    <?php if (count($orders) === 0): ?>
        <div class="alert alert-info text-center">You haven't placed any orders yet.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped order-table">
                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['id']) ?></td>
                            <td><?= htmlspecialchars($order['created_at']) ?></td>
                            <td>$<?= number_format($order['total'], 2) ?></td>
                            <td>
                                <?php if ($order['order_status'] == 'Pending'): ?>
                                    <span class="badge bg-warning text-dark"><?= htmlspecialchars($order['order_status']) ?></span>
                                <?php else: ?>
                                    <span class="badge bg-success"><?= htmlspecialchars($order['order_status']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="order-actions">
                                <a href="order_details.php?order_id=<?= $order['id'] ?>" class="btn btn-info btn-sm">View Details</a>
                                <?php if ($order['order_status'] === 'Pending' && isCancelable($order['created_at'])): ?>
                                    <a href="cancel_order.php?order_id=<?= $order['id'] ?>" class="btn btn-danger btn-sm">Cancel Order</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
