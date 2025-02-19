<?php
session_start();

// Redirect to login if the user is not authenticated
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="dashboard.php">Miss Rose Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="brands.php">Brands</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories.php">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="my_orders.php">My Orders</a>
                </li>
                <li class="nav-item">
                    <!-- Cart icon instead of text -->
                    <a class="nav-link" href="view_cart.php">
                        <i class="fas fa-shopping-cart"></i> <!-- Font Awesome cart icon -->
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <span class="me-3 text-muted">
                    Welcome, <?php echo htmlspecialchars($_SESSION['customer_name']); ?>
                </span>
                <form class="d-flex me-3" action="search.php" method="GET">
                    <input class="form-control form-control-sm me-2" type="search" name="query" placeholder="Search..." required>
                    <button class="btn btn-outline-primary btn-sm" type="submit">Search</button>
                </form>
                <form method="POST" action="logout.php" class="m-0">
                    <button class="btn btn-danger btn-sm" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
