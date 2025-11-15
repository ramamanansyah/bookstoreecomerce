

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="courses-page">
        <div class="courses-header">
            <h1>E-Course</h1>
            <div class="courses-actions">
                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->isAdmin()): ?>
                        <a href="<?php echo e(route('courses.create')); ?>" class="btn btn-primary">Tambah Course Baru</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        
        <div class="courses-grid">
            <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="course-card">
                <div class="course-image">
                    <?php if($course->image_path): ?>
                        <img src="<?php echo e(asset('storage/' . $course->image_path)); ?>" alt="<?php echo e($course->title); ?>">
                    <?php else: ?>
                        <div class="course-placeholder">Gambar Course</div>
                    <?php endif; ?>
                </div>
                <div class="course-content">
                    <h3><?php echo e($course->title); ?></h3>
                    <span class="course-level"><?php echo e($course->level); ?></span>
                    <div class="course-meta">
                        <span><?php echo e($course->students_count); ?> siswa</span>
                        <span><?php echo e($course->lessons_count); ?> pelajaran</span>
                    </div>
                    <div class="course-price">
                        <?php if($course->price): ?>
                            Rp<?php echo e(number_format($course->price, 0, ',', '.')); ?>

                        <?php else: ?>
                            Gratis
                        <?php endif; ?>
                    </div>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(Auth::user()->isAdmin()): ?>
                            <div class="course-admin-actions">
                                <a href="<?php echo e(route('courses.edit', $course->id)); ?>" class="btn btn-secondary btn-sm">Edit</a>
                                <form action="<?php echo e(route('courses.destroy', $course->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus course ini?')">Hapus</button>
                                </form>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="no-courses">
                <p>Tidak ada course tersedia.</p>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="pagination">
            <?php echo e($courses->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Hype\ruangkasep\resources\views/courses/index.blade.php ENDPATH**/ ?>