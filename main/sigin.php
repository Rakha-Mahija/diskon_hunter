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
    <title>Sign Up - Diskon Hunter</title>
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
                    
                    <h2 class="form-title">Create Account</h2>
                    <p class="form-subtitle">Sign up to start saving with the best deals</p>

                    <form class="auth-form" id="signupForm">
                        <div class="form-group">
                            <label for="signupName" class="form-label">Full Name</label>
                            <input type="text" name="username" class="form-input" placeholder="Enter your full name" required>
                        </div>

                        <div class="form-group">
                            <label for="signupEmail" class="form-label">Email</label>
                            <input type="email" name="email" class="form-input" placeholder="Enter your email" required>
                        </div>

                        <div class="form-group">
                            <label for="signupPassword" class="form-label">Password</label>
                            <input type="password" name="password" class="form-input" placeholder="Create a password" required>
                        </div>

                        <div class="form-group">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" name="confirmPassword" class="form-input" placeholder="Confirm your password"required>
                        </div>

                        <label class="checkbox-label terms-label">
                            <input type="checkbox" class="checkbox-input" id="termsCheckbox" required>
                            <span>I agree to the <a href="#terms" class="terms-link">Terms & Conditions</a></span>
                        </label>

                        <button type="submit" class="btn-primary">Sign Up</button>

                        <div class="divider">
                            <span>OR</span>
                        </div>

                        <button type="button" class="btn-google">
                            <img src="images/ggl.png" alt="Google" class="google-icon">
                            Continue with Google
                        </button>
                    </form>

                    <p class="switch-form">
                        Already have an account? 
                        <a href="login.php" class="switch-link">Login</a>
                    </p>
                </div>
            </div>

            <!-- Illustration Side -->
            <div class="illustration-side">
                <div class="illustration-content">
                    <img src="images/DH.png" alt="Shopping Illustration" class="auth-illustration">
                    <h3 class="illustration-title">Join Us Today!</h3>
                    <p class="illustration-text">Create your account and start discovering amazing deals from thousands of products</p>
                </div>
            </div>
        </div>
    </section>

<script>
document.getElementById("formsig").addEventListener("submit", function(e) {
const username = document.getElementById("username").value.trim();
const link = document.getElementById("link").value.trim();
const email = document.getElementById("email").value.trim();

if (username === "" || link === "" || email === "") {
    e.preventDefault(); 
    alert("Semua field wajib diisi!");
    return;
}
});
</script>
</body>
</html>