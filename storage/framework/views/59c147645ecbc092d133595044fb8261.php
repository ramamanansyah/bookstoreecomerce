

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="profile">
        <h1>Profil Pengguna</h1>
        
        <div class="profile-info">
            <div class="profile-header">
                <div class="profile-avatar">
                    <?php if(Auth::user()->avatar): ?>
                        <img src="<?php echo e(asset('storage/' . Auth::user()->avatar)); ?>" alt="Avatar" class="avatar-img">
                    <?php else: ?>
                        <i class="fas fa-user fa-3x"></i>
                    <?php endif; ?>
                </div>
                <div class="profile-details">
                    <h2><?php echo e(Auth::user()->name); ?></h2>
                    <p><?php echo e(Auth::user()->email); ?></p>
                    <p>Anggota sejak: <?php echo e(Auth::user()->created_at->format('d M Y')); ?></p>
                </div>
            </div>
            
            <div class="profile-form">
                <h3>Edit Profil</h3>
                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>
                
                <form method="POST" action="<?php echo e(route('profile.update')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="<?php echo e(old('name', Auth::user()->name)); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo e(old('email', Auth::user()->email)); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="avatar">Foto Profil</label>
                        <input type="file" id="avatar" name="avatar" accept="image/*">
                        <?php if(Auth::user()->avatar): ?>
                            <p>Foto profil saat ini: <?php echo e(basename(Auth::user()->avatar)); ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Hype\ruangkasep\resources\views/pages/profile.blade.php ENDPATH**/ ?>