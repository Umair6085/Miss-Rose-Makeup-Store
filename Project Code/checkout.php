<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .checkout-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; 

if (!isset($_SESSION['customer'])) {
    // Redirect to login if the user is not logged in
    header("Location: login.php");
    exit;
}

if (empty($_SESSION['cart'])) {
    // Redirect to cart page if the cart is empty
    header("Location: view_cart.php");
    exit;
}

// Get logged-in customer's details
$customer = $_SESSION['customer'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle the checkout form submission
    $address = trim($_POST['address']);
    $total = $_POST['total'];

    // Validate input
    if (empty($address)) {
        $error = "Shipping address is required.";
    } else {
        require 'db.php'; // Include database connection

        // Insert order details into the `orders` table
        $orderSQL = "INSERT INTO orders (customer_id, customer_name, email, phone, address, total) VALUES (?, ?, ?, ?, ?, ?)";
        $orderStmt = $pdo->prepare($orderSQL);
        $orderStmt->execute([
            $customer['id'],
            $customer['name'],
            $customer['email'],
            $customer['phone'],
            $address,
            $total
        ]);

        $orderId = $pdo->lastInsertId(); // Get the inserted order ID

        // Insert each cart item into the `order_items` table
        foreach ($_SESSION['cart'] as $item) {
            $itemSQL = "INSERT INTO order_items (order_id, product_id, product_name, quantity, price) VALUES (?, ?, ?, ?, ?)";
            $itemStmt = $pdo->prepare($itemSQL);
            $itemStmt->execute([
                $orderId,
                $item['id'],
                $item['name'],
                $item['quantity'],
                $item['price']
            ]);
        }

        // Clear the cart
        unset($_SESSION['cart']);

        // Redirect to the success page
        header("Location: success.php?order_id=$orderId");
        exit;
    }
}
?>

<div class="container mt-5">
    <div class="checkout-container">
        <h2 class="text-center mb-4">Checkout</h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="checkout.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($customer['name']) ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($customer['email']) ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" name="phone" id="phone" class="form-control" value="<?= htmlspecialchars($customer['phone']) ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Shipping Address</label>
                <textarea name="address" id="address" class="form-control" rows="3" placeholder="Enter your shipping address here..." required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Order Total</label>
                <input type="text" name="total" class="form-control" value="<?= number_format(array_sum(array_map(function ($item) {
                    return $item['price'] * $item['quantity'];
                }, $_SESSION['cart'])), 2) ?>" readonly>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success btn-lg">Place Order</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
