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

// Get categories
$category_stmt = $pdo->query("SELECT * FROM categories ORDER BY name");
$categories = $category_stmt->fetchAll(PDO::FETCH_ASSOC);

// Get users
$user_stmt = $pdo->query("SELECT * FROM users ORDER BY name");
$users = $user_stmt->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $excerpt = $_POST['excerpt'];
    $category_id = $_POST['category_id'];
    $status = $_POST['status'];
    $user_id = $_POST['user_id'];
    $featured_image = $_POST['featured_image'];
    
    // Validasi
    if(empty($title) || empty($content)) {
        $error = 'Judul dan konten wajib diisi';
    } else {
        // Simpan ke database
        $stmt = $pdo->prepare("INSERT INTO posts (title, content, excerpt, category_id, status, user_id, featured_image, slug) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $title));
        $result = $stmt->execute([
            $title, $content, $excerpt, $category_id, $status, $user_id, $featured_image, $slug
        ]);
        
        if($result) {
            $success = 'Postingan berhasil ditambahkan!';
        } else {
            $error = 'Gagal menambahkan postingan';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Postingan - RUANGKASEP</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="admin-container">
        <?php include 'admin_header.php'; ?>
        
        <div class="admin-content">
            <div class="admin-header">
                <h1>Tambah Postingan Baru</h1>
                <a href="manage_posts.php" class="btn">Kembali</a>
            </div>
            
            <?php if($error): ?>
            <div class="alert error"><?= $error ?></div>
            <?php endif; ?>
            
            <?php if($success): ?>
            <div class="alert success"><?= $success ?></div>
            <?php endif; ?>
            
            <form method="POST" class="admin-form">
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" id="title" name="title" required>
                </div>
                
                <div class="form-group">
                    <label for="user_id">Penulis</label>
                    <select id="user_id" name="user_id" required>
                        <?php foreach($users as $user): ?>
                        <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="category_id">Kategori</label>
                    <select id="category_id" name="category_id">
                        <option value="">Pilih Kategori</option>
                        <?php foreach($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="excerpt">Excerpt</label>
                    <textarea id="excerpt" name="excerpt" rows="3"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="featured_image">Featured Image URL</label>
                    <input type="url" id="featured_image" name="featured_image">
                </div>
                
                <div class="form-group">
                    <label for="content">Konten</label>
                    <textarea id="content" name="content" rows="15" required></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Simpan Postingan</button>
            </form>
        </div>
    </div>
</body>
</html>