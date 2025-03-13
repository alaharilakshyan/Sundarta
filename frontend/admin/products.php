<?php
/**
 * Admin Products Management
 * 
 * This page manages all products in the system.
 * It integrates with the following API endpoints:
 * - GET /api/products - Get all products
 * - POST /api/products - Create new product
 * - PUT /api/products/{id} - Update product
 * - DELETE /api/products/{id} - Delete product
 * 
 * Required JS Modules:
 * - modules/admin/products.js - Handles product management
 * - utils/pagination.js - Handles pagination
 * - utils/filters.js - Handles filtering
 */

require_once __DIR__ . '/../../backend/helpers/auth.php';

// Check authentication first
if (!isAuthenticated()) {
    header('Location: /sundarta/login?redirect=' . urlencode($_SERVER['REQUEST_URI']));
    exit;
}

// Then check admin role
if (!hasRole('admin')) {
    header('Location: /sundarta/');
    exit;
}

// Now we can safely include header and output content
require '../partials/header.php';
?>

<div class="container mx-auto py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="font-heading text-3xl">Products Management</h1>
        <button id="add-product-btn" class="btn btn-primary">Add New Product</button>
    </div>

    <!-- Filters -->
    <div class="card mb-8">
        <div class="filters-container">
            <!-- Search -->
            <div class="search-box">
                <input type="text" id="product-search" placeholder="Search products...">
            </div>

            <!-- Category Filter -->
            <div class="category-filter">
                <select id="category-filter">
                    <option value="">All Categories</option>
                    <!-- Categories will be populated by JS -->
                </select>
            </div>

            <!-- Status Filter -->
            <div class="status-filter">
                <select id="status-filter">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="out_of_stock">Out of Stock</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Products Table -->
    <div class="card">
        <table class="w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="products-table-body">
                <!-- Products will be populated by JS -->
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination mt-4">
            <!-- Pagination will be handled by JS -->
        </div>
    </div>
</div>

<!-- Add/Edit Product Modal -->
<div id="product-modal" class="modal hidden">
    <div class="modal-content">
        <h2 class="font-heading text-2xl mb-6">Add/Edit Product</h2>
        <form id="product-form">
            <!-- Product form fields will be populated by JS -->
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="modal hidden">
    <div class="modal-content">
        <h2 class="font-heading text-2xl mb-6">Delete Product</h2>
        <p>Are you sure you want to delete this product? This action cannot be undone.</p>
        <div class="flex justify-end gap-4 mt-6">
            <button id="cancel-delete" class="btn btn-outline">Cancel</button>
            <button id="confirm-delete" class="btn btn-danger">Delete</button>
        </div>
    </div>
</div>

<?php
require '../partials/footer.php';
?> 