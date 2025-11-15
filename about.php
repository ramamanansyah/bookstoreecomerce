<?php
require_once 'config/database.php';
require_once 'config/config.php';
include 'includes/header.php';

// Ambil data dari Google Scholar (contoh data)
$scholar_data = getGoogleScholarData();
?>

<div class="container">
    <section class="about-section">
        <h1>Tentang Saya</h1>
        <div class="about-content">
            <div class="about-text">
                <p>Halo! Saya Kasep, seorang peneliti dan pengembang perangkat lunak yang berfokus pada bidang ilmu komputer dan kecerdasan buatan.</p>
                
                <h2>Informasi Google Scholar</h2>
                <div class="scholar-info">
                    <p><strong>Affiliation:</strong> <?= $scholar_data['affiliation'] ?></p>
                    <p><strong>Citations:</strong> <?= $scholar_data['citations'] ?></p>
                    <p><strong>H-Index:</strong> <?= $scholar_data['h_index'] ?></p>
                    <p><strong>I-10 Index:</strong> <?= $scholar_data['i10_index'] ?></p>
                    <p><strong>Publications:</strong> <?= $scholar_data['publications'] ?></p>
                    <p><strong>Research Areas:</strong> <?= implode(', ', $scholar_data['research_areas']) ?></p>
                    <p><strong>Profile:</strong> <a href="<?= $scholar_data['profile_url'] ?>" target="_blank">Google Scholar Profile</a></p>
                </div>
                
                <h2>Profil Lengkap</h2>
                <p>Saya memiliki pengalaman dalam berbagai bidang teknologi informasi, termasuk:</p>
                <ul>
                    <li>Machine Learning</li>
                    <li>Data Mining</li>
                    <li>Web Development</li>
                    <li>Research Publication</li>
                    <li>Software Engineering</li>
                </ul>
            </div>
        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>