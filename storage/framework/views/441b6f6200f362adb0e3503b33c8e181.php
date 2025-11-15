

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="blog-public-container">
        <div class="blog-header">
            <h1>Blog & Artikel</h1>
            <p></p>
        </div>
        
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        
        <div class="blog-posts-grid">
            <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <article class="blog-post-card">
                <div class="blog-post-image-wrapper">
                    <?php if($post->featured_image): ?>
                        <img src="<?php echo e(asset('storage/' . $post->featured_image)); ?>" alt="<?php echo e($post->title); ?>" class="blog-post-image">
                    <?php else: ?>
                        <img src="<?php echo e(asset('images/default-blog-image.jpg')); ?>" alt="<?php echo e($post->title); ?>" class="blog-post-image">
                    <?php endif; ?>
                </div>
                <div class="blog-post-content">
                    <div class="blog-post-meta">
                        <span class="post-date"><?php echo e($post->created_at->format('d M Y')); ?></span>
                        <span class="post-author">Oleh <?php echo e($post->author->name); ?></span>
                    </div>
                    <h2 class="blog-post-title">
                        <a href="<?php echo e(route('blog.public.show', $post->id)); ?>"><?php echo e($post->title); ?></a>
                    </h2>
                    <p class="blog-post-excerpt"><?php echo e($post->excerpt); ?></p>
                    <div class="blog-post-footer">
                        <a href="<?php echo e(route('blog.public.show', $post->id)); ?>" class="read-more-btn">Baca Selengkapnya</a>
                    </div>
                </div>
            </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="no-posts">
                <p>Tidak ada artikel yang tersedia.</p>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="pagination-wrapper">
            <?php echo e($posts->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Hype\ruangkasep\resources\views/blog/public-index.blade.php ENDPATH**/ ?>