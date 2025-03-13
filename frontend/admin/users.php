<?php
/**
 * Admin Users Management
 * 
 * This page manages all users in the system.
 * It integrates with the following API endpoints:
 * - GET /api/users - Get all users
 * - PUT /api/users/{id} - Update user status/role
 * - DELETE /api/users/{id} - Delete user
 * 
 * Required JS Modules:
 * - modules/admin/users.js - Handles user management
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
        <h1 class="font-heading text-3xl">Users Management</h1>
        <button id="add-user-btn" class="btn btn-primary">Add New User</button>
    </div>

    <!-- Filters -->
    <div class="card mb-8">
        <div class="filters-container">
            <!-- Search -->
            <div class="search-box">
                <input type="text" id="user-search" placeholder="Search users...">
            </div>

            <!-- Role Filter -->
            <div class="role-filter">
                <select id="role-filter">
                    <option value="">All Roles</option>
                    <option value="admin">Admin</option>
                    <option value="customer">Customer</option>
                    <option value="seller">Service Provider</option>
                </select>
            </div>

            <!-- Status Filter -->
            <div class="status-filter">
                <select id="status-filter">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="banned">Banned</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="card">
        <table class="w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="users-table-body">
                <!-- Users will be populated by JS -->
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination mt-4">
            <!-- Pagination will be handled by JS -->
        </div>
    </div>
</div>

<!-- Add/Edit User Modal -->
<div id="user-modal" class="modal hidden">
    <div class="modal-content">
        <h2 class="font-heading text-2xl mb-6">Add/Edit User</h2>
        <form id="user-form">
            <!-- User form fields will be populated by JS -->
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="modal hidden">
    <div class="modal-content">
        <h2 class="font-heading text-2xl mb-6">Delete User</h2>
        <p>Are you sure you want to delete this user? This action cannot be undone.</p>
        <div class="flex justify-end gap-4 mt-6">
            <button id="cancel-delete" class="btn btn-outline">Cancel</button>
            <button id="confirm-delete" class="btn btn-danger">Delete</button>
        </div>
    </div>
</div>

<?php
require '../partials/footer.php';
?>