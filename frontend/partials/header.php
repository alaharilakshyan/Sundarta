<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sundarta - Beauty and Wellness</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link href="/sundarta/assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-background font-main">
    <header class="bg-surface shadow-md">
        <div class="container mx-auto px-6 py-2">            
            <!-- Main Navigation -->
            <nav class="flex justify-between items-center py-2">
                <div class="flex items-center">
                    <a href="/sundarta/" class="font-heading text-2xl font-bold text-primary">
                        Sundarta<span class="text-secondary">.</span>
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center gap-6">
                    <a href="/sundarta/" class="nav-link">Home</a>
                    <a href="/sundarta/products" class="nav-link">Products</a>
                    <a href="/sundarta/services" class="nav-link">Services</a>
                    <a href="/sundarta/about" class="nav-link">About Us</a>
                    <a href="/sundarta/contact" class="nav-link">Contact</a>
                </div>
                
                <!-- Navigation Icons -->
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <input type="checkbox" id="search-toggle" class="hidden">
                        <label for="search-toggle" class="cursor-pointer text-text-light hover:text-primary transition-colors">
                            <i class="fas fa-search"></i>
                        </label>
                        <div id="search-container" class="absolute right-0 top-full mt-2 w-64 bg-surface p-2 rounded-md shadow-lg hidden">
                            <div class="search-box">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" class="search-input" placeholder="Search...">
                            </div>
                        </div>
                    </div>
                    
                    <a href="/sundarta/cart" class="relative text-text-light hover:text-primary transition-colors">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="absolute -top-2 -right-2 bg-primary text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">0</span>
                    </a>
                    
                    <?php if (isLoggedIn()): ?>
                        <div class="relative">
                            <input type="checkbox" id="user-toggle" class="hidden">
                            <label for="user-toggle" class="cursor-pointer text-text-light hover:text-primary transition-colors">
                                <i class="fas fa-user-circle"></i>
                            </label>
                            <div id="user-dropdown" class="absolute right-0 top-full mt-2 w-48 bg-surface rounded-md shadow-lg hidden">
                                <div class="p-3 border-b border-gray-200">
                                    <span class="block font-semibold">Hello, <?php echo $_SESSION['username']; ?></span>
                                </div>
                                <ul class="py-2">
                                    <li><a href="/sundarta/profile" class="block px-4 py-2 hover:bg-sand-light">My Profile</a></li>
                                    <li><a href="/sundarta/orders" class="block px-4 py-2 hover:bg-sand-light">My Orders</a></li>
                                    <li><a href="/sundarta/logout" class="block px-4 py-2 hover:bg-sand-light">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="/sundarta/login" class="text-text-light hover:text-primary transition-colors">
                            <i class="fas fa-sign-in-alt"></i>
                        </a>
                    <?php endif; ?>
                    
                    <!-- Mobile Menu Toggle -->
                    <button id="mobile-menu-btn" class="block md:hidden text-text-light hover:text-primary">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </nav>
            
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200 py-3">
                <div class="flex flex-col gap-3">
                    <a href="/sundarta/" class="block py-2 hover:text-primary">Home</a>
                    <a href="/sundarta/products" class="block py-2 hover:text-primary">Products</a>
                    <a href="/sundarta/services" class="block py-2 hover:text-primary">Services</a>
                    <a href="/sundarta/about" class="block py-2 hover:text-primary">About Us</a>
                    <a href="/sundarta/contact" class="block py-2 hover:text-primary">Contact</a>
                    <?php if (!isLoggedIn()): ?>
                        <a href="/sundarta/login" class="block py-2 hover:text-primary">Login</a>
                        <a href="/sundarta/register" class="block py-2 hover:text-primary">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    
    <main class="container mx-auto px-6 py-8">
