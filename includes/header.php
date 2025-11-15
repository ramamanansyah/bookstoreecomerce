<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= SITE_DESCRIPTION ?>">
    <title><?= SITE_NAME ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header class="main-header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <h1><a href="index.php"><?= SITE_NAME ?></a></h1>
                </div>
                <nav class="main-nav">
                    <ul>
                        <li><a href="index.php">Beranda</a></li>
                        <li><a href="blog/">Blog</a></li>
                        <li><a href="about.php">Tentang</a></li>
                        <li><a href="contact.php">Kontak</a></li>
                        <?php if(isset($_SESSION['admin_logged_in'])): ?>
                            <li><a href="admin/dashboard.php">Admin</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>