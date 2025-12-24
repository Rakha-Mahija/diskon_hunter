<?php
session_start();

if(!isset($_SESSION["is_login"])){
    header("Location: login.php");
    exit;
}

if(isset($_SESSION["hasil"])){
    $hasil = $_SESSION["hasil"];
    unset($_SESSION["hasil"]); 
} else {
    $hasil = null;
}

if(isset($_SESSION["pesan"])){
    $pesan = $_SESSION["pesan"];
    unset($_SESSION["pesan"]); 
} else {
    $pesan = null;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diskon Hunter - Find The Best Deals</title>
    <link rel="stylesheet" href="CSS/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="nav-wrapper">
                <h1 class="logo">Diskon Hunter</h1>
                <nav class="nav-menu">
                    <a href="#home" class="nav-link active">Home</a>
                    <a href="#notification" class="nav-link">Notification</a>
                    <a href="#contacts" class="nav-link">Contacts</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h2 class="hero-title">FIND THE BEST DEALS THAT MATCH YOUR NEEDS</h2>
                    <p class="hero-description">Discover curated discounts from top brands and start saving effortlessly</p>
                    
                    <div class="search-bar">
                        <span class="search-icon"></span>
                        <input type="text" placeholder="Search with url products..." class="search-input">
                    </div>

                    <div class="stats">
                        <div class="stat-item">
                            <h3 class="stat-number">800+</h3>
                            <p class="stat-label">Active Customers</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number">3,000+</h3>
                            <p class="stat-label">Happy Customers</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number">50,000+</h3>
                            <p class="stat-label">Products Delivered</p>
                        </div>
                    </div>
                </div>

                <div class="image1">
                    <img src="images/img1.png" alt="Shopping Illustration">
                    <p class="img1-tagline">Search smarter. Save more. Shop better</p>
                </div>
            </div>
        </div>
    </section>

    <section class="how-it-works">
        <div class="container">
            <h2 class="section-title">How It Works</h2>
            
            <div class="steps-container">
                <div class="step-card">
                    <img src="images/copy.png" alt="Copy Link Icon" class="step-icon">
                    <h3 class="step-number">1. Copy Link</h3>
                </div>
                
                <div class="step-card">
                    <img src="images/paste.png" alt="Paste Icon" class="step-icon">
                    <h3 class="step-number">Paste & Relax</h3>
                </div>
                
                <div class="step-card">
                    <img src="images/notif.png" alt="Notification Icon" class="step-icon">
                    <h3 class="step-number">3. Get Notified</h3>
                </div>
            </div>

            <p class="steps-description">
                Track prices effortlessly.<br>
                Just paste the link to the product you want, and we'll notify<br>
                you instantly when it's on sale at your desired deal.
            </p>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter">
        <div class="container">
            <div class="newsletter-content">
                <div class="newsletter-text">
                    <h2 class="newsletter-title">STAY UPTO DATE ABOUT OUR LATEST OFFERS</h2>
                </div>
                <div class="newsletter-form">
                    <input type="email" placeholder="Enter your email" class="newsletter-input">
                    <button class="newsletter-button">Get Deal Alerts</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3 class="footer-logo">Diskon Hunter</h3>
                    <p class="footer-description">
                        Diskon Hunter helps you find the best deals effortlessly. Designed to help you save money, we aggregate prices from top brands, making it easier to track and shop smartly.
                    </p>
                    <div class="social-links">
                        <!-- Icons social media -->
                        <a href="#" class="social-icon"><img src="images/X.png" alt="Twitter"></a>
                        <a href="#" class="social-icon"><img src="images/FB.png" alt="Facebook"></a>
                        <a href="#" class="social-icon"><img src="images/IG.png" alt="Instagram"></a>
                    </div>
                </div>

                <div class="footer-column">
                    <h4 class="footer-heading">HELP</h4>
                    <ul class="footer-links">
                        <li><a href="#customer-support">Customer Support</a></li>
                        <li><a href="#terms">Terms & Conditions</a></li>
                        <li><a href="#privacy">Privacy Policy</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4 class="footer-heading">COMPANY</h4>
                    <ul class="footer-links">
                        <li><a href="#about">About</a></li>
                        <li><a href="#features">Features</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4 class="footer-heading">FAQ</h4>
                    <ul class="footer-links">
                        <li><a href="#account">Account</a></li>
                        <li><a href="#orders">Orders</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>Diskon Hunter © 2024-2025 All Rights Reserved</p>
            </div>
        </div>
    </footer>
</body>
</html>