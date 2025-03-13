<?php
/**
 * Login Page
 * 
 * This page handles user authentication.
 * It integrates with the following API endpoints:
 * - POST /api/users/login - Authenticate user
 * 
 * Required JS Modules:
 * - modules/auth.js - Handles login form submission
 * - utils/validation.js - Form validation
 * - utils/ui.js - UI feedback
 */

require_once __DIR__ . '/../backend/helpers/auth.php';

// Redirect if already logged in
if (isAuthenticated()) {
    $redirect = isset($_GET['redirect']) ? $_GET['redirect'] : '/';
    header('Location: ' . $redirect);
    exit;
}

require 'partials/header.php';
?>

<div class="container mx-auto py-8">
    <div class="max-w-md mx-auto">
        <h1 class="font-heading text-3xl mb-6 text-center">Login to Your Account</h1>
        
        <!-- Login Form -->
        <form id="login-form" class="login-form">
            <!-- Email Input -->
            <div class="input-group">
                <label for="email" class="input-label">Email Address</label>
                <input type="email" id="email" name="email" class="input-text" required>
            </div>

            <!-- Password Input -->
            <div class="input-group">
                <label for="password" class="input-label">Password</label>
                <input type="password" id="password" name="password" class="input-text" required>
            </div>

            <!-- Error Message Container -->
            <div id="login-error" class="error-message hidden"></div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-full">Login</button>
        </form>

        <!-- Registration Link -->
        <p class="text-center mt-4">
            Don't have an account? 
            <a href="/sundarta/register" class="text-primary hover:text-primary-dark">Register here</a>
        </p>
    </div>
</div>

<?php
require 'partials/footer.php';
?> 