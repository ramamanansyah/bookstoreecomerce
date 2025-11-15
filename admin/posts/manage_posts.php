<?php
session_start();
require_once '../config/database.php';
require_once '../config/config.php';

if(!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Handle delete
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: manage_posts.php?message=deleted');
    exit;
}

// Get all posts
$stmt = $pdo->query("SELECT p.*, u.name as author_name, c.name as category_name 
                     FROM posts p 
                     LEFT JOIN users u ON p.user_id = u.id 
                     LEFT JOIN categories c ON p.category_id = c.id 
                     ORDER BY p.created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Postingan - RUANGKASEP</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="admin-container">
        <?php include 'admin_header.php'; ?>
        
        <div class="admin-content">
            <div class="admin-header">
                <h1>Manajemen Postingan</h1>
                <a href="add_post.php" class="btn btn-primary">Tambah Postingan</a>
            </div>
            
            <?php if(isset($_GET['message']) && $_GET['message'] == 'deleted'): ?>
            <div class="alert success">Postingan berhasil dihapus!</div>
            <?php endif; ?>
            
            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($posts as $post): ?>
                    <tr>
                        <td><?= htmlspecialchars($post['title']) ?></td>
                        <td><?= $post['category_name'] ? htmlspecialchars($post['category_name']) : '-' ?></td>
                        <td><?= htmlspecialchars($post['author_name']) ?></td>
                        <td><?= $post['status'] ?></td>
                        <td><?= date('d M Y', strtotime($post['created_at'])) ?></td>
                        <td>
                            <a href="edit_post.php?id=<?= $post['id'] ?>">Edit</a>
                            <a href="?delete=<?= $post['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>