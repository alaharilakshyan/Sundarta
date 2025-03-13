<?php
/**
 * Shopping Cart Page
 * 
 * This page displays the user's shopping cart with products and services.
 * It integrates with the following API endpoints:
 * - GET /api/cart - Get cart contents
 * - PUT /api/cart/item - Update cart item quantity
 * - DELETE /api/cart/item - Remove item from cart
 * - DELETE /api/cart/clear - Clear entire cart
 * - GET /api/cart/check-stock - Check product stock availability
 * 
 * Required JS Modules:
 * - modules/cart.js - Handles cart operations
 * - utils/price.js - Handles price formatting and calculations
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

<div class="container mx-auto px-4 py-8">
    <h1 class="font-heading text-4xl mb-8">Shopping Cart</h1>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2">
            <div id="cart-items" class="space-y-4">
                <!-- Cart items will be loaded dynamically -->
            </div>
        </div>
        
        <!-- Cart Summary -->
        <div class="bg-surface rounded-lg p-6">
            <h2 class="font-heading text-2xl mb-4">Cart Summary</h2>
            
            <div class="space-y-2 mb-4">
                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span id="cart-subtotal">₹0.00</span>
                </div>
                <div class="flex justify-between">
                    <span>Tax</span>
                    <span id="cart-tax">₹0.00</span>
                </div>
                <div class="flex justify-between font-semibold text-lg">
                    <span>Total</span>
                    <span id="cart-total">₹0.00</span>
                </div>
            </div>
            
            <button id="checkout-btn" class="btn btn-primary w-full">Proceed to Checkout</button>
        </div>
    </div>
</div>

<?php
require 'partials/footer.php';
?> 