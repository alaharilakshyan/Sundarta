<?php
/**
 * Registration Page
 * 
 * This page handles new user registration.
 * It integrates with the following API endpoints:
 * - POST /api/users/register - Create new user account
 * 
 * Required JS Modules:
 * - modules/auth.js - Handles registration form submission
 * - utils/validation.js - Form validation
 * - utils/ui.js - UI feedback
 */

require_once __DIR__ . '/../backend/helpers/auth.php';
require 'partials/header.php';

// Redirect if already logged in
if (isAuthenticated()) {
    header('Location: /');
    exit;
}
?>

<div class="container mx-auto py-8">
    <div class="max-w-md mx-auto">
        <h1 class="font-heading text-3xl mb-6 text-center">Create Your Account</h1>
        
        <!-- Registration Form -->
        <form id="register-form" class="register-form">
            <!-- Username Input -->
            <div class="input-group">
                <label for="username" class="input-label">Username</label>
                <input type="text" id="username" name="username" class="input-text" required>
            </div>

            <!-- Email Input -->
            <div class="input-group">
                <label for="email" class="input-label">Email Address</label>
                <input type="email" id="email" name="email" class="input-text" required>
            </div>

            <!-- Phone Input -->
            <div class="input-group">
                <label for="phone" class="input-label">Phone Number</label>
                <input type="tel" id="phone" name="phone" class="input-text" required>
            </div>

            <!-- Password Input -->
            <div class="input-group">
                <label for="password" class="input-label">Password</label>
                <input type="password" id="password" name="password" class="input-text" required>
            </div>

            <!-- Confirm Password Input -->
            <div class="input-group">
                <label for="confirm_password" class="input-label">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="input-text" required>
            </div>

            <!-- Role Selection -->
            <div class="input-group">
                <label class="input-label">Account Type</label>
                <div class="flex gap-4">
                    <label class="flex items-center">
                        <input type="radio" name="role" value="customer" checked>
                        <span class="ml-2">Customer</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="role" value="seller">
                        <span class="ml-2">Service Provider</span>
                    </label>
                </div>
            </div>

            <!-- Error Message Container -->
            <div id="register-error" class="error-message hidden"></div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-full">Create Account</button>
        </form>

        <!-- Login Link -->
        <p class="text-center mt-4">
            Already have an account? 
            <a href="/sundarta/login" class="text-primary hover:text-primary-dark">Login here</a>
        </p>
    </div>
</div>

<?php
require 'partials/footer.php';
?> 