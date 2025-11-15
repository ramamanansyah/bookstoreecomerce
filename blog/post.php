<?php
require_once '../config/database.php';
require_once '../config/config.php';
include '../includes/header.php';

if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$post_id = $_GET['id'];

// Ambil detail post
$stmt = $pdo->prepare("SELECT p.*, u.name as author_name, c.name as category_name 
                      FROM posts p 
                      LEFT JOIN users u ON p.user_id = u.id 
                      LEFT JOIN categories c ON p.category_id = c.id 
                      WHERE p.id = ? AND p.status = 'published'");
$stmt->execute([$post_id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$post) {
    header('Location: index.php');
    exit;
}

// Ambil postingan terkait
$related_stmt = $pdo->prepare("SELECT * FROM posts WHERE status = 'published' AND id != ? AND category_id = ? ORDER BY created_at DESC LIMIT 3");
$related_stmt->execute([$post_id, $post['category_id']]);
$related_posts = $related_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="single-post">
        <article class="post-content">
            <h1><?= htmlspecialchars($post['title']) ?></h1>
            <div class="post-meta">
                <span><i class="far fa-calendar"></i> <?= date('d M Y', strtotime($post['created_at'])) ?></span>
                <span><i class="far fa-user"></i> <?= htmlspecialchars($post['author_name']) ?></span>
                <?php if($post['category_name']): ?>
                <span class="category-badge"><?= htmlspecialchars($post['category_name']) ?></span>
                <?php endif; ?>
            </div>
            
            <?php if($post['featured_image']): ?>
            <div class="post-image">
                <img src="<?= htmlspecialchars($post['featured_image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>">
            </div>
            <?php endif; ?>
            
            <div class="post-body">
                <?= nl2br(htmlspecialchars_decode($post['content'])) ?>
            </div>
        </article>
        
        <div class="related-posts">
            <h3>Postingan Terkait</h3>
            <div class="posts-grid">
                <?php foreach($related_posts as $related): ?>
                <article class="post-card">
                    <h4><a href="post.php?id=<?= $related['id'] ?>"><?= htmlspecialchars($related['title']) ?></a></h4>
                    <p><?= htmlspecialchars(substr($related['excerpt'], 0, 100)) ?>...</p>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>