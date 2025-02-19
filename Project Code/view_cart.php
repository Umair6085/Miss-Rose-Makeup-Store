<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .cart-empty {
            font-size: 1.2rem;
            color: #ff6b6b;
        }
        .cart-item img {
            max-width: 100px;
            height: auto;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Your Shopping Cart</h1>

    <?php if (!empty($_SESSION['cart'])): ?>
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $grandTotal = 0;
                    foreach ($_SESSION['cart'] as $index => $cartItem):
                        $total = $cartItem['price'] * $cartItem['quantity'];
                        $grandTotal += $total;
                    ?>
                        <tr class="cart-item">
                            <td>
                                <img src="uploads/<?= htmlspecialchars($cartItem['image']) ?>" alt="<?= htmlspecialchars($cartItem['name']) ?>">
                            </td>
                            <td><?= htmlspecialchars($cartItem['name']) ?></td>
                            <td>$<?= number_format($cartItem['price'], 2) ?></td>
                            <td>
                                <form method="POST" action="update_cart.php" class="d-flex justify-content-center">
                                    <input type="number" name="quantity" value="<?= $cartItem['quantity'] ?>" class="form-control w-50 me-2 text-center" min="1" disabled>
                                </form>
                            </td>
                            <td>$<?= number_format($total, 2) ?></td>
                            <td>
                                <a href="remove_from_cart.php?index=<?= $index ?>" class="btn btn-danger btn-sm">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Grand Total:</strong></td>
                        <td colspan="2">$<?= number_format($grandTotal, 2) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <a href="dashboard.php" class="btn btn-outline-secondary me-2">Continue Shopping</a>
            <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
        </div>
    <?php else: ?>
        <div class="text-center mt-5">
            <p class="cart-empty">Your cart is empty.</p>
            <a href="dashboard.php" class="btn btn-primary">Browse Products</a>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
