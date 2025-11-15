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
        // Update ke database
        $stmt = $pdo->prepare("UPDATE posts SET title=?, content=?, excerpt=?, category_id=?, status=?, user_id=?, featured_image=?, slug=? WHERE id=?");
        $slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $title));
        $result = $stmt->execute([
            $title, $content, $excerpt, $category_id, $status, $user_id, $featured_image, $slug, $id
        ]);
        
        if($result) {
            $success = 'Postingan berhasil diperbarui!';
        } else {
            $error = 'Gagal memperbarui postingan';
        }
    }
}

// Get post data
if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: manage_posts.php');
    exit;
}

$post_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$post) {
    header('Location: manage_posts.php');
    exit;
}

// Get categories
$category_stmt = $pdo->query("SELECT * FROM categories ORDER BY name");
$categories = $category_stmt->fetchAll(PDO::FETCH_ASSOC);

// Get users
$user_stmt = $pdo->query("SELECT * FROM users ORDER BY name");
$users = $user_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Postingan - RUANGKASEP</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="admin-container">
        <?php include 'admin_header.php'; ?>
        
        <div class="admin-content">
            <div class="admin-header">
                <h1>Edit Postingan</h1>
                <a href="manage_posts.php" class="btn">Kembali</a>
            </div>
            
            <?php if(isset($error)): ?>
            <div class="alert error"><?= $error ?></div>
            <?php endif; ?>
            
            <?php if(isset($success)): ?>
            <div class="alert success"><?= $success ?></div>
            <?php endif; ?>
            
            <form method="POST" class="admin-form">
                <input type="hidden" name="id" value="<?= $post['id'] ?>">
                
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="user_id">Penulis</label>
                    <select id="user_id" name="user_id" required>
                        <?php foreach($users as $user): ?>
                        <option value="<?= $user['id'] ?>" <?php echo $user['id'] == $post['user_id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($user['name']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="category_id">Kategori</label>
                    <select id="category_id" name="category_id">
                        <option value="">Pilih Kategori</option>
                        <?php foreach($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" <?php echo $category['id'] == $post['category_id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="draft" <?php echo $post['status'] == 'draft' ? 'selected' : ''; ?>>Draft</option>
                        <option value="published" <?php echo $post['status'] == 'published' ? 'selected' : ''; ?>>Published</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="excerpt">Excerpt</label>
                    <textarea id="excerpt" name="excerpt" rows="3"><?= htmlspecialchars($post['excerpt']) ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="featured_image">Featured Image URL</label>
                    <input type="url" id="featured_image" name="featured_image" value="<?= htmlspecialchars($post['featured_image']) ?>">
                </div>
                
                <div class="form-group">
                    <label for="content">Konten</label>
                    <textarea id="content" name="content" rows="15" required><?= htmlspecialchars_decode($post['content']) ?></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Perbarui Postingan</button>
            </form>
        </div>
    </div>
</body>
</html>