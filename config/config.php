<?php
// Konfigurasi situs
define('SITE_URL', 'http://localhost/ruangkasep');
define('SITE_NAME', 'RUANGKASEP');
define('SITE_DESCRIPTION', 'Portfolio and Blog of Kasep');

// Fungsi untuk mengambil data dari Google Scholar
function getGoogleScholarData() {
    // Data dummy sesuai dengan profil Google Scholar
    return [
        'citations' => 1250,
        'h_index' => 23,
        'i10_index' => 45,
        'publications' => 67,
        'affiliation' => 'Universitas Indonesia',
        'research_areas' => ['Computer Science', 'Artificial Intelligence', 'Data Mining'],
        'profile_url' => 'https://scholar.google.com/citations?user=MrQXJVoAAAAJ&hl=id'
    ];
}

// Fungsi untuk mengambil data programing
function getProgrammingContent() {
    return [
        [
            'id' => 1,
            'title' => 'Laragon',
            'excerpt' => 'Laragon adalah lingkungan pengembangan web yang sangat mudah digunakan untuk Windows.',
            'content' => 'Laragon adalah lingkungan pengembangan web yang sangat mudah digunakan untuk Windows. Laragon menyediakan semua yang dibutuhkan untuk mengembangkan aplikasi web, termasuk Apache, Nginx, MySQL, PHP, Node.js, Python, Ruby, dan lainnya. Ini sangat cocok untuk pengembang yang ingin memiliki lingkungan pengembangan yang lengkap dan mudah digunakan.',
            'link' => 'https://laragon.org/',
            'image' => 'assets/images/laragon.png'
        ],
        [
            'id' => 2,
            'title' => 'Laravel',
            'excerpt' => 'Laravel adalah framework PHP yang populer untuk pengembangan aplikasi web.',
            'content' => 'Laravel adalah framework PHP yang populer untuk pengembangan aplikasi web. Framework ini dirancang untuk membuat pengembangan web menjadi lebih menyenangkan dan efisien. Laravel menyediakan fitur-fitur canggih seperti routing, ORM, queue, cache, dan banyak lagi. Laravel juga memiliki komunitas yang besar dan dokumentasi yang baik.',
            'link' => 'https://laravel.com/',
            'image' => 'assets/images/laravel.png'
        ],
        [
            'id' => 3,
            'title' => 'PHP',
            'excerpt' => 'PHP adalah bahasa pemrograman server-side yang digunakan untuk pengembangan web.',
            'content' => 'PHP adalah bahasa pemrograman server-side yang digunakan untuk pengembangan web. PHP sangat populer karena kemudahan penggunaannya dan kemampuan untuk mengintegrasikan dengan berbagai database. PHP juga mendukung berbagai framework modern seperti Laravel, Symfony, dan CodeIgniter.',
            'link' => 'https://www.php.net/',
            'image' => 'assets/images/php.png'
        ],
        [
            'id' => 4,
            'title' => 'MySQL',
            'excerpt' => 'MySQL adalah sistem manajemen basis data relational yang populer.',
            'content' => 'MySQL adalah sistem manajemen basis data relational yang populer dan digunakan secara luas dalam pengembangan web. MySQL merupakan bagian dari stack LAMP (Linux, Apache, MySQL, PHP) dan merupakan pilihan utama untuk aplikasi web berbasis PHP. MySQL dikenal karena kinerjanya yang baik dan kemudahan penggunaannya.',
            'link' => 'https://www.mysql.com/',
            'image' => 'assets/images/mysql.png'
        ],
        [
            'id' => 5,
            'title' => 'JavaScript',
            'excerpt' => 'JavaScript adalah bahasa pemrograman yang digunakan untuk pengembangan web frontend dan backend.',
            'content' => 'JavaScript adalah bahasa pemrograman yang digunakan untuk pengembangan web frontend dan backend. JavaScript sangat penting dalam pengembangan web modern karena dapat membuat halaman web interaktif. Dengan Node.js, JavaScript juga bisa digunakan untuk pengembangan backend.',
            'link' => 'https://developer.mozilla.org/en-US/docs/Web/JavaScript',
            'image' => 'assets/images/javascript.png'
        ],
        [
            'id' => 6,
            'title' => 'Git',
            'excerpt' => 'Git adalah sistem kontrol versi yang digunakan oleh para developer.',
            'content' => 'Git adalah sistem kontrol versi yang digunakan oleh para developer untuk melacak perubahan dalam kode sumber dan mengelola proyek perangkat lunak. Git memungkinkan kolaborasi tim yang efektif dan memungkinkan developer untuk bekerja secara paralel tanpa mengganggu satu sama lain. Git juga mendukung branching dan merging yang kuat.',
            'link' => 'https://git-scm.com/',
            'image' => 'assets/images/git.png'
        ]
    ];
}
?>