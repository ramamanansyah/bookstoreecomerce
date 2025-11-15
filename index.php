<?php
require_once 'config/database.php';
require_once 'config/config.php';
include 'includes/header.php';

// Ambil postingan terbaru
$stmt = $pdo->prepare("SELECT p.*, u.name as author_name, c.name as category_name 
                      FROM posts p 
                      LEFT JOIN users u ON p.user_id = u.id 
                      LEFT JOIN categories c ON p.category_id = c.id 
                      WHERE p.status = 'published' 
                      ORDER BY p.created_at DESC 
                      LIMIT 5");
$stmt->execute();
$latest_posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil data dari Google Scholar
$scholar_data = getGoogleScholarData();

// Ambil data programming content
$programming_content = getProgrammingContent();
?>

<div class="container">
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Selamat Datang di RUANGKASEP</h1>
            <p class="hero-subtitle">Portfolio dan Blog Kasep</p>
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number"><?= $scholar_data['citations'] ?></span>
                    <span class="stat-label">Citations</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number"><?= $scholar_data['h_index'] ?></span>
                    <span class="stat-label">H-Index</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number"><?= $scholar_data['publications'] ?></span>
                    <span class="stat-label">Publications</span>
                </div>
            </div>
        </div>
    </section>

    <section class="featured-posts">
        <h2>Programming Resources</h2>
        <div class="posts-grid">
            <?php foreach($programming_content as $content): ?>
            <article class="post-card" onclick="showContentModal(<?= $content['id'] ?>)">
                <div class="card-image">
                    <?php if($content['image']): ?>
                    <img src="<?= htmlspecialchars($content['image']) ?>" alt="<?= htmlspecialchars($content['title']) ?>">
                    <?php else: ?>
                    <img src="assets/images/default.jpg" alt="Default Image">
                    <?php endif; ?>
                </div>
                <h3><?= htmlspecialchars($content['title']) ?></h3>
                <p><?= htmlspecialchars(substr($content['excerpt'], 0, 100)) ?>...</p>
                <div class="card-footer">
                    <a href="#" onclick="showContentModal(<?= $content['id'] ?>); return false;" class="read-more">Baca Selengkapnya</a>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="about-section">
        <h2>Tentang Saya</h2>
        <div class="about-content">
            <div class="about-text">
                <p>Saya adalah seorang peneliti dan pengembang perangkat lunak dengan fokus pada bidang ilmu komputer dan kecerdasan buatan. Saya aktif dalam penelitian dan publikasi ilmiah.</p>
                <p>Berikut adalah beberapa informasi tentang saya dari Google Scholar:</p>
                <ul>
                    <li><strong>Affiliation:</strong> <?= $scholar_data['affiliation'] ?></li>
                    <li><strong>Research Areas:</strong> <?= implode(', ', $scholar_data['research_areas']) ?></li>
                    <li><strong>Profile:</strong> <a href="<?= $scholar_data['profile_url'] ?>" target="_blank">Google Scholar Profile</a></li>
                </ul>
            </div>
        </div>
    </section>

    <section class="featured-posts">
        <h2>Postingan Terbaru</h2>
        <div class="posts-grid">
            <?php foreach($latest_posts as $post): ?>
            <article class="post-card">
                <h3><a href="blog/post.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h3>
                <div class="post-meta">
                    <span><?= date('d M Y', strtotime($post['created_at'])) ?></span>
                    <?php if($post['category_name']): ?>
                    <span class="category-badge"><?= htmlspecialchars($post['category_name']) ?></span>
                    <?php endif; ?>
                </div>
                <p><?= htmlspecialchars(substr($post['excerpt'], 0, 150)) ?>...</p>
                <a href="blog/post.php?id=<?= $post['id'] ?>" class="read-more">Baca Selengkapnya</a>
            </article>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<!-- Modal Content -->
<div id="contentModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="modalBody"></div>
    </div>
</div>

<script>
// Modal script
const modal = document.getElementById('contentModal');
const span = document.getElementsByClassName('close')[0];

// Close the modal when clicking on x
span.onclick = function() {
    modal.style.display = "none";
}

// Close the modal when clicking outside of it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Function to show content in modal
function showContentModal(id) {
    const content = <?= json_encode($programming_content) ?>;
    const item = content.find(item => item.id === id);
    
    if (item) {
        const modalBody = document.getElementById('modalBody');
        modalBody.innerHTML = `
            <h2>${item.title}</h2>
            <div class="modal-image">
                <img src="${item.image}" alt="${item.title}">
            </div>
            <p>${item.content}</p>
            <div class="modal-link">
                <a href="${item.link}" target="_blank" class="btn">Baca Lebih Lanjut</a>
            </div>
        `;
        modal.style.display = "block";
    }
}
</script>

<?php include 'includes/footer.php'; ?>