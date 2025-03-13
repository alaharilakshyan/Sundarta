<?php
/**
 * Admin Orders Management
 * 
 * This page manages all orders in the system.
 * It integrates with the following API endpoints:
 * - GET /api/orders - Get all orders
 * - PUT /api/orders/{id} - Update order status
 * - DELETE /api/orders/{id} - Delete order
 * 
 * Required JS Modules:
 * - modules/admin/orders.js - Handles order management
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
        <h1 class="font-heading text-3xl">Orders Management</h1>
    </div>

    <!-- Filters -->
    <div class="card mb-8">
        <div class="filters-container">
            <!-- Search -->
            <div class="search-box">
                <input type="text" id="order-search" placeholder="Search orders...">
            </div>

            <!-- Customer Filter -->
            <div class="customer-filter">
                <select id="customer-filter">
                    <option value="">All Customers</option>
                    <!-- Customers will be populated by JS -->
                </select>
            </div>

            <!-- Status Filter -->
            <div class="status-filter">
                <select id="status-filter">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <!-- Date Range Filter -->
            <div class="date-filter">
                <input type="date" id="date-from" placeholder="From Date">
                <input type="date" id="date-to" placeholder="To Date">
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="card">
        <table class="w-full">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="orders-table-body">
                <!-- Orders will be populated by JS -->
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination mt-4">
            <!-- Pagination will be handled by JS -->
        </div>
    </div>
</div>

<!-- Order Details Modal -->
<div id="order-modal" class="modal hidden">
    <div class="modal-content">
        <h2 class="font-heading text-2xl mb-6">Order Details</h2>
        <div id="order-details">
            <!-- Order details will be populated by JS -->
        </div>
        <div class="mt-6">
            <h3 class="font-heading text-xl mb-4">Update Status</h3>
            <form id="status-form" class="flex gap-4">
                <select id="new-status" class="flex-grow">
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

<?php
require '../partials/footer.php';
?> 