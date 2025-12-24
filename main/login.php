<?php
session_start();
$pesan = $_SESSION["pesan"] ?? "";
unset($_SESSION["pesan"]);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Diskon Hunter</title>
    <link rel="stylesheet" href="CSS/Login-Signup.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
    <section class="auth-section">
        <div class="auth-container">
            <div class="form-container">
                <div class="form-content">
                    <div class="logo-section">
                        <h1 class="brand-logo">Diskon Hunter</h1>
                    </div>
                    
                    <h2 class="form-title">Welcome Back!</h2>
                    <p class="form-subtitle">Login to continue finding the best deals</p>

                    <form class="auth-form" id="loginForm" action="/fitur/loginproses.php" method = "POST">
                        <div class="form-group">
                            <label for="loginUsername" class="form-label">Username</label>
                            <input type="text" name="username" class="form-input" placeholder="Enter your Username" required>
                        </div>

                        <div class="form-group">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" name="password" class="form-input" placeholder="Enter your password" required>
                        </div>

                        <div class="form-options">
                            <label class="checkbox-label">
                                <input type="checkbox" class="checkbox-input">
                                <span>Remember me</span>
                            </label>
                            <a href="#forgot" class="forgot-link">Forgot Password?</a>
                        </div>

                        <button type="submit" class="btn-primary" name="login">Login</button>

                        
                    </form>
                    
                    <p class="switch-form">
                        Don't have an account? 
                        <a href="sigin.php" class="switch-link">Sign Up</a>
                    </p>
                </div>
            </div>

            <div class="illustration-side">
                <div class="illustration-content">
                    <img src="images/DH.png" alt="Shopping Illustration" class="auth-illustration">
                    <h3 class="illustration-title">Welcome Back!</h3>
                    <p class="illustration-text">Continue your journey to discover amazing deals and save money every day</p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>