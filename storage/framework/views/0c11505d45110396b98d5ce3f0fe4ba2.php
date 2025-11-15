<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RUANGKASEP</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <link rel="icon" href="<?php echo e(asset('images/favicon.ico')); ?>" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <nav class="navbar">
                <div class="logo">RUANGKASEP</div>
                           <!-- Tambahkan link blog di navbar -->
<ul class="nav-links">
    <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
    <li><a href="<?php echo e(route('courses')); ?>">Courses</a></li>
    <li><a href="<?php echo e(route('books')); ?>">Books</a></li>
    <li><a href="<?php echo e(route('faq')); ?>">FAQ</a></li>
    <li><a href="<?php echo e(route('testimonials')); ?>">Testimonials</a></li>
    <li><a href="<?php echo e(route('blog.public')); ?>">Blog</a></li> <!-- Tambahkan ini -->
 
</ul>
                <div class="auth-buttons">
                    <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('login')); ?>" class="login-btn">Login</a>
                        <a href="<?php echo e(route('register')); ?>" class="register-btn">Register</a>
                    <?php else: ?>
                        <div class="user-dropdown">
                            <button class="user-btn">
                                <i class="fas fa-user"></i> <?php echo e(Auth::user()->name); ?>

                            </button>
                            <div class="dropdown-menu">
                                <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
                                <a href="<?php echo e(route('profile')); ?>">Profile</a>
                                <?php if(Auth::user()->isAdmin()): ?>
                                    <a href="<?php echo e(route('blog')); ?>">Blog CMS</a>
                                <?php endif; ?>
                                <a href="<?php echo e(route('logout')); ?>" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </div>
                        </div>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column">
                    <h3>RUANGKASEP</h3>
                    <p>Brand edukasi digital yang didirikan oleh Asep Surahmat untuk meningkatkan literasi digital di Indonesia.</p>
                </div>
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                        <li><a href="<?php echo e(route('courses')); ?>">Courses</a></li>
                        <li><a href="<?php echo e(route('books')); ?>">Books</a></li>
                        <li><a href="<?php echo e(route('faq')); ?>">FAQ</a></li>

                        <li><a href="<?php echo e(route('blog.public')); ?>">Blog</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <ul>
                        <li>Email: info@ruangkasep.com</li>
                        <li>Phone: +62 812 3456 7890</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 RUANGKASEP. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
</body>
</html><?php /**PATH C:\Users\Hype\ruangkasep\resources\views/layouts/app.blade.php ENDPATH**/ ?>