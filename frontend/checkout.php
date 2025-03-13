<?php
/**
 * Checkout Page
 * 
 * This page handles the checkout process for cart items.
 * It integrates with the following API endpoints:
 * - GET /api/cart - Get cart contents
 * - GET /api/cart/check-stock - Verify stock availability
 * - POST /api/orders/checkout - Create order from cart
 * 
 * Required JS Modules:
 * - modules/checkout.js - Handles checkout process
 * - modules/cart.js - Handles cart data
 * - utils/price.js - Handles price formatting
 * - utils/validation.js - Handles form validation
 */

require_once __DIR__ . '/../backend/helpers/auth.php';

// Redirect to login if user is not authenticated
if (!isAuthenticated()) {
    header('Location: /sundarta/login?redirect=' . urlencode($_SERVER['REQUEST_URI']));
    exit;
}

// Now we can safely include header and output content
require 'partials/header.php';
?>

<div class="container mx-auto py-8">
    <!-- Order Summary -->
    <div class="order-summary">
        <!-- Will be populated by JS -->
    </div>

    <!-- Checkout Form -->
    <form id="checkout-form" class="checkout-form">
        <!-- Shipping Information -->
        <div class="shipping-info">
            <!-- Will be populated by JS -->
        </div>

        <!-- Payment Information -->
        <div class="payment-info">
            <!-- Will be populated by JS -->
        </div>

        <!-- Place Order Button -->
        <div class="order-actions">
            <!-- Will be populated by JS -->
        </div>
    </form>
</div>

<?php
require 'partials/footer.php';
?> 