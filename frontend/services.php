<?php
/**
 * Services Page
 * 
 * This page displays all available services with filtering and search capabilities.
 * It integrates with the following API endpoints:
 * - GET /api/services - List all services with pagination
 * - GET /api/services/search - Search services
 * - GET /api/services/category - Filter services by category
 * - GET /api/categories - Get all categories for filtering
 * 
 * Required JS Modules:
 * - modules/services.js - Handles service listing and filtering
 * - utils/pagination.js - Handles pagination
 * - utils/filters.js - Handles filter UI and state
 */

require_once __DIR__ . '/../backend/helpers/auth.php';
require 'partials/header.php';
?>

<div class="container mx-auto py-8">
    <!-- Service Filters Section -->
    <div class="filters-container">
        <!-- Category filter will be populated by JS -->
    </div>

    <!-- Services Grid -->
    <div class="services-grid">
        <!-- Services will be populated by JS -->
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <!-- Pagination will be handled by JS -->
    </div>
</div>

<?php
require 'partials/footer.php';
?> 