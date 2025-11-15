

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<section class="hero">
    <div class="container hero-content">
        <h1>Bersiap Untuk Era Digital</h1>
        <h2>Build & Upgrade Your Digital Skill From Now</h2>
        <p>Belajar keterampilan digital yang relevan untuk masa depan</p>
        <div class="hero-buttons">
            <a href="<?php echo e(route('courses')); ?>" class="btn btn-primary">Mulai Belajar</a>
            <a href="<?php echo e(route('faq')); ?>" class="btn btn-secondary">Pelajari Lebih Lanjut</a>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <h3>7K+</h3>
                <p>Member Eksklusif</p>
            </div>
            <div class="stat-item">
                <h3>100+</h3>
                <p>Kelas</p>
            </div>
            <div class="stat-item">
                <h3>4.85</h3>
                <p>Rating</p>
            </div>
            <div class="stat-item">
                <h3>50+</h3>
                <p>Buku IT</p>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features">
    <div class="container">
        <h2 class="text-center">Keunggulan RUANGKASEP</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253"></svg>
                    </div>
                    <h3>Bimbingan Langsung</h3>
                    <p>Mendapatkan bimbingan langsung dari instruktur berpengalaman</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></svg>
                        </div>
                        <h3>Investasi Terjangkau</h3>
                        <p>Harga terjangkau untuk kualitas pendidikan berkualitas tinggi</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></svg>
                            </div>
                            <h3>Modul Lengkap</h3>
                            <p>Materi lengkap dalam bentuk video dan dokumen PDF</p>
                        </div>
                    </div>
                </section>

                <!-- Courses Section -->
                <section class="courses-section">
                    <div class="container">
                        <h2 class="text-center">Top E-Course</h2>
                        <p class="text-center">Kursus Populer</p>
                        <div class="courses-grid">
                            <?php $__currentLoopData = $featuredCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="course-card">
                                <div class="course-img">
                                    <img src="<?php echo e(asset('images/course-placeholder.jpg')); ?>" alt="<?php echo e($course->title); ?>">
                                </div>
                                <div class="course-content">
                                    <h3><?php echo e($course->title); ?></h3>
                                    <span class="course-level"><?php echo e($course->level); ?></span>
                                    <div class="course-meta">
                                        <span><?php echo e($course->students_count); ?> siswa</span>
                                        <span><?php echo e($course->lessons_count); ?> pelajaran</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 60%"></div>
                                    </div>
                                    <a href="#" class="btn btn-primary">Lihat Detail</a>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </section>

                <!-- Books Section -->
                <section class="books-section">
                    <div class="container">
                        <h2 class="text-center">Top E-Book & Buku</h2>
                        <p class="text-center">Buku Terlaris</p>
                        <div class="books-grid">
                            <?php $__currentLoopData = $topBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="book-card">
                                <div class="book-img">
                                    <img src="<?php echo e(asset('images/book-placeholder.jpg')); ?>" alt="<?php echo e($book->title); ?>">
                                </div>
                                <div class="book-content">
                                    <h3><?php echo e($book->title); ?></h3>
                                    <p class="book-author"><?php echo e($book->author); ?></p>
                                    <div class="book-rating">
                                        <?php for($i=1; $i<=5; $i++): ?>
                                            <?php if($i <= $book->rating): ?>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            <?php else: ?>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <span>(<?php echo e($book->review_count); ?>)</span>
                                    </div>
                                    <div class="book-meta">
                                        <span>Rp<?php echo e(number_format($book->price, 0, ',', '.')); ?></span>
                                    </div>
                                    <a href="#" class="btn btn-primary">Lihat Detail</a>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </section>

                <!-- Partners Section -->
                <section class="partners-section">
                    <div class="container">
                        <h2 class="text-center">Partner Kami</h2>
                        <p class="text-center">Mitras Edukasi</p>
                        <div class="partners-grid">
                            <img src="https://oyusep.com/wp-content/uploads/2025/07/dac-new-3-blue-687f54ccac530-1.webp" alt="Partner 1" class="partner-logo">
                            <img src="https://oyusep.com/wp-content/uploads/2025/07/logo-tokopedia-687f554c2e34c-1.webp" alt="Partner 2" class="partner-logo">
                            <img src="https://oyusep.com/wp-content/uploads/2025/07/1657519296-logo-1-4-1-1-687f54ccb36a5-1.webp" alt="Partner 3" class="partner-logo">
                            <img src="https://oyusep.com/wp-content/uploads/2025/07/e-belajar-logo-copy-pvdrvre43wpivxoy5uob8t5d42vi8fs485wduhh8u8-1-687f54cd4da85-1.webp" alt="Partner 4" class="partner-logo">
                            <img src="https://oyusep.com/wp-content/uploads/2025/07/telkomsel-logo-687f554bee1cc-1-scaled.webp" alt="Partner 5" class="partner-logo">
                            <img src="https://oyusep.com/wp-content/uploads/2025/07/1280px-pertamina-logosvg-687f567dd9b0e.webp" alt="Partner 6" class="partner-logo">
                        </div>
                    </div>
                </section>

                <!-- Testimonials Section -->
                <section class="testimonials-section">
                    <div class="container">
                        <h2 class="text-center">Testimoni Edukasi</h2>
                        <p class="text-center">Pendapat Member RUANGKASEP</p>
                        <div class="testimonials-grid">
                            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="testimonial-card">
                                <div class="testimonial-content">
                                    "<?php echo e($testimonial->content); ?>"
                                </div>
                                <div class="testimonial-author">
                                    <div class="author-avatar"><?php echo e(substr($testimonial->name, 0, 1)); ?></div>
                                    <div class="author-info">
                                        <h4><?php echo e($testimonial->name); ?></h4>
                                        <p><?php echo e($testimonial->role); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </section>
                <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Hype\ruangkasep\resources\views/pages/home.blade.php ENDPATH**/ ?>