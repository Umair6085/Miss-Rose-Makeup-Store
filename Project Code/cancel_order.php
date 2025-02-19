<?php
session_start();

if (!isset($_SESSION['customer'])) {
    header("Location: login.php");
    exit;
}

require 'db.php';

// Validate the `order_id` parameter
$orderId = $_GET['order_id'] ?? null;

if (!$orderId) {
    header("Location: my_orders.php");
    exit;
}

// Ensure the order belongs to the logged-in customer and is still cancelable
$customerId = $_SESSION['customer']['id'];
$sql = "SELECT * FROM orders WHERE id = ? AND customer_id = ? AND order_status = 'Pending' LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([$orderId, $customerId]);
$order = $stmt->fetch();

if (!$order) {
    header("Location: my_orders.php");
    exit;
}

// Check if the order is still within the cancellation period
$orderTime = strtotime($order['created_at']);
if (time() - $orderTime > 24 * 60 * 60) { // 24 hours
    $_SESSION['error'] = "Order cannot be canceled after 24 hours.";
    header("Location: my_orders.php");
    exit;
}

// Update the order status to "Canceled"
$updateSql = "UPDATE orders SET order_status = 'Canceled' WHERE id = ?";
$updateStmt = $pdo->prepare($updateSql);
$updateStmt->execute([$orderId]);

$_SESSION['success'] = "Order has been successfully canceled.";
header("Location: my_orders.php");
exit;
?>
