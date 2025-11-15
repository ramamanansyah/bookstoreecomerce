

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="books-page">
        <div class="books-header">
            <h1>E-Book & Buku</h1>
            <div class="books-actions">
                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->isAdmin()): ?>
                        <a href="<?php echo e(route('books.create')); ?>" class="btn btn-primary">Tambah Buku Baru</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        
        <div class="books-grid">
            <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="book-card">
                <div class="book-image">
                    <?php if($book->cover_image): ?>
                        <img src="<?php echo e(asset('storage/' . $book->cover_image)); ?>" alt="<?php echo e($book->title); ?>">
                    <?php else: ?>
                        <div class="book-placeholder">Cover Buku</div>
                    <?php endif; ?>
                </div>
                <div class="book-content">
                    <h3><?php echo e($book->title); ?></h3>
                    <p class="book-author">Oleh: <?php echo e($book->author); ?></p>
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
                        <span class="book-price">Rp<?php echo e(number_format($book->price, 0, ',', '.')); ?></span>
                    </div>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(Auth::user()->isAdmin()): ?>
                            <div class="book-admin-actions">
                                <a href="<?php echo e(route('books.edit', $book->id)); ?>" class="btn btn-secondary btn-sm">Edit</a>
                                <form action="<?php echo e(route('books.destroy', $book->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus buku ini?')">Hapus</button>
                                </form>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="no-books">
                <p>Tidak ada buku tersedia.</p>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="pagination">
            <?php echo e($books->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Hype\ruangkasep\resources\views/books/index.blade.php ENDPATH**/ ?>