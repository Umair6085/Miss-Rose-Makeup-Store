<?php
session_start();
require 'db.php'; // Include database connection

$error = null;
$success = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM customers WHERE email = ? LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['customer_id'] = $user['id'];
        $_SESSION['customer_name'] = $user['name'];
        $_SESSION['customer'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'phone' => $user['phone']
        ];
        // Set success message to show the login toast
        $success = "Login successful! Redirecting to your dashboard...";

        // Prevent the page from redirecting until the toast shows
        echo "<script>window.location.href = 'dashboard.php';</script>";
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="w-100" style="max-width: 400px;">
            <h1 class="text-center mb-4">Miss Rose Store</h1>
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="text-center mb-4">Login</h2>

                    <!-- Toast Notifications -->
                    <?php if ($success): ?>
                        <div class="toast align-items-center text-white bg-success border-0 position-fixed bottom-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    <?= htmlspecialchars($success); ?>
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($error): ?>
                        <div class="toast align-items-center text-white bg-danger border-0 position-fixed bottom-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    <?= htmlspecialchars($error); ?>
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form method="POST" novalidate>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            <div class="invalid-feedback">
                                Please provide a valid email address.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            <div class="invalid-feedback">
                                Please provide a password.
                            </div>
                        </div>
                        <button type="submit" class="btn text-white w-100" style="background-color: #ff85c4;">Login</button>
                    </form>
                    <p class="text-center mt-3">
                        Don't have an account? <a href="register.php" class="text-decoration-none">Register here</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS with Popper for validation functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Bootstrap custom validation function
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })

            // Display toast notifications
            var toastLiveExample = document.querySelectorAll('.toast');
            toastLiveExample.forEach(function(toastNode) {
                var toast = new bootstrap.Toast(toastNode);
                toast.show();
            });
        })()
    </script>
</body>
</html>
