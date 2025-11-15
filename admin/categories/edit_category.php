<?php
session_start();
require_once '../config/database.php';
require_once '../config/config.php';

if(!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Handle update
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    
    // Validasi
    if(empty($name)) {
        $error = 'Nama kategori wajib diisi';
    } else {
        // Update ke database
        $stmt = $pdo->prepare("UPDATE categories SET name=?, slug=?, description=? WHERE id=?");
        $result = $stmt->execute([$name, $slug, $description, $id]);
        
        if($result) {
            $success = 'Kategori berhasil diperbarui!';
        } else {
            $error = 'Gagal memperbarui kategori';
        }
    }
}

// Get category data
if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: manage_categories.php');
    exit;
}

$category_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM categories WHERE id = ?");
$stmt->execute([$category_id]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$category) {
    header('Location: manage_categories.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori - RUANGKASEP</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="admin-container">
        <?php include 'admin_header.php'; ?>
        
        <div class="admin-content">
            <div class="admin-header">
                <h1>Edit Kategori</h1>
                <a href="manage_categories.php" class="btn">Kembali</a>
            </div>
            
            <?php if(isset($error)): ?>
            <div class="alert error"><?= $error ?></div>
            <?php endif; ?>
            
            <?php if(isset($success)): ?>
            <div class="alert success"><?= $success ?></div>
            <?php endif; ?>
            
            <form method="POST" class="admin-form">
                <input type="hidden" name="id" value="<?= $category['id'] ?>">
                
                <div class="form-group">
                    <label for="name">Nama Kategori</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($category['name']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" id="slug" name="slug" value="<?= htmlspecialchars($category['slug']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" rows="3"><?= htmlspecialchars($category['description']) ?></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Perbarui Kategori</button>
            </form>
        </div>
    </div>
</body>
</html>