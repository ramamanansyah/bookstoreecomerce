

<?php $__env->startSection('content'); ?>
<br>
<br>
<br>

<div class="container">
    <h1 class="text-center mb-8">Testimoni Member RUANGKASEP</h1>
    
    <div class="testimonials-grid">
        <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="testimonial-card">
            <div class="testimonial-content">
                "<?php echo e($testimonial->content); ?>"
            </div>
            <div class="testimonial-author">
                <div class="author-avatar">A</div>
                <div class="author-info">
                    <h4><?php echo e($testimonial->name); ?></h4>
                    <p><?php echo e($testimonial->role); ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Hype\ruangkasep\resources\views/pages/testimonials.blade.php ENDPATH**/ ?>