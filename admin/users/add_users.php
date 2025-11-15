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
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    
    // Validasi
    if(empty($username) || empty($password) || empty($email)) {
        $error = 'Semua field wajib diisi';
    } else {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        // Simpan ke database
        $stmt = $pdo->prepare("INSERT INTO admin_users (username, password, email) VALUES (?, ?, ?)");
        $result = $stmt->execute([$username, $hashed_password, $email]);
        
        if($result) {
            $success = 'Admin berhasil ditambahkan!';
        } else {
            $error = 'Gagal menambahkan admin';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin - RUANGKASEP</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="admin-container">
        <?php include 'admin_header.php'; ?>
        
        <div class="admin-content">
            <div class="admin-header">
                <h1>Tambah Admin Baru</h1>
                <a href="manage_users.php" class="btn">Kembali</a>
            </div>
            
            <?php if($error): ?>
            <div class="alert error"><?= $error ?></div>
            <?php endif; ?>
            
            <?php if($success): ?>
            <div class="alert success"><?= $success ?></div>
            <?php endif; ?>
            
            <form method="POST" class="admin-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Simpan Admin</button>
            </form>
        </div>
    </div>
</body>
</html>