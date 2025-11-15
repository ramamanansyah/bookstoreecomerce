<?php
require_once '../config/database.php';
require_once '../config/config.php';
include '../includes/header.php';

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5;
$offset = ($page - 1) * $limit;

// Hitung total posts
$total_stmt = $pdo->query("SELECT COUNT(*) FROM posts WHERE status = 'published'");
$total_posts = $total_stmt->fetchColumn();
$total_pages = ceil($total_posts / $limit);

// Ambil posts
$stmt = $pdo->prepare("SELECT p.*, u.name as author_name, c.name as category_name 
                      FROM posts p 
                      LEFT JOIN users u ON p.user_id = u.id 
                      LEFT JOIN categories c ON p.category_id = c.id 
                      WHERE p.status = 'published' 
                      ORDER BY p.created_at DESC 
                      LIMIT ? OFFSET ?");
$stmt->execute([$limit, $offset]);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil kategori
$category_stmt = $pdo->query("SELECT * FROM categories ORDER BY name");
$categories = $category_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="blog-wrapper">
        <div class="blog-main">
            <h1>Blog Posts</h1>
            
            <?php if(!empty($posts)): ?>
            <div class="posts-list">
                <?php foreach($posts as $post): ?>
                <article class="post-item">
                    <div class="post-image">
                        <?php if($post['featured_image']): ?>
                        <img src="<?= htmlspecialchars($post['featured_image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>">
                        <?php else: ?>
                        <img src="assets/images/default.jpg" alt="Default Image">
                        <?php endif; ?>
                    </div>
                    <div class="post-content">
                        <h2><a href="post.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h2>
                        <div class="post-meta">
                            <span><i class="far fa-calendar"></i> <?= date('d M Y', strtotime($post['created_at'])) ?></span>
                            <span><i class="far fa-user"></i> <?= htmlspecialchars($post['author_name']) ?></span>
                            <?php if($post['category_name']): ?>
                            <span class="category-badge"><?= htmlspecialchars($post['category_name']) ?></span>
                            <?php endif; ?>
                        </div>
                        <p><?= htmlspecialchars(substr($post['excerpt'], 0, 200)) ?>...</p>
                        <a href="post.php?id=<?= $post['id'] ?>" class="read-more">Baca Selengkapnya</a>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
            
            <!-- Pagination -->
            <div class="pagination">
                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?= $i ?>" <?php echo $i == $page ? 'class="active"' : ''; ?>><?= $i ?></a>
                <?php endfor; ?>
            </div>
            <?php else: ?>
            <p>Tidak ada postingan ditemukan.</p>
            <?php endif; ?>
        </div>
        
        <aside class="blog-sidebar">
            <div class="sidebar-widget">
                <h3>Kategori</h3>
                <ul class="category-list">
                    <?php foreach($categories as $category): ?>
                    <li><a href="category.php?slug=<?= $category['slug'] ?>"><?= htmlspecialchars($category['name']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <div class="sidebar-widget">
                <h3>Tentang Saya</h3>
                <p>Saya adalah peneliti dan pengembang perangkat lunak dengan fokus pada bidang ilmu komputer dan kecerdasan buatan.</p>
            </div>
        </aside>
    </div>
</div>

<?php include '../includes/footer.php'; ?>