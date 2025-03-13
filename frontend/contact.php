<?php
require_once __DIR__ . '/../backend/helpers/auth.php';
require 'partials/header.php';
?>

<div class="container mx-auto px-4 py-8">
    <!-- Hero Section -->
    <div class="text-center mb-16">
        <h1 class="font-heading text-4xl md:text-5xl mb-4">Contact Us</h1>
        <p class="text-text-light text-lg max-w-2xl mx-auto">Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Contact Form -->
        <div class="bg-surface rounded-lg p-8">
            <h2 class="font-heading text-2xl mb-6">Send us a Message</h2>
            
            <form id="contact-form" class="space-y-6">
                <div class="input-group">
                    <label for="name" class="input-label">Your Name</label>
                    <input type="text" id="name" name="name" class="input-text" required>
                </div>

                <div class="input-group">
                    <label for="email" class="input-label">Email Address</label>
                    <input type="email" id="email" name="email" class="input-text" required>
                </div>

                <div class="input-group">
                    <label for="phone" class="input-label">Phone Number</label>
                    <input type="tel" id="phone" name="phone" class="input-text">
                </div>

                <div class="input-group">
                    <label for="subject" class="input-label">Subject</label>
                    <select id="subject" name="subject" class="input-text" required>
                        <option value="">Select a subject</option>
                        <option value="general">General Inquiry</option>
                        <option value="product">Product Question</option>
                        <option value="service">Service Question</option>
                        <option value="support">Customer Support</option>
                        <option value="business">Business Partnership</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="message" class="input-label">Your Message</label>
                    <textarea id="message" name="message" rows="5" class="input-text" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-full">Send Message</button>
            </form>
        </div>

        <!-- Contact Information -->
        <div>
            <h2 class="font-heading text-2xl mb-6">Get in Touch</h2>
            
            <!-- Contact Cards -->
            <div class="grid gap-6">
                <div class="p-6 bg-surface rounded-lg">
                    <div class="text-primary text-2xl mb-4">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3 class="font-heading text-xl mb-2">Visit Us</h3>
                    <p class="text-text-light">123 Beauty Lane, Wellness District</p>
                    <p class="text-text-light">Mumbai, Maharashtra 400001</p>
                </div>

                <div class="p-6 bg-surface rounded-lg">
                    <div class="text-primary text-2xl mb-4">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h3 class="font-heading text-xl mb-2">Call Us</h3>
                    <p class="text-text-light">Customer Support: +91 1234567890</p>
                    <p class="text-text-light">Business Inquiries: +91 9876543210</p>
                </div>

                <div class="p-6 bg-surface rounded-lg">
                    <div class="text-primary text-2xl mb-4">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3 class="font-heading text-xl mb-2">Email Us</h3>
                    <p class="text-text-light">Customer Support: support@sundarta.com</p>
                    <p class="text-text-light">Business: business@sundarta.com</p>
                </div>

                <div class="p-6 bg-surface rounded-lg">
                    <div class="text-primary text-2xl mb-4">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="font-heading text-xl mb-2">Business Hours</h3>
                    <p class="text-text-light">Monday - Friday: 9:00 AM - 8:00 PM</p>
                    <p class="text-text-light">Saturday: 10:00 AM - 6:00 PM</p>
                    <p class="text-text-light">Sunday: Closed</p>
                </div>
            </div>

            <!-- Social Media Links -->
            <div class="mt-8">
                <h3 class="font-heading text-xl mb-4">Follow Us</h3>
                <div class="flex gap-4">
                    <a href="#" class="text-2xl text-primary hover:text-primary-dark transition-colors">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="text-2xl text-primary hover:text-primary-dark transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-2xl text-primary hover:text-primary-dark transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-2xl text-primary hover:text-primary-dark transition-colors">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <section class="mt-16">
        <h2 class="font-heading text-2xl mb-6">Our Location</h2>
        <div class="w-full h-96 bg-surface rounded-lg overflow-hidden">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3806.41887795898!2d78.4429782!3d17.4396543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb90c51b90639b%3A0xb3468113a448a6b0!2sLovely%20Professional%20University%20Counselling%20Office!5e0!3m2!1sen!2sin!4v1741895546853!5m2!1sen!2sin" 
                class="w-full h-full"
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>
</div>

<script>
document.getElementById('contact-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    try {
        const formData = new FormData(this);
        const response = await fetch('/api/contact/submit', {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            showAlert('Message sent successfully! We\'ll get back to you soon.', 'success');
            this.reset();
        } else {
            showAlert(data.message || 'Failed to send message. Please try again.', 'error');
        }
    } catch (error) {
        showAlert('An error occurred. Please try again later.', 'error');
    }
});

function showAlert(message, type) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} fixed top-4 right-4 z-50`;
    alertDiv.textContent = message;
    
    document.body.appendChild(alertDiv);
    
    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
}
</script>

<?php
require 'partials/footer.php';
?> 