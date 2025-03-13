</main>
    <footer class="bg-clay-dark text-white pt-12 pb-6">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- About Section -->
                <div>
                    <h3 class="font-heading text-xl mb-4">Sundarta<span class="text-primary">.</span></h3>
                    <p class="mb-4 text-sm opacity-80">Discover the essence of natural beauty and wellness with Sundarta. We bring you high-quality, ethically sourced products and services.</p>
                    <div class="social-links mt-4">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="font-heading text-xl mb-4">Quick Links</h3>
                    <ul class="footer-list">
                        <li><a href="/sundarta/about">About Us</a></li>
                        <li><a href="/sundarta/products">Products</a></li>
                        <li><a href="/sundarta/services">Services</a></li>
                        <li><a href="/sundarta/blog">Blog</a></li>
                        <li><a href="/sundarta/contact">Contact Us</a></li>
                    </ul>
                </div>
                
                <!-- Customer Service -->
                <div>
                    <h3 class="font-heading text-xl mb-4">Customer Service</h3>
                    <ul class="footer-list">
                        <li><a href="/sundarta/faq">FAQ</a></li>
                        <li><a href="/sundarta/shipping">Shipping & Returns</a></li>
                        <li><a href="/sundarta/terms">Terms & Conditions</a></li>
                        <li><a href="/sundarta/privacy">Privacy Policy</a></li>
                    </ul>
                </div>
                
                <!-- Newsletter -->
                <div>
                    <h3 class="font-heading text-xl mb-4">Subscribe</h3>
                    <p class="mb-4 text-sm opacity-80">Stay updated with our latest products, services, and exclusive offers.</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Your Email Address" class="newsletter-input" required>
                        <button type="submit" class="newsletter-btn">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Divider -->
            <hr class="my-8 border-clay opacity-30">
            
            <!-- Bottom Footer -->
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-sm opacity-70 mb-4 md:mb-0">
                    &copy; <?php echo date('Y'); ?> Sundarta. All rights reserved.
                </div>
                <div class="flex gap-4">
                    <img src="https://via.placeholder.com/40x25/f8f9fa/6c757d?text=VISA" alt="Visa" class="h-6">
                    <img src="https://via.placeholder.com/40x25/f8f9fa/6c757d?text=MC" alt="MasterCard" class="h-6">
                    <img src="https://via.placeholder.com/40x25/f8f9fa/6c757d?text=AMEX" alt="American Express" class="h-6">
                    <img src="https://via.placeholder.com/40x25/f8f9fa/6c757d?text=PAY" alt="PayPal" class="h-6">
                </div>
            </div>
        </div>
        
        <!-- Back to Top Button -->
        <button id="back-to-top" class="fixed bottom-6 right-6 p-3 bg-primary text-white rounded-full shadow-lg hover:bg-primary-light transition-all hidden z-50">
            <i class="fas fa-arrow-up"></i>
        </button>
    </footer>
    
    <script src="/sundarta/assets/js/script.js"></script>
    <script src="/assets/js/utils/charts.js"></script> <!-- Only needed for admin dashboard -->
    <script src="/assets/js/utils/validation.js"></script>
    <script src="/assets/js/utils/ui.js"></script>
    <script src="/assets/js/utils/price.js"></script>
    <script src="/assets/js/utils/pagination.js"></script>
    <script src="/assets/js/utils/filters.js"></script>
    <script>
        // Initialize toggle functionality for search and user dropdown
        document.getElementById('search-toggle').addEventListener('change', function() {
            document.getElementById('search-container').classList.toggle('hidden', !this.checked);
        });
        
        <?php if (isLoggedIn()): ?>
        document.getElementById('user-toggle').addEventListener('change', function() {
            document.getElementById('user-dropdown').classList.toggle('hidden', !this.checked);
        });
        <?php endif; ?>
    </script>
</body>
</html>