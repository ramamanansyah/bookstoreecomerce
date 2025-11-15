

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="blog-container">
        <div class="blog-header">
            <h1>Blog CMS</h1>
            <a href="<?php echo e(route('blog.create')); ?>" class="btn btn-primary">Tambah Post Baru</a>
        </div>
        
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        
        <div class="blog-posts">
            <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="blog-post-card">
                <h3><?php echo e($post->title); ?></h3>
                <p class="post-excerpt"><?php echo e($post->excerpt); ?></p>
                <div class="post-meta">
                    <span>Status: <strong><?php echo e(ucfirst($post->status)); ?></strong></span>
                    <span>Oleh: <?php echo e($post->author->name); ?></span>
                    <span><?php echo e($post->created_at->format('d M Y H:i')); ?></span>
                </div>
                <div class="post-actions">
                    <a href="<?php echo e(route('blog.edit', $post->id)); ?>" class="btn btn-secondary">Edit</a>
                    <form action="<?php echo e(route('blog.destroy', $post->id)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus post ini?')">Hapus</button>
                    </form>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p>Tidak ada post tersedia.</p>
            <?php endif; ?>
        </div>
        
        <div class="pagination">
            <?php echo e($posts->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Hype\ruangkasep\resources\views/blog/index.blade.php ENDPATH**/ ?>