<?php
require_once __DIR__ . '/../backend/helpers/auth.php';
require 'partials/header.php';
?>

<div class="container mx-auto px-4 py-8">
    <!-- Hero Section -->
    <div class="text-center mb-16">
        <h1 class="font-heading text-4xl md:text-5xl mb-4">About Sundarta</h1>
        <p class="text-text-light text-lg max-w-2xl mx-auto">Discover the story behind India's premier beauty and wellness destination, where traditional wisdom meets modern innovation.</p>
    </div>

    <!-- Our Story Section -->
    <section class="mb-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="font-heading text-3xl mb-6">Our Story</h2>
                <p class="text-text-light mb-4">Founded in 2024, Sundarta was born from a vision to make authentic Indian beauty and wellness practices accessible to everyone. Our name, derived from Sanskrit, means "beautiful" – reflecting our commitment to helping people discover their natural beauty.</p>
                <p class="text-text-light mb-4">We believe in the power of traditional Indian ingredients and practices, carefully curated and combined with modern science to create products and services that truly work.</p>
                <p class="text-text-light">Today, we're proud to serve thousands of customers across India, helping them embrace natural beauty and holistic wellness through our carefully selected products and expert services.</p>
            </div>
            <div class="relative">
                <img src="https://img.freepik.com/free-photo/lifestyle-beauty-fashion-people-emotions-concept-young-asian-female-office-manager-ceo-with-pleased-expression-standing-white-background-smiling-with-arms-crossed-chest_1258-59329.jpg" alt="Sundarta Story" class="rounded-lg shadow-xl">
                <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-primary rounded-full opacity-20"></div>
            </div>
        </div>
    </section>

    <!-- Mission & Values Section -->
    <section class="mb-16 bg-surface rounded-lg p-8">
        <div class="text-center mb-12">
            <h2 class="font-heading text-3xl mb-4">Our Mission & Values</h2>
            <p class="text-text-light max-w-2xl mx-auto">We're guided by our commitment to authenticity, sustainability, and customer well-being.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="text-primary text-4xl mb-4">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3 class="font-heading text-xl mb-2">Natural & Pure</h3>
                <p class="text-text-light">We source the purest ingredients and maintain the highest standards of quality in all our products and services.</p>
            </div>

            <div class="text-center">
                <div class="text-primary text-4xl mb-4">
                    <i class="fas fa-heart"></i>
                </div>
                <h3 class="font-heading text-xl mb-2">Customer First</h3>
                <p class="text-text-light">Your satisfaction and well-being are our top priorities. We're here to help you look and feel your best.</p>
            </div>

            <div class="text-center">
                <div class="text-primary text-4xl mb-4">
                    <i class="fas fa-seedling"></i>
                </div>
                <h3 class="font-heading text-xl mb-2">Sustainability</h3>
                <p class="text-text-light">We're committed to environmental responsibility in our sourcing, packaging, and operations.</p>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="mb-16">
        <div class="text-center mb-12">
            <h2 class="font-heading text-3xl mb-4">Meet Our Team</h2>
            <p class="text-text-light max-w-2xl mx-auto">The passionate individuals behind Sundarta who work tirelessly to bring you the best in beauty and wellness.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="text-center">
                <img src="https://img.freepik.com/free-photo/young-beautiful-woman-pink-warm-sweater-natural-look-smiling-portrait-isolated-long-hair_285396-896.jpg" alt="Team Member" class="w-48 h-48 rounded-full mx-auto mb-4 object-cover">
                <h3 class="font-heading text-xl mb-1">Priya Sharma</h3>
                <p class="text-primary mb-2">Founder & CEO</p>
                <p class="text-text-light">With 15 years of experience in Ayurvedic beauty practices, Priya leads our vision for natural beauty.</p>
            </div>

            <div class="text-center">
                <img src="https://img.freepik.com/free-photo/portrait-young-indian-top-manager-t-shirt-tie-crossed-arms-smiling-white-isolated-wall_496169-1513.jpg" alt="Team Member" class="w-48 h-48 rounded-full mx-auto mb-4 object-cover">
                <h3 class="font-heading text-xl mb-1">Rahul Mehta</h3>
                <p class="text-primary mb-2">Head of Product Development</p>
                <p class="text-text-light">A certified Ayurvedic practitioner who ensures our products meet the highest standards.</p>
            </div>

            <div class="text-center">
                <img src="https://img.freepik.com/free-photo/young-beautiful-woman-pink-warm-sweater-natural-look-smiling-portrait-isolated-long-hair_285396-896.jpg" alt="Team Member" class="w-48 h-48 rounded-full mx-auto mb-4 object-cover">
                <h3 class="font-heading text-xl mb-1">Anjali Patel</h3>
                <p class="text-primary mb-2">Wellness Expert</p>
                <p class="text-text-light">Specializes in creating holistic wellness experiences for our service offerings.</p>
            </div>
        </div>
    </section>

    <!-- Join Us Section -->
    <section class="text-center bg-sand-light bg-opacity-10 rounded-lg p-12">
        <h2 class="font-heading text-3xl mb-4">Join Our Journey</h2>
        <p class="text-text-light mb-8 max-w-2xl mx-auto">Be part of our mission to revolutionize beauty and wellness through natural, traditional practices.</p>
        <div class="flex justify-center gap-4">
            <a href="/sundarta/contact" class="btn btn-primary">Contact Us</a>
            <a href="/sundarta/register" class="btn btn-outline">Join Now</a>
        </div>
    </section>
</div>

<?php
require 'partials/footer.php';
?> 