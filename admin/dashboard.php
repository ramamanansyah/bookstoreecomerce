<?php
session_start();
require_once '../config/database.php';
require_once '../config/config.php';

if(!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Statistik
$total_posts = $pdo->query("SELECT COUNT(*) FROM posts")->fetchColumn();
$total_categories = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
$total_users = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();

// Postingan terbaru
$newest_posts = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - RUANGKASEP</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="admin-container">
        <?php include 'admin_header.php'; ?>
        
        <div class="admin-content">
            <h1>Dashboard Admin</h1>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <h3><?= $total_posts ?></h3>
                    <p>Postingan</p>
                </div>
                <div class="stat-card">
                    <h3><?= $total_categories ?></h3>
                    <p>Kategori</p>
                </div>
                <div class="stat-card">
                    <h3><?= $total_users ?></h3>
                    <p>Pengguna</p>
                </div>
            </div>
            
            <div class="recent-posts">
                <h2>Postingan Terbaru</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($newest_posts as $post): ?>
                        <tr>
                            <td><?= htmlspecialchars($post['title']) ?></td>
                            <td><?= $post['status'] ?></td>
                            <td><?= date('d M Y', strtotime($post['created_at'])) ?></td>
                            <td>
                                <a href="posts/edit_post.php?id=<?= $post['id'] ?>">Edit</a>
                                <a href="posts/delete_post.php?id=<?= $post['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>