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
    // Hanya hapus jika bukan admin utama
    if($id != 1) {
        $stmt = $pdo->prepare("DELETE FROM admin_users WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: manage_users.php?message=deleted');
    } else {
        header('Location: manage_users.php?message=error');
    }
    exit;
}

// Get all admin users
$stmt = $pdo->query("SELECT * FROM admin_users ORDER BY created_at DESC");
$admin_users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Admin - RUANGKASEP</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="admin-container">
        <?php include 'admin_header.php'; ?>
        
        <div class="admin-content">
            <div class="admin-header">
                <h1>Manajemen Admin</h1>
                <a href="add_user.php" class="btn btn-primary">Tambah Admin</a>
            </div>
            
            <?php if(isset($_GET['message'])): ?>
                <?php if($_GET['message'] == 'deleted'): ?>
                    <div class="alert success">Admin berhasil dihapus!</div>
                <?php elseif($_GET['message'] == 'error'): ?>
                    <div class="alert error">Tidak bisa menghapus admin utama!</div>
                <?php endif; ?>
            <?php endif; ?>
            
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($admin_users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= date('d M Y', strtotime($user['created_at'])) ?></td>
                        <td>
                            <?php if($user['id'] != 1): ?>
                            <a href="?delete=<?= $user['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>