<?php
require_once 'config/database.php';
require_once 'config/config.php';
include 'includes/header.php';
?>

<div class="container">
    <section class="contact-section">
        <h1>Kontak Saya</h1>
        <div class="contact-content">
            <div class="contact-info">
                <h2>Informasi Kontak</h2>
                <p>Anda dapat menghubungi saya melalui informasi berikut:</p>
                
                <div class="contact-details">
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>admin@ruangkasep.com</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Universitas Indonesia</span>
                    </div>
                </div>
            </div>
            
            <div class="contact-form">
                <h2>Kirim Pesan</h2>
                <form method="POST">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Nama Anda" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email Anda" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" placeholder="Subjek" required>
                    </div>
                    <div class="form-group">
                        <textarea name="message" placeholder="Pesan Anda" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>