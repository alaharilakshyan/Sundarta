<?php
/**
 * User Profile Page
 * 
 * This page displays and manages user profile information.
 * It integrates with the following API endpoints:
 * - GET /api/users/profile - Get user profile
 * - PUT /api/users/profile - Update profile
 * - PUT /api/users/password - Update password
 * - GET /api/orders/my-orders - Get user's order history
 * - GET /api/reviews/my-reviews - Get user's reviews
 * - GET /api/services/my-services - Get seller's services (if seller)
 * 
 * Required JS Modules:
 * - modules/profile.js - Handles profile management
 * - modules/orders.js - Displays order history
 * - modules/reviews.js - Displays user reviews
 * - modules/services.js - Manages seller services
 * - utils/validation.js - Form validation
 * - utils/ui.js - UI feedback
 */

require_once __DIR__ . '/../backend/helpers/auth.php';

// Redirect if not logged in
if (!isAuthenticated()) {
    header('Location: /sundarta/login?redirect=' . urlencode($_SERVER['REQUEST_URI']));
    exit;
}

// Now we can safely include header and output content
require 'partials/header.php';
?>

<div class="container mx-auto py-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Sidebar Navigation -->
        <div class="md:col-span-1">
            <nav class="profile-nav">
                <a href="#profile" class="profile-nav-item active" data-tab="profile">Profile Information</a>
                <a href="#password" class="profile-nav-item" data-tab="password">Change Password</a>
                <a href="#orders" class="profile-nav-item" data-tab="orders">Order History</a>
                <a href="#reviews" class="profile-nav-item" data-tab="reviews">My Reviews</a>
                <?php if (hasRole('seller')): ?>
                <a href="#services" class="profile-nav-item" data-tab="services">My Services</a>
                <?php endif; ?>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div class="md:col-span-2">
            <!-- Profile Tab -->
            <div id="profile-tab" class="profile-tab active">
                <h2 class="font-heading text-2xl mb-6">Profile Information</h2>
                <form id="profile-form" class="profile-form">
                    <!-- Profile form fields will be populated by JS -->
                </form>
            </div>

            <!-- Password Tab -->
            <div id="password-tab" class="profile-tab hidden">
                <h2 class="font-heading text-2xl mb-6">Change Password</h2>
                <form id="password-form" class="password-form">
                    <!-- Password form fields will be populated by JS -->
                </form>
            </div>

            <!-- Orders Tab -->
            <div id="orders-tab" class="profile-tab hidden">
                <h2 class="font-heading text-2xl mb-6">Order History</h2>
                <div class="orders-list">
                    <!-- Orders will be populated by JS -->
                </div>
            </div>

            <!-- Reviews Tab -->
            <div id="reviews-tab" class="profile-tab hidden">
                <h2 class="font-heading text-2xl mb-6">My Reviews</h2>
                <div class="reviews-list">
                    <!-- Reviews will be populated by JS -->
                </div>
            </div>

            <!-- Services Tab (Seller Only) -->
            <?php if (hasRole('seller')): ?>
            <div id="services-tab" class="profile-tab hidden">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-heading text-2xl">My Services</h2>
                    <button id="add-service-btn" class="btn btn-primary">Add New Service</button>
                </div>
                <div class="services-list">
                    <!-- Services will be populated by JS -->
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
require 'partials/footer.php';
?> 