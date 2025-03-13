<?php
/**
 * Service Detail Page
 * 
 * This page displays detailed information about a specific service.
 * It integrates with the following API endpoints:
 * - GET /api/services/detail - Get service details
 * - GET /api/reviews/service - Get service reviews
 * - POST /api/reviews/service - Add service review (authenticated users only)
 * - POST /api/cart/item - Add service to cart
 * 
 * Required JS Modules:
 * - modules/service-detail.js - Handles service detail view
 * - modules/reviews.js - Handles review display and submission
 * - modules/cart.js - Handles add to cart functionality
 * - utils/gallery.js - Handles service image gallery
 */

require_once __DIR__ . '/../backend/helpers/auth.php';
require 'partials/header.php';

// Get service ID from URL parameter
$service_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>

<div class="container mx-auto py-8">
    <!-- Service Details Section -->
    <div class="service-detail">
        <!-- Will be populated by JS -->
    </div>

    <!-- Provider Information -->
    <div class="provider-info">
        <!-- Will be populated by JS -->
    </div>

    <!-- Reviews Section -->
    <div class="reviews-section">
        <!-- Will be populated by JS -->
    </div>

    <!-- Review Form (for authenticated users) -->
    <div class="review-form">
        <!-- Will be populated by JS if user is authenticated -->
    </div>
</div>

<?php
require 'partials/footer.php';
?> 