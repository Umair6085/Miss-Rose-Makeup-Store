<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Miss Rose Make-up Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@400;500&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
        }

        .hero-section {
            background: url('./uploads/about.jpg') no-repeat center center/cover;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .hero-section h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            background: rgba(0, 0, 0, 0.5);
            padding: 10px 20px;
            border-radius: 5px;
        }

        .about-content {
            padding: 40px 15px;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            margin-bottom: 30px;
            text-align: center;
            color: #d63384;
        }

        .info-box {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .info-box:hover {
            transform: scale(1.05);
        }

        .info-box h3 {
            color: #d63384;
            margin-bottom: 15px;
        }

        .info-box p {
            font-size: 0.95rem;
            color: #495057;
        }

        .text-highlight {
            color: #d63384;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<!-- Hero Section -->
<div class="hero-section">
    <h1>About Us</h1>
</div>

<!-- About Content Section -->
<div class="container about-content">
    <h2 class="section-title">Welcome to <span class="text-highlight">Miss Rose Make-up Store</span></h2>
    <p class="text-center mb-5">
        Your ultimate destination for premium cosmetics and beauty essentials, designed to inspire and empower you.
    </p>

    <div class="row gy-4">
        <!-- Mission Section -->
        <div class="col-md-4">
            <div class="info-box">
                <h3>Our Mission</h3>
                <p>Providing high-quality, affordable beauty products that empower individuals to embrace their confidence and style.</p>
            </div>
        </div>

        <!-- Vision Section -->
        <div class="col-md-4">
            <div class="info-box">
                <h3>Our Vision</h3>
                <p>To redefine the beauty industry with innovative products and a commitment to excellence in everything we do.</p>
            </div>
        </div>

        <!-- Values Section -->
        <div class="col-md-4">
            <div class="info-box">
                <h3>Our Values</h3>
                <p>Customer satisfaction, quality assurance, and ethical practices are at the heart of our mission.</p>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <h4 class="text-highlight">Why Choose Us?</h4>
        <p>
            At Miss Rose Make-up Store, we believe in celebrating individuality and enhancing natural beauty.
            Our diverse range of products caters to everyone, ensuring confidence and radiance in every moment.
        </p>
    </div>
</div>

<!-- Footer -->
<div class="bg-dark text-white text-center py-3">
    <p>&copy; <?php echo date("Y"); ?> Miss Rose Make-up Store. All rights reserved.</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
