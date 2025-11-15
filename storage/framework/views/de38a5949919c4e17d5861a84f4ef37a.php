

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="dashboard">
        <h1>Dashboard Pengguna</h1>
        <p>Selamat datang, <?php echo e(Auth::user()->name); ?>!</p>
        
        <div class="dashboard-stats">
            <div class="stat-card">
                <h3>Kursus Terdaftar</h3>
                <p>5 kursus</p>
            </div>
            <div class="stat-card">
                <h3>Buku Dipinjam</h3>
                <p>2 buku</p>
            </div>
            <div class="stat-card">
                <h3>Progress Belajar</h3>
                <p>75%</p>
            </div>
        </div>
        
        <div class="dashboard-content">
            <h2>Kursus Terbaru</h2>
            <div class="courses-grid">
                <div class="course-card">
                    <div class="course-img">
                        <img src="<?php echo e(asset('images/course-placeholder.jpg')); ?>" alt="Kursus">
                    </div>
                    <div class="course-content">
                        <h3>Pemrograman Dasar Python</h3>
                        <span class="course-level">Pemula</span>
                        <div class="course-meta">
                            <span>327 siswa</span>
                            <span>28 pelajaran</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 60%"></div>
                        </div>
                        <a href="#" class="btn btn-primary">Lanjutkan Belajar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Hype\ruangkasep\resources\views/pages/dashboard.blade.php ENDPATH**/ ?>