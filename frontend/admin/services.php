<?php
/**
 * Admin Services Management
 * 
 * This page manages all services in the system.
 * It integrates with the following API endpoints:
 * - GET /api/services - Get all services
 * - POST /api/services - Create new service
 * - PUT /api/services/{id} - Update service
 * - DELETE /api/services/{id} - Delete service
 * - GET /api/categories - Get categories for service assignment
 * - GET /api/users - Get service providers
 * 
 * Required JS Modules:
 * - modules/admin/services.js - Handles service management
 * - utils/validation.js - Form validation
 * - utils/ui.js - UI components
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
        <h1 class="font-heading text-3xl">Services Management</h1>
        <button id="add-service-btn" class="btn btn-primary">Add New Service</button>
    </div>

    <!-- Filters -->
    <div class="card mb-8">
        <div class="filters-container">
            <!-- Search -->
            <div class="search-box">
                <input type="text" id="service-search" placeholder="Search services...">
            </div>

            <!-- Category Filter -->
            <div class="category-filter">
                <select id="category-filter">
                    <option value="">All Categories</option>
                    <!-- Categories will be populated by JS -->
                </select>
            </div>

            <!-- Provider Filter -->
            <div class="provider-filter">
                <select id="provider-filter">
                    <option value="">All Providers</option>
                    <!-- Providers will be populated by JS -->
                </select>
            </div>

            <!-- Status Filter -->
            <div class="status-filter">
                <select id="status-filter">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Services Table -->
    <div class="card">
        <table class="w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Provider</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="services-table-body">
                <!-- Services will be populated by JS -->
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination mt-4">
            <!-- Pagination will be handled by JS -->
        </div>
    </div>
</div>

<!-- Add/Edit Service Modal -->
<div id="service-modal" class="modal hidden">
    <div class="modal-content">
        <h2 class="font-heading text-2xl mb-6">Add/Edit Service</h2>
        <form id="service-form">
            <!-- Service form fields will be populated by JS -->
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="modal hidden">
    <div class="modal-content">
        <h2 class="font-heading text-2xl mb-6">Delete Service</h2>
        <p>Are you sure you want to delete this service? This action cannot be undone.</p>
        <div class="flex justify-end gap-4 mt-6">
            <button id="cancel-delete" class="btn btn-outline">Cancel</button>
            <button id="confirm-delete" class="btn btn-danger">Delete</button>
        </div>
    </div>
</div>

<?php
require '../partials/footer.php';
?>