<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Miss Rose Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .hero {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .hero h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }
        .hero p {
            font-size: 1rem;
            color: #666;
            margin-bottom: 30px;
        }
        .btn-custom {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            font-size: 1rem;
        }
        .btn-primary {
            background-color: #ff69b4;
            border: none;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
        .btn-primary:hover {
            background-color: #ff85c4;
        }
        .btn-secondary:hover {
            background-color: #848e93;
        }
    </style>
</head>
<body>
    <div class="hero">
        <h1>Welcome to Miss Rose</h1>
        <p>Your one-stop shop for premium make-up products. Look beautiful, feel confident!</p>
        <a href="register.php" class="btn btn-primary btn-custom">Register</a>
        <a href="login.php" class="btn btn-secondary btn-custom">Login</a>
    </div>
</body>
</html>
