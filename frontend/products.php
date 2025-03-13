<?php
/**
 * Products Page
 * 
 * This page displays the product catalog with filtering, sorting, and search capabilities.
 * It integrates with the following API endpoints:
 * - GET /api/products - List all products with pagination
 * - GET /api/products/search - Search products
 * - GET /api/products/category - Filter products by category
 * - GET /api/categories - Get all categories for filtering
 * 
 * Required JS Modules:
 * - modules/products.js - Handles product listing and filtering
 * - modules/cart.js - Handles add to cart functionality
 * - utils/pagination.js - Handles pagination
 * - utils/filters.js - Handles filter UI and state
 */

require_once __DIR__ . '/../backend/helpers/auth.php';
require 'partials/header.php';
?>

<div class="container mx-auto py-8">
    <!-- Product Filters Section -->
    <div class="filters-container">
        <!-- Category filter will be populated by JS -->
    </div>

    <!-- Products Grid -->
    <div class="products-grid">
        <!-- Products will be populated by JS -->
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <!-- Pagination will be handled by JS -->
    </div>
</div>

<?php
require 'partials/footer.php';
?> 