<?php
/**
 * Admin Dashboard
 * 
 * This page displays the main admin dashboard with statistics and quick actions.
 * It integrates with the following API endpoints:
 * - GET /api/orders/statistics - Get order statistics
 * - GET /api/products - Get recent products
 * - GET /api/services - Get recent services
 * - GET /api/orders - Get recent orders
 * - GET /api/users - Get recent users
 * 
 * Required JS Modules:
 * - modules/admin/dashboard.js - Handles dashboard functionality
 * - utils/charts.js - Renders statistics charts
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
    <h1 class="font-heading text-3xl mb-8">Admin Dashboard</h1>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="stat-card">
            <h3>Total Orders</h3>
            <div class="stat-value" id="total-orders">Loading...</div>
        </div>
        <div class="stat-card">
            <h3>Total Revenue</h3>
            <div class="stat-value" id="total-revenue">Loading...</div>
        </div>
        <div class="stat-card">
            <h3>Active Users</h3>
            <div class="stat-value" id="active-users">Loading...</div>
        </div>
        <div class="stat-card">
            <h3>Total Products</h3>
            <div class="stat-value" id="total-products">Loading...</div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Revenue Chart -->
        <div class="card">
            <h3 class="font-heading text-xl mb-4">Revenue Overview</h3>
            <canvas id="revenue-chart"></canvas>
        </div>

        <!-- Orders Chart -->
        <div class="card">
            <h3 class="font-heading text-xl mb-4">Order Statistics</h3>
            <canvas id="orders-chart"></canvas>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Orders -->
        <div class="card">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-heading text-xl">Recent Orders</h3>
                <a href="/sundarta/admin/orders" class="text-primary hover:text-primary-dark">View All</a>
            </div>
            <div class="recent-orders">
                <!-- Will be populated by JS -->
            </div>
        </div>

        <!-- Recent Users -->
        <div class="card">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-heading text-xl">Recent Users</h3>
                <a href="/sundarta/admin/users" class="text-primary hover:text-primary-dark">View All</a>
            </div>
            <div class="recent-users">
                <!-- Will be populated by JS -->
            </div>
        </div>
    </div>
</div>

<?php
require '../partials/footer.php';
?> 