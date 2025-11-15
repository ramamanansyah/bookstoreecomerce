<?php
session_start();
require_once '../config/database.php';
require_once '../config/config.php';

if(!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$error = '';
$success = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    
    // Validasi
    if(empty($name)) {
        $error = 'Nama kategori wajib diisi';
    } else {
        // Simpan ke database
        $stmt = $pdo->prepare("INSERT INTO categories (name, slug, description) VALUES (?, ?, ?)");
        $result = $stmt->execute([$name, $slug, $description]);
        
        if($result) {
            $success = 'Kategori berhasil ditambahkan!';
        } else {
            $error = 'Gagal menambahkan kategori';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori - RUANGKASEP</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="admin-container">
        <?php include 'admin_header.php'; ?>
        
        <div class="admin-content">
            <div class="admin-header">
                <h1>Tambah Kategori Baru</h1>
                <a href="manage_categories.php" class="btn">Kembali</a>
            </div>
            
            <?php if($error): ?>
            <div class="alert error"><?= $error ?></div>
            <?php endif; ?>
            
            <?php if($success): ?>
            <div class="alert success"><?= $success ?></div>
            <?php endif; ?>
            
            <form method="POST" class="admin-form">
                <div class="form-group">
                    <label for="name">Nama Kategori</label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" id="slug" name="slug" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" rows="3"></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Simpan Kategori</button>
            </form>
        </div>
    </div>
</body>
</html>